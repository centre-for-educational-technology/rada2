<?php


namespace App\Traits;


use App\Exceptions\UnknownExternalImageProvider;
use App\ExternalImageResource;
use App\Image;
use App\Services\AjapaikService;
use App\Services\Exceptions\PhotoDataNotLoaded;
use App\Services\Exceptions\UnreachableUrl;
use App\Services\ImageService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Http\UploadedFile;

trait InteractsWithImage
{
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'model');
    }

    /**
     * Add uploaded image to an existing model. Existing image will be removed.
     *
     * @param UploadedFile $file
     * @param int|null $dimensionsConstraint
     *
     * @return Image
     *
     * @throws \Exception
     */
    public function addImage(UploadedFile $file, int $dimensionsConstraint = null): Image
    {
        $imageService = app(ImageService::class);
        $previousImage = $this->getImage();

        $path = $this->getStoragePath();
        $originalExtension = $file->getClientOriginalExtension();
        $fileName = $imageService->generateUniqueFileName(self::FILE_NAME_PREFIX, $originalExtension);

        $imageService->process($file->getRealPath(), $path, $fileName, $dimensionsConstraint);

        $image = Image::create([
            'file_name' => $fileName,
            'path' => $path,
            'mime_type' => $file->getClientMimeType(),
            'size' => $file->getSize(),
        ]);
        $image->model()->associate($this)->save();

        if ($previousImage) {
            $previousImage->delete();
            $this->load('image');
        }

        return $image;
    }

    /**
     * Creates an image from an external url, adds provider data to custom properties and applies dimensions constraint
     * to the downloaded image file.
     *
     * @param string $imageUrl               External image URL.
     * @param array $providerData            Provider data for custom_properties.
     * @param int|null $dimensionsConstraint Dimensions constraint value.
     * @return Image                         Image model instance.
     *
     * @throws UnreachableUrl
     */
    private function createImageFromExternalUrl(string $imageUrl, array $providerData, int $dimensionsConstraint = null): Image
    {
        $path = $this->getStoragePath();
        $imageService = app(ImageService::class);
        $temporaryFile = $imageService->downloadImageFromUrl($imageUrl);
        $fileName = $imageService->generateUniqueFileName(self::FILE_NAME_PREFIX, $imageService::getFileExtension($temporaryFile));

        $imageService->process($temporaryFile, $path, $fileName, $dimensionsConstraint);

        $image = Image::create([
            'file_name' => $fileName,
            'path' => $path,
            'mime_type' => mime_content_type($temporaryFile),
            'size' => filesize($temporaryFile),
            'custom_properties' => [
                'provider' => $providerData,
            ],
        ]);
        $image->model()->associate($this)->save();

        return $image;
    }

    /**
     * @param string $provider
     * @param int $imageId
     * @param int|null $dimensionsConstraint
     *
     * @return Image|null
     *
     * @throws PhotoDataNotLoaded
     * @throws UnreachableUrl
     * @throws UnknownExternalImageProvider
     * @throws ModelNotFoundException
     * @throws \Exception
     */
    public function addImageFromExternalProvider(string $provider, int $imageId, int $dimensionsConstraint = null): ?Image
    {
        $image = null;
        $previousImage = $this->getImage();

        // Location-based search uses local data and returns identifiers for ExternalImageResource items. Ajapaik
        // identifier is fetched from the database and provide name is set to the correct one.
        if ($provider === 'ajapaik_local') {
            $resource = ExternalImageResource::findOrFail($imageId);
            $imageId = (int) $resource->external_data['id'];
            $provider = 'ajapaik';
        }

        switch($provider) {
            case 'ajapaik':
                $ajapaikService = app(AjapaikService::class);

                $photoData = $ajapaikService->getPhotoJson($imageId);

                $image = $this->createImageFromExternalUrl($photoData['image'], [
                    'name' => $provider,
                    'id' => $photoData['id'],
                    'imageUrl' => $photoData['image'],
                ], $dimensionsConstraint);
                break;
            case 'muinas':
                $resource = ExternalImageResource::findOrFail($imageId);

                $image = $this->createImageFromExternalUrl($resource->image_url, [
                    'name' => $provider,
                    'id' => (int) $resource->external_data['id'],
                    'imageUrl' => $resource->image_url,
                ], $dimensionsConstraint);
                break;
            default:
                throw new UnknownExternalImageProvider($provider);
        }

        if ($image && $previousImage) {
            $previousImage->delete();
            $this->load('image');
        }

        return $image;
    }

    /**
     * Determines if related image exists.
     *
     * @return bool
     */
    public function hasImage(): bool
    {
        return !!$this->getImage();
    }

    /**
     * Returns related image, if one exists.
     *
     * @return Image|null
     */
    public function getImage(): ?Image
    {
        return $this->image;
    }

    /**
     * Deletes related image, if one exists.
     *
     * @return bool|null
     *
     * @throws \Exception
     */
    public function deleteImage(): ?bool
    {
        if ($this->hasImage()) {
            $result = $this->getImage()->delete();
            $this->load('image');

            return $result;
        }

        return FALSE;
    }

    /**
     * Returns storage path for current entity.
     *
     * @return string
     */
    public function getStoragePath(): string
    {
        return self::getStoragePathForId($this->id);
    }

    /**
     * Returns storage path based on provided identifier and defined STORAGE_PATH_FORMAT constant.
     * Constant should be defined as '/<catalog-name>'&d/' with ending slash being required.
     *
     * @param int $id
     *
     * @return string
     */
    public static function getStoragePathForId(int $id): string
    {
        return sprintf(self::STORAGE_PATH_FORMAT, $id);
    }
}
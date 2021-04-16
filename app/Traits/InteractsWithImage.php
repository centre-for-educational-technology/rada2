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
     */
    public function addImageFromExternalProvider(string $provider, int $imageId, int $dimensionsConstraint = null): ?Image
    {
        $image = NULL;
        $previousImage = $this->getImage();

        $path = $this->getStoragePath();

        switch($provider) {
            case 'ajapaik':
                $ajapaikService = app(AjapaikService::class);
                $imageService = app(ImageService::class);

                $photoData = $ajapaikService->getPhotoJson($imageId);

                $temporaryFile = $imageService->downloadImageFromUrl($photoData['image']);
                $originalExtension = $imageService::getFileExtension($temporaryFile);
                $fileName = $imageService->generateUniqueFileName(self::FILE_NAME_PREFIX, $originalExtension);

                $imageService->process($temporaryFile, $path, $fileName, $dimensionsConstraint);

                $image = Image::create([
                    'file_name' => $fileName,
                    'path' => $path,
                    'mime_type' => mime_content_type($temporaryFile),
                    'size' => filesize($temporaryFile),
                    'custom_properties' => [
                        'provider' => [
                            'name' => $provider,
                            'id' => $photoData['id'],
                            'imageUrl' => $photoData['image'],
                        ],
                    ],
                ]);
                $image->model()->associate($this)->save();
                break;
            case 'muinas':
                $imageService = app(ImageService::class);

                // TODO Need to load with exception and handle one
                $resource = ExternalImageResource::findOrFail($imageId);
                $temporaryFile = $imageService->downloadImageFromUrl($resource->image_url);
                $originalExtension = $imageService::getFileExtension($temporaryFile);
                $fileName = $imageService->generateUniqueFileName(self::FILE_NAME_PREFIX, $originalExtension);

                $imageService->process($temporaryFile, $path, $fileName, $dimensionsConstraint);

                $image = Image::create([
                    'file_name' => $fileName,
                    'path' => $path,
                    'mime_type' => mime_content_type($temporaryFile),
                    'size' => filesize($temporaryFile),
                    'custom_properties' => [
                        'provider' => [
                            'name' => $provider,
                            'id' => (int)$resource->external_data['id'],
                            'imageUrl' => $resource->image_url,
                        ],
                    ],
                ]);
                $image->model()->associate($this)->save();
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
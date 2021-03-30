<?php


namespace App\Traits;


use App\Image;
use App\Services\AjapaikService;
use App\Services\Exceptions\PhotoDataNotLoaded;
use App\Services\ImageService;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Http\UploadedFile;

trait InteractsWithImage
{
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'model');
    }

    public function addImage(UploadedFile $file, int $dimensionsConstraint = null): Image
    {
        if ($this->hasImage()) {
            // TODO Need a special excpetion for this
            throw new \Exception();
        }

        $imageService = app(ImageService::class);

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

        return $image;
    }

    public function addImageFromExternalProvider(string $provider, int $imageId, int $dimensionsConstraint = null): ?Image
    {
        $path = $this->getStoragePath();
        // TODO Need to use switch with exception for unknown services
        switch($provider) {
            case 'ajapaik':
                $ajapaikService = app(AjapaikService::class);

                try {
                    $photoData = $ajapaikService->getPhotoJson($imageId);

                    if ($photoData) {
                        $imageService = app(ImageService::class);

                        $temporaryFile = $imageService->downloadImageFromUrl($photoData['image']);

                        $originalExtension = explode('/', mime_content_type($temporaryFile))[1];
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

                        return $image;
                    }

                } catch (PhotoDataNotLoaded $e) {
                    // TODO See if there is a need to handle this exception
                }
                break;
            default:
                throw new \Exception('Unknown external image provider ' . $provider);
        }

        return NULL;
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
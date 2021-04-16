<?php

namespace App\Services;

use App\Services\Exceptions\UnreachableUrl;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ImageService
{
    /**
     * Generates unique file name for newly uploaded image.
     * @param  string $prefix            Prefix to ensure more uniqueness
     * @param  string $originalExtension File original extension
     * @return string                    Image unique name with extension
     */
    public function generateUniqueFileName(string $prefix, string $originalExtension): string
    {
        return sha1( uniqid( $prefix, true ) ) . '.' . $originalExtension;
    }

    /**
     * Returns full path for a relative one given.
     * @param  string $path Relative path or image name
     * @return string       Full path
     */
    public function getStoragePath(string $path): string
    {
        return public_path('uploads/images/' . $path);
    }

    /**
     * Ensures taht directory for a given path exists or crares one.
     * @param  string $path Relative path
     * @return void
     */
    public function ensureDirectoryPath(string $path)
    {
        $fullPath = $this->getStoragePath($path);

        if ( !File::isDirectory($fullPath) )
        {
            File::makeDirectory($fullPath, 0755, true);
        }
    }

    /**
     * Process uploaded image, resizing and moving to final storage path.
     * Destroys the Image in memory representation as soon as it is done.
     * @param  string $sourcePath Full path to uploaded image
     * @param  string $path       Additional path if applicable or NULL
     * @param  string $fileName   Image file name
     * @param  int    $constraint Witdth and Height counstraint to be applied
     * @return void
     */
    public function process(string $sourcePath, string $path, string $fileName, int $constraint )
    {
        $imagePath = $path ? $path . $fileName : $fileName;
        $image = Image::make($sourcePath);

        if ( $constraint )
        {
            $imageHeight = $image->height();
            $imageWidth = $image->width();

            if ( $imageHeight > $constraint || $imageWidth > $constraint )
            {
                if ( $imageWidth >= $imageHeight )
                {
                    $image->resize($constraint, null, function($constraint) {
                        $constraint->upsize();
                        $constraint->aspectRatio();
                    });
                }
                else
                {
                    $image->resize(null, $constraint, function($constraint) {
                        $constraint->upsize();
                        $constraint->aspectRatio();
                    });
                }
            }
        }

        if ( $path )
        {
            $this->ensureDirectoryPath($path);
        }

        $image->save($this->getStoragePath($imagePath));
        $image->destroy();
    }

    /**
     * Delete image file
     * @param  string $path Relative path or file name
     * @return void
     */
    public function delete(string $path)
    {
        File::delete($this->getStoragePath($path));
    }

    /**
     * Download an image from url and save it to a temporary file.
     *
     * @param string $url URL of an image to download
     *
     * @return false|string
     *
     * @throws UnreachableUrl
     */
    public function downloadImageFromUrl(string $url)
    {
        if (!$stream = @fopen($url, 'r')) {
            throw new UnreachableUrl($url);
        }

        $temporaryFile = tempnam(sys_get_temp_dir(), 'downloaded-external-images');

        file_put_contents($temporaryFile, $stream);

        return $temporaryFile;
    }

    /**
     * Returns ori
     * @param string $path
     * @return string
     */
    public static function getFileExtension(string $path): string
    {
        return explode('/', mime_content_type($path))[1];
    }
}

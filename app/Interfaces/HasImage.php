<?php


namespace App\Interfaces;


use App\Image;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Http\UploadedFile;

interface HasImage
{
    public function image(): MorphOne;

    public function addImage(UploadedFile $file, int $dimensionsConstraint = null): Image;

    public function addImageFromExternalProvider(string $provider, int $imageId, int $dimensionsConstraint = null): ?Image;

    public function hasImage(): bool;

    public function getImage(): ?Image;

    public function deleteImage(): ?bool;

    public function getStoragePath(): string;

    public static function getStoragePathForId(int $id): string;
}
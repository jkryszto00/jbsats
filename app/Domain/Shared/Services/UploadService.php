<?php

namespace App\Domain\Shared\Services;

use App\Domain\Shared\Data\FileData;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadService
{
    public function logo(UploadedFile $file): FileData
    {
        return $this->upload(
            file: $file,
            collection: 'logos',
            public: true
        );
    }

    public function cv(UploadedFile $file): FileData
    {
        return $this->upload(
            file: $file,
            collection: 'cvs'
        );
    }

    private function upload(UploadedFile $file, string $collection, bool $public = false): FileData
    {
        $name = $file->hashName();
        $path = $this->makePath(collection: $collection, public: $public);
        $filePath = $path.$name;

        Storage::put($path, $file);

        return new FileData(
            name: $name,
            file_name: $file->getClientOriginalName(),
            mime_type: $file->getClientMimeType(),
            path: $filePath,
            disk: 'local',
            collection: $collection,
            size: $file->getSize()
        );
    }

    private function makePath(string $collection, bool $public): string
    {
        $collection = $collection.'/';

        if ($public) {
            return 'public/'.$collection;
        }

        return $collection;
    }
}

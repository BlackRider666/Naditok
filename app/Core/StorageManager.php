<?php


namespace App\Core;


use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class StorageManager
{
    /** @var string */
    protected $localPublicDisk = 'public';

    /**
     * @return Filesystem
     */
    public function getLocalPublicDisk(): Filesystem
    {
        return Storage::disk($this->localPublicDisk);
    }

    /**
     * @param UploadedFile $file
     * @param string $type
     * @param int $size
     * @return string
     */
    public function savePicture(UploadedFile $file, string $type, int $size): string
    {
        $image = Image::make($file)->resize($size,null, function ($constraint) {
            $constraint->aspectRatio();
        })->save();
        $filename = uniqid(time(), true) . '.' . $file->getClientOriginalExtension();
        if (!$this->getLocalPublicDisk()->exists($type)) {
            $this->getLocalPublicDisk()->makeDirectory($type);
        }
        $this->getLocalPublicDisk()->put($type . '/' . $filename, $image);

        return $filename;
    }

    /**
     * @param string $file
     * @param string $type
     */
    public function deleteFile(string $file, string $type): void
    {
        $this->getLocalPublicDisk()->delete($type.'/'.$file);
    }
}

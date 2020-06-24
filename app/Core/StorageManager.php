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

    public function savePictureFromUrl(string $avatar): string
    {
        $file = file_get_contents($avatar);
        $image = Image::make($file)->resize(400,null, function ($constraint) {
            $constraint->aspectRatio();
        })->save();
        $filename = uniqid(time(), true) . '.jpg';
        if (!$this->getLocalPublicDisk()->exists('user_avatar')) {
            $this->getLocalPublicDisk()->makeDirectory('user_avatar');
        }
        $this->getLocalPublicDisk()->put('user_avatar/' . $filename, $image);

        return $filename;
    }
}

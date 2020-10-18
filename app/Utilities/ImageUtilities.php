<?php
namespace App\Utilities;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use \File;
/**
 * @todo class summary here
 *
 * @package App\Utilities
 *
 * @uses Illuminate\Http\UploadedFile
 * @uses File
 */
class ImageUtilities
{

    /**
     * Utility function to store an image.
     *
     * This function stores $image in the public folder and
     * returns the new image's url.
     *
     * @param UploadedFile $image
     * @return string
     */
    public static function store_image(UploadedFile $image)
    {
        //create a unique name for the image using the current time and its
        //original name
        $path = $image->store('public/images');
        return Storage::url($path);
    }

    /**
     * Utility function to update an image.
     *
     * This function stores $image in the public /images/ folder,
     * deletes the old image, and returns the new image's url.
     *
     * @param UploadedFile $image
     * @param string $oldPhotoPath
     * @return string
     */
    public static function update_image(UploadedFile $image, string $oldPhotoPath)
    {

        $photo_url = ImageUtilities::store_image($image);
        ImageUtilities::remove_image($oldPhotoPath);

        return $photo_url;
    }
    /**
     * deletes the image located at the given file path.
     */
    public static function remove_image(string $photo_path){
        Storage::delete(str_replace("/storage", "public", $photo_path));
    }
}

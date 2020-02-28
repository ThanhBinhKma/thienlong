<?php 
namespace App\Helpers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
class UploadsHelper {
  public static function getFileExtension($name, $request) {
    if ($request->hasFile($name)) {
        $image = $request->file($name);
        return $image->getClientOriginalExtension();
    }
    return '';
  }

  public static function uploadFileOrigin($image, $uploadPath, $name , $request , $userId) {
    if ($request->hasFile($name)) {
      $imageName = $image->getClientOriginalName();
      $file_extension = self::getFileExtension($name, $request);
      return $file_extension;
      if (!is_dir($uploadPath)) {
          mkdir($uploadPath, 0777, true);
      }
      $image->move($uploadPath, $imageName);
      return '/' . $uploadPath . '/' . $imageName;
    }
  }

  public static function getOriginImage($name, $dir, $request, $userId) {
    if ($request->hasFile($name)) {
        $image = $request->file($name);
        // Upload file
        $uploadPath = str_replace('USERID', $userId, $dir);
        $image = self::uploadFileOrigin($image, $uploadPath , $name , $request , $userId);
        return $image;
    }
    return '';
  }

  public static function uploadAvatar($name , $uploadPath , $request , $userId) {
    if ($request->hasFile($name)) {
      $image = $request->file($name);
      $imageSize = $image->getSize();
      $maxSize = ceil(($imageSize/1024)/1024);
      if ($maxSize>5) {
        return false;
      } else {
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }
        $extension_file = $image->getClientOriginalExtension();
        $imageName = $image->getClientOriginalName();
        $newName = 'driver'.$userId.'.'.$extension_file;
        $image->move($uploadPath, $newName);
        return '/' . $uploadPath . '/' . $newName;
      }
    }
    return '';
  }
}

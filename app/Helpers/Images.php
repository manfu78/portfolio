
<?php

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

if(!function_exists('setImage600')){
    function setImage600 (Request $request, string $fieldName,string $folderName){
        if (!Storage::disk('public')->exists($folderName)) {
            Storage::disk('public')->makeDirectory($folderName);
        }
        $storagePath = storage_path()."/app/public/".$folderName;

        $manager = new ImageManager(new Driver());
        $imageName = date('YmdHis').'.'.$request->file($fieldName)->getClientOriginalExtension();
        $image = $manager->read($request->file($fieldName));

        $image = $image->resize(600, 600, function ($constraint) {
            $constraint->aspectRatio();
        });

        $image->save($storagePath.'/'.$imageName);
        $imageFormatedName = $folderName.'/'.$imageName;

        return $imageFormatedName;
    }
}



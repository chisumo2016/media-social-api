<?php
namespace App\Services ;

use Intervention\Image\Facades\Image;

class ImageService
{
    public function updateImage($model , $request , $path , $methodType)
    {
        $image = Image::make($request->file('image'));
        /**image isn't empty*/
        if (!empty($model->image)){
            $currentImage = public_path() . $path . $model->image; //model - user
            /** Image exist*/
            if(file_exists($currentImage)){
                unlink($currentImage);
            }
        }
        /** Take the image and put into variable*/
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();

        $image->crop(
            $request->width,
            $request->height,
            $request->left,
            $request->top,
        );
        $name = time() . '.' . $extension;

        /**Save into folder*/
        $image->save(public_path() .  $path . $name);

        if ($methodType === 'store'){
            /**Make new record with user id*/
            $model->user_id = $request->get('user_id');
        }

        /**Update */
        $model->image = $name;
        $model->save();

    }
}


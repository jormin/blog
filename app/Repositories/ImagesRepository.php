<?php

namespace App\Repositories;


use Illuminate\Support\Facades\Storage;
use Webpatser\Uuid\Uuid;

class ImagesRepository
{


    /**
     * 上传图片
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function uploadImg($request)
    {
        $uuid = Uuid::generate()->string;
        $file = $request->file('editormd-image-file');
        $filename = $uuid.'.jpg';
        $disk = Storage::disk('qiniu');
        $disk->put($filename, fopen($file,'r'));
        $url = 'https://' . config('filesystems.disks.qiniu.domain') . '/' . $filename;
        return $url;
    }

}

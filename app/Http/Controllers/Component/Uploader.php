<?php

namespace App\Http\Controllers\Component;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Uploader extends Controller
{
    /**
     * 上传处理
     */
    public function uploader(Request $request) {
        $upload = $request->file;
        if($upload->isValid()){
            $path = $upload->store(date('ymd'));
            return ['message'=>asset('attachment/' . $path),'valid'=>1];
        }
    }

    public function filesLists(){
        return [ 'data' => [], 'page' => '' ];
    }
}

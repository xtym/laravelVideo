<?php

namespace App\Http\Controllers\Component;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Uploader extends Controller
{
    /**
     * 上传处理
     */
    public function uploader(Request $request) {
        $upload = $request->file;
        if($upload->isValid()){
            $path = $upload->store(date('ymd'));
            $filename= explode('.',$upload->getClientOriginalName());
            $data = [
                //用户编号请自行设置
                'name'       => $upload->getClientOriginalName(),
                'filename'   => $filename[0],
                'path'       => $path,
                'extension'  => $upload->getClientOriginalExtension(), //上传文件的后缀.
                'createtime' => time(),
                'size'       => $upload->getClientSize(), //获取文件的大小
                'status'     => $upload->getError(),
            ];
//            $data = array_merge($data, $request->input(), []);
            Db::table('attachments')->insert($data);
            return ['message'=>asset('attachment/' . $path),'valid'=>1];
        }
    }

    /**
     * 浏览图片时返回数据
     * @param Request $request
     * @return array
     */
    public function filesLists(Request $request){
        $Res  = DB::table('attachments')
            ->whereIn('extension', explode(',', strtolower($request->input('extensions'))))
            ->orderBy('id', 'DESC')->paginate(32);
        $data = [];

        if ($Res->toArray()) {
            foreach ($Res as $k => $v) {

                $data[$k]['createtime'] = date('Y/m/d', $v->createtime);
                $data[$k]['size']       = $v->size;
                $data[$k]['url']        = asset('attachment/'.$v->path);
                $data[$k]['path']       = asset('attachment/'.$v->path);
                $data[$k]['name']       = $v->name;
            }
        }

        return ['data' => $data, 'page' => 32];
    }

    /**
     * 删除图片
     * delWebuploader
     *
     * @return array
     */
    public function removeImage()
    {
        $db   = Db::table('attachment');
        $file = $db->where('id', $_POST['id'])->first();
        if (is_file($file['path'])) {
            unlink($file['path']);
        }
        $db->where('id', $_POST['id'])->where('uid', v('user.info.uid'))->delete();

        return ['valid' => 1, 'message' => '删除成功'];
    }
}

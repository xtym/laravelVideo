<?php

namespace App\Http\Controllers\Admin;

use App\Model\LessonTag;
use App\Model\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Lesson as LessonModel;
use App\Model\Tag;

class Lesson extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = LessonModel::get();
        // dd($data->toArray());

        return view('admin.lesson.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 获取所有标签数据
        $tagData = Tag::get();
        return view('admin.lesson.create',compact('tagData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 进行数据存储
        // 添加课程
        $lesson = new LessonModel();
        $lesson['title']     = $request['title'];
        $lesson['introduce'] = $request['introduce'];
        $lesson['preview']   = $request['preview'];
        $lesson['iscommend'] = $request['iscommend'];
        $lesson['ishot']     = $request['ishot'];
        $lesson['click']     = $request['click'];
        $lesson->save();

        // 添加中间表
        $lessonTag = new LessonTag();
        if ( $request['tid']){
            foreach ($request['tid'] as $tid){
                $lessonTag->create([
                    'lesson_id' => $lesson->id,
                    'tag_id' => $tid
                ]);
            }
        }


        // 添加视频表
        foreach (json_decode($request['videos'],true) as $v){
            // 通过多表管理 来添加数据
            $lesson->videos()->create([
                'title' => $v['title'],
                'path' => $v['path'],
            ]);
        }

        // 跳转到课程列表
        return redirect('/admin/lesson');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 获取所有标签数据
        $tagData = Tag::all();
        // 获取旧数据对象数据
        $model = LessonModel::find($id);
        // 获取当前课程中带有的标签数据  取出单列字段
        $tids = LessonTag::where(['lesson_id'=>$id])->pluck('tag_id');
        // 获取当前课程对于的视频
        $videos = $model->videos()->get();
        $videos = json_encode($videos,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        // 加载视图
        return view( 'admin.lesson.edit',compact('tagData','model','tids','videos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //课程表
        $lesson = LessonModel::find($id);
        $lesson['title']     = $request['title'];
        $lesson['introduce'] = $request['introduce'];
        $lesson['preview']   = $request['preview'];
        $lesson['iscommend'] = $request['iscommend'];
        $lesson['ishot']     = $request['ishot'];
        $lesson['click']     = $request['click'];
        $lesson->save();
        //中间表，先删后填
        LessonTag::where(['lesson_id'=>$id])->delete();
        $lessonTag = new LessonTag();
        if ($request['tid']){
            foreach ($request['tid'] as $tid){
                $lessonTag->create([
                    'lesson_id' => $lesson->id,
                    'tag_id' => $tid
                ]);
            }
        }

        //视频表,先删后填
        $lesson->videos()->delete();
        foreach (json_decode($request['videos'],true) as $v){
            $lesson->videos()->create([
                'title' => $v['title'],
                'path' => $v['path'],
            ]);
        }

        return redirect('/admin/lesson');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 删除课程表中对应的数据
        LessonModel::destroy($id);
        // 删除中间表中数据
        LessonTag::where(['lesson_id'=>$id])->delete();
        // 删除视频表
//        Video::where(['lesson_id'=>$id])->delete();
        Video::where('lesson_id',$id)->delete();
        // 返回删除信息
        return ['msg'=>'删除成功','status'=>true];
    }
}

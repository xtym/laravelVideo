<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TagRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Tag as TagModel;

class Tag extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * tag 首页
     * get请求
     * url: /adimin/tag
     */
    public function index()
    {
        // 获取tag表数据
        $data = TagModel::get();
        // 加载列表试图
        return view('admin.tag.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     *
     * 加载添加标签视图
     * get请求
     * url:/admin/tag/create
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * 保存标签数据到数据库中
     * post请求
     * url:/admin/tag/create
     */
    public function store(TagRequest $request)
    {
        // 批量填充 ，在后台中可以使用批量填充，在模型中开启批量填充
        // 在前台中 一定不要使用批量填充
       /* $tag = new TagModel();
        $tag->create($request->all());
        flash()->overlay('添加成功','友情提示');*/

       // 单个填充
        $tag = new TagModel();
        $tag->name = $request->input('name');
        $tag->save();
        flash()->overlay('添加成功','友情提示');
        return view('admin.tag.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *  显示单条 tag 详细数据
     * get
     * url :/admin/id
     * 没有用到
     */
    /*public function show($id)
    {
        //
    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 加载单挑tag的详细信息
     * get
     * url :/admin/id
     * 用于编辑tag信息
     */
    public function edit($id)
    {
        //
        $model = TagModel::find($id);
        return view('admin.tag.edit',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 更新单挑tag数据
     * 请求方式 ：PUT/PATCH
     * url: /admin/tag/id
     */
    public function update(Request $request, $id)
    {
        $model = TagModel::find($id);
        $model->name = $request->input('name');
        $model->save();
        return redirect('/admin/tag');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * 删除数据
     *  请求类型：DELETE
     * url: /admin/id
     */
    public function destroy($id)
    {
        TagModel::destroy($id);
        return response()->json(['msg'=>'删除成功','status'=>true]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Http\Requests\CreateTopicRequest;


class TopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $topics     = Topic::latest()->get();
      $context    = [ "topics" => $topics ];

      return view("index",$context);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTopicRequest $request)
    {
      Topic::create($request->all());

      return redirect(route("topics.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $context            = [];
      $context["topics"]  = Topic::where("id",$id)->get();

      #HACK:↑と↓は等価。
        #contextに仕込むモデルオブジェクトが増えるたび、context定義時の行数が増えるので、混乱を防ぐために↑のやり方のほうが良いかもしれない。

        /*
        $topics     = Topic::where("id",$id)->get();
        $context    = [ "topics" => $topics ];
        */

        return view("show",$context);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $topics     = Topic::where("id",$id)->get();
      $context    = [ "topics" => $topics ];

      return view("edit",$context);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateTopicRequest $request, $id)
    {
      #編集処理のベストプラクティス
      Topic::find($id)->update($request->all());

      #HACK:このやり方ではモデルフィールドが増えると対処しきれない。
      /*
      $topic  = Topic::find($id);
      $topic->name    = $request->name;
      $topic->content = $request->content;
      $topic->save();
      */

      return redirect(route("topics.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      #削除のベストプラクティス
      Topic::destroy($id);

      #HACK:もっと短く書ける
      #Topic::find($id)->delete();

      #HACK:deleteメソッドはつなげ書いても良い。
      /*
      $topic  = Topic::find($id);
      $topic->delete();
      */

      return redirect(route("topics.index"));
    }

}

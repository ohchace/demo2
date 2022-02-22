<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Http\Requests\CreateTopicRequest;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $data           = $request->all();
      $query          = Topic::query();
      //var_dump($data);

      if ( array_key_exists('search',$data) ){

          #TIPS:半角、全角スペース、改行、タブ、ノーブレークスペース等を元に配列化させる。空白のみの場合空配列を返す。
          $search_list    = preg_split('/[\p{Z}\p{Cc}]++/u', $data["search"], -1, PREG_SPLIT_NO_EMPTY);


          #option指定なし→ AND検索、あり→ OR検索
          if ( array_key_exists('option',$data) ){
              foreach( $search_list as $search ){
                  $query->orwhere("content","LIKE","%{$search}%")
                        ->orwhere("name","LIKE","%{$search}%");
              }
          }
          else{
              foreach( $search_list as $search ){
                  $query->where("content","LIKE","%{$search}%")
                        ->where("name","LIKE","%{$search}%");
              }
          }
      }
      //var_dump($query);
      #TIPS:orderByを使用すればソートをもっと細かくできる。
      $topics     = $query->orderBy("created_at","desc")->get();
      //var_dump($topics);
      $context    = [ "topics" => $topics ];
      //var_dump($context);

      return view("index",$context);
    }

}

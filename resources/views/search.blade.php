@extends("base")

@section("main")
<!--
<a class="btn btn-outline-success"  href="{{ route('topics.create') }}">＋ トピックを作る</a>
-->
<form method="POST" action="">
  {{ csrf_field() }}
    @if( request()->query("option") )<input type="checkbox" name="option" checked>
    @else<input type="checkbox" name="option">
    @endif
    <input type="text" name="search" placeholder="ここにキーワードを入れる" value="{{ request()->query('search') }}">
    <input type="submit" name="button" value="キーワード検索">
</form>

@if(isset($_POST['button']))
@forelse( (array)$topics as $topic )
<?php var_dump($topic);?>
<div class="border my-2 p-2">
    <div class="text-secondary">{{ $topic->name }} さん</div>
    <div class="p-2">{!! nl2br(e($topic->content)) !!}</div>
    <div class="text-secondary">投稿日:{{ $topic->created_at }}</div>
    <div class="text-secondary">編集日:{{ $topic->updated_at }}</div>
    <a class="btn btn-outline-primary" href="{{ route('topics.show',$topic->id) }}">詳細</a>
    <a class="btn btn-outline-success" href="{{ route('topics.edit',$topic->id) }}">編集</a>
    <form action="{{ route('topics.destroy',$topic->id) }}/" method="POST" style="display:inline-block;">
        {{ csrf_field() }}
        {{ method_field("delete") }}
        <button class="btn btn-outline-danger" type="submit">削除</button>
    </form>
</div>
@empty
<p>投稿はありません</p>
@endforelse
@endif

@endsection

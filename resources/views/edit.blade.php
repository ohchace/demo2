
@extends("base")

@section("main")
<?php
$error_message = null;
?>

@if(isset($_POST['send']))

   // 空白除去
   	$name = preg_replace( '/\A[\p{C}\p{Z}]++|[\p{C}\p{Z}]++\z/u', '', $_POST['name']);
   	$content = preg_replace( '/\A[\p{C}\p{Z}]++|[\p{C}\p{Z}]++\z/u', '', $_POST['content']);

   	// 表示名の入力チェック
   	@if( empty($name) )
   		$error_message[] = '表示名を入力してください。';
   	@endif

   	// メッセージの入力チェック
   	@if( empty($content) )
   		$error_message[] = 'メッセージを入力してください。';
   	@endif

@endif


@if( empty($error_message) )
<ul>
    @foreach((array)$error_message as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>
@endif



@forelse($topics as $topic )
<form action="{{ route('topics.update',$topic->id) }}/" method="POST">
    {{ csrf_field() }}
    {{ method_field("put") }}
    <input class="form-control" type="text" name="name" placeholder="名前" value="{{ $topic->name }}">
    <textarea id="" class="form-control" name="content" rows="10" placeholder="コメント">{{ $topic->content }}</textarea>
    <!--<button class="form-control" name="send" type="submit" value="{{ url('/') }}">送信</button>-->
    <!--<input class="form-control" name="update" type="submit" value="送信">-->
    <button class="form-control" type="submit">送信</button>
</form>

@empty
<p>ありません。</p>



@endforelse

@endsection

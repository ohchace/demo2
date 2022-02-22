@extends("base")

@section("main")


@if( count($errors) )
<ul>
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>
@endif

@forelse($topics as $topic )
<form action="{{ route('topics.update',$topic->id) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field("put") }}
    <input class="form-control" type="text" name="name" placeholder="名前" value="{{ $topic->name }}">
    <textarea id="" class="form-control" name="content" rows="10" placeholder="コメント">{{ $topic->content }}</textarea>
    <button class="form-control" name="send" type="submit" value="{{ url('/') }}">送信</button>
    <!--<input class="form-control" type="submit" value="送信" href="{{ url('/index') }}">-->
</form>
@empty
<p>ありません。</p>
@endforelse

@endsection

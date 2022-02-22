@extends("base")

@section("main")

@if( count($errors) )
<ul>
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>
@endif

<form class="" action="{{ route('topics.store') }}" method="POST">
    {{ csrf_field() }}
    <input class="form-control" type="text" name="name" placeholder="名前">
    <textarea id="" class="form-control" name="content" rows="4" placeholder="コメント"></textarea>
    <input class="form-control" type="submit" value="送信">
</form>
@endsection

@extends("base")

@section("main")

@forelse($topics as $topic )
<div class="border my-2 p-2">
    <div class="text-secondary">{{ $topic->name }} さん</div>
    <div class="p-2">{!! nl2br(e($topic->content)) !!}</div>
    <div class="text-secondary">投稿日:{{ $topic->created_at }}</div>
</div>
@empty
<p>ありません。</p>
@endforelse

@endsection

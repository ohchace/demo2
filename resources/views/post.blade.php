<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>簡易掲示板</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


    <style>
    h1 {
      display: none;
    }
    </style>

</head>
<body>

    <header>

        <h2 class="bg-primary text-white text-center">簡易掲示板サイト</h1>

    </header>

    <main class="container">
      @extends("base")

      @section("main")


        <form method="POST">
            {{ csrf_field() }}


            <input class="form-control my-2" type="text" name="name" placeholder="ここに名前を入力">
            <textarea class="form-control my-2" name="content" rows="4" placeholder="ここにコメントを入力"></textarea>
            <input class="form-control my-2" name="post" type="submit" value="送信">
        </form>

        @if(isset($_POST['post']))
        @forelse ( $topics as $topic )
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
        <p>投稿はありません。</p>
        @endforelse
        @endif

    </main>
</body>
</html>

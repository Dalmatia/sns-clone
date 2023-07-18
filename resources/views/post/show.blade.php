<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>投稿詳細</title>
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:300,400,400i,700&display=fallback" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
  <div class="container d-flex flex-column flex-md-row justify-content-between">
    <a class="py-2 d-none d-md-inline-block" href="{{ route('post.index') }}">投稿記事一覧</a>
    <a class="py-2 d-none d-md-inline-block" href="{{ route('post.create') }}">新規投稿</a>
    <a class="py-2 d-none d-md-inline-block" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
  </div>

  <div class="container">
    <h1>記事詳細</h1>
    <div>
      <h2>タイトル:</h2>
      <h2>{{ $post->title }}</h2>
    </div>

    <div>
      <h2>画像:</h2>
      <img src="../../uploads/{{$post->image}}" class="card-img-top" alt="Card image cap" width="300" height="200">
    </div>

    <div>
      <h2>詳細:</h2>
      <h2>{{ $post->description }}</h2>
    </div>

    <h1>コメント</h1>
    <ul>
      <li>
        <form method="POST" action="{{ route('comments.store', $post) }}">
          @csrf
          <input type="text" name="body">
          <button>コメントする</button>
          @error('body')
          {{ $message }}
          @enderror
        </form>
      </li>
    </ul>
    <ul>
      @foreach($post->comments()->latest()->get() as $comment)
      <li>
        {{ $comment->body }}
        <form method="POST" action="{{ route('comments.destroy', $comment) }}">
          @method('DELETE')
          @csrf
          <button>削除</button>
        </form>
      </li>
      @endforeach
    </ul>
  </div>
</body>

</html>
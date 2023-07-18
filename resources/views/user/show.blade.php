<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザーページ</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<div class="container d-flex flex-column flex-md-row justify-content-between">
  <a class="py-2 d-none d-md-inline-block" href="{{ route('post.index') }}">投稿記事一覧</a>
  <a class="py-2 d-none d-md-inline-block" href="{{ route('post.create') }}">新規投稿</a>
  <a class="py-2 d-none d-md-inline-block" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
  </form>
</div>
<div>
  <div class="text-center mb-4">
    <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAAHd3dwAAACH58AAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
    <h1 class="h3 mb-3 font-weight-normal">{{ $user->name }}</h1>
    @if(Auth::id() != $user_flg)
    @if(Auth::user()->isFollowing($user->id))
    <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
      <button type=" submit" class="btn btn-danger">フォロー解除</button>
    </form>
    @else
    <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
      {{ csrf_field() }}
      <button type=" submit" class="btn btn-primary">フォローする</button>
    </form>
    @endif
    @else
    <a href="{{ route('user.edit', ['id' => Auth::id()]) }}">編集</a>
    @endif
  </div>
</div>
<main role="main">
  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row">
        @foreach($post as $p)
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <a href="{{ route('post.show', ['id' => $p->id]) }}">
              <img src="../../uploads/{{$p->image}}" class="card-img-top" alt="Card image cap" width="300" height="200">
            </a>
            <div class="card-body">
              <p class="card-text">
                <a href="{{ route('user.show', ["id" => $p->user_id]) }}">{{ $p->name }}</a>
              </p>
              <p class="card-text">{{ $p->title }}</p>
              <p class="card-text">{{ $p->description }}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  @if(Auth::id() != $p->user_id)

                  @if(Auth::user()->is_favorite($p->id))
                  {!! Form::open(['route' => ['favorites.unfavorite', $p->id], 'method' => 'delete']) !!}
                  {!! Form::submit('いいね!を外す', ['class' => "button btn btn-warning"]) !!}
                  {!! Form::close() !!}
                  @else
                  {!! Form::open(['route' => ['favorites.favorite', $p->id]]) !!}
                  {!! Form::submit('いいね!を付ける', ['class' => "button btn btn-success"]) !!}
                  {!! Form::close() !!}
                  @endif

                  @endif

                  @if($p->user_id == Auth::id())
                  <a href="{{ route('post.edit', ['id' => $p->id]) }}" class="btn btn-sm btn-outline-secondary">編集</a>
                  <form method="POST" action="{{ route('post.destroy', ['id' => $p->id]) }}">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-secondary">削除</button>
                    @endif
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</main>

<script src="../../assets/js/vendor/holder.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script>
  window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js/"><\/script>')
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
<script src="/docs/4.5/assets/js/vendor/anchor.min.js"></script>
<script src="/docs/4.5/assets/js/vendor/clipboard.min.js"></script>
<script src="/docs/4.5/assets/js/vendor/bs-custom-file-input.min.js"></script>
<script src="/docs/4.5/assets/js/src/application.js"></script>
<script src="/docs/4.5/assets/js/src/search.js"></script>
<script src="/docs/4.5/assets/js/src/ie-emulation-modes-warning.js"></script>

</html>
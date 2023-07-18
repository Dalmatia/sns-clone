<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>編集機能</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<div class="container">
  <div>
    <form method="POST" action="{{ route('post.update', ['id' => $post->id]) }}" enctype="multipart/form-data">
      @csrf
      <h1>投稿記事編集画面</h1>
      <div class="mb-2">
        <label class="form-label" for="title">タイトル</label>
        <input class="form-control" type="text" name="title" value="{{$post->title}}">
        @error('title')
        {{ $message }}
        @enderror
      </div>

      <div class="mb-2">
        <label class="form-label" for="image" accept="image/png,image/jpeg,image/jpg">ファイルを選択</label>
        <input class="form-control" type="file" name="image" value="{{$post->image}}">
        @error('image')
        {{ $message }}
        @enderror
      </div>

      <div class="mb-2">
        <label class="form-label" for="description">詳細</label>
        <input class="form-control" type="text" name="description" value="{{$post->description}}"></input>
        @error('description')
        {{ $message }}
        @enderror
      </div>

      <button type="submit" class="btn btn-primary">更新</button>
    </form>
  </div>
</div>

</html>
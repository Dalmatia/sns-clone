<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>新規投稿</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<div class="container">
  <div>
    <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
      @csrf
      <h1>新規投稿</h1>
      <div class="mb-2">
        <label class="form-label" for="title">タイトル</label>
        <input class="form-control" type="text" name="title" value="{{old("title")}}">
        @error('title')
        {{ $message }}
        @enderror
      </div>

      <div class="mb-2">
        <label class="form-label" for="image" accept="image/png,image/jpeg,image/jpg">ファイルを選択</label>
        <input class="form-control" type="file" name="image" value="{{old("image")}}">
        @error('image')
        {{ $message }}
        @enderror
      </div>

      <div class="mb-2">
        <label class="form-label" for="description">詳細</label>
        <textarea class="form-control" type="text" name="description" value="{{old("description")}}"></textarea>
        @error('description')
        {{ $message }}
        @enderror
      </div>

      <button type="submit" class="btn btn-primary">投稿を保存</button>
    </form>
  </div>
</div>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー情報編集</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>
  <div class="container">
    <form method="POST" action="{{ route('user.update', ['id' => $user->id]) }}">
      @csrf
      <h1>ユーザー情報編集</h1>
      <div class="mb-2">
        <label class="form-label" for="name">ユーザー名</label>
        <input class="form-label" type="text" name="name" value="{{ $user->name }}">
        @error('name')
        {{ $message }}
        @enderror
      </div>

      <button type="submit" class="btn btn-primary">更新</button>
    </form>
  </div>
</body>

</html>
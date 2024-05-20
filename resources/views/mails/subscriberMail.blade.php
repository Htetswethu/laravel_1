<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Notify mail for {{$user->name}}</h1>
    <p>Comment - {{$comment->body}}</p>
    <p>Subscribed blog - {{$comment->blog->title}}</p>
</body>
</html>
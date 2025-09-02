<!DOCTYPE html>
<html>
<head>
    <title>대시보드</title>
</head>
<body>
    <h1>환영합니다, {{ Auth::user()->name }}님!</h1>

    <form method="POST" action="/logout">
        @csrf
        <button type="submit">로그아웃</button>
    </form>
</body>
</html>

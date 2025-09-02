<!DOCTYPE html>
<html>
<head>
    <title>회원가입</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 400px; margin: 100px auto; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        button { background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        .error { color: red; font-size: 14px; }
    </style>
</head>
<body>
    <h2>회원가입</h2>

    <form method="POST" action="/register">
        @csrf

        <div class="form-group">
            <label for="name">이름:</label>
            <input type="name" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">이메일:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">비밀번호:</label>
            <input type="password" id="password" name="password" required>
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">회원가입</button>
    </form>
</body>
</html>

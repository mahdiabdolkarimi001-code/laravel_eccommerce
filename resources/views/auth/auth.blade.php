<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود / ثبت‌نام</title>
    <link href="https://cdn.jsdelivr.net/gh/rastikdizaj/Vazirmatn@v1.9.0/dist/font/font-face.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        /* ====== CSS شما بدون حتی یک کاراکتر تغییر ====== */
        :root {
            --primary-color: #007bff;
            --secondary-color: #6c757d;
            --background-color: #f8f9fa;
            --card-background: #ffffff;
            --border-color: #dee2e6;
            --text-color: #343a40;
            --font-family: 'Vazirmatn', sans-serif;
        }
        * { box-sizing:border-box;margin:0;padding:0;transition:.25s ease }
        body {
            font-family:var(--font-family);
            background-color:var(--background-color);
            color:var(--text-color);
            direction:rtl;
            display:flex;
            justify-content:center;
            align-items:center;
            min-height:100vh;
            padding:20px;
        }
        .auth-wrapper {
            width:100%;
            max-width:1200px;
            background:var(--card-background);
            box-shadow:0 10px 30px rgba(0,0,0,.1);
            border-radius:12px;
            overflow:hidden;
            display:flex;
        }
        .auth-image { flex:1;max-width:50%;display:flex;align-items:center;justify-content:center }
        .auth-image img { width:100%;height:100%;object-fit:cover }
        .auth-form { flex:1;max-width:50%;display:flex;justify-content:center;align-items:center;padding:40px }
        .form-content { width:100%;max-width:380px }
        .title { font-size:2.2rem;font-weight:700;margin-bottom:10px;color:#000 }
        .subtitle { font-size:1.1rem;color:#6c757d;margin-bottom:30px }
        .input-group { margin-bottom:20px }
        .input-group label { display:block;margin-bottom:8px }
        .input-group input {
            width:100%;padding:12px 15px;border:1px solid var(--border-color);
            border-radius:8px;font-size:1rem
        }
        .remember-me { display:flex;align-items:center;margin-bottom:25px }
        .login-button {
            width:100%;padding:14px;background:var(--primary-color);
            color:#fff;border:none;border-radius:8px;font-size:1.1rem;font-weight:700
        }
        .error {
            background:#ffe8e8;color:#d32f2f;border:1px solid #f55;
            border-radius:6px;padding:10px;text-align:center;margin-bottom:18px
        }
    </style>
</head>
<body>

<div class="auth-wrapper">

    <div class="auth-image">
        <img src="{{ asset('images/auth/auth.jpg') }}" alt="تصویر پس‌زمینه جذاب">
    </div>

    <!-- فرم ورود -->
    <div class="auth-form" id="login-form" style="display:flex;">
        <div class="form-content">

            <h2 class="title">خوش آمدید</h2>
            <p class="subtitle">لطفاً برای ادامه وارد شوید.</p>

            @if (isset($errors) && $errors->has('login_error'))
                <p class="error">{{ $errors->first('login_error') }}</p>
            @endif

            <!-- ✅ اصلاح فقط این خط -->
            <form action="{{ route('auth.login') }}" method="POST">
                @csrf

                <div class="input-group">
                    <label for="email"><i class="fas fa-envelope"></i> ایمیل</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="input-group">
                    <label for="password"><i class="fas fa-lock"></i> رمز عبور</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">مرا به خاطر بسپار</label>
                </div>

                <button type="submit" class="login-button">ورود</button>
            </form>

            <button class="toggle-link" onclick="toggleForms()">حساب کاربری ندارید؟ ثبت نام کنید</button>
        </div>
    </div>

    <!-- فرم ثبت نام -->
    <div class="auth-form" id="register-form" style="display:none;">
        <div class="form-content">

            <h2 class="title">ثبت‌نام</h2>
            <p class="subtitle">کاربر جدید هستید؟</p>

            <!-- ✅ اصلاح فقط این خط -->
            <form action="{{ route('auth.register') }}" method="POST">
                @csrf

                <div class="input-group">
                    <label for="name"><i class="fas fa-user"></i> نام</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="input-group">
                    <label for="reg_email"><i class="fas fa-envelope"></i> ایمیل</label>
                    <input type="email" id="reg_email" name="email" required>
                </div>

                <div class="input-group">
                    <label for="reg_password"><i class="fas fa-lock"></i> رمز عبور</label>
                    <input type="password" id="reg_password" name="password" required>
                </div>

                <button type="submit" class="login-button" style="background-color:#6c757d">
                    ثبت نام
                </button>
            </form>

            <button class="toggle-link" onclick="toggleForms()">حساب کاربری دارید؟ ورود کنید</button>
        </div>
    </div>

</div>

<script>
    function toggleForms() {
        const login = document.getElementById("login-form");
        const register = document.getElementById("register-form");
        login.style.display = login.style.display === "none" ? "flex" : "none";
        register.style.display = register.style.display === "none" ? "flex" : "none";
    }
</script>

</body>
</html>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ورود ادمین | جذاب</title>
    <style>
        /* فونت‌ها و تنظیمات پایه */
        @import url('https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;600;700;900&display=swap');
        
        * {
            box-sizing: border-box;
            font-family: 'Vazirmatn', sans-serif;
        }

        /* === تم رنگی و متغیرها === */
        :root {
            --bg-color: #e0e7ff; /* آبی روشن و ملایم برای پس‌زمینه اصلی */
            --card-bg-blur: rgba(255, 255, 255, 0.6); /* پس‌زمینه کانتینر کمی شفاف */
            --primary-blue: #4f46e5; /* بنفش/آبی عمیق‌تر برای جذابیت بیشتر */
            --primary-blue-hover: #4338ca;
            --text-color: #1f2937;
            --border-color: rgba(255, 255, 255, 0.5); /* مرز شفاف */
            --shadow-light: rgba(255, 255, 255, 0.7);
            --shadow-dark: rgba(0, 0, 0, 0.15);
            --error-bg: #fecaca;
            --error-text: #b91c1c;
        }

        body {
            margin: 0;
            background: linear-gradient(135deg, var(--bg-color) 0%, #ffffff 100%); /* گرادینت ملایم */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--text-color);
            direction: rtl;
        }

        /* کانتینر ورود با جلوه Glassmorphism */
        .login-container {
            background: var(--card-bg-blur);
            backdrop-filter: blur(12px); /* اعمال افکت بلور */
            -webkit-backdrop-filter: blur(12px);
            padding: 50px 40px;
            border-radius: 25px; /* گردی بسیار زیاد */
            width: 90%; /* عرض 90% در موبایل */
            max-width: 380px;
            text-align: center;
            border: 1px solid var(--border-color);
            /* سایه برای عمق بیشتر */
            box-shadow: 0 20px 60px var(--shadow-dark), 0 0 30px var(--shadow-light) inset; 
        }

        .login-container h2 {
            margin-bottom: 40px;
            font-weight: 900;
            font-size: 1.9rem;
            letter-spacing: 1px;
            color: #1e3a8a; /* آبی سرمه‌ای برای عنوان */
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        /* استایل ورودی‌ها با سایه داخلی (Inset) */
        input[type="email"],
        input[type="password"] {
            padding: 18px 20px;
            border-radius: 15px;
            border: none; /* حذف مرز بیرونی */
            font-size: 1.1rem;
            outline: none;
            transition: 0.4s ease-in-out;
            background-color: rgba(255, 255, 255, 0.8); /* پس‌زمینه ورودی‌ها */
            color: var(--text-color);
            /* سایه داخلی برای حس فرو رفتگی */
            box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.1), 0 1px 1px var(--shadow-light);
        }

        input[type="email"]::placeholder,
        input[type="password"]::placeholder {
            color: #a1a1aa;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            background-color: #ffffff;
            /* هایلایت فوکوس با رنگ آبی عمیق‌تر */
            box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.1), 0 0 0 5px rgba(79, 70, 229, 0.3);
        }

        /* دکمه آبی جذاب و برجسته */
        button {
            background-color: var(--primary-blue);
            border: none;
            padding: 18px 0;
            border-radius: 15px;
            font-size: 1.2rem;
            color: white;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            /* سایه اصلی برای برجسته سازی */
            box-shadow: 0 10px 25px rgba(79, 70, 229, 0.4); 
        }

        button:hover {
            background-color: var(--primary-blue-hover);
            box-shadow: 0 12px 30px rgba(79, 70, 229, 0.6);
            transform: translateY(-2px);
        }
        
        button:active {
            transform: translateY(0);
            box-shadow: 0 5px 15px rgba(79, 70, 229, 0.4);
        }

        /* پیام‌های خطا (با حفظ ظاهر Glassmorphism) */
        .errors {
            background-color: var(--error-bg);
            color: var(--error-text);
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-size: 0.95rem;
            text-align: right;
            border: 1px solid #ef4444;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        
        /* =================================== */
        /* ===== تنظیمات ریسپانسیو (موبایل) ===== */
        /* =================================== */
        @media (max-width: 600px) {
            .login-container {
                /* در دستگاه‌های بسیار کوچک، فضای کناری کمتری می‌گیریم و پدینگ کمتری می‌دهیم */
                padding: 40px 25px;
                border-radius: 20px;
            }

            .login-container h2 {
                font-size: 1.6rem; /* کمی کوچکتر شدن عنوان */
                margin-bottom: 30px;
            }

            form {
                gap: 20px; /* فاصله کمتر بین فیلدها */
            }

            input[type="email"],
            input[type="password"] {
                padding: 16px 18px; /* پدینگ کمتر برای راحت‌تر کلیک کردن */
                font-size: 1rem;
            }

            button {
                padding: 16px 0;
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>ورود به پنل ادمین</h2>

        <!-- بخش شبیه سازی خطا -->
        <div id="error-display" style="display:none;">
            <div class="errors">
                <p>خطای امنیتی: اعتبار سنجی ناموفق بود.</p>
            </div>
        </div>
        <!-- پایان شبیه سازی خطا -->

        <form action="{{ route('admin.login.submit') }}" method="POST" autocomplete="off">
            @csrf
            <input type="email" name="email" placeholder="ایمیل" required autofocus />
            <input type="password" name="password" placeholder="رمز عبور" required />
            <button type="submit">ورود</button>
        </form>
    </div>
</body>
</html>

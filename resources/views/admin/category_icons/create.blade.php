<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>افزودن آیکن جدید</title>

    <!-- Bootstrap 5 RTL CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />

    <!-- فونت فارسی وزیر -->
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.1.0/dist/font-face.css" rel="stylesheet" />

    <!-- آیکون های Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        body {
            font-family: 'Vazir', Tahoma, sans-serif;
            background: #f0f2f5; /* پس‌زمینه صفحه سفید/روشن */
            color: #333;
            padding: 40px 15px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }
        .form-container {
            background: #ffffff; /* پس‌زمینه فرم سفید */
            border-radius: 15px;
            padding: 30px 35px;
            max-width: 600px;
            width: 100%;
            /* سایه نرم برای زیبایی روی پس‌زمینه سفید */
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
            transition: box-shadow 0.3s ease;
        }
        .form-container:hover {
            box-shadow: 0 12px 40px rgba(0,0,0,0.15);
        }
        h4 {
            font-weight: 900;
            font-size: 2rem;
            margin-bottom: 30px;
            color: #28a745; /* رنگ سبز برای تاکید بر عملیات افزودن */
            text-align: center;
        }
        label {
            font-weight: 700;
            font-size: 1rem;
            margin-bottom: 8px;
            color: #555;
        }
        input[type="text"], input[type="file"] {
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            color: #333;
            padding: 10px 12px;
            transition: all 0.3s ease;
        }
        input[type="text"]:focus, input[type="file"]:focus {
            outline: none;
            border-color: #28a745;
            box-shadow: 0 0 8px rgba(40, 167, 69, 0.5);
        }

        /* بخش پیش‌نمایش تصویر */
        .preview {
            width: 100%;
            height: 180px;
            border: 2px dashed #aaa;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background-color: #f9f9f9;
            margin-bottom: 20px;
            color:#888;
            font-size:.9rem;
        }
        .preview img {
            width: 100%;
            height: 100%;
            object-fit: contain; /* برای نمایش کامل آیکن بدون برش زیاد */
        }
        
        .btn-submit {
            width: 100%;
            background: linear-gradient(45deg, #28a745, #218838); /* گرادیان سبز (مثل کد اول) */
            border: none;
            color: #fff;
            font-weight: 700;
            font-size: 1.2rem;
            padding: 12px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(40, 167, 69, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
        }
        .btn-submit:hover {
            background: linear-gradient(45deg, #218838, #1e7e34);
            box-shadow: 0 6px 15px rgba(30, 126, 52, 0.7);
        }
        
        .invalid-feedback {
            display: block !important;
            margin-top: .25rem;
            font-size: .875em;
            color: #dc3545;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h4>افزودن آیکن جدید</h4>

    {{-- نمایش خطاهای کلی (مخصوص لاراول Blade) --}}
    @if (isset($errors) && $errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.category_icons.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- بخش پیش‌نمایش --}}
        <div class="preview" id="imagePreview">
            <span>پیش‌نمایش تصویر آیکن</span>
        </div>

        {{-- فیلد تصویر آیکن --}}
        <div class="mb-4">
            <label for="image">انتخاب تصویر آیکن *</label>
            <input type="file" id="image" name="image"
                   class="form-control @error('image') is-invalid @enderror"
                   accept="image/*"
                   onchange="previewImage(event)"
                   required />
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- فیلد نام دسته --}}
        <div class="mb-4">
            <label for="name">نام دسته</label>
            <input type="text" id="name" name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="نام دسته را وارد کنید"
                   value="{{ old('name', '') }}"
                   required />
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn-submit">
            <i class="bi bi-plus-circle" style="margin-left: 8px;"></i> ذخیره آیکن
        </button>
    </form>
</div>

<script>
    // تابع جاوا اسکریپت برای نمایش پیش‌نمایش تصویر
    function previewImage(event) {
      const preview = document.getElementById("imagePreview");
      preview.innerHTML = "";
      const img = document.createElement("img");
      
      if (event.target.files && event.target.files[0]) {
          img.src = URL.createObjectURL(event.target.files[0]);
          preview.appendChild(img);
      } else {
          preview.innerHTML = "<span>پیش‌نمایش تصویر آیکن</span>";
      }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ویرایش آیکن</title>

    <!-- Bootstrap 5 RTL CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />

    <!-- فونت فارسی وزیر -->
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.1.0/dist/font-face.css" rel="stylesheet" />

    <!-- آیکون های Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        body {
            font-family: 'Vazir', Tahoma, sans-serif;
            background: #f0f2f5; /* پس‌زمینه صفحه روشن (مشابه فرم افزودن) */
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
            color: #28a745; /* رنگ سبز جذاب */
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

        /* بخش نمایش تصویر فعلی (معادل ناحیه پیش‌نمایش) */
        .image-display {
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
            position: relative; /* برای قرار دادن متن روی تصویر */
        }
        .image-display img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain; 
            display: none; /* به صورت پیش‌فرض مخفی است تا تصویر لود شود */
        }
        .image-display span {
            position: absolute;
            color:#888;
            font-size:.9rem;
        }
        
        .btn-submit {
            width: 100%;
            background: linear-gradient(45deg, #28a745, #218838); /* گرادیان سبز */
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
    <h4>ویرایش آیکن</h4>

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

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.category_icons.update', $categoryIcon->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- 1. ناحیه نمایش تصویر فعلی --}}
        <div class="image-display" id="imageDisplay">
            @if($categoryIcon->image)
                {{-- نمایش تصویر موجود در سرور --}}
                <img src="{{ asset('storage/' . $categoryIcon->image) }}"
                     alt="آیکن فعلی"
                     id="existingImage"
                     style="display: block;" />
                <span style="display: none;">در حال بارگذاری تصویر...</span>
            @else
                <span>آیکن فعلی برای این آیتم ثبت نشده است</span>
            @endif
        </div>

        {{-- 2. فیلد آپلود تصویر جدید --}}
        <div class="mb-4">
            <label for="image">تصویر جدید (اختیاری)</label>
            <input type="file" id="image" name="image"
                   class="form-control @error('image') is-invalid @enderror"
                   accept="image/*"
                   onchange="previewNewImage(event)" />
            <small class="text-muted mt-1 d-block">اگر فایلی انتخاب کنید، تصویر بالا جایگزین می‌شود.</small>
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- 3. فیلد نام دسته --}}
        <div class="mb-4">
            <label for="name">نام دسته *</label>
            <input type="text" id="name" name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $categoryIcon->name) }}"
                   required />
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn-submit">
            <i class="bi bi-pencil-square" style="margin-left: 8px;"></i> ذخیره تغییرات
        </button>
    </form>
</div>

<script>
    // تابع برای نمایش پیش‌نمایش تصویر جدید در صورت انتخاب توسط کاربر
    function previewNewImage(event) {
      const displayContainer = document.getElementById("imageDisplay");
      const existingImageElement = document.getElementById("existingImage");
      const defaultSpan = displayContainer.querySelector('span');

      if (event.target.files && event.target.files[0]) {
          // پنهان کردن محتوای قدیمی و نمایش محتوای جدید
          if (existingImageElement) {
              existingImageElement.style.display = 'none';
          }
          defaultSpan.style.display = 'none'; // پنهان کردن متن پیش‌فرض

          // ایجاد و نمایش تگ موقت برای پیش‌نمایش
          let tempImg = document.getElementById('tempPreviewImage');
          if (!tempImg) {
            tempImg = document.createElement("img");
            tempImg.id = 'tempPreviewImage';
            displayContainer.appendChild(tempImg);
          }
          
          tempImg.src = URL.createObjectURL(event.target.files[0]);
          tempImg.style.display = 'block';
          tempImg.style.maxWidth = '100%';
          tempImg.style.maxHeight = '100%';
          tempImg.style.objectFit = 'contain';

      } else {
          // اگر فایلی انتخاب نشد (مثلاً کاربر کنسل کرد)، تصویر اصلی را برگردان
          if (existingImageElement) {
              existingImageElement.style.display = 'block';
          }
          document.getElementById('tempPreviewImage')?.remove();
          if (defaultSpan) {
             defaultSpan.style.display = 'block';
          }
      }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

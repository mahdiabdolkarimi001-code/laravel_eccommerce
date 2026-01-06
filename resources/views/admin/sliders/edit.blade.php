<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ویرایش اسلایدر</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;600;700&display=swap');

        body {
            font-family: "Vazirmatn", sans-serif;
            direction: rtl;
            background-color: #f0f2f5;
            /* حذف حالت تیره و استفاده از حالت روشن */
            color: #333;
            padding: 0;
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
        }

        form {
            width: 90%;
            max-width: 1100px;
            margin: 40px auto;
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            background-color: #ffffff;
            /* حفظ استایل کانتینر فرم سفید */
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            width: 100%;
            text-align: center;
            color: #28a745;
            font-size: 1.7rem;
            margin-bottom: 25px;
            font-weight: 700;
        }

        h3 {
            margin-top: 25px;
            color: #28a745;
            font-weight: 600;
        }

        .column {
            flex: 1;
            min-width: 340px;
            background-color: #fafafa;
            border-radius: 12px;
            padding: 25px;
            border: 1px solid #e0e0e0;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #555;
        }

        input[type="text"],
        input[type="url"],
        input[type="file"],
        input[type="checkbox"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border-radius: 6px;
            border: 1px solid #ccc;
            background-color: #fff;
            color: #333;
            font-size: 1rem;
            transition: border-color 0.2s ease;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #28a745;
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.3);
        }

        .preview {
            width: 100%;
            height: 260px;
            border: 2px dashed #aaa;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background-color: #f9f9f9;
            margin-bottom: 15px;
            color: #888;
            font-size: .9rem;
        }

        .preview img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .form-check {
            margin-bottom: 20px;
            padding-right: 0;
        }

        .form-check-input {
            margin-left: 10px;
            margin-right: 0;
            /* این چک باکس باید روی صفحه بماند و نه تغییر کند */
            width: auto; 
            height: auto;
        }
        
        .form-check-label {
            display: inline-block;
            margin-bottom: 0;
        }

        .actions {
            margin-top: 30px;
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        button[type="submit"],
        button[type="button"] {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(40, 167, 69, 0.3);
            flex-grow: 1;
        }

        button:hover {
            background-color: #1e7e34;
            box-shadow: 0 4px 10px rgba(30, 126, 52, 0.4);
        }
        
        button[type="button"] {
            background-color: #6c757d; /* رنگ خاکستری برای دکمه بازگشت */
            box-shadow: 0 2px 5px rgba(108, 117, 125, 0.3);
        }
        button[type="button"]:hover {
            background-color: #5a6268;
        }

        @media (max-width: 850px) {
            form {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <!-- فرم ویرایش اسلایدر با استایل جدید -->
    <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data" id="slider-edit-form">
        @csrf
        @method('PUT')
        
        <h2>ویرایش اسلایدر: {{ $slider->title }}</h2>

        <!-- نمایش خطاهای ولیدیشن -->
        @if ($errors->any())
        <div class="alert alert-danger w-100" style="border-radius: 8px;">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- نمایش پیام موفقیت -->
        @if (session('success'))
        <div class="alert alert-success w-100" style="border-radius: 8px;">
            {{ session('success') }}
        </div>
        @endif

        <!-- ستون چپ (اطلاعات تصویری و وضعیت) -->
        <div class="column">
            <div class="preview" id="imagePreview">
                <!-- نمایش تصویر موجود -->
                <img src="{{ asset('storage/'.$slider->image) }}" alt="تصویر فعلی اسلایدر" />
            </div>
            <label for="image">انتخاب تصویر جدید</label>
            <input type="file" name="image" id="image" accept="image/*" onchange="previewImage(event)" />
            <small class="text-muted" style="display:block; margin-bottom: 16px;">اگر تصویری را انتخاب نکنید، تصویر فعلی ($slider->image) باقی می‌ماند.</small>

            <label for="link">لینک</label>
            <input type="url" name="link" id="link" placeholder="https://example.com" value="{{ old('link', $slider->link) }}" />
            
            <h3 style="margin-top: 15px;">وضعیت</h3>
            <div class="form-check">
                <input type="checkbox" name="active" value="1" class="form-check-input" id="active" {{ old('active', $slider->active) ? 'checked' : '' }}>
                <label class="form-check-label" for="active">فعال باشد</label>
            </div>
        </div>

        <!-- ستون راست (اطلاعات متنی و اقدامات) -->
        <div class="column">
            <label for="title">عنوان اسلایدر</label>
            <input type="text" name="title" id="title" placeholder="مثلاً: تخفیف ویژه تابستانی" value="{{ old('title', $slider->title) }}" />

            <h3 style="margin-top: 15px;">عملیات</h3>
            <div class="actions">
                <button type="submit">ذخیره تغییرات</button>
                <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">
                    بازگشت
                </a>
            </div>
        </div>
    </form>

    <script>
        function previewImage(event) {
            const previewDiv = document.getElementById("imagePreview");
            previewDiv.innerHTML = "";
            const img = document.createElement("img");

            if (event.target.files && event.target.files[0]) {
                img.src = URL.createObjectURL(event.target.files[0]);
                previewDiv.appendChild(img);
            } else {
                // در صورت حذف فایل، تصویر پیش‌فرض (موجود) را دوباره بارگذاری کنید
                // توجه: برای این کار باید مسیر اصلی تصویر را از Blade بازگردانیم، اما به دلیل محدودیت سند، از روش ساده‌تر استفاده می‌کنیم:
                const originalImageSrc = "{{ asset('storage/'.$slider->image) }}";
                img.src = originalImageSrc;
                previewDiv.appendChild(img);
            }
        }
    </script>
</body>

</html>

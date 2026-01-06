<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ویرایش نوار دلخواه</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Vazirmatn', sans-serif;
            background-color: #f0f2f5; /* پس‌زمینه روشن */
            color: #333; /* متن تیره */
            padding: 0;
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
        }

        .card {
            width: 90%;
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff; /* فرم با پس‌زمینه سفید */
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1); /* سایه نرم‌تر */
        }

        .card h4 {
            color: #28a745; /* رنگ سبز تاکید */
            text-align: center;
            margin-bottom: 25px;
            font-weight: 700;
        }

        .form-label {
            font-weight: 600;
            color: #555;
        }

        .form-control {
            border-radius: 6px;
            border: 1px solid #ccc;
            background-color: #fff;
            color: #333;
            font-size: 1rem;
            transition: border-color 0.2s ease;
        }

        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.3);
            outline: none;
        }

        .preview-container {
            margin-bottom: 15px;
        }

        .preview-label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #555;
        }

        .preview-area {
            width: 100%;
            height: 200px; /* ارتفاع برای محدوده نمایش */
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

        .preview-area img {
            width: 100%;
            height: 100%;
            object-fit: contain; /* برای اینکه تصویر داخل محدوده جا شود */
        }

        .btn-primary {
            background-color: #007bff; /* آبی استاندارد بوت‌استرپ برای دکمه ویرایش */
            border-color: #007bff;
            color: #fff;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 123, 255, 0.3);
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            box-shadow: 0 4px 10px rgba(0, 86, 179, 0.4);
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="card p-4 mx-auto">
            <h4 class="mb-4 text-center">ویرایش نوار دلخواه</h4>

            <form action="{{ route('admin.custom-product-bars.update', $customProductBar) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">عنوان</label>
                    <input type="text" name="title" class="form-control" value="{{ $customProductBar->title }}" required>
                </div>

                <div class="mb-3 preview-container">
                    <label class="preview-label">تصویر فعلی:</label>
                    
                    {{-- محدوده نمایش تصویر فعلی --}}
                    <div class="preview-area" id="imagePreview">
                        @if($customProductBar->image)
                            {{-- فرض بر این است که مسیردهی در Blade برای دسترسی به فایل‌های ذخیره‌شده در استوریج لاراول صحیح است --}}
                            <img src="{{ asset('storage/' . $customProductBar->image) }}" alt="تصویر نوار">
                        @else
                            <span>بدون تصویر</span>
                        @endif
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">تعویض تصویر (انتخاب فایل جدید)</label>
                    <input type="file" name="image" class="form-control" accept="image/*" onchange="previewNewImage(event)">
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-3">ذخیره تغییرات</button>
            </form>
        </div>
    </div>

    <script>
        // تابع برای پیش‌نمایش تصویر جدیدی که کاربر انتخاب می‌کند
        function previewNewImage(event) {
            const previewArea = document.getElementById("imagePreview");
            previewArea.innerHTML = "";
            const img = document.createElement("img");

            if (event.target.files && event.target.files[0]) {
                img.src = URL.createObjectURL(event.target.files[0]);
                previewArea.appendChild(img);
            } else {
                previewArea.innerHTML = "<span>تصویر جدیدی انتخاب نشده است.</span>";
            }
        }
    </script>
</body>
</html>

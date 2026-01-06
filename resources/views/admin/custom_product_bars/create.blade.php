<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ایجاد نوار دلخواه</title>
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
            color: #28a745;
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

        .preview {
            width: 100%;
            height: 200px; /* ارتفاع کمتر */
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

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            color: #fff;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(40, 167, 69, 0.3);
        }

        .btn-success:hover {
            background-color: #1e7e34;
            border-color: #1e7e34;
            box-shadow: 0 4px 10px rgba(30, 126, 52, 0.4);
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="card p-4 mx-auto">
            <h4 class="mb-4 text-center">ایجاد نوار دلخواه</h4>

            <form action="{{ route('admin.custom-product-bars.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">عنوان نوار</label>
                    <input type="text" name="title" class="form-control" placeholder="مثلاً: بهترین‌های لپ‌تاپ" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">تصویر (دلخواه)</label>
                    <div class="preview" id="imagePreview">
                        <span>پیش‌نمایش تصویر</span>
                    </div>
                    <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
                </div>

                <button type="submit" class="btn btn-success w-100">ثبت نوار</button>
            </form>
        </div>
    </div>
    <script>
        function previewImage(event) {
            const preview = document.getElementById("imagePreview");
            preview.innerHTML = "";
            const img = document.createElement("img");

            if (event.target.files && event.target.files[0]) {
                img.src = URL.createObjectURL(event.target.files[0]);
                preview.appendChild(img);
            } else {
                preview.innerHTML = "<span>پیش‌نمایش تصویر</span>";
            }
        }
    </script>
</body>
</html>

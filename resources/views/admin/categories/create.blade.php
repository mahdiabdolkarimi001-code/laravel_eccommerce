<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>افزودن دسته‌بندی جدید</title>

  <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: "Vazirmatn", sans-serif;
      direction: rtl;
      background-color: #f0f2f5;
      color: #333;
      padding: 0;
      margin: 0;
      min-height: 100vh;
      display: flex;
      justify-content: center;
    }

    form {
      width: 90%;
      max-width: 900px;
      margin: 40px auto;
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
      background-color: #ffffff;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    h2 {
      width: 100%;
      text-align: center;
      color: #007bff;
      font-size: 1.7rem;
      margin-bottom: 25px;
      font-weight: 700;
    }

    .column {
      flex: 1;
      min-width: 320px;
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
    input[type="file"],
    select {
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

    input:focus, select:focus {
      outline: none;
      border-color: #007bff;
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
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

    .actions {
      width: 100%;
      margin-top: 20px;
      display: flex;
      justify-content: center;
      gap: 15px;
      flex-wrap: wrap;
    }

    button[type="submit"] {
      background-color: #007bff;
      color: #fff;
      border: none;
      padding: 10px 25px;
      border-radius: 8px;
      font-weight: 600;
      font-size: 1rem;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 2px 5px rgba(0,123,255,0.3);
    }

    button[type="submit"]:hover {
      background-color: #0056b3;
      box-shadow: 0 4px 10px rgba(0,123,255,0.4);
    }

    button[type="button"] {
      background-color: #6c757d;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    button[type="button"]:hover {
      background-color: #5a6268;
    }

    @media(max-width:850px){
      form {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>

  <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <h2>افزودن دسته‌بندی جدید</h2>

    <!-- ستون چپ: تصویر -->
    <div class="column">
      <div class="preview" id="imagePreview">
        <span>پیش‌نمایش تصویر دسته‌بندی</span>
      </div>
      <label for="image">انتخاب تصویر</label>
      <input type="file" name="image" id="image" accept="image/*" onchange="previewImage(event)" />
      <small style="color:#666">این تصویر جهت نمایش در بخش کاربری استفاده می‌شود (اختیاری)</small>
    </div>

    <!-- ستون راست: اطلاعات دسته‌بندی -->
    <div class="column">
      <label for="name">نام دسته‌بندی</label>
      <input type="text" id="name" name="name" placeholder="مثلاً لوازم الکترونیکی" required>

      <label for="navbar_category_id">دسته‌بندی ناوبری (اختیاری)</label>
      <select id="navbar_category_id" name="navbar_category_id">
        <option value="">— انتخاب نکردید —</option>
        @foreach($navbarCategories as $navbarCategory)
          <option value="{{ $navbarCategory->id }}">{{ $navbarCategory->name }}</option>
        @endforeach
      </select>

      <div class="actions">
        <button type="submit">ثبت دسته‌بندی</button>
        
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
            بازگشت
        </a>
      </div>
    </div>
  </form>

  <script>
    function previewImage(event){
      const preview = document.getElementById("imagePreview");
      preview.innerHTML = "";
      const img = document.createElement("img");
      img.src = URL.createObjectURL(event.target.files[0]);
      preview.appendChild(img);
    }
  </script>
</body>
</html>

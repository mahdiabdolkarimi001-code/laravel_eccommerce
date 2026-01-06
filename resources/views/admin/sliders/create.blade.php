<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8" />
  <title>افزودن اسلایدر جدید</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;600;700&display=swap');
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
      max-width: 1100px;
      margin: 40px auto;
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
      background-color: #ffffff;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
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
    textarea,
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
    input:focus, textarea:focus, select:focus {
      outline: none;
      border-color: #28a745;
      box-shadow: 0 0 5px rgba(40, 167, 69, 0.3);
    }
    textarea {
      resize: vertical;
      min-height: 100px;
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
      color:#888;
      font-size:.9rem;
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
    }
    button:hover {
      background-color: #1e7e34;
      box-shadow: 0 4px 10px rgba(30, 126, 52, 0.4);
    }
    .error-message {
      color: red;
      font-size: 0.9rem;
      margin-top: -12px;
      margin-bottom: 10px;
      display: block;
    }
    @media(max-width:850px){ form{ flex-direction:column; } }
  </style>
</head>
<body>

  <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data" id="slider-form">
    @csrf

    <h2>افزودن اسلایدر جدید</h2>

    <!-- ستون چپ -->
    <div class="column">
      <div class="preview" id="imagePreview">
        <span>پیش‌نمایش تصویر اسلایدر</span>
      </div>
      <label for="image">انتخاب تصویر اسلایدر *</label>
      <input type="file" name="image" id="image" accept="image/*" onchange="previewImage(event)" required />
      @error('image')
        <span class="error-message">{{ $message }}</span>
      @enderror

      <label for="link">لینک (اختیاری)</label>
      <input type="url" name="link" id="link" placeholder="مثلاً: https://yourdomain.com/sale" value="{{ old('link') }}" />
      @error('link')
        <span class="error-message">{{ $message }}</span>
      @enderror

      <h3 style="margin-top: 15px;">تنظیمات نمایش</h3>
      <div class="form-check" style="margin-bottom: 0;">
        <input type="checkbox" name="active" value="1" class="form-check-input" id="active" {{ old('active', true) ? 'checked' : '' }}>
        <label class="form-check-label" for="active">فعال باشد</label>
      </div>
      @error('active')
        <span class="error-message">{{ $message }}</span>
      @enderror
    </div>

    <!-- ستون راست -->
    <div class="column">
      <label for="title">عنوان اسلایدر (اختیاری)</label>
      <input type="text" name="title" id="title" placeholder="مثلاً: تخفیف ویژه تابستانی" value="{{ old('title') }}" />
      @error('title')
        <span class="error-message">{{ $message }}</span>
      @enderror

      <div class="actions">
        <button type="submit">ذخیره اسلایدر</button>
        <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">
            بازگشت
        </a>
      </div>
    </div>
  </form>

  <script>
    function previewImage(event) {
      const preview = document.getElementById("imagePreview");
      preview.innerHTML = "";
      const img = document.createElement("img");
      if (event.target.files && event.target.files[0]) {
          img.src = URL.createObjectURL(event.target.files[0]);
          preview.appendChild(img);
      } else {
          preview.innerHTML = "<span>پیش‌نمایش تصویر اسلایدر</span>";
      }
    }
  </script>
</body>
</html>

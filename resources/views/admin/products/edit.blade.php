<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8" />
  <title>افزودن محصول جدید</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;600;700&display=swap');
    body {
      font-family: "Vazirmatn", sans-serif;
      direction: rtl;
      background-color: #f0f2f5; /* پس‌زمینه روشن */
      color: #333; /* متن تیره */
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
      background-color: #ffffff; /* فرم با پس‌زمینه سفید */
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1); /* سایه نرم‌تر */
    }
    h2 {
      width: 100%;
      text-align: center;
      color: #007bff; /* رنگ آبی برای عنوان */
      font-size: 1.7rem;
      margin-bottom: 25px;
      font-weight: 700;
    }
    h3 {
      margin-top: 25px;
      color: #007bff;
      font-weight: 600;
    }
    .column {
      flex: 1;
      min-width: 340px;
      background-color: #fafafa; /* کمی متفاوت از سفید اصلی */
      border-radius: 12px;
      padding: 25px;
      border: 1px solid #e0e0e0; /* حاشیه سبک */
    }
    label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
      color: #555;
    }
    input[type="text"],
    input[type="number"],
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
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    input:focus, textarea:focus, select:focus {
      outline: none;
      border-color: #007bff;
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
    }
    textarea {
      resize: vertical;
      min-height: 100px;
    }
    .preview {
      width: 100%;
      height: 260px;
      border: 2px dashed #aaa; /* خط‌چین خاکستری */
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
    .attribute-row {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 10px;
      background: #f0f0f0;
      border-radius: 6px;
      padding: 10px;
      border: 1px solid #eee;
    }
    .attribute-row input { flex: 1; }
    .attribute-row button {
      background-color: #dc3545; /* قرمز برای حذف */
      border: none;
      border-radius: 5px;
      padding: 8px 12px;
      color: #fff;
      cursor: pointer;
      transition: 0.2s;
      font-size: 0.9rem;
    }
    .attribute-row button:hover { background-color: #c82333; }
    .actions {
      margin-top: 30px;
      display: flex;
      gap: 15px;
      justify-content: center;
      flex-wrap: wrap;
    }
    button[type="submit"],
    button[type="button"],
    .add-attr-btn {
      background-color: #007bff; /* رنگ آبی اصلی */
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
      transition: all 0.3s ease;
      box-shadow: 0 2px 5px rgba(0, 123, 255, 0.3);
    }
    button:hover,
    .add-attr-btn:hover {
      background-color: #0056b3;
      box-shadow: 0 4px 10px rgba(0, 123, 255, 0.4);
    }
    @media(max-width:850px){ form{ flex-direction:column; } }
  </style>
</head>
<body>

  <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="product-form">
    @csrf
    {{-- @method('PUT') حذف شد و به POST تغییر یافت --}}

    <h2>افزودن محصول جدید</h2>

    <!-- ستون چپ -->
    <div class="column">
      <div class="preview" id="imagePreview">
        <span>پیش‌نمایش تصویر محصول</span>
      </div>
      <label for="image">انتخاب تصویر محصول</label>
      <input type="file" name="image" id="image" accept="image/*" onchange="previewImage(event)" />

      <label for="category_id">دسته‌بندی</label>
      <select name="category_id" id="category_id">
        <option value="">انتخاب دسته‌بندی</option>
        @foreach($categories as $cat)
          <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach
      </select>

      <label for="navbar_category_id">دسته‌بندی نوار ناوبر</label>
      <select name="navbar_category_id" id="navbar_category_id">
        <option value="">انتخاب کنید</option>
        @foreach($navbarCategories as $cat)
          <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach
      </select>

      <label for="subcategory_id">زیرشاخه</label>
      <select name="subcategory_id" id="subcategory_id">
        <option value="">ابتدا دسته‌بندی نوار ناوبر را انتخاب کنید</option>
      </select>

      <label for="category_icon_id">دسته‌بندی آیکونی</label>
      <select name="category_icon_id" id="category_icon_id">
        <option value="">— انتخاب کنید —</option>
        @foreach($categoryIcons as $icon)
          <option value="{{ $icon->id }}">{{ $icon->name }}</option>
        @endforeach
      </select>
    </div>

    <!-- ستون راست -->
    <div class="column">
      <label>عنوان محصول</label>
      <input type="text" name="title" placeholder="مثلاً لپ‌تاپ گیمینگ ایسوس" />

      <label>توضیحات</label>
      <textarea name="description" placeholder="توضیحات کامل محصول را بنویسید..."></textarea>

      <label>قیمت (تومان)</label>
      <input type="number" name="price" placeholder="مثلاً 4500000" />

      <label>برند</label>
      <input type="text" name="brand" placeholder="مثلاً ایسوس" />

      <label>درصد تخفیف</label>
      <input type="number" name="discount" min="0" max="100" placeholder="مثلاً 15" />

      <h3>مشخصات محصول</h3>
      <div id="attributes-container">
        <div class="attribute-row">
          <input type="text" name="attributes[0][name]" placeholder="مثلاً رنگ" />
          <input type="text" name="attributes[0][value]" placeholder="مثلاً مشکی" />
          <button type="button" onclick="removeAttribute(this)">حذف</button>
        </div>
      </div>

      <button type="button" class="add-attr-btn" onclick="addAttribute()">افزودن مشخصه</button>

      <div class="actions">
        <button type="submit">ذخیره محصول</button>
        <button type="button" onclick="window.location.href='{{ route('admin.products.index') }}'">بازگشت</button>
      </div>
    </div>
  </form>

  <script>
    const subcategorySelect = document.getElementById("subcategory_id");
    const navbarSelect = document.getElementById("navbar_category_id");

    navbarSelect.addEventListener("change", function() {
      const navbarId = this.value;
      if (!navbarId) {
        subcategorySelect.innerHTML = '<option value="">ابتدا دسته‌بندی نوار ناوبر را انتخاب کنید</option>';
        return;
      }
      // این مسیر باید به API صحیح بک‌اند شما برای دریافت زیرشاخه‌ها اشاره کند
      fetch(`/admin/navbar-categories/${navbarId}/subcategories`)
        .then(res => res.json())
        .then(data => {
          subcategorySelect.innerHTML = '<option value="">انتخاب زیرشاخه</option>';
          data.forEach(sub => {
            subcategorySelect.innerHTML += `<option value="${sub.id}">${sub.name}</option>`;
          });
        });
    });

    function previewImage(event) {
      const preview = document.getElementById("imagePreview");
      preview.innerHTML = "";
      const img = document.createElement("img");
      img.src = URL.createObjectURL(event.target.files[0]);
      preview.appendChild(img);
    }

    let attributeIndex = 1;
    function addAttribute(){
      const container = document.getElementById("attributes-container");
      const div = document.createElement("div");
      div.classList.add("attribute-row");
      div.innerHTML = `
        <input type="text" name="attributes[${attributeIndex}][name]" placeholder="ویژگی" />
        <input type="text" name="attributes[${attributeIndex}][value]" placeholder="مقدار" />
        <button type="button" onclick="removeAttribute(this)">حذف</button>
      `;
      container.appendChild(div);
      attributeIndex++;
    }
    function removeAttribute(btn){ btn.parentElement.remove(); }
  </script>
</body>
</html>

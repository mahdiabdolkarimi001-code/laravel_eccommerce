<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
<meta charset="UTF-8" />
<title>داشبورد مدیریت محصولات</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<style>
    /* --- استایل‌های پایه و فونت Vazirmatn --- */
    @import url('https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;600;700&display=swap');

    body {
        font-family: "Vazirmatn", sans-serif;
        background: #f4f7f9; /* پس‌زمینه روشن و تمیز */
        color: #333;
        margin: 0;
        padding: 0;
        display: flex;
        min-height: 100vh;
        overflow-x: hidden;
        transition: margin-right 0.3s ease;
    }

    /* === Sidebar === */
    #sidebar {
      background-color: #ffffff;
      width: 60px;
      height: 100vh;
      position: fixed;
      top: 0;
      right: 0;
      padding: 60px 0;
      box-shadow: -2px 0 12px rgba(0,0,0,0.08);
      overflow: hidden;
      transition: width 0.3s ease;
      display: flex;
      flex-direction: column;
      align-items: center;
      z-index: 1000;
    }

    #sidebar.open {
      width: 200px;
      align-items: flex-start;
      padding-left: 20px;
    }

    #sidebar nav {
      width: 100%;
      display: flex;
      flex-direction: column;
      margin-top: 20px;
    }

    #sidebar a {
      color: #555;
      padding: 14px 12px;
      text-decoration: none;
      font-weight: 600;
      font-size: 14px;
      border-bottom: 1px solid #eee;
      display: flex;
      align-items: center;
      gap: 12px;
      white-space: nowrap;
      transition: 0.25s ease;
    }

    #sidebar:not(.open) a {
      justify-content: center;
      text-indent: -9999px;
    }

    #sidebar a:hover {
      background-color: #eaf4ff;
      color: #007bff;
    }

    #sidebar svg {
      width: 20px;
      height: 20px;
      fill: currentColor;
      flex-shrink: 0;
    }

    /* دکمه تاگل */
    #toggle-btn {
        position: fixed;
        top: 15px;
        right: 70px; 
        width: 30px;
        height: 30px;
        background-color: #007bff;
        border-radius: 4px 0 0 4px;
        border: none;
        color: white;
        font-weight: bold;
        cursor: pointer;
        transition: right 0.3s ease;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1100;
    }

    #sidebar.open ~ #toggle-btn {
        right: 220px; 
        border-radius: 0 4px 4px 0; 
    }

    /* محتوای اصلی */
    main {
        flex-grow: 1;
        margin-right: 70px; 
        padding: 40px 30px;
        transition: margin-right 0.3s ease;
        min-width: 0;
    }

    #sidebar.open ~ main {
        margin-right: 220px; 
    }

    h2 {
        margin-bottom: 30px;
        font-weight: 700;
        font-size: 30px;
        color: #007bff;
        border-bottom: 2px solid #e0e0e0;
        padding-bottom: 10px;
    }

    /* دکمه افزودن محصول (مشابه دکمه اصلی فرم مرجع) */
    a.button-primary {
        display: inline-block;
        padding: 12px 24px;
        background-color: #007bff;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 25px; /* فاصله بیشتر از فرم */
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
    }

    a.button-primary:hover {
        background-color: #0056b3;
        box-shadow: 0 6px 15px rgba(0, 123, 255, 0.5);
    }
    
    /* ساختار فرم اصلی (الهام از ظاهر فرم مرجع) */
    #productsForm {
        border: 1px solid #e0e0e0; /* حاشیه سبک‌تر */
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 30px;
        background-color: #ffffff; /* پس‌زمینه سفید */
        box-shadow: 0 4px 20px rgba(0,0,0,0.05); /* سایه نرم */
        display: block; /* برای اطمینان از رفتار صحیح در کل محتوا */
    }

    .form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 10px;
        border-bottom: 1px solid #e0e0e0;
    }

    .form-header h3 {
        margin: 0;
        font-size: 20px;
        color: #007bff;
        font-weight: 600;
    }
    
    /* دکمه‌های عملیات دسته‌ای (الهام از دکمه‌های Submit) */
    .bulk-actions-container {
        display: flex;
        gap: 10px;
    }

    .btn-action {
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        font-size: 14px;
    }

    .btn-delete-bulk {
        background-color: #dc3545; 
        color: white;
        box-shadow: 0 2px 5px rgba(220, 53, 69, 0.3);
    }

    .btn-delete-bulk:hover {
        background-color: #c82333;
        box-shadow: 0 4px 10px rgba(220, 53, 69, 0.4);
    }
    
    /* --- استایل کارت‌ها (باریک‌تر و ساده‌تر) --- */
    /* برای داشتن کارت‌های "طولانی‌تر و باریک‌تر"، از یک تعداد ستون ثابت و عرض کمتر استفاده می‌کنیم */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); /* عرض کمتر (200px) و سهم بیشتر از فضا */
        gap: 20px;
    }

    .product-card {
        background-color: #ffffff;
        border-radius: 10px; /* گوشه‌های گردتر الهام گرفته از فرم مرجع */
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        padding: 15px;
        display: flex;
        flex-direction: column;
        border-top: 3px solid #007bff; /* نوار آبی برای زیبایی بیشتر */
        transition: transform 0.2s ease;
    }
    
    .product-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .product-image-container {
        text-align: center;
        margin-bottom: 10px;
    }

    .product-image {
        width: 100%;
        max-height: 120px; /* کمی کوچکتر */
        object-fit: contain;
        border-radius: 6px;
        background-color: #f0f2f5;
        padding: 5px;
    }

    /* عنوان ساده‌تر و کوتاهتر */
    .product-title {
        font-size: 15px; 
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
        height: 40px; /* ارتفاع ثابت */
        overflow: hidden;
    }
    
    .product-category {
        font-size: 11px;
        color: #777;
        margin-bottom: 10px;
    }

    .product-price {
        font-size: 17px;
        font-weight: 700;
        color: #28a745; /* سبز */
        margin-top: auto;
        margin-bottom: 15px;
    }

    /* دکمه‌های ساده و جای‌گیری مناسب (در انتهای کارت) */
    .actions-container {
        display: flex;
        justify-content: space-between;
        gap: 8px;
    }

    .btn-edit-card, .btn-delete-card {
        flex-grow: 1;
        padding: 8px 0;
        border-radius: 6px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 600;
        text-align: center;
        transition: opacity 0.2s;
    }

    .btn-edit-card {
        background-color: #e9ecef; /* خاکستری روشن */
        color: #495057;
    }

    .btn-edit-card:hover {
        background-color: #d6d8db;
    }

    .btn-delete-card {
        background-color: #f8d7da; /* قرمز بسیار روشن */
        color: #721c24;
        border: 1px solid #f5c6cb;
        cursor: pointer;
    }

    .btn-delete-card:hover {
        background-color: #f5c6cb;
    }
    
    /* چک‌باکس برای فرم دسته‌ای */
    .product-card input[type="checkbox"] {
        position: absolute;
        top: 10px;
        right: 10px;
        transform: scale(1.2);
        z-index: 10;
        opacity: 0.8;
    }
    
</style>
</head>
<body>

    <!-- Sidebar -->
<div id="sidebar" class="open">
  <nav>

    <a href="{{ url('admin/dashboard') }}">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8v-10h-8v10zm0-18v6h8V3h-8z"/>
      </svg>
      <span>داشبورد</span>
    </a>

    <a href="{{ url('admin/products/create') }}">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6v-2z"/>
      </svg>
      <span>افزودن محصول</span>
    </a>

    <a href="{{ url('admin/users') }}">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M16 11c1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 3-1.34 3-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4z"/>
      </svg>
      <span>مدیریت کاربران</span>
    </a>

    <a href="{{ url('admin/orders') }}">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M20 8h-3V6a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2z"/>
      </svg>
      <span>مدیریت سفارشات</span>
    </a>

    <a href="{{ url('admin/categories') }}">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M4 6h16v2H4V6zm0 5h16v2H4v-2zm0 5h16v2H4v-2z"/>
      </svg>
      <span>مدیریت دسته‌بندی‌ها</span>
    </a>

    <a href="{{ url('admin/sliders') }}">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <rect x="2" y="5" width="6" height="14"/>
        <rect x="9" y="3" width="6" height="18"/>
        <rect x="16" y="7" width="6" height="10"/>
      </svg>
      <span>مدیریت اسلایدر</span>
    </a>

    <a href="{{ url('admin/category_icons') }}">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M10 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-8l-2-2z"/>
      </svg>
      <span>مدیریت آیکن داشبورد</span>
    </a>

    <a href="{{ url('admin/custom-product-bars') }}">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M7 4h-2l-1 2H1v2h1l3.6 7.59-1.35 2.45A1 1 0 0 0 5 20h14v-2H6.42a.25.25 0 0 1-.24-.17l.03-.06L7.1 15h7.45a1 1 0 0 0 .92-.61l3.58-8.59A1 1 0 0 0 18 4H7z"/>
      </svg>
      <span>نوار محصولات</span>
    </a>

  </nav>
</div>

    <!-- دکمه تاگل -->
    <button id="toggle-btn" aria-label="باز/بسته کردن منو">≡</button>

    <main>
        <h2>مدیریت محصولات</h2>

        <!-- دکمه افزودن محصول -->
        <a href="{{ url('admin/products/create') }}" class="button-primary">افزودن محصول جدید</a>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        {{-- ساختار جدید: فرم بزرگ که کارت‌ها را در بر می‌گیرد --}}
        <form id="productsForm" action="{{ url('/admin/products/bulk-action') }}" method="POST"> 
            @csrf
            <div class="form-header">
                <h3>لیست محصولات جاری</h3>
                <div class="bulk-actions-container">
                    {{-- دکمه حذف دسته‌جمعی --}}
                    <button type="submit" name="action" value="delete_selected" class="btn-action btn-delete-bulk">حذف انتخاب شده‌ها</button>
                    
                    {{-- یک دکمه دیگر برای عملیات دیگر یا صرفاً جهت زیبایی --}}
                    <button type="button" onclick="alert('در حال حاضر فقط عملیات حذف فعال است.')" class="btn-action btn-edit-card" style="background-color: #e9ecef; color: #495057;">مشاهده</button>
                </div>
            </div>

            <div class="product-grid">
                {{-- منطق Blade: @foreach کاملاً حفظ شد --}}
                @foreach($products as $product)
                    <div class="product-card">
                        {{-- چک‌باکس در گوشه بالا سمت راست --}}
                        <input type="checkbox" name="selected_ids[]" value="{{ $product->id }}">

                        <div class="product-image-container">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="product-image">
                            @else
                                <div class="product-image" style="display: flex; align-items: center; justify-content: center;">
                                    تصویر پیش‌فرض
                                </div>
                            @endif
                        </div>
                        <div class="product-title">{{ $product->title }}</div>
                        <div class="product-category">
                            دسته: {{ $product->category_icon ? $product->category_icon->name : 'عمومی' }}
                        </div>
                        <div class="product-price">
                            @if($product->price)
                                {{ number_format($product->price) }} تومان
                            @else
                                —
                            @endif
                        </div>

                        {{-- دکمه‌های ساده در انتهای کارت --}}
                        <div class="actions-container">
                            <a href="{{ url('admin/products/' . $product->id . '/edit') }}" class="btn-action btn-edit-card">ویرایش</a>
                            
                            {{-- فرم حذف تکی --}}
                            <form action="{{ url('admin/products/' . $product->id) }}" method="POST" style="flex-grow: 1;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete-card" onclick="return confirm('آیا از حذف این محصول مطمئن هستید؟')">حذف</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </form>
        
        {{-- منطق صفحه‌بندی Blade حفظ شد --}}
        <nav aria-label="Pagination">
            {{ $products->links() }}
        </nav>
    </main>

<script>
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggle-btn');
    const mainContent = document.querySelector('main');

    function toggleSidebar() {
        sidebar.classList.toggle('open');
        
        if (sidebar.classList.contains('open')) {
            mainContent.style.marginRight = '220px';
            toggleBtn.style.right = '220px'; 
            toggleBtn.style.borderRadius = '0 4px 4px 0'; 
        } else {
            mainContent.style.marginRight = '70px';
            toggleBtn.style.right = '70px'; 
            toggleBtn.style.borderRadius = '4px 0 0 4px'; 
        }
    }

    toggleBtn.addEventListener('click', toggleSidebar);

    document.addEventListener('DOMContentLoaded', () => {
        if (!sidebar.classList.contains('open')) {
            mainContent.style.marginRight = '70px';
            toggleBtn.style.right = '70px';
        }
    });
</script>

</body>
</html>

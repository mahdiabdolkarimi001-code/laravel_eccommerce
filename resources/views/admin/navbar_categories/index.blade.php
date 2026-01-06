<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>مدیریت دسته‌بندی نوار ناوبر</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />

  <style>
    @import url('https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.1.0/dist/font-face.css');

    body {
      background: linear-gradient(180deg, #f5f5f5, #eaeaea);
      color: #333;
      font-family: 'Vazir', Tahoma, sans-serif;
      direction: rtl;
      padding: 35px 15px;
      min-height: 100vh;
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

    /* ===== Toggle ===== */
    #toggle-btn {
      position: fixed;
      top: 15px;
      right: 40px;
      width: 35px;
      height: 35px;
      background:#1565c0;
      border:none;
      border-radius:4px 0 0 4px;
      color:#fff;
      cursor:pointer;
      z-index:1100;
      transition:right .3s ease;
    }
    #sidebar.open ~ #toggle-btn { right:210px }

    /* ===== Content ===== */
    .container {
      max-width: 1000px;
      background:#fff;
      border-radius:16px;
      padding:40px 45px;
      box-shadow:0 6px 25px rgba(0,0,0,.1);
    }

    h4 {
      margin-bottom:30px;
      color:#1565c0;
      font-weight:700;
      border-bottom:2px solid #1565c0;
      padding-bottom:10px;
      font-size:1.9rem;
    }

    .card-grid {
      display:grid;
      grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
      gap:20px;
    }

    .category-card {
      background:#fafafa;
      border:1px solid #ddd;
      border-radius:12px;
      padding:20px;
      box-shadow:0 5px 15px rgba(0,0,0,.08);
      transition:.25s;
    }
    .category-card:hover {
      transform:translateY(-3px);
      box-shadow:0 8px 18px rgba(21,101,192,.15);
    }

    .category-card h5 {
      font-size:1.2rem;
      font-weight:700;
      color:#1565c0;
    }

    .card-actions {
      display:flex;
      justify-content:flex-end;
      gap:10px;
      flex-wrap:wrap;
    }

    @media (max-width:767px){
      .container{padding:25px 20px}
      h4{text-align:center;font-size:1.4rem}
      #sidebar.open{width:70%}
      #sidebar.open ~ #toggle-btn{right:70%}
      .card-grid{grid-template-columns:1fr}
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

<button id="toggle-btn" onclick="toggleSidebar()">☰</button>

<div class="container">
  <div class="d-flex justify-content-between align-items-center flex-row-reverse mb-4">
    <h4>مدیریت دسته‌بندی‌های نوار ناوبر</h4>
    <a href="{{ route('admin.navbar-categories.create') }}" class="btn btn-success">
      افزودن دسته
    </a>
  </div>

  <div class="card-grid">
    @forelse($navbarCategories as $cat)
      <div class="category-card">
        <h5>{{ $cat->name }}</h5>
        <p class="text-muted">تعداد زیرمجموعه‌ها: {{ $cat->children_count ?? 0 }}</p>

        <div class="card-actions">
          <a href="{{ route('admin.navbar-categories.edit',$cat->id) }}" class="btn btn-warning">
            ویرایش
          </a>

          <form action="{{ route('admin.navbar-categories.destroy',$cat->id) }}"
                method="POST"
                onsubmit="return confirm('آیا مطمئن هستید؟');">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">حذف</button>
          </form>
        </div>
      </div>
    @empty
      <p class="text-center text-muted col-12">هیچ دسته‌بندی‌ای یافت نشد.</p>
    @endforelse
  </div>
</div>

<script>
function toggleSidebar(){
  document.getElementById('sidebar').classList.toggle('open');
}
</script>

</body>
</html>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>مدیریت دسته‌بندی‌ها</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- فونت و آیکن‌ها -->
  <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <style>
    body {
      font-family: "Vazirmatn", sans-serif;
      background-color: #f4f7f9;
      margin: 0;
      min-height: 100vh;
      display: flex;
      color: #333;
      overflow-x: hidden;
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

    /* Toggle */
    #toggle-btn {
      position: fixed;
      top: 15px;
      right: 60px;
      width: 32px;
      height: 32px;
      background: #007bff;
      color: #fff;
      border: none;
      border-radius: 4px 0 0 4px;
      cursor: pointer;
      z-index: 1100;
      font-size: 18px;
    }

    #sidebar.open ~ #toggle-btn {
      right: 200px;
    }

    /* === Main === */
    main {
      flex: 1;
      margin-right: 60px;
      padding: 40px 30px;
      transition: margin-right 0.3s ease;
    }

    #sidebar.open ~ main {
      margin-right: 200px;
    }

    h3 {
      font-weight: 700;
      color: #007bff;
      border-bottom: 2px solid #e0e0e0;
      padding-bottom: 10px;
      margin-bottom: 25px;
    }

    .alert-success {
      background: #d4edda;
      color: #155724;
      padding: 12px 15px;
      border-radius: 10px;
      border: 1px solid #c3e6cb;
      margin-bottom: 15px;
    }

    .add-btn {
      background-color: #007bff;
      color: white;
      padding: 10px 20px;
      border-radius: 8px;
      font-weight: 600;
      text-decoration: none;
      transition: 0.3s ease;
      box-shadow: 0 3px 10px rgba(0,123,255,0.3);
      margin-bottom: 25px;
      display: inline-block;
    }

    .add-btn:hover {
      background-color: #0056b3;
    }

    /* === Category Cards === */
    .cards-container {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
      gap: 20px;
    }

    .category-card {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.05);
      overflow: hidden;
      transition: 0.3s ease;
    }

    .category-card::before {
      content: "";
      display: block;
      height: 6px;
      background-color: #007bff;
    }

    .category-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 5px 16px rgba(0,123,255,0.2);
    }

    .card-body {
      padding: 15px;
      text-align: center;
    }

    .category-name {
      font-size: 17px;
      font-weight: 600;
      margin-bottom: 15px;
      color: #333;
    }

    .btn-danger {
      background-color: #dc3545;
      border: none;
      color: #fff;
      border-radius: 8px;
      font-weight: 600;
      padding: 8px 16px;
      cursor: pointer;
      transition: 0.3s ease;
      box-shadow: 0 3px 8px rgba(220,53,69,0.3);
    }

    .btn-danger:hover {
      background-color: #b42b38;
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

<!-- Main -->
<main>

  <h3><i class="fa-solid fa-list-check"></i> مدیریت دسته‌بندی‌ها</h3>

  @if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
  @endif

  <a href="{{ route('admin.categories.create') }}" class="add-btn">
    <i class="fa-solid fa-plus"></i> افزودن دسته‌بندی جدید
  </a>

  <div class="cards-container">
    @forelse($categories as $cat)
      <div class="category-card">
        <div class="card-body">
          <div class="category-name">{{ $cat->name }}</div>
          <form action="{{ route('categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('آیا مطمئن هستید؟')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-danger">
              <i class="fa-solid fa-trash"></i> حذف
            </button>
          </form>
        </div>
      </div>
    @empty
      <p>هیچ دسته‌بندی‌ای وجود ندارد.</p>
    @endforelse
  </div>

</main>

<script>
  function toggleSidebar() {
    document.getElementById("sidebar").classList.toggle("open");
  }
</script>

</body>
</html>

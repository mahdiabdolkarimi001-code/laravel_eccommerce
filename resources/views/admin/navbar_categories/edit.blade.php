<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ویرایش دسته‌بندی ناوبر</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />
    <style>
        @import url('https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.1.0/dist/font-face.css');
        body {
            background: linear-gradient(180deg, #f5f5f5, #eaeaea);
            color: #333;
            font-family: 'Vazir', sans-serif;
            padding: 40px 15px;
        }

        .container {
            max-width: 650px;
            background: #ffffff;
            border-radius: 16px;
            padding: 40px 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin: auto;
        }

        h4 {
            text-align: right;
            font-weight: 700;
            font-size: 1.9rem;
            color: #1565c0;
            border-bottom: 2px solid #1565c0;
            margin-bottom: 30px;
            padding-bottom: 10px;
        }

        label.form-label { font-weight: 600; }

        input.form-control {
            background: #f7f7f7;
            border: 1.5px solid #ccc;
            border-radius: 10px;
            transition: all 0.25s;
        }
        input.form-control:focus {
            border-color: #1565c0;
            box-shadow: 0 0 6px rgba(21, 101, 192, 0.25);
            background: #fff;
        }

        #subcategory-fields {
            background-color: #f9f9f9;
            border: 1px dashed #ccc;
            border-radius: 12px;
            padding: 18px;
            margin-bottom: 25px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1976d2, #1565c0);
            border: none;
            width: 100%;
            border-radius: 50px;
            padding: 12px;
            font-weight: 700;
            font-size: 1.1rem;
            box-shadow: 0 5px 15px rgba(25,118,210,0.3);
        }

        .btn-outline-secondary, .btn-outline-danger {
            border-radius: 10px;
            font-weight: 700;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(7px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .added-field { animation: fadeIn 0.3s ease; }

        @media (max-width: 767px) {
            .container { padding: 25px 20px; }
            h4 { text-align: center; font-size: 1.6rem; }
            input.form-control { font-size: 0.95rem; }
            .btn-primary { font-size: 1rem; padding: 10px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h4>ویرایش دسته‌بندی</h4>

        <form action="{{ route('admin.navbar-categories.update', $navbarCategory) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="form-label" for="name">نام دسته‌بندی</label>
                <input type="text" id="name" name="name" value="{{ $navbarCategory->name }}" class="form-control" required>
            </div>

            <div id="subcategory-fields">
                <label class="form-label mb-3">زیرشاخه‌ها</label>
                @foreach($navbarCategory->subcategories as $sub)
                    <div class="input-group mb-2">
                        <input type="text" name="subcategories[]" value="{{ $sub->name }}" class="form-control">
                        <button type="button" class="btn btn-outline-danger" onclick="this.parentNode.remove()">حذف</button>
                    </div>
                @endforeach
                <div class="input-group mb-2">
                    <input type="text" name="subcategories[]" class="form-control" placeholder="افزودن زیرشاخه جدید">
                    <button type="button" class="btn btn-outline-secondary" onclick="addSubcategory()">افزودن</button>
                </div>
            </div>

            <button type="submit" class="btn-primary">به‌روزرسانی دسته‌بندی</button>
        </form>
    </div>

    <script>
        function addSubcategory() {
            const container = document.getElementById('subcategory-fields');
            const div = document.createElement('div');
            div.className = 'input-group mb-2 added-field';
            div.innerHTML = `
                <input type="text" name="subcategories[]" class="form-control" placeholder="زیرشاخه جدید">
                <button type="button" class="btn btn-outline-danger" onclick="div.remove()">حذف</button>
            `;
            container.appendChild(div);
        }
    </script>
</body>
</html>

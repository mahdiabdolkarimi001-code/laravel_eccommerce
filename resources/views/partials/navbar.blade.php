<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ul class="navbar-nav">
    @foreach($navbarCategories->whereNull('parent_id') as $parent)
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">{{ $parent->name }}</a>
            <ul class="dropdown-menu">
                @foreach($parent->children as $child)
                    <li><a class="dropdown-item" href="{{ route('navbar-category.products', $child->id) }}">{{ $child->name }}</a></li>
                @endforeach
            </ul>
        </li>
    @endforeach
</ul>

</body>
</html>
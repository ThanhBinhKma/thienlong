<?php
/*
|--------------------------------------------------------------------------
| Web Breakcrumbs
|--------------------------------------------------------------------------
*/
/**
* Faqs
*/
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Trang chủ');
});


// Home > Blog > Bài viết
Breadcrumbs::for('event', function ($trail) {
    $trail->parent('home');
    $trail->push('Sự kiện');
});

// Home > Blog > Create new post
Breadcrumbs::for('addevent', function ($trail) {
    $trail->parent('home');
    $trail->push('Tạo sự kiện');
});

// Home > Blog > Edit Post
Breadcrumbs::for('editevent', function ($trail) {
    $trail->parent('home');
    $trail->push('Sửa sự kiện');
});

// Home > Categories
Breadcrumbs::for('categories', function ($trail) {
    $trail->parent('home');
    $trail->push('Chuyên mục');
});

// Home > Chuyên mục > Tạo chuyên mục
Breadcrumbs::for('addcategory', function ($trail) {
    $trail->parent('categories');
    $trail->push('Tạo chuyên mục');
});

// Home > Chuyên mục > Chỉnh sửa chuyên mục
Breadcrumbs::for('editcategory', function ($trail) {
    $trail->parent('categories');
    $trail->push('Chỉnh sửa chuyên mục');
});

// Home > Trang

// Home > Trang > Sửa Trang

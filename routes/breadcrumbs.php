<?php
/*
|--------------------------------------------------------------------------
| Web Breakcrumbs
|--------------------------------------------------------------------------
*/
/**
* Faqs
*/



// Home > Blog > Bài viết
Breadcrumbs::for('posts', function ($trail) {
    $trail->parent('home');
    $trail->push('Bài viết');
});

// Home > Blog > Create new post
Breadcrumbs::for('addpost', function ($trail) {
    $trail->parent('home');
    $trail->push('Create new post');
});

// Home > Blog > Edit Post
Breadcrumbs::for('editpost', function ($trail) {
    $trail->parent('home');
    $trail->push('Edit Post');
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

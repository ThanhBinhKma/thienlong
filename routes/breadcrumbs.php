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
    $trail->parent('event');
    $trail->push('Tạo sự kiện');
});

// Home > Blog > Edit Post
Breadcrumbs::for('editevent', function ($trail) {
    $trail->parent('event');
    $trail->push('Sửa sự kiện');
});

// Home > Categories
Breadcrumbs::for('member', function ($trail) {
    $trail->parent('home');
    $trail->push('Thành viên');
});

// Home > Chuyên mục > Tạo chuyên mục
Breadcrumbs::for('addmember', function ($trail) {
    $trail->parent('member');
    $trail->push('Tạo thành viên');
});

// Home > Chuyên mục > Chỉnh sửa chuyên mục
Breadcrumbs::for('editmember', function ($trail) {
    $trail->parent('member');
    $trail->push('Chỉnh sửa thành viên');
});

// Home > Categories
Breadcrumbs::for('partner', function ($trail) {
    $trail->parent('home');
    $trail->push('Đối tác');
});

// Home > Chuyên mục > Tạo chuyên mục
Breadcrumbs::for('editpartner', function ($trail) {
    $trail->parent('partner');
    $trail->push('Tạo đối tác');
});

// Home > Chuyên mục > Chỉnh sửa chuyên mục
Breadcrumbs::for('addpartner', function ($trail) {
    $trail->parent('partner');
    $trail->push('Chỉnh sửa đối tác');
});

// Home > Trang

// Home > Trang > Sửa Trang

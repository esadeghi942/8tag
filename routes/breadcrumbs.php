<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use App\Models\User;

/*********admin***********/
Breadcrumbs::for('admin', function ($trail) {
    $trail->push('مدیریت', route('admin'));
});

Breadcrumbs::for('admin.user.index', function ($trail) {
    $trail->parent('admin');
    $trail->push('لیست کاربران', route('admin.user.index'));
});

Breadcrumbs::for('admin.user.create', function ($trail) {
    $trail->parent('admin');
    $trail->push('ایجاد کاربر جدید', route('admin.user.create'));
});

Breadcrumbs::for('admin.role.create', function ($trail) {
    $trail->parent('admin');
    $trail->push('ایجاد شاخه کاری جدید', route('admin.role.create'));
});

Breadcrumbs::for('admin.user.edit', function ($trail,$user) {
    $trail->parent('admin');
    $trail->push('ویرایش کاربر', route('admin.user.edit',$user->user_id));
});

Breadcrumbs::for('admin.role.edit', function ($trail,$role) {
    $trail->parent('admin');
    $trail->push('ویرایش شاخه کاری', route('admin.role.edit',$role->id));
});

Breadcrumbs::for('admin.role.index', function ($trail) {
    $trail->parent('admin');
    $trail->push('لیست کل شاخه های کاری', route('admin.role.index'));
});

Breadcrumbs::for('admin.leavement.index', function ($trail) {
    $trail->parent('admin');
    $trail->push('لیست کل مرخصی ها', route('admin.leavement.index'));
});

Breadcrumbs::for('admin.worktime.index', function ($trail,$user_id) {
    $trail->parent('admin');
    $name=User::find($user_id);
    $name=$name->fname.' '.$name->lname;
    $trail->push('لیست کل کارکردهای '.$name, route('admin.worktime.index',$user_id));
});

/*************users**************/

Breadcrumbs::for('index', function ($trail) {
    $trail->push('خانه', route('index'));
});

Breadcrumbs::for('user.leavement.index', function ($trail) {
    $trail->parent('index');
    $trail->push('لیست کل مرخصی ها', route('user.leavement.index'));
});

Breadcrumbs::for('user.leavement.create', function ($trail) {
    $trail->parent('index');
    $trail->push('درخواست مرخصی ', route('user.leavement.create'));
});

Breadcrumbs::for('user.leavement.edit', function ($trail,$leavement) {
    $trail->parent('index');
    $trail->push('ویرایش مرخصی', route('user.leavement.edit',$leavement->id));
});

Breadcrumbs::for('user.worktime.create', function ($trail) {
    $trail->parent('index');
    $trail->push('ثبت ساعت کاری ', route('user.worktime.create'));
});

Breadcrumbs::for('user.worktime.edit', function ($trail,$worktime) {
    $trail->parent('index');
    $trail->push('ویرایش ساعت کاری', route('user.worktime.edit',$worktime->id));
});

Breadcrumbs::for('user.worktime.index', function ($trail) {
    $trail->parent('index');
    $trail->push('لیست کل ساعات کاری', route('user.worktime.index'));
});
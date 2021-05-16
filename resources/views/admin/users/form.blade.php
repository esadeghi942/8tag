<style>
    .user_image img{
        width: 100px;
    }
</style>
<div class="content-wrapper">
   <?php
    if(isset($userItem))
       echo Breadcrumbs::render('admin.user.edit',$userItem);
    else
        echo Breadcrumbs::render('admin.user.create');
    ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="card">
            <form method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    @include('admin.partials.errors')
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex p-0">
                                    <h3 class="card-title p-3"></h3>
                                    <ul class="nav nav-pills ml-auto p-2">
                                        <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">عمومی</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">تماس</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">پسورد</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab">استخدام</a></li>
                                    </ul>
                                    <button class="btn btn-flat btn-primary">ذخیره اطلاعات</button>

                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1">
                                            <div class="row">
                                                <div class="form-group col-lg-4">
                                                    <label for="input" class="control-label">نام</label>
                                                    <div class="input-group">
                                                        <input id="fname" name="fname"
                                                               type="text" value="{{old('fname',isset($userItem) ? $userItem->fname: '')}}"
                                                               class="form-control" required/>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label for="input" class="control-label">نام خانوادگی</label>
                                                    <div class="input-group">
                                                        <input id="lname" name="lname"
                                                               type="text" value="{{old('lname',isset($userItem) ? $userItem->lname: '')}}"
                                                               class="form-control" required/>
                                                    </div>
                                                </div>

                                                <div class="form-group col-lg-4">
                                                    <label for="input" class="control-label">کد ملی</label>
                                                    <div class="input-group">
                                                        <input type="text" id="code" name="code"
                                                               value="{{old('code',isset($userItem) ? $userItem->code: '')}}"
                                                               class="form-control direction_ltr" required/>
                                                    </div>
                                                </div>

                                                <div class="form-group col-lg-4">
                                                    <label for="input" class="control-label">عکس</label>
                                                    <div class="input-group">
                                                        <input type="file" id="user_image" name="user_image" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group user_image col-lg-4">
                                                    <img src="{{old('user_image',isset($userItem) && $userItem->user_image !='' ? url('user_image\\').$userItem->user_image: '')}}"/>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="tab_2">
                                            <div class="row">
                                                <div class="form-group col-lg-4">
                                                    <label for="input" class="control-label">شماره تماس</label>
                                                    <div class="input-group">
                                                        <input type="text" id="lname" name="phone_number"
                                                               value="{{old('phone_number',isset($userItem) ? $userItem->phone_number: '')}}"
                                                               class="form-control direction_ltr" required/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group col-lg-4">
                                                <label for="input" class="control-label">ایمیل</label>
                                                <div class="input-group">
                                                    <input type="email" id="email" name="email"
                                                           value="{{old('email',isset($userItem) ? $userItem->email: '')}}"
                                                           class="form-control direction_ltr" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="tab_3">
                                            <div class="row">
                                                <div class="form-group col-lg-4">
                                                    <label for="input" class="control-label">پسورد</label>
                                                    <div class="input-group">
                                                        <input type="password" name="password"
                                                               autocomplete="new-password" id="password"
                                                               class="form-control"/>
                                                    </div>
                                                </div>

                                                <div class="form-group col-lg-4">
                                                    <label for="input" class="control-label">تایید پسورد</label>
                                                    <div class="input-group">
                                                        <input type="password" name="password_confirmation"
                                                               id="password_confirmation"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tab_4">
                                            <div class="row">
                                                <div class="form-group col-lg-4">
                                                    <label for="input" class="control-label">تاریخ ستخدام</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                              <span class="input-group-text">
                                                                <i class="fa fa-calendar"></i>
                                                              </span>
                                                        </div>
                                                        <input id="date_employment" name="date_employment"
                                                               value="{{old('date_employment',isset($userItem) ? $userItem->date_employment: '')}}"
                                                               class="normal-example form-control"/>
                                                    </div>
                                                </div>

                                                <div class="form-group col-lg-4">
                                                    <label for="input" class="control-label">شاخه کاری</label>
                                                    @foreach($roles as $role)
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="branch_work[]" type="checkbox" value="{{$role->id}}" {{old('branch_work',isset($userItem) && in_array($role->id,$userrole)) ? 'checked': '' }}>
                                                            <label class="form-check-label">{{$role->title}}</label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="form-group col-lg-4">
                                                    <label for="input" class="control-label">توضیحات</label>
                                                        <textarea class="form-control" name="user_description" rows="3" placeholder="وارد کردن اطلاعات ...">
                                                            {{old('user_description',isset($userItem) ? $userItem->user_description: '')}}
                                                        </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.tab-pane -->
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
</div>
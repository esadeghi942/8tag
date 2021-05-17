<div class="content-wrapper">
    <?php
    if(isset($roleItem))
        echo Breadcrumbs::render('admin.role.edit',$roleItem);
    else
        echo Breadcrumbs::render('admin.role.create');
    ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="card">
                <form method="post">
                    @csrf
                    <div class="card-body">
                        @include('admin.partials.errors')
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group col-lg-4">
                                    <label for="input" class="control-label">عنوان</label>
                                    <div class="input-group">
                                        <input type="text" id="title" name="title"
                                               value="{{old('title',isset($roleItem) ? $roleItem->name: '')}}"
                                               class="form-control direction_ltr" required/>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info">ثبت</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

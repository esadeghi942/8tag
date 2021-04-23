<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">درخواست مرخصی</h3>
                </div>
                <form method="post" class="form-horizontal">
                    @csrf
                    <div class="card-body">
                        @include('users.partials.errors')
                        <div class="form-group">
                            <label for="input" class="control-label">نوع مرخصی</label>
                            <div class="form-group">
                                <select name="leavement_type" class="form-control col-lg-4">
                                    <option @if(isset($leavementItem) && $leavementItem->leavement_type==1) selected="selected" @endif value="1">روزانه</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="input" class="control-label">تاریخ شروع</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="fa fa-calendar"></i>
                          </span>
                                    </div>
                                    <input id="leavement_start" name="leavement_start"
                                           value="{{old('leavement_start',isset($leavementItem) ? $leavementItem->leavement_start: '')}}"
                                           class="normal-example form-control initial-value-type-example"/>
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="input" class="control-label">تاریخ پایان</label>

                                <div class="input-group ">
                                    <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="fa fa-calendar"></i>
                          </span>
                                    </div>
                                    <input id="leavement_finish" name="leavement_finish"
                                           value="{{old('leavement_finish',isset($leavementItem) ? $leavementItem->leavement_finish: '')}}"
                                           class="normal-example form-control"/>
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="input" class="control-label">چند روز کاری</label>

                                <div class="input-group ">
                                    <input id="leavement_finish" name="leavement_date_count"
                                           value="{{old('leavement_date_count',isset($leavementItem) ? $leavementItem->leavement_date_count: '')}}"
                                           class="form-control"/>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="leavement_description" rows="3"
                                      placeholder="دلیل مرخصی خود را بنویسید">{{old('leavement_description',isset($leavementItem) ? $leavementItem->leavement_description: '')}}</textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ثبت</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </section>
</div>
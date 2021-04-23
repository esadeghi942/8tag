<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">ثبت حضور و غیاب</h3>
                </div>
                <form method="post">
                    @csrf
                    <div class="card-body">
                        @include('users.partials.errors')
                        <div class="row">
                            <div class="form-group">
                                <label for="input" class="control-label">تاریخ</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                      </span>
                                    </div>
                                    <input id="date" name="date"
                                           value="{{old('date',isset($worktimeItem) ? $worktimeItem->date: '')}}"
                                           class="normal-example form-control initial-value-type-example" required/>
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="input" class="control-label">ساعت ورود</label>
                                <input id="start" type="text" name="start"
                                       value="{{old('start',isset($worktimeItem) ? $worktimeItem->start: '')}}"
                                       class="form-control timepicker" required/>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="input" class="control-label">ساعت خروج</label>
                                <input id="finish" type="text" name="finish"
                                       value="{{old('finish',isset($worktimeItem) ? $worktimeItem->finish: '')}}"
                                       class="form-control timepicker" required/>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="input" class="control-label">کسر</label>

                                <div class="input-group ">
                                    <input id="reduce" name="reduce"
                                           value="{{old('reduce',isset($worktimeItem) ? $worktimeItem->reduce: '')}}"
                                           class="form-control" required/>
                                </div>
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="input" class="control-label">مجموع</label>

                                <div class="input-group ">
                                    <input id="total" name="total"
                                           value="{{old('total',isset($worktimeItem) ? $worktimeItem->total: '')}}"
                                           class="form-control"/>
                                </div>
                            </div>
                            
                            <div class="form-group col-lg-4">
                                <label for="input" class="control-label">دورکاری</label>

                                <div class="input-group ">
                                    <input id="teleworking" name="teleworking"
                                           value="{{old('teleworking',isset($worktimeItem) ? $worktimeItem->teleworking: '')}}"
                                           class="form-control" required/>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="input" class="control-label">توضیحات</label>
                            <textarea class="form-control" name="description" rows="3">{{old('description',isset($worktimeItem) ? $worktimeItem->description: '')}}</textarea>
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
<div class="content-wrapper">
    <?php
    if(isset($worktimeItem))
        echo Breadcrumbs::render('user.worktime.edit',$worktimeItem);
    else
        echo Breadcrumbs::render('user.worktime.create');
    ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">ثبت ساعت کاری</h3>
                </div>
                <form method="post">
                    @csrf
                    <div class="card-body">
                        @include('user.partials.errors')
                        <div class="row">
                           {{-- <div class="form-group col-lg-4">
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
                            </div>--}}
                            <div class="form-group col-lg-4">
                                <label for="input" class="control-label">تایخ</label>
                                <div class="form-group">
                                    <select id="date" name="date" class="form-control">
                                        @foreach($dates as $date)
                                            <option {{old('date',isset($worktimeItem) && $worktimeItem->date ==$date) ?'selected': ''}} value="{{$date}}">{{$date}}</option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="input" class="control-label">ساعت ورود</label>
                                <input id="start" type="text" name="time_start"
                                       value="{{old('time_start',isset($worktimeItem) ? $worktimeItem->time_start: '')}}"
                                       class="form-control bs-timepicker" required/>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="input" class="control-label">ساعت خروج</label>
                                <input id="finish" type="text" name="time_finish"
                                       value="{{old('time_finish',isset($worktimeItem) ? $worktimeItem->time_finish: '')}}"
                                       class="form-control bs-timepicker" required/>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="input" class="control-label">کسر</label>

                                <div class="input-group ">
                                    <input id="reduce" name="reduce"
                                           value="{{old('reduce',isset($worktimeItem) ? $worktimeItem->reduce: 0)}}"
                                           class="form-control" required/>
                                </div>
                            </div>

                           {{-- <div class="form-group col-lg-4">
                                <label for="input" class="control-label">مجموع</label>

                                <div class="input-group ">
                                    <input id="total" name="total"
                                           value="{{old('total',isset($worktimeItem) ? $worktimeItem->total: '')}}"
                                           class="form-control"/>
                                </div>
                            </div>--}}
                            
                            <div class="form-group col-lg-4">
                                <label for="input" class="control-label">دورکاری</label>

                                <div class="input-group ">
                                    <input id="teleworking" name="teleworking"
                                           value="{{old('teleworking',isset($worktimeItem) ? $worktimeItem->teleworking: 0)}}"
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
<script>
    $(function () {
        $('.bs-timepicker').timepicker();
    });
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
    try {
        fetch(new Request("https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", { method: 'HEAD', mode: 'no-cors' })).then(function(response) {
            return true;
        }).catch(function(e) {
            var carbonScript = document.createElement("script");
            carbonScript.src = "//cdn.carbonads.com/carbon.js?serve=CK7DKKQU&placement=wwwjqueryscriptnet";
            carbonScript.id = "_carbonads_js";
            document.getElementById("carbon-block").appendChild(carbonScript);
        });
    } catch (error) {
        console.log(error);
    }
</script>
<style>
    .hour{
        display: none;
    }
</style>
<script>
    $(document).ready(function () {
        var type={{isset($leavementItem)?$leavementItem->type :1}};
        if(type==2){
            $('.daily').hide();
            $('.hour').css('display','flex');
        }
        $(document).on('change','.leavement_type',function () {
            var val=$(this).val();
            if(val=='1') {
                $('.daily').css('display','flex');
                $('.hour').hide();
            }
            else if(val=='2') {
                $('.daily').hide();
                $('.hour').css('display','flex');
            }
        });
    });
</script>
<div class="content-wrapper">
    <?php
    if(isset($leavementItem))
        echo Breadcrumbs::render('user.leavement.edit',$leavementItem);
    else
        echo Breadcrumbs::render('user.leavement.create');
    ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">درخواست مرخصی</h3>
                </div>
                <form method="post" class="form-horizontal">
                    @csrf
                    <div class="card-body">
                        @include('user.partials.errors')
                        <div class="form-group">
                            <label for="input" class="control-label">نوع مرخصی</label>
                            <div class="form-group">
                                <select name="type" class="leavement_type form-control col-lg-4">
                                    <option @if(isset($leavementItem) && $leavementItem->type==1) selected="selected" @endif value="1">روزانه</option>
                                    <option @if(isset($leavementItem) && $leavementItem->type==2) selected="selected" @endif value="2">ساعتی</option>
                                </select>
                            </div>
                        </div>
                        <div class="row daily">
                            <div class="form-group col-lg-4">
                                <label for="input" class="control-label">تاریخ شروع</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="fa fa-calendar"></i>
                          </span>
                                    </div>
                                    <input id="start" name="start"
                                           value="{{old('start',isset($leavementItem) ? $leavementItem->start: '')}}"
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
                                    <input id="finish" name="finish"
                                           value="{{old('finish',isset($leavementItem) ? $leavementItem->finish: '')}}"
                                           class="normal-example form-control"/>
                                </div>
                            </div>
                           {{-- <div class="form-group col-lg-4">
                                <label for="input" class="control-label">چند روز کاری</label>

                                <div class="input-group ">
                                    <input id="finish" name="date_count"
                                           value="{{old('date_count',isset($leavementItem) ? $leavementItem->date_count: '')}}"
                                           class="form-control"/>
                                </div>
                            </div>--}}

                        </div>

                        <div class="row hour">
                            <div class="form-group col-lg-4">
                                <label for="input" class="control-label">تاریخ</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                               </div>
                                    <input id="date" name="date"
                                           value="{{old('date',isset($leavementItem) ? $leavementItem->date: '')}}"
                                           class="normal-example form-control initial-value-type-example"/>
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="input" class="control-label">ساعت شروع</label>
                                <input id="time_start" type="text" name="time_start"
                                       value="{{old('start',isset($leavementItem) ? $leavementItem->start: '')}}"
                                       class="form-control bs-timepicker"/>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="input" class="control-label">ساعت پایان</label>
                                <input id="time_finish" type="text" name="time_finish"
                                       value="{{old('finish',isset($leavementItem) ? $leavementItem->finish: '')}}"
                                       class="form-control bs-timepicker"/>
                            </div>

                        </div>

                       {{-- <div class="form-group">
                            <textarea class="form-control" name="description" required rows="3"
                                      placeholder="دلیل مرخصی خود را بنویسید">{{old('description',isset($leavementItem) ? $leavementItem->description: '')}}</textarea>
                        </div>--}}
                        <div class="form-group">
                            <label for="input" class="control-label">دلیل مرخصی</label>
                            <div class="form-group">
                                <select name="description" class="form-control col-lg-4">
                                    <option @if(isset($leavementItem) && $leavementItem->description=='بیماری') selected="selected" @endif value="بیماری">بیماری</option>
                                    <option @if(isset($leavementItem) && $leavementItem->description=='شخصی') selected="selected" @endif value="شخصی">شخصی</option>
                                    <option @if(isset($leavementItem) && $leavementItem->description=='کلاس') selected="selected" @endif value="کلاس">کلاس</option>
                                    <option @if(isset($leavementItem) && $leavementItem->description=='کار بانکی/اداری') selected="selected" @endif value="کار بانکی/اداری">کار بانکی/اداری</option>
                                    <option @if(isset($leavementItem) && $leavementItem->description=='سایر') selected="selected" @endif value="سایر">سایر</option>
                                </select>
                            </div>
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
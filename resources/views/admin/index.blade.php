@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        {{ Breadcrumbs::render('admin')}}
       {{-- <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">صفحه سریع</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>--}}
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $prosessing }}</h3>

                                <p>درخواست مرخصی جدید</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('admin.leavement.index') }}" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{$count-1}}</h3>

                                <p>تعداد کل کارمندان</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{route('admin.user.index')}}" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection

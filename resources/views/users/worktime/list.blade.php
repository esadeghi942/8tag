@extends('layouts.index')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            @include('admin.partials.notifications')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{route('user.worktime.create')}}" class="btn btn-success btn-sm">ثبت ساعت کاری</a>
                            </div>
                            <div class="card-body table-responsive p-0">
                                @if($worktimes && count($worktimes) > 0)
                                    <table class="table table-bordered">
                                        <thead>
                                        @include('users.worktime.columns')
                                        </thead>
                                        @foreach($worktimes as $worktime)
                                            @include('users.worktime.items',$worktime)
                                        @endforeach
                                    </table>
                                @endif
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
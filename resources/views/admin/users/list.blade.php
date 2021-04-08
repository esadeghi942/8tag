@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            @include('admin.partials.notifications')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{route('admin.user.create')}}" class="btn btn-success btn-sm">ثبت کاربر جدید</a>
                            </div>
                            <div class="card-body table-responsive p-0">
                                @if($users && count($users) > 0)
                                    <table class="table table-bordered">
                                        <thead>
                                        @include('admin.users.columns')
                                        </thead>
                                        @foreach($users as $user)
                                            @include('admin.users.items',$user)
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
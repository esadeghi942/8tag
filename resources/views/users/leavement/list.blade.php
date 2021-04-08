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
                                <a href="{{route('user.leavement.create')}}" class="btn btn-success btn-sm">درخواست مرخصی</a>
                            </div>
                            <div class="card-body table-responsive p-0">
                                @if($leavements && count($leavements) > 0)
                                    <table class="table table-bordered">
                                        <thead>
                                        @include('users.leavement.columns')
                                        </thead>
                                        @foreach($leavements as $leavement)
                                            @include('users.leavement.items',$leavement)
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
@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            @include('admin.partials.notifications')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                @if($worktimes && count($worktimes) > 0)
                                    <table class="table table-bordered">
                                        <thead>
                                        @include('admin.worktime.columns')
                                        </thead>
                                        @foreach($worktimes as $worktime)
                                            @include('admin.worktime.items',$worktime)
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
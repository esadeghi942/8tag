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
                                @if($leavements && count($leavements) > 0)
                                    <table class="table table-bordered">
                                        <thead>
                                        @include('admin.leavement.columns')
                                        </thead>
                                        @foreach($leavements as $leavement)
                                            @include('admin.leavement.items',$leavement)
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
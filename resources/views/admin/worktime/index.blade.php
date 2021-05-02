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
                                <table class="table table-bordered data-table">
                                    <thead>
                                    @include('admin.worktime.columns')
                                    </thead>
                                   <tbody></tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script type="text/javascript">
        $(function () {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.user.worktime',$user_id) }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'date', name: 'date'},
                    {data: 'time_start', name: 'time_start'},
                    {data: 'time_finish', name: 'time_finish'},
                    {data: 'total', name: 'total'},
                    {data: 'reduce', name: 'reduce'},
                    {data: 'teleworking', name: 'teleworking'},
                    {data: 'description', name: 'description'}
                ]
            });
        });
    </script>
@endsection
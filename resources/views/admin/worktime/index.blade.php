@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        {{ Breadcrumbs::render('admin.worktime.index',$user_id)}}
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
                language: {
                    "url": "http://cdn.datatables.net/plug-ins/1.10.24/i18n/Persian.json"
                },
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
@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        {{ Breadcrumbs::render('admin.leavement.index')}}
        <section class="content">
            @include('admin.partials.notifications')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                <table class="table table table-bordered data-table">
                                    <thead>
                                    @include('admin.leavement.columns')
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
                ajax: "{{ route('admin.leavement.data') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'phone_number', name: 'phone_number'},
                    {data: 'type', name: 'type'},
                    {data: 'start', name: 'start'},
                    {data: 'finish', name: 'finish'},
                    {data: 'date_count', name: 'date_count'},
                    {data: 'description', name: 'description'},
                    {data: 'status', name: 'status',"render": function (data, type, full, meta) {
                            if(data==1)
                                return ' <span class="badge bg-danger">رد شده </span> ';
                            else if(data==2)
                                return ' <span class="badge bg-success">تایید شده </span> ';
                            else
                                return ' <span class="badge bg-warning"> در حال بررسی</span> ';
                        }
                    , class : "status",},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
        $(document).ready(function () {
            $(document).on('click', '.disagree', function (e){
                e.preventDefault();
                let id = $(this).data('id');
                let elm=$(this).closest('tr').find('td.status');
                $.ajax({
                    type: 'get',
                    url: '/admin/leavement/disagree/' + id,
                    success: function (data) {
                        elm.html('');
                        elm.append('<span class="badge bg-danger">رد شده </span>');
                    }
                });
            });
            $(document).on('click', '.agree', function (e) {
                e.preventDefault();
                let id = $(this).data('id');
                let elm=$(this).closest('tr').find('.status');
                $.ajax({
                    type: 'get',
                    url: '/admin/leavement/agree/' + id,
                    success: function (data) {
                        elm.html('');
                        elm.append('<span class="badge bg-success">تایید شده </span>');

                    }
                });
            });
        });
    </script>
@endsection
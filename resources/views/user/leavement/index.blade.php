@extends('layouts.index')
@section('content')
    <div class="content-wrapper">
        {{ Breadcrumbs::render('user.leavement.index')}}
        <section class="content">
            @include('user.partials.notifications')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-bordered data-table">
                                    <thead>
                                    @include('user.leavement.columns')
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
                ajax: "{{ route('user.leavement.data') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
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
                        , class : "status"},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });

        $(document).ready(function () {
            $(document).on('click','.delete',function (e) {
                e.preventDefault();
                var confirm=window.confirm('Are You Sure To Delete?');
                if (confirm) {
                    let id = $(this).data('id');
                    $('#msg').html('');
                    let elm = $(this);
                    $.ajax({
                        type: 'get',
                        url: '/leavement/delete/' + id,
                        success: function (data) {
                            if (data == 'error') {
                                $('#msg').append('<div class="alert alert-danger">\n' +
                                    '        <p>حذف مرخصی ممکن نیست.</p>\n' +
                                    '    </div>');
                            }
                            else if (data == 'success') {
                                $('#msg').append('<div class="alert alert-success">\n' +
                                    '        <p>درخواست مرخصی مورد نظر با موفقیت حذف گردید.</p>\n' +
                                    '    </div>');
                                elm.closest('tr').remove();
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
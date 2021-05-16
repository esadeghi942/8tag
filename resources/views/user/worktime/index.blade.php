@extends('layouts.index')

@section('content')
    <div class="content-wrapper">
        {{ Breadcrumbs::render('user.worktime.index')}}
        <section class="content">
            @include('user.partials.notifications')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                    <table class="table table-bordered data-table">
                                        <thead>
                                        @include('user.worktime.columns')
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
                ajax: "{{ route('user.worktime.data') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'date', name: 'date'},
                    {data: 'time_start', name: 'time_start'},
                    {data: 'time_finish', name: 'time_finish'},
                    {data: 'total', name: 'total'},
                    {data: 'reduce', name: 'reduce'},
                    {data: 'teleworking', name: 'teleworking'},
                    {data: 'description', name: 'description'},
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
                        url: '/worktime/delete/' + id,
                        success: function (data) {
                            if (data == 'error') {
                                $('#msg').append('<div class="alert alert-danger">\n' +
                                    '        <p>حذف ساعت کاری ممکن نیست.</p>\n' +
                                    '    </div>');
                            }
                            else if (data == 'success') {
                                $('#msg').append('<div class="alert alert-success">\n' +
                                    '        <p>ساعت کاری مورد نظر با موفقیت حذف گردید.</p>\n' +
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
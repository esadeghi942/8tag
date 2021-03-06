@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        {{ Breadcrumbs::render('admin.user.index')}}
        <section class="content">
            @include('admin.partials.notifications')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-bordered data-table">
                                    <thead>
                                    @include('admin.users.columns')
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
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
                ajax: "{{ route('admin.user.data') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'user_image', name: 'user_image',"render": function (data, type, full, meta) {
                            return "<img src='"+ data + "' height='40px' />";
                        }
                    },
                    {data: 'name', name: 'name'},
                    {data: 'code', name: 'code'},
                    {data: 'email', name: 'email'},
                    {data: 'phone_number', name: 'phone_number'},
                    {data: 'date_employment', name: 'date_employment'},
                    {data: 'branch_work', name: 'branch_work'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
        $(document).ready(function () {
            $(document).on('click','.delete',function (e) {
                e.preventDefault();
                var confirm=window.confirm('Are You Sure To Delete?');
                if(confirm) {
                    let id = $(this).data('user');
                    $('#msg').html('');
                    let elm = $(this);
                    $.ajax({
                        type: 'get',
                        url: '/admin/user/delete/' + id,
                        success: function (data) {
                            if (data == 'error') {
                                $('#msg').append('<div class="alert alert-danger">\n' +
                                    '        <p>?????? ?????????? ???????? ????????.</p>\n' +
                                    '    </div>');
                            }
                            else if (data == 'success') {
                                $('#msg').append('<div class="alert alert-success">\n' +
                                    '        <p>?????????? ???????? ?????? ???? ???????????? ?????? ??????????.</p>\n' +
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
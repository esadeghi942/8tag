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
                                    @include('admin.role.columns')
                                    </thead>
                                    <tbody>
                                    </tbody>
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
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.role.data') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'title', name: 'title'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
        $(document).ready(function () {
            $(document).on('click','.delete',function (e) {
                e.preventDefault();
                let id=$(this).data('id');
                $('#msg').html('');
                let elm=$(this);
                $.ajax({
                    type:'get',
                    url:'/admin/role/destroy/'+id,
                    success:function(data) {
                        if(data=='error'){
                            $('#msg').append('<div class="alert alert-danger">\n' +
                                '        <p>حذف شاخع کاری ممکن نیست.</p>\n' +
                                '    </div>');
                        }
                        else if(data=='success'){
                            $('#msg').append('<div class="alert alert-success">\n' +
                                '        <p>شاخه کاری مورد نظر با موفقیت حذف گردید.</p>\n' +
                                '    </div>');
                            elm.closest('tr').remove();
                        }
                    }
                });
            });
        });
    </script>
@endsection
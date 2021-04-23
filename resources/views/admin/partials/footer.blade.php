<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<script>
    $(function () {
        if($('.normal-example').length>0) {
            $('.normal-example').persianDatepicker({
                observer: true,
                format: 'YYYY/MM/DD',
                altField: '.observer-example-alt',
                initialValueType: 'persian',
                toolbox: {
                    calendarSwitch:
                        {
                            enabled: false
                        }
                }
            });
        }
    });
</script>
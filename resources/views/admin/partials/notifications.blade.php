<div id="msg">
@if(session('success'))
    <div class="alert alert-success">
        <p>{{ session('success') }}</p>
    </div>
    @endif

@if(session('danger'))
    <div class="alert alert-danger">
        <p>{{ session('danger') }}</p>
    </div>
    @endif

@if(session('warninig'))
    <div class="alert alert-warning">
        <p>{{ session('warninig') }}</p>
    </div>
    @endif
</div>
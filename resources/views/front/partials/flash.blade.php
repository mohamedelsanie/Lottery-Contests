@if(session('message'))
<div class="container">
    <div class="alert alert-{{ session('alert_type') }} showAlert alert-dismissible fade show" role="alert" style="">
    {{ session('message') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif
@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade in text-left" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        @foreach($errors->all() as $error)
            <strong><i class="fa fa-info-circle"></i></strong> {{ $error }}<br>
        @endforeach
    </div>
@endif
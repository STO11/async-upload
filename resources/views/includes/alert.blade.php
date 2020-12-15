
@if(session()->has('error'))
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Erro!</h5>
        {!! session('msg') !!}
    </div>
    @else
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Sucesso!</h5>
        {!! session('msg') !!}
    </div>
    @endif
@endif
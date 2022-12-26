@extends('paginas.partials.app')
@section('content')
<div class="jumbotron bg-light align-items-end d-sm-none d-xl-flex">
	<div class="container mx-auto">
		<div class="text-blue align-items-center justify-content-between d-flex mb-4">
			<h1 class="font-size-45">Presupuesto</h1>
			<span class="font-size-24">Solicitá tu cotización.</span>
		</div>
	</div>
</div>
<div class="container mx-auto bg-light my-5 py-5">
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $error)
                <span class="d-block">{{$error}}</span>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>  
    @endif
    @if (Session::has('mensaje'))
        <div class="alert alert-{{Session::get('class')}} alert-dismissible fade show" role="alert">
            <strong>{{ Session::get('mensaje') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>                    
    @endif
    <form action="{{ route('send-quote') }}" method="post" id="cotizadorOnline" enctype="multipart/form-data" class="py-sm-2 py-md-5" style="color: #666666;">
        @csrf
        <div class="row w-75 mx-auto">
            <div class="col-sm-12 col-md-6 mb-3">
                <div class="form-group">
                    <label class="mb-2 d-block fw-bold">Nombre y apellido*</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control valid">
                </div>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <div class="form-group">
                    <label class="mb-2 d-block fw-bold">Email*</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control valid">
                </div>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <div class="form-group">
                    <label class="mb-2 d-block fw-bold">Teléfono</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-control valid">
                </div>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <div class="form-group">
                    <label class="mb-2 d-block fw-bold">Empresa</label>
                    <input type="text" name="company" value="{{ old('company') }}" class="form-control">
                </div>
            </div>    
            <div class="col-sm-12 col-md-6 mb-3">
                <div class="form-group">
                    <label class="mb-2 d-block fw-bold">Asunto a consultar*</label>
                    <input type="text" name="case" value="{{ old('case') }}" class="form-control">
                </div>
            </div> 
            <div class="col-sm-12 col-md-6 mb-sm-3 mb-md-5">
                <label class="mb-2 d-block fw-bold">Adjuntar archivo</label>
                <input type="file" name="file" class="form-control-file">
            </div>      
            <div class="col-sm-12 mb-3">
                <div class="form-group">
                    <label class="mb-2 d-block fw-bold">Mensaje*</label>
                    <textarea name="message" class="form-control" cols="30" rows="5">{{ old('message') }}</textarea>
                </div>
            </div>
            <div class="d-flex flex-sm-column flex-md-row justify-content-between col-sm-12 mt-4">
                <span>*Campos Obligatorios</span>
                <button class="btn px-5 py-2 text-white bg-blue" style="border-radius:0;">Solicitar Presupuesto</button>
            </div>
        </div>

    </form>
</div>
@endsection
@push('head')
@endpush
@push('scripts')	
@endpush
       

@extends('paginas.partials.app')
@section('content')
<div class="jumbotron bg-light align-items-end d-flex">
	<div class="container mx-auto">
		<div class="text-red align-items-center justify-content-between d-flex mb-4">
			<h1 class="font-size-45">Contacto</h1>
		</div>
	</div>
</div>
<div class="py-5">
    <div class="container">
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
        <form action="{{ route('send-contact') }}" method="post" enctype="multipart/form-data" class="mb-5">
            @csrf
            <div class="row justify-content-between">
                <div class="col-sm-12 col-md-4 font-size-14">
                    <div class="font-size-16 fw-light mb-4">
                        Para mayor información, no dude en contactarse mediante el siguiente formulario, o a través de nuestras vías de comunicación.
                    </div> 
                    <div class="d-flex align-items-center mb-4">
                        <i class="fas fa-map-marker-alt text-red d-block me-3"></i><span class="d-block"> {{ $data->address }}</span>
                    </div>
                    <div class="d-flex align-items-center mb-4">
                        <i class="fas fa-envelope text-red d-block me-3"></i><span class="d-block"></span>  
                        <div class="">
                            <a href="mailto:{{ $data->email }}" class="underline text-dark text-decoration-none">{{ $data->email }}</a><br> 
                            <a href="mailto:{{ $data->email2}}" class="underline text-dark text-decoration-none">{{ $data->email2 }}</a>  
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4">
                        <i class="fas fa-phone-alt text-red d-block me-3"></i>
                        @php $phone = Str::of($data->phone1)->explode('|') @endphp
                        @if (count($phone) == 2)
                            <a href="tel:{{ $phone[0] }}" class="underline text-dark text-decoration-none">{{ $phone[1] }}</a>
                        @else 
                            <a href="tel:{{ $data->phone1 }}" class="underline text-dark text-decoration-none">{{ $data->phone1 }}</a>
                        @endif        
                    </div> 
                    <div>No disponemos de atencion al cliente en nuestra planta</div>
                    <div class="mt-5">
                        <img src="{{ asset('images/Rectangle-205.png') }}" class="w-100 img-fluid">
                    </div>
                </div>
                <div class="col-sm-12 col-md-8">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label class="fw-bold d-block mb-2">Nombre y Apellido *</label>
                                <input type="text" name="nombre" class="form-control font-size-14 input-fondo">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-sm-3 mb-sm-3">
                            <div class="form-group">
                                <label class="fw-bold d-block mb-2">E-mail *</label>
                                <input type="email" name="email" class="form-control font-size-14 input-fondo">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label class="fw-bold d-block mb-2">Teléfono *</label>
                                <input type="tel" name="telefono" class="form-control font-size-14 input-fondo">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label class="fw-bold d-block mb-2">Empresa</label>
                                <input type="text" name="compania" class="form-control font-size-14 input-fondo">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-sm-3 mb-sm-3">
                            <div class="form-group">
                                <label class="fw-bold d-block mb-2">Mensaje*</label>
                                <textarea name="mensaje" class="form-control font-size-14 input-fondo" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-sm-3">
                            <div class="form-group pt-4">{!! app('captcha')->display() !!}</div>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-sm-3">
                            <div class="form-group">
                                <input type="file" name="file" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-sm-3 mb-sm-3 text-sm-center text-md-end">
                            <span class="me-3" style="color: #454545;">*Campos Obligatorios</span>
                            <button type="submit" class="btn bg-red font-size-14 py-2 mb-sm-3 mb-md-0 text-white px-5 rounded-pill">Enviar mensaje</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3280.2414513087997!2d-58.322725884973686!3d-34.69908948043486!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95a3325e00d7fb97%3A0x89a0276d54a0f446!2sCSD%2C%20Lomas%20de%20Zamora%20130%2C%20B1875%20Wilde%2C%20Provincia%20de%20Buenos%20Aires%2C%20Argentina!5e0!3m2!1ses!2sve!4v1657734828393!5m2!1ses!2sve" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="w-100" style="height: 516px;"></iframe>
        </div>
    </div>
</div>
@endsection
@push('head')
@endpush
@push('scripts')	
@endpush
       


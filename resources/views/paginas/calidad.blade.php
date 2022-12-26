@extends('paginas.partials.app')
@section('content')
<div class="jumbotron bg-light align-items-end d-sm-none d-xl-flex">
	<div class="container mx-auto">
		<div class="text-blue align-items-center justify-content-between d-flex mb-4">
			<h1 class="font-size-32 text-red">Calidad</h1>
		</div>
	</div>
</div>
@isset($calidad)
	<section id="calidad" class="py-sm-2 pt-md-5">
		<div class="container py-sm-0 py-md-3">
			<div class="row justify-content-between">
				<div class="col-sm-12 col-md-5">
					<h3 class="font-size-28 mb-5">{{$calidad->content_1}}</h3>
					<div class="fw-light font-size-16">{!! $calidad->content_2 !!}</div>
				</div>
				<div class="col-sm-12 col-md-6 mb-sm-4 mb-md-0">
					@if (Storage::disk('public')->exists($calidad->image))
						<img src="{{ asset($calidad->image) }}" class="img-fluid">
					@endif
				</div>
			</div>
		</div>
	</section>	
@endisset
@isset($certificados)
    @if (count($certificados))
        <div class="py-5 container mx-auto">
            <h3 class="font-size-20 mb-5">Descargas</h3>
            <div class="row mb-5">
                @foreach ($certificados as $certificado)
                    <div class="col-sm-12 col-md-4 mb-sm-4 mb-md-0 ">
                        <a href="{{ route('descargar-archivo', ['id'=>$certificado->id, 'reg' => 'image']) }}" class="bg-light py-3 px-3 d-flex justify-content-between align-items-center text-decoration-none text-dark">
                            <h4 class="m-0 font-size-20">{{ $certificado->content_1 }}</h4>
                            @if (Storage::disk('public')->exists('images/Vector.png'))
                                <img src="{{ asset('images/Vector.png') }}" class="img-fluid d-block" style="min-height: 17px; max-height: 17px;">
                            @endif
                        </a>
                    </div>			
                @endforeach
            </div>
        </div>
    @endif  
@endisset

@endsection

@extends('paginas.partials.app')
@section('content')
@if(count($sliders))
	<div id="sliderHero" class="carousel slide" data-bs-ride="carousel">
		<div class="carousel-indicators">
			@foreach ($sliders as $k => $item)
				<button type="button" data-bs-target="#sliderHero" data-bs-slide-to="{{$k}}" class="@if(!$k) active @endif"  aria-current="true" aria-label="Slide {{$k}}"></button>			
			@endforeach
		</div>
		<div class="carousel-inner" style="box-shadow: -1px -1px 14px #00000014;">
			@foreach ($sliders as $key => $slider)
				<div class="carousel-item @if(!$key) active @endif" style="background-image: linear-gradient(to right, rgba(0, 0, 0, 0.9),rgba(0, 0, 0, 0.1)), url({{$slider->image}}); background-repeat: no-repeat; background-size: cover; background-position: center;">
					<div class="container mx-auto contentHero">
						<div class="mt-sm-2 text-start" style="max-width: 500px !important;">
							<h1 class="font-size-48 text-white hero-content-slider mb-sm-2 mb-md-5">{{ $slider->content_1 }}</h1>
							<p class="text-white hero-content-slider font-size-18 d-sm-none d-xl-block fw-light mb-5">{{ $slider->content_2 }}</p>
							<a href="{{ route('categorias') }}" class="btn bg-red text-white py-2 px-4 rounded-pill">Ver productos</a>
						</div>
					</div>
				</div>			
			@endforeach
		</div>	
	</div>	
@endif
@isset($categories)
	@if (count($categories))
		<div class="row container mx-auto mt-sm-5 mb-sm-3 my-md-5">
			<div class="col-sm 12-col-md-6">
				<h3 class="text-dark fw-bold font-size-32">Productos</h3>
			</div>
			<div class="col-sm-12 col-md-6 text-end d-sm-none d-xl-block">
				<a href="{{ route('categorias') }}" class="text-red text-decoration-none py-2 px-4 font-size-16 rounded-pill" style="border: 1px solid #E4161C;">Ver más</a>
			</div>
		</div>
		<div class="row container mx-auto mb-5">
			@foreach ($categories as $c)
				<div class="col-sm-12 col-md-4 mb-4">
					@includeIf('paginas.partials.categoria', ['c' => $c])
				</div>
			@endforeach		
		</div>
	@endif
@endisset
@isset($section2)
	<section id="section2">
		<div class="row">
			<div class="col-sm-12 col-md-6 px-0 d-sm-none d-md-block">
				@if (Storage::disk('public')->exists($section2->image))
					<img src="{{Storage::disk('public')->url($section2->image)}}" class="img-fluid w-100">
				@endif
			</div>
			<div class="col-sm-12 col-md-6 d-flex align-items-center justify-content-center px-0 py-sm-2 py-md-0 bg-light">
				<div style="max-width: 70%">
					<h3 class="font-size-32 fw-bold mt-md-4 mt-sm-0 mb-3">{{ $section2->content_1 }}</h3>
					<div class="font-size-16 fw-light mb-sm-2 mb-md-5">{!! $section2->content_2 !!}</div>
					@if ($section2->image2)
						@if(Storage::disk('public')->exists($section2->image2))
							<img src="{{ asset($section2->image2) }}" class="img-fluid">
						@endif
					@endif
				</div>
			</div>
		</div>
	</section>
@endisset
@isset($industries)
	@if (count($industries))
		<div class="row container mx-auto mt-sm-5 mb-sm-2 my-md-5">
			<div class="col-sm 12-col-md-6">
				<h3 class="text-dark fw-bold font-size-32">Industrias</h3>
			</div>
			<div class="col-sm-12 col-md-6 text-end d-sm-none d-xl-block">
				<a href="{{ route('industrias') }}" class="text-red text-decoration-none py-2 px-4 font-size-16 rounded-pill" style="border: 1px solid #E4161C;">Ver más</a>
			</div>
		</div>
		<div class="row container mx-auto mb-5">
			@foreach ($industries as $i)
				<div class="col-sm-12 col-md-4 mb-4">
					@includeIf('paginas.partials.industria', ['i' => $i])
				</div>
			@endforeach		
		</div>
	@endif
@endisset
@isset($clients)
	@if (count($clients))
		<div class="row container mx-auto my-5">
			<div class="col-sm 12-col-md-6">
				<h3 class="text-dark fw-bold font-size-32">Clientes</h3>
			</div>
		</div>
		<div class="row container mx-auto mb-5">
			@foreach ($clients as $c)
				<div class="col-sm-6 col-md-2 d-flex align-items-center mb-4">
					@if (Storage::disk('public')->exists($c->image))
						<img src="{{ asset($c->image) }}" class="img-fluid">
					@endif
				</div>
			@endforeach
		</div>
	@endif
@endisset
@isset($news)
	@if (count($news))
		<div class="py-5">
			<div class="row container mx-auto mb-5">
				<div class="col-sm 12-col-md-6">
					<h3 class="text-dark fw-bold font-size-32">Novedades</h3>
				</div>
				<div class="col-sm 12-col-md-6 text-end d-sm-none d-xl-block">
					<a href="{{ route('novedades') }}" class="text-red text-decoration-none py-2 px-4 font-size-16 rounded-pill" style="border: 1px solid #E4161C;">Ver más</a>
				</div>
			</div>
			<div class="row container mx-auto mb-5">
				@foreach ($news as $n)
					<div class="col-sm-12 col-md-6 col-lg-4 mb-sm-4 mb-md-0">
						@includeIf('paginas.partials.novedad', ['e' => $n])
					</div>			
				@endforeach
			</div>
		</div>
	@endif
@endisset
@isset($popup)
	@if ($popup->content_3 == 1)
		<div id="popup" class="modal" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content px-5 py-3 text-center" style="max-width: 95%;">
					<div class="modal-body">
						<h5 class="modal-title mb-5 font-size-32">{{ $popup->content_1 }}</h5>
						<div class="mb-5 font-size-16">{!! $popup->content_2 !!}</div>
						<div class="text-center mb-3">
							<button type="button" class="btn text-white bg-red rounded-pill py-2 px-4" data-bs-dismiss="modal">Volver al inicio</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif
@endisset
@endsection
@push('head')
	<style>
		.carousel-indicators [data-bs-target]{
			background-color: #A5A5A5 !important;
		}
	</style>
@endpush
@push('scripts')
	@isset($popup)
		@if ($popup->content_3 == 1)
			<script>
				$(document).ready(function(e){

					const fecha = new Date();
					const hoy = fecha.getDate()

					if (localStorage.getItem('popup')){
						if (localStorage.getItem('popup') != hoy) {
							localStorage.setItem('popup',hoy);
							$('#popup').modal('show')
						}	
					}else{
						localStorage.setItem('popup',hoy);
						$('#popup').modal('show')
					}
					
				})
			</script>
		@endif
	@endisset
@endpush



@extends('paginas.partials.app')
@section('content')
<div class="jumbotron bg-light align-items-end d-flex">
	<div class="container mx-auto">
		<div class="text-blue align-items-center justify-content-between d-flex mb-4">
			<h1 class="font-size-32 text-red">Productos</h1>
		</div>
	</div>
</div>
@isset($section1)
	<section id="section1" class="py-sm-2 pt-md-5">
		<div class="container py-sm-0 py-md-3">
			<div class="row justify-content-between">
				<div class="col-sm-12 col-md-5">
					<h3 class="font-size-32 mb-5">{{$section1->content_1}}</h3>
					<div class="fw-light font-size-18">{!! $section1->content_2 !!}</div>
				</div>
				<div class="col-sm-12 col-md-6 mb-sm-4 mb-md-0">
					@if (Storage::disk('public')->exists($section1->image))
						<img src="{{ asset($section1->image) }}" class="img-fluid">
					@endif
				</div>
			</div>
		</div>
	</section>	
@endisset
@isset($categorias)
	@if (count($categorias))
		<div class="row container mx-auto my-5 px-0">
			@foreach ($categorias as $c)
				<div class="col-sm-12 col-md-4 mb-4">
					@includeIf('paginas.partials.categoria', ['c' => $c])
				</div>
			@endforeach		
		</div>
	@endif
@endisset
@endsection

       

@extends('paginas.partials.app')
@section('content')
<div class="jumbotron bg-light align-items-end d-flex">
	<div class="container mx-auto">
		<div class="text-blue align-items-center justify-content-between d-flex mb-4">
			<h1 class="font-size-32 text-red">Empresa</h1>
		</div>
	</div>
</div>
@isset($section1)
	<section id="section1" class="py-sm-2 pt-md-5">
		<div class="container py-sm-0 py-md-3">
			<div class="row justify-content-between">
				<div class="col-sm-12 col-md-5">
					<h3 class="font-size-32 mb-sm-3 mb-md-5">{{$section1->content_1}}</h3>
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
@isset($sections2)
	@if (count($sections2))
		<div class="bg-light py-5">
			<div class="row container mx-auto mb-5">
				@foreach ($sections2 as $s2)
					<div class="col-sm-12 col-md-4 mb-sm-4 mb-md-0">
						<div class="bg-white py-5 px-3">
							@if (Storage::disk('public')->exists($s2->image))
								<img src="{{ asset($s2->image) }}" class="img-fluid d-block mb-4" style="min-height: 54px; max-height: 54px;">
							@else
								<div class="mb-4" style="min-height: 54px; max-height: 54px;"></div>
							@endif
							<h4 class="mb-3 font-size-20">{{ $s2->content_1 }}</h4>
							<div class="font-size-16">{!! $s2->content_2 !!}</div>
						</div>
					</div>			
				@endforeach
			</div>
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
						<img src="{{ asset($c->image) }}" class="img-fluid ">
					@endif
				</div>
			@endforeach
		</div>
	@endif
@endisset
@endsection

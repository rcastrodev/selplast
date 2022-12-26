@extends('paginas.partials.app')
@section('content')
<div class="jumbotron bg-light align-items-end d-flex">
	<div class="container mx-auto">
		<div class="text-blue align-items-center justify-content-between d-flex mb-4">
			<h1 class="font-size-32 text-red">APLICACIONES</h1>
		</div>
	</div>
</div>
<div class="py-5 container">
    @foreach ($aplicaciones as $a)
        <div class="row mb-5" style="min-height: 340px; border:1px solid #E0E0E0; border-radius:8px;">
            <div class="col-sm-12 col-md-6 p-md-0 mb-sm-3 mb-md-0">
                @if (count($a->images))
                    @if (Storage::disk('public')->exists($a->images()->first()->image))
                        <div id="sliderAplicacion{{$a->id}}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                @foreach ($a->images as $k => $item)
                                    <button type="button" data-bs-target="#sliderAplicacion{{$a->id}}" data-bs-slide-to="{{$k}}" class="@if(!$k) active @endif"  aria-current="true" aria-label="Slide {{$k}}"></button>			
                                @endforeach
                            </div>
                            <div class="carousel-inner" style="box-shadow: -1px -1px 14px #00000014;">
                                @foreach ($a->images as $key => $slider)
                                    <div class="carousel-item @if(!$key) active @endif" style="background-image: url({{$slider->image}}); background-repeat: no-repeat; background-size: 100% 100%; background-position: center;">
                                    </div>			
                                @endforeach
                            </div>	
                        </div>	
                    @endif           
                @endif
            </div>
            <div class="col-sm-12 col-md-6 d-flex justify-content-center align-items-center">
                <div class="mx-auto" style="max-width: 350px;">
                    <h2 class="font-size-24 mb-md-5 mb-sm-2">{{ $a->content_1 }}</h2>
                    <div class="font-size-16">{!! $a->content_2 !!}</div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
@push('head')
    <style>
        .carousel-item{
            min-height: 340px;
        }
    </style>
@endpush
@push('scripts')	
@endpush
       

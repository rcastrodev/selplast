@extends('paginas.partials.app')
@section('content')
<div class="row hero-industrias" style="min-height: 384px;">
    <div class="col-sm-12 col-md-6 p-0">
        @if (Storage::disk('public')->exists($industria->image))
            <img src="{{ asset($industria->image) }}" class="img-fluid w-100">
        @endif
    </div>
    <div class="col-sm-12 col-md-6 d-flex align-items-center bg-light">
        <div class="mx-auto" style="width:90%;">
            <div class="mb-sm-2 mt-sm-3 mt-md-0 mb-md-5" style="color: #848484;">
                <a href="{{ route('industrias') }}" class="text-decoration-none" style="color: #848484;">Industrias</a>
                <span class="mx-2">/</span>
                <span>{{ $industria->content_1 }}</span>
            </div>
            <h1 class="text-red mb-sm-2 mb-md-5 font-size-32">{{ $industria->content_1 }}</h1>
            <div class="">{!! $industria->content_2 !!}</div>
        </div>
    </div>
</div>
@if ($industria->images)
    @if(count($industria->images))
        <div class="container mx-auto py-5">
            <h3 class="mb-4 font-size-24">Productos relacionados</h3>
            <div class="row">
                @foreach ($industria->images as $pr)
                    <div class="col-sm-12 col-md-3 mb-4">
                        <div class="card">
                            @if ($pr->image)
                                <img src="{{ asset($pr->image) }}" class="img-fluid img-product" style="min-height: 236px; max-height:236px; object-fit: contain;">
                            @else
                                <img src="{{ asset('images/default.jpg') }}" class="img-fluid img-product" style="min-height: 236px; max-height:236px; object-fit: contain;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title font-size-16">{{ $pr->name }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endif
@if (count($industria->clients))
    <div class="row container mx-auto mt-sm-0 my-5">
        <div class="col-sm 12-col-md-6">
            <h3 class="text-dark fw-bold font-size-32">Clientes</h3>
        </div>
    </div>
    <div class="row container mx-auto mb-5">
        @foreach ($industria->clients as $c)
            <div class="col-sm-6 col-md-2 d-flex align-items-center mb-4">
                @if (Storage::disk('public')->exists($c->image))
                    <img src="{{ asset($c->image) }}" class="img-fluid ">
                @endif
            </div>
        @endforeach
    </div>
@endif
@endsection
@push('head')
    <style>
        .card img{
            border: 1px solid #E0E0E0 !important;
        }
    </style>

@endpush
       

@extends('paginas.partials.app')
@section('content')
<div class="contenedor-breadcrumb">
    <div class="container">
        <div aria-label="breadcrumb">
            <ol class="breadcrumb text-uppercase py-2 font-size-13">
                <li class="breadcrumb-item">
                    <a href="{{ route('categorias') }}" class="text-decoration-none text-dark">Productos</a>
                </li>
                <li class="breadcrumb-item active text-dark" aria-current="page">{{ $categoria->name }}</li>
            </ol>
        </div>  
        <div class="py-3 row">
            <div class="col-sm-12 col-md-5">
                <h1 class="text-red font-size-32 mb-4">{{ $categoria->name }}</h1>
                <div>{!! $categoria->description !!}</div>
            </div>
        </div>
        @if ($categoria->has_subcategory)
            <div class="row">
                @foreach ($categoria->subCategories as $subCategory)
                    <div class="col-sm-12 col-md-6 mb-4">
                        <a href="{{ route('subCategoria', ['id'=> $subCategory->id]) }}" class="card card1 position-relative justify-content-end d-flex text-decoration-none text-dark" style="height: 330px;">
                            @if ($subCategory->image)
                                <img src="{{ asset($subCategory->image) }}" class="img-fluid img-product position-absolute" style="min-height: 330px; max-height:330px; object-fit: contain; right:0;">
                            @else
                                <img src="{{ asset('images/default.jpg') }}" class="img-fluid img-product position-absolute" style="min-height: 330px; max-height:330px; object-fit: contain; right:0;">
                            @endif
                            <div class="ms-4 mb-4">
                                <h5 class="card-title font-size-24">{{ $subCategory->name }}</h5>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="row">
                @foreach ($categoria->images as $image)
                    <div class="col-sm-12 col-md-3 mb-4 d-block">
                        <a  href="{{ asset($image->image) }}" data-lightbox="{{$categoria->name}}" class="card card2 text-decoration-none text-dark">
                            @if ($image->image)
                                <img src="{{ asset($image->image) }}" class="img-fluid img-product" style="min-height: 236px; max-height:236px; object-fit: contain;">
                            @else
                                <img src="{{ asset('images/default.jpg') }}" class="img-fluid img-product" style="min-height: 236px; max-height:236px; object-fit: contain;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title font-size-16">{{ Str::limit($image->name, 40) }}</h5>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</div>
@endsection
@push('head')
    <link rel="stylesheet" href="{{ asset('vendor/lightbox/dist/css/lightbox.css') }}">
    <style>
        .breadcrumb-item + .breadcrumb-item::before{
            content:'/' !important;
        }

        .card.card1,
        .card2 img{
            border: 1px solid #E0E0E0 !important;
        }
    </style>
@endpush
@push('scripts')
    <script src="{{ asset('vendor/lightbox/dist/js/lightbox.js') }}"></script>
@endpush


       

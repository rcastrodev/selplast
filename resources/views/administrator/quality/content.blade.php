@extends('adminlte::page')
@section('title', 'Calidad')
@section('content_header')
    <div class="d-flex">
        <h1 class="mr-3">Calidad</h1>
    </div>
@stop
@section('content')
@if ($errors->any())
    @include('administrator.partials.mensaje-error')
@endif
@includeIf('administrator.partials.mensaje-exitoso')
@isset($section1)
    <section>
        <form action="{{ route('quality.content.updateInfo') }}" method="post" class="row mt-5 mb-5" data-sync="no" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$section1->id}}">
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <input type="text" name="content_1" value="{{$section1->content_1}}" placeholder="Título" class="form-control">
                </div>
                <div class="form-group">
                    <textarea name="content_2" cols="30" rows="10" class="ckeditor">{{$section1->content_2}}</textarea>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    @if (Storage::disk('public')->exists($section1->image))
                        <img src="{{Storage::disk('public')->url($section1->image)}}" class="img-fluid d-block mb-3">
                    @endif
                    <small>la imagen debe ser al menos 671x463</small>
                    <input type="file" name="image" class="form-control-input">
                </div>
            </div>
            <div class="text-right col-sm-12">
                <button type="submit" class="btn btn-primary w-100">Actualizar</button>
            </div>
        </form>
    </section>
@endisset
<div class="row mb-5">
    <div class="col-sm-12">
        <div class="d-flex align-items-center">
            <h2 class="mr-2 mb-0">Descargas</h2>
            <button type="button" class="btn btn-sm btn-primary mb" data-toggle="modal" data-target="#modal-create-element">crear</button>
        </div>
        <table id="page_table_slider" class="table">
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Título</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@includeIf('administrator.quality.modals.create')
@includeIf('administrator.quality.modals.update')
@stop
@section('css')
    <meta name="_token" content="{{csrf_token()}}">
    <meta name="url" content="{{route('quality.content')}}">
    <meta name="content_find" content="{{route('content')}}">
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
@stop

@section('js')
    <script src="{{ asset('/vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/axios.js') }}"></script>
    <script src="{{ asset('js/admin/index.js') }}"></script>
    <script src="{{ asset('js/admin/quality/index.js') }}"></script>
@stop


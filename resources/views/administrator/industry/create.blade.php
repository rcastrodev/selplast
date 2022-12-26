@extends('adminlte::page')
@section('title', 'crear industria')
@section('content')

<form action="{{ route('industry.content.store') }}" method="POST" enctype="multipart/form-data" class="row mb-5">
    @csrf
    <div class="col-sm-12 col-md-7">
        <div class="form-group">
            <label for="">Título</label>
            <input type="text" name="content_1" placeholder="Título" class="form-control">
        </div>
    </div>
    <div class="col-sm-12 col-md-3">
        <div class="form-group">
            <label for="">Orden</label>
            <input type="text" name="order" placeholder="Orden" class="form-control">
        </div>
    </div>
    <div class="col-sm-12 col-md-2">
        <div class="form-group d-flex flex-column align-items-center">
            <label for="">¿ Es destacado ?</label>
            <input type="checkbox" name="outstanding">
        </div>
    </div>
    <div class="col-sm-12">
        <label for="">Descripción</label>
        <textarea name="content_2" class="ckeditor" cols="30" rows="10"></textarea>
    </div>
    <div class="col-sm-12 my-4">
        <label for="">Imagen</label>
        <input type="file" name="image" class="form-control-file">
    </div>
    <div class="col-sm-12">
        <button class="btn btn-primary w-100">Guardar</button>
    </div>
</form>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
@stop
@section('js')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
@stop
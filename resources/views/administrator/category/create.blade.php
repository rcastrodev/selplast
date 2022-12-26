@extends('adminlte::page')
@section('title', 'crear categoría')
@section('content')

<form action="{{ route('category.content.store') }}" method="POST" enctype="multipart/form-data" class="row mb-5">
    @csrf
    <div class="col-sm-12 col-md-9">
        <div class="form-group">
            <label for="">Nombre</label>
            <input type="text" name="name" placeholder="Nombre" class="form-control">
        </div>
    </div>
    <div class="col-sm-12 col-md-3">
        <div class="form-group">
            <label for="">Orden</label>
            <input type="text" name="order" placeholder="Orden" class="form-control">
        </div>
    </div>
    <div class="col-sm-12">
        <label for="">Descripción</label>
        <textarea name="description" class="ckeditor" cols="30" rows="10"></textarea>
    </div>
    <div class="col-sm-12 my-4">
        <label for="">Icono</label>
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
@extends('adminlte::page')
@section('title', 'crear aplicación')
@section('content')

<form action="{{ route('application.content.store') }}" method="POST" class="row mb-5">
    @csrf
    <input type="hidden" name="section_id" value="5">
    <div class="col-sm-12 col-md-9">
        <div class="form-group">
            <label for="">Nombre</label>
            <input type="text" name="content_1" placeholder="Nombre" class="form-control">
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
        <textarea name="content_2" class="ckeditor" cols="30" rows="10"></textarea>
    </div>
    <div class="col-sm-12 mt-4">
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
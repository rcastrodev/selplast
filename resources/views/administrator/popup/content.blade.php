@extends('adminlte::page')
@section('title', 'Contenido empresa')
@section('content')
<div class="row">
    @includeIf('administrator.partials.mensaje-error')
    @includeIf('administrator.partials.mensaje-exitoso')
</div>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Popup</h3>
    </div>
    <form action="{{ route('popup.content.update') }}" method="post">
        @csrf
        @method('put')
        <div class="card-body">
            <input type="hidden" name="id" value="{{$content->id}}">
            <div class="form-group d-flex flex-column">
                <label for="" class="mb-2">Mostrar popup</label>
                <input type="checkbox" name="content_3" value="1" @if($content->content_3) {{ 'checked' }} @endif>
            </div>
            <div class="form-group">
                <input type="text" name="content_1" value="{{$content->content_1}}" class="form-control" placeholder="Título">
            </div>
            <div class="form-group">
                <label for="">Contenido</label>
                <textarea name="content_2" class="ckeditor form-control" placeholder="Contenido">{{$content->content_2}}</textarea>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary ">Actualizar</button>
        </div>
    </form>
</div>      

@stop
@section('css')
    <meta name="_token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
    <style>
        .cke_top{
            display: none;
        }
    </style>
@stop
@section('js')
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
@stop


@extends('adminlte::page')
@section('title', 'Editar industria')
@section('content')
<form action="{{ route('industry.content.update', ['id' => $industry->id]) }}" method="POST" enctype="multipart/form-data" class="row mb-5" data-sync="no">
    @csrf
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label for="">Nombre</label>
            <input type="text" name="content_1" placeholder="Nombre" value="{{ $industry->content_1 }}" class="form-control">
        </div>
    </div>
    <div class="col-sm-12 col-md-3">
        <div class="form-group">
            <label for="">Orden</label>
            <input type="text" name="order" placeholder="Orden" value="{{ $industry->order }}" class="form-control">
        </div>
    </div>
    <div class="col-sm-12 col-md-3">
        <div class="form-group d-flex flex-column align-items-center">
            <label for="">¿ Es destacado ?</label>
            <input type="checkbox" name="outstanding" @if($industry->outstanding == 1) {{ 'checked' }} @endif>
        </div>
    </div>
    <div class="col-sm-12">
        <label for="">Descripción</label>
        <textarea name="content_2" class="ckeditor" cols="30" rows="10">{{ $industry->content_2 }}</textarea>
    </div>
    <div class="form-group col-sm-12 my-4">
        <label for="">Clientes</label>
        <select name="clients_id[]" id="clients_id" class="form-control select2"  multiple="multiple">
            @foreach ($clients as $client)
                <option value="{{$client->id}}"
                    @if(in_array($client->id, $industry->clients->pluck('id')->toArray(), true)) selected @endif
                >{{$client->content_1}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm-12 my-4">
        @if (Storage::disk('public')->exists($industry->image))
            <div class="postion-relative">
                <img src="{{ asset($industry->image) }}" alt="{{ $industry->name }}" class="">
            </div>
        @endif
        <label for="">Imagen</label>
        <input type="file" name="image" class="form-control-file">
    </div>
    <div class="col-sm-12 mt-4">
        <button class="btn btn-primary w-100">Guardar</button>
    </div>
</form>
<div class="row pb-5" id="imagenes">
    <div class="col-sm-12">
        <div class="d-flex mb-3">
            <h3 class="mr-3">Productos relacionados</h3>
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-create-element">Subir</button>
        </div>
        <table id="page_table_slider" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Orden</th>
                    <th>Título</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@includeIf('administrator.industry.images.create')
@includeIf('administrator.industry.images.update') 

@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
    <meta name="root" content="{{route('industry.content')}}">
    <meta name="url" content="{{route('industry.slider.get-images', ['id' => $industry->id])}}">
@stop
@section('js')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/axios.js') }}"></script>
    <script src="{{ asset('js/admin/index.js') }}"></script>
    <script>

        $('document').ready(function(){
            $('.select2').select2()
        })

        let table = $('#page_table_slider').DataTable({
            serverSide: true,
            ajax: `${$('meta[name="url"]').attr('content')}`,
            bSort: true,
            order: [],
            destroy: true,
            columns: [
                { data: "id" },
                { data: "order" },
                { data: "name" },
                { data: "image" },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json",
            }, 
        });

        async function findContentImageCategory(id)
        {
            // get content 
            let url = `${document.querySelector('meta[name="root"]').getAttribute('content')}/image-category`
            if(url){
                if(id){
                    try {
                        let result = await axios.get(`${url}/${id}`)
                        let content = result.data.content 
                        dataImageCategory(content)
                    } catch (error) {
                        console.log(new Error(error));
                    }
                }
            }
        }

        function dataImageCategory(content)
        {
            let form = document.getElementById('form-update-slider')
            form.reset()
            form.querySelector('input[name="id"]').setAttribute('value', content.id)
            form.querySelector('input[name="order"]').setAttribute('value', content.order)
            form.querySelector('input[name="name"]').setAttribute('value', content.name)
        }

        function modalDestroy2(id)
            {
                Swal.fire({
                    title: 'Deseas eliminar?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Si!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        elementDestroy2(id)
                    }
                })
            }

            function elementDestroy2(id)
            {
                axios.delete(`${$('meta[name="root"]').attr('content')}/image/${id}`).then(r => {
                    Swal.fire(
                        'Eliminado!',
                        '',
                        'success'
                    )

                    if(typeof table !== 'undefined')    
                        table.ajax.reload()
                    
                    if(typeof tableService !== 'undefined')    
                        tableService.ajax.reload()
                    
                }).catch(error => console.error(error))

            }
    </script>

@stop
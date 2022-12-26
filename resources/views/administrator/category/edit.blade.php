@extends('adminlte::page')
@section('title', 'Editar categoría')
@section('content')
<form action="{{ route('category.content.update', ['id' => $category->id]) }}" method="POST" enctype="multipart/form-data" class="row mb-5" data-sync="no">
    @csrf
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label for="">Nombre</label>
            <input type="text" name="name" placeholder="Nombre" value="{{ $category->name }}" class="form-control">
        </div>
    </div>
    <div class="col-sm-12 col-md-3">
        <div class="form-group">
            <label for="">Orden</label>
            <input type="text" name="order" placeholder="Orden" value="{{ $category->order }}" class="form-control">
        </div>
    </div>
    <div class="col-sm-12 col-md-3">
        <div class="form-group d-flex flex-column align-items-center">
            <label for="">¿ Tiene subcategorías ?</label>
            <input type="checkbox" id="has_subcategory" name="has_subcategory" @if($category->has_subcategory == 1) {{ 'checked' }} @endif>
        </div>
    </div>
    <div class="col-sm-12 col-md-9">
        <label for="">Descripción</label>
        <textarea name="description" class="ckeditor" cols="30" rows="10">{{ $category->description }}</textarea>
    </div>
    <div class="col-sm-12 col-md-3">
        @if (Storage::disk('public')->exists($category->image))
            <div class="postion-relative">
                <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="d-block mx-auto">
            </div>
        @endif
        <label for="">Icono</label>
        <input type="file" name="image" class="form-control-file">
    </div>
    <div class="col-sm-12 mt-4">
        <button class="btn btn-primary w-100">Guardar</button>
    </div>
</form>
@if ($category->has_subcategory == 1)
@else 
    <div class="row pb-5" id="imagenes">
        <div class="col-sm-12">
            <div class="d-flex mb-3">
                <h3 class="mr-3">Imágenes</h3>
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
    @includeIf('administrator.category.images.create')
    @includeIf('administrator.category.images.update') 
@endif

@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
    <meta name="root" content="{{route('category.content')}}">
    <meta name="url" content="{{route('category.slider.get-images', ['id' => $category->id])}}">
@stop
@section('js')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/axios.js') }}"></script>
    <script src="{{ asset('js/admin/index.js') }}"></script>
    @if ($category->has_subcategory == 1)
    @else
        <script>
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
    @endif 

@stop
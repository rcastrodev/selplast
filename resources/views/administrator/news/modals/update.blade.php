<div class="modal fade" id="modal-update-element">
    <form action="{{ route('news.content.updateInfo') }}" method="post" id="form-update-slider" class="modal-dialog" enctype="multipart/form-data" data-sync="no">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Actualizar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
        <div class="modal-body">
            <input type="hidden" name="id">
            <div class="form-group">
                <input type="text" name="order" class="form-control" placeholder="Ingrese el orden AA BB CC">
            </div>
            <div class="form-group">
                <select name="content_4" class="form-control">
                    <option value="Empresa">Empresa</option>
                    <option value="Equipos">Equipos</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" name="content_1" class="form-control" placeholder="Título">
            </div>
            <div class="form-group">
                <input type="text" name="content_2" class="form-control" placeholder="Contenido corto">
            </div>
            <div class="form-group">
                <textarea name="content_3" id="content_33" cols="30" rows="10" class="ckeditor" placeholder="Contenido"></textarea>
            </div>
            <div class="form-group">
                <input type="file" name="image" class="form-control-file">
                <small>la imagen debe ser al menos 679x547</small>
            </div> 
            <div class="form-group">
                <input type="file" name="image2" class="form-control-file">
                <small>la imagen post debe ser al menos 679x547</small>
            </div> 
            <div class="form-group">
                <label for="">Destacado</label>
                <input type="checkbox" name="content_5" value="1">
            </div>       
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </form>
    <!-- /.modal-dialog -->
</div>
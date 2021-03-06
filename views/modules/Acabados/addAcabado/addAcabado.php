<!-- DATOS DEL ACABADO -->
<div class="form-group">
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
        </div>
        <input type="text" class="form-control" name="ingNomAcabado" id="ingNomAcabado" placeholder="Nombre del acabado" autocomplete="off">
    </div>
    <div class="invalid-feedback" id="errorIngNomAcabado">
        <ul>
            <li>El nombre no puede contener números ni caracteres especiales.</li>
        </ul>
    </div>
</div>

<div class="row">
    <!-- FOTO DEL ACABADO -->
    <div class="col-12">
        <div class="mb-3 text-center border p-0 mx-auto" style="max-width:150px; max-height: 150px;">
            <img class="previsualizarAcabado img-thumbnail border-0" src="views/img/Acabados/defaultAcabado.png" alt="" style="width:100%;">
        </div>
        <div class="custom-file">
            <input type="file" class="fotoAcabado custom-file-input" name="ingfotoAcabado" id="ingfotoAcabado">
            <label class="custom-file-label text-truncate" for="ingfotoAcabado" data-browse="Elegir">Subir una imagen</label>
        </div>
    </div>


</div>
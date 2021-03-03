<!-- DATOS DEL ACABADO -->
<div class="form-group">
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
        </div>
        <input type="text" class="form-control" name="ingNomCorte" id="ingNomCorte" placeholder="Nombre del corte o proceso" autocomplete="off">
    </div>
    <div class="invalid-feedback" id="errorIngNomCorte">
        <ul>
            <li>El nombre no puede contener números ni caracteres especiales.</li>
        </ul>
    </div>
</div>

<div class="row">
    <!-- FOTO DEL CORTE -->
    <div class="col-12">
        <div class="mb-3 text-center border p-0 mx-auto" style="max-width:150px; max-height: 150px;">
            <img class="previsualizarCorte img-thumbnail border-0" src="views/img/Cortes/defaultCorte.png" alt="" style="width:100%;">
        </div>
        <div class="custom-file">
            <input type="file" class="fotoCorte custom-file-input" name="ingfotoCorte" id="ingfotoCorte">
            <label class="custom-file-label text-truncate" for="ingfotoCorte" data-browse="Elegir">Subir una imagen</label>
        </div>
    </div>


</div>
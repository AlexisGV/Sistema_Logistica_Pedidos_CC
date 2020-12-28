<input type="hidden" name="editIdMarca" id="editIdMarca">
<input type="hidden" name="editNomActualMarca" id="editNomActualMarca">
<input type="hidden" name="editFotoActualMarca" id="editFotoActualMarca">

<!-- DATOS DE LA MARCA -->
<div class="form-group">
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
        </div>
        <input type="text" class="form-control" name="editNomMarca" id="editNomMarca" placeholder="Nombre de la marca" autocomplete="off">
    </div>
    <div class="invalid-feedback" id="errorEditNomMarca">
        <ul>
            <li>El nombre no puede contener números ni caracteres especiales.</li>
        </ul>
    </div>
</div>

<div class="row">
    <!-- FOTO DE LA MARCA -->
    <div class="col-12">
        <div class="mb-3 text-center border p-0 mx-auto" style="max-width:150px; max-height: 150px;">
            <img class="previsualizarMarca img-thumbnail border-0" src="views/img/Marcas/defaultMarca.png" alt="" style="width:100%;">
        </div>
        <div class="custom-file">
            <input type="file" class="fotoMarca custom-file-input" name="editfotoMarca" id="editfotoForma">
            <label class="custom-file-label text-truncate" for="editfotoMarca" data-browse="Elegir">Subir una imagen</label>
        </div>
    </div>


</div>
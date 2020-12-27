<input type="hidden" name="editIdAcabado" id="editIdAcabado">
<input type="hidden" name="editNomActualAcabado" id="editNomActualAcabado">
<input type="hidden" name="editFotoActualAcabado" id="editFotoActualAcabado">

<!-- DATOS DEL ACABADO -->
<div class="form-group">
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
        </div>
        <input type="text" class="form-control" name="editNomAcabado" id="editNomAcabado" placeholder="Nombre del acabado" autocomplete="off">
    </div>
    <div class="invalid-feedback" id="errorEditNomAcabado">
        <ul>
            <li>La primera letra del nombre debe ser una mayúscula y el resto minusculas.</li>
            <li>El nombre no puede contener números ni caracteres especiales.</li>
            <li>El nombre no puede contener mas de una palabra.</li>
        </ul>
    </div>
</div>

<div class="row">

    <div class="col-9 col-sm-10">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-spell-check"></i></div>
                </div>
                <input type="text" class="form-control" name="editAbvAcabado" id="editAbvAcabado" placeholder="Abreviación del acabado" autocomplete="off" readonly>
            </div>
            <div class="invalid-feedback" id="errorEditAbvAcabado">
                <ul>
                    <li>La abreviación debe contener solo letras mayúsculas.</li>
                    <li>La abreviación no puede contener números ni caracteres especiales.</li>
                    <li>La abreviación no puede contener mas de una palabra.</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-3 col-sm-2">
        <div class="icheck-warning d-inline">
            <input type="checkbox" name="editAbreviacionEspecial" id="editAbreviacionEspecial">
            <label for="editAbreviacionEspecial">
                Editar
            </label>
        </div>
    </div>

</div>


<div class="form-group">
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
        </div>
        <input type="number" min="1" step=".01" class="form-control" name="editPrecioAcabado" id="editPrecioAcabado" placeholder="Precio del acabado" autocomplete="off">
    </div>
</div>

<div class="row">
    <!-- FOTO DEL USUARIO -->
    <div class="col-12">
        <div class="mb-3 text-center border p-0 mx-auto" style="max-width:150px; max-height: 150px;">
            <img class="previsualizarAcabado img-thumbnail border-0" src="views/img/Acabados/defaultAcabado.png" alt="" style="width:100%;">
        </div>
        <div class="custom-file">
            <input type="file" class="fotoAcabado custom-file-input" name="editfotoAcabado" id="editfotoAcabado">
            <label class="custom-file-label text-truncate" for="editfotoAcabado" data-browse="Elegir">Subir una imagen</label>
        </div>
    </div>


</div>
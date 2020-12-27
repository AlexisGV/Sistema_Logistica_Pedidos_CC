<input type="hidden" name="editIdForma" id="editIdForma">
<input type="hidden" name="editNomActualForma" id="editNomActualForma">
<input type="hidden" name="editFotoActualForma" id="editFotoActualForma">

<!-- DATOS DE LA FORMA -->
<div class="form-group">
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
        </div>
        <input type="text" class="form-control" name="editNomForma" id="editNomForma" placeholder="Nombre de la forma" autocomplete="off">
    </div>
    <div class="invalid-feedback" id="errorEditNomForma">
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
                <input type="text" class="form-control" name="editAbvForma" id="editAbvForma" placeholder="Abreviación de la forma" autocomplete="off" readonly>
            </div>
            <div class="invalid-feedback" id="errorEditAbvForma">
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
            <input type="checkbox" name="editAbreviacionEspecialForma" id="editAbreviacionEspecialForma">
            <label for="editAbreviacionEspecialForma">
                Editar
            </label>
        </div>
    </div>

</div>

<div class="row">
    <!-- FOTO DE LA FORMA -->
    <div class="col-12">
        <div class="mb-3 text-center border p-0 mx-auto" style="max-width:150px; max-height: 150px;">
            <img class="previsualizarForma img-thumbnail border-0" src="views/img/Formas/defaultForma.png" alt="" style="width:100%;">
        </div>
        <div class="custom-file">
            <input type="file" class="fotoForma custom-file-input" name="editfotoForma" id="editfotoForma">
            <label class="custom-file-label text-truncate" for="editfotoForma" data-browse="Elegir">Subir una imagen</label>
        </div>
    </div>


</div>
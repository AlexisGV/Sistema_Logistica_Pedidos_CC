<!-- DATOS DE LA FORMA -->
<div class="form-group">
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
        </div>
        <input type="text" class="form-control" name="ingNomForma" id="ingNomForma" placeholder="Nombre de la forma" autocomplete="off">
    </div>
    <div class="invalid-feedback" id="errorIngNomForma">
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
                <input type="text" class="form-control" name="ingAbvForma" id="ingAbvForma" placeholder="Abreviación de la forma" autocomplete="off" readonly>
            </div>
            <div class="invalid-feedback" id="errorIngAbvForma">
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
            <input type="checkbox" name="ingAbreviacionEspecialForma" id="ingAbreviacionEspecialForma">
            <label for="ingAbreviacionEspecialForma">
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
            <input type="file" class="fotoForma custom-file-input" name="ingfotoForma" id="ingfotoForma">
            <label class="custom-file-label text-truncate" for="ingfotoForma" data-browse="Elegir">Subir una imagen</label>
        </div>
    </div>


</div>
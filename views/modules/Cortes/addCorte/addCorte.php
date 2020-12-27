<!-- DATOS DEL ACABADO -->
<div class="form-group">
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
        </div>
        <input type="text" class="form-control" name="ingNomCorte" id="ingNomCorte" placeholder="Nombre del corte" autocomplete="off">
    </div>
    <div class="invalid-feedback" id="errorIngNomCorte">
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
                <input type="text" class="form-control" name="ingAbvCorte" id="ingAbvCorte" placeholder="Abreviación del corte" autocomplete="off" readonly>
            </div>
            <div class="invalid-feedback" id="errorIngAbvCorte">
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
            <input type="checkbox" name="ingAbreviacionEspecialCorte" id="ingAbreviacionEspecialCorte">
            <label for="ingAbreviacionEspecialCorte">
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
        <input type="number" min="1" step=".01" class="form-control" name="ingPrecioCorte" id="ingPrecioCorte" placeholder="Precio del corte" autocomplete="off">
    </div>
</div>

<div class="row">
    <!-- FOTO DEL USUARIO -->
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
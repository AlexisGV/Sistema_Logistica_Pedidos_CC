<!--=============================================
TITULO O DESCRIPCION DEL PRODUCTO
=============================================-->
<div class="form-group">
    <label for="ingNomProducto">Título o descripción breve del producto</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
        </div>
        <textarea type="text" class="form-control" name="ingNomProducto" id="ingNomProducto" placeholder="Titulo o descripción breve del producto" autocomplete="off" rows="1" required></textarea>
        <div class="invalid-feedback" id="errorIngNomProducto">
            Este campo solo admite los siguientes caracteres especiales: (,) Comas y (.) Puntos. NO lo puedes dejar vacío.
        </div>
    </div>
</div>

<!--=============================================
VALORES NUMERICOS
=============================================-->
<div class="row">
    <div class="form-group col-12 col-sm-3">
        <label for="ingPrecioInicial">Precio inicial</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
            </div>
            <input type="text" class="form-control" name="ingPrecioInicial" id="ingPrecioInicial" placeholder="Precio inicial" autocomplete="off" required>
            <div class="invalid-feedback" id="errorIngPrecioInicial">
                El valor debe tener 2 decimales.
            </div>
        </div>
    </div>

    <div class="form-group col-12 col-sm-3">
        <label for="ingCantidad">Cantidad</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></div>
            </div>
            <input type="number" min="1" step="1" class="form-control" name="ingCantidad" id="ingCantidad" autocomplete="off" placeholder="Cantidad" value="1" required>
            <div class="invalid-feedback">
                Este campo no puede tener decimales y mucho menos puede quedar vacío.
            </div>
        </div>
    </div>

    <div class="form-group col-12 col-sm-3">
        <label for="ingDescuento">Descuento</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-percentage"></i></div>
            </div>
            <input type="number" min="0" step="1" class="form-control" name="ingDescuento" id="ingDescuento" autocomplete="off" placeholder="Descuento" value="0" required>
            <div class="invalid-feedback">
                Este campo no puede tener decimales y mucho menos puede quedar vacío.
            </div>
        </div>
    </div>

    <div class="form-group col-12 col-sm-3">
        <label for="ingPrecioFinal">Precio final</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-money-check-alt"></i></div>
            </div>
            <input type="text" class="form-control" name="ingPrecioFinal" id="ingPrecioFinal" autocomplete="off" placeholder="Precio final" required readonly>
            <div class="invalid-feedback" id="errorIngPrecioFinal"></div>
        </div>
    </div>
</div>

<!--=============================================
CARACTERISTICAS DEL PRODUCTO
=============================================-->
<div class="row">
    <div class="form-group col-12 col-sm-6">
        <!-- MARCA GUARDADA EN LA BASE DE DATOS -->
        <label for="ingMarcaProducto" class="text-primary">Marca ( <i class="fas fa-wine-bottle"></i> )</label>
        <select class="form-control select2" name="ingMarcaProducto" id="ingMarcaProducto" data-placeholder="Seleccione una marca" required>
            <option></option>
            <?php
            $tabla = "marca";
            $item = "Marca";
            $excepcion = "Otra marca";

            $marcas = ControladorPedidos::ctrTraerRegistros($tabla, $item, $excepcion);
            foreach ($marcas as $key => $value) :
            ?>
                <option value="<?php echo $value["Marca"]; ?>"><?php echo $value["Marca"]; ?></option>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback" id="errorIngMarcaProducto">Este campo no puede quedar vacío, seleccione una marca.</div>

        <!-- MARCA ESCRITA POR EL USUARIO -->
        <div class="icheck-primary mt-2">
            <input type="checkbox" name="ingCheckOtraMarcaProd" id="ingCheckOtraMarcaProd">
            <label for="ingCheckOtraMarcaProd">
                Ingresar otra marca
            </label>
        </div>
        <input type="text" class="form-control mt-2 d-none" name="ingOtraMarcaProd" id="ingOtraMarcaProd" placeholder="Nombre de la marca">
        <div class="invalid-feedback">
            Este campo solo admite los siguientes caracteres especiales: (,) Comas y (.) Puntos. Y una vez habilitado no lo puedes dejar vacío.
        </div>
    </div>

    <div class="form-group col-12 col-sm-6">
        <!-- FORMA GUARDADA EN LA BASE DE DATOS -->
        <label for="ingFormaProducto" class="text-success">Forma ( <i class="fas fa-cubes"></i> )</label>
        <select class="form-control select2" name="ingFormaProducto" id="ingFormaProducto" data-placeholder="Seleccione una forma" required>
            <option></option>
            <?php
            $tabla = "forma";
            $item = "Forma";
            $excepcion = "Otra forma";

            $marcas = ControladorPedidos::ctrTraerRegistros($tabla, $item, $excepcion);
            foreach ($marcas as $key => $value) :
            ?>
                <option value="<?php echo $value["Forma"]; ?>"><?php echo $value["Forma"]; ?></option>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback" id="errorIngFormaProducto">Este campo no puede quedar vacío, seleccione una marca.</div>

        <!-- FORMA ESCRITA POR EL USUARIO -->
        <div class="icheck-success mt-2">
            <input type="checkbox" name="ingCheckOtraFormaProd" id="ingCheckOtraFormaProd">
            <label for="ingCheckOtraFormaProd">
                Ingresar otra forma
            </label>
        </div>
        <input type="text" class="form-control mt-2 d-none" name="ingOtraFormaProd" id="ingOtraFormaProd" placeholder="Nombre de la forma">
        <div class="invalid-feedback">
            Este campo solo admite los siguientes caracteres especiales: (,) Comas y (.) Puntos. Y una vez habilitado no lo puedes dejar vacío. Además, no acepta valores númericos.
        </div>
    </div>

    <div class="form-group col-12 col-sm-6">
        <!-- CORTE GUARDADA EN LA BASE DE DATOS -->
        <label for="ingCorteProducto" class="text-warning">Corte ( <i class="fas fa-cut"></i> )</label>
        <select class="form-control select2" name="ingCorteProducto[]" id="ingCorteProducto" data-placeholder="Seleccione un corte" multiple="multiple">
            <?php
            $tabla = "corte";
            $item = "Corte";
            $excepcion = "Otro corte";

            $marcas = ControladorPedidos::ctrTraerRegistros($tabla, $item, $excepcion);
            foreach ($marcas as $key => $value) :
            ?>
                <option value="<?php echo $value["Corte"]; ?>"><?php echo $value["Corte"]; ?></option>
            <?php endforeach; ?>
        </select>

        <!-- CORTE ESCRITO POR EL USUARIO -->
        <div class="icheck-warning mt-2">
            <input type="checkbox" name="ingCheckOtroCorteProd" id="ingCheckOtroCorteProd">
            <label for="ingCheckOtroCorteProd">
                Ingresar otro corte
            </label>
        </div>
        <input type="text" class="form-control mt-2 d-none" name="ingOtroCorteProd" id="ingOtroCorteProd" placeholder="Nombre del corte">
        <div class="invalid-feedback">
            Este campo solo admite los siguientes caracteres especiales: (,) Comas y (.) Puntos. Y una vez habilitado no lo puedes dejar vacío.
        </div>
        <div class="invalid-feedback" id="errorNingunCorte">
            Debes seleccionar al menos un corte de la lista o bien, puedes ingresar uno que no este en la lista dando clic en la casilla para "Ingresar otro corte".
        </div>
    </div>

    <div class="form-group col-12 col-sm-6">
        <!-- ACABADO GUARDADA EN LA BASE DE DATOS -->
        <label for="ingAcabadoProducto" class="text-danger">Acabado ( <i class="fas fa-border-style"></i> )</label>
        <select class="form-control select2" name="ingAcabadoProducto[]" id="ingAcabadoProducto" data-placeholder="Seleccione un acabado" multiple="multiple">
            <?php
            $tabla = "acabado";
            $item = "Acabado";
            $excepcion = "Otro acabado";

            $marcas = ControladorPedidos::ctrTraerRegistros($tabla, $item, $excepcion);
            foreach ($marcas as $key => $value) :
            ?>
                <option value="<?php echo $value["Acabado"]; ?>"><?php echo $value["Acabado"]; ?></option>
            <?php endforeach; ?>
        </select>

        <!-- ACABADO ESCRITA POR EL USUARIO -->
        <div class="icheck-danger mt-2">
            <input type="checkbox" name="ingCheckOtroAcabadoProd" id="ingCheckOtroAcabadoProd">
            <label for="ingCheckOtroAcabadoProd">
                Ingresar otro acabado
            </label>
        </div>
        <input type="text" class="form-control mt-2 d-none" name="ingOtroAcabadoProd" id="ingOtroAcabadoProd" placeholder="Nombre del acabado">
        <div class="invalid-feedback">
            Este campo solo admite los siguientes caracteres especiales: (,) Comas y (.) Puntos. Y una vez habilitado no lo puedes dejar vacío. Además, no acepta valores númericos.
        </div>
        <div class="invalid-feedback" id="errorNingunAcabado">
            Debes seleccionar al menos un acabado de la lista o bien, puedes ingresar uno que no este en la lista dando clic en la casilla para "Ingresar otro acabado".
        </div>
    </div>
</div>

<!--=============================================
OBSERVACIONES DEL PRODUCTO
=============================================-->
<div class="form-group">
    <label for="ingObvProducto">Observaciones del producto (Opcional)</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-info-circle"></i></div>
        </div>
        <textarea type="text" class="form-control" name="ingObvProducto" id="ingObvProducto" placeholder="Observaciones acerca del producto" autocomplete="off" rows="1"></textarea>
        <div class="invalid-feedback">
            Este campo solo admite los siguientes caracteres especiales: (,) Comas y (.) Puntos.
        </div>
    </div>
</div>
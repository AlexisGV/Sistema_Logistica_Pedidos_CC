<body class="hold-transition login-page">

    <div class="login-box">
        <div class="card">
            <div class="card-body login-card-body">

                <img src="views/dist/img/Logo-CC-Largo.png" alt="" class="w-100 pt-1 pb-3 px-5">

                <p class="login-box-msg">Bienvenido/a</p>

                <form method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Correo electrónico o usuario" name="ingresoCorreo" required autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Contraseña" name="ingresoPassword" required autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 text-center mb-2 col-xl-6 text-xl-left mb-xl-0">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember">
                                    Recordarme
                                </label>
                            </div>
                        </div>

                        <div class="col-12 text-center col-xl-6">
                            <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
                        </div>
                    </div>

                    <?php

                    $ingreso =  new FormularioIngreso();
                    $ingreso->ctlIngreso();

                    ?>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
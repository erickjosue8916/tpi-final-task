<div class="opaco">
    <main class="container h-100 d-flex justify-content-center align-items-center">
        <content class="formu2">
            <h1 class="font-weight-light">Iniciar Sesión</h1>
            <!-- Mensaje de error si las credenciales no coinciden -->
            <?php if (isset($error)) { ?>
                <div class="alert bg-danger text-white" role="alert">
                    <?=$error;?>
                </div>
            <?php } ?>
            <form action="" method="POST">
                <!-- Nombre de usuario input -->
                <div class="form-group">
                    <div class="form-outline mb-4">
                        <input type="text" id="form1Example1" name="username" class="form-control bg-dark text-white" autocomplete=off required/>
                        <label class="form-label text-white font-weight-light" for="form1Example1">Nombre de Usuario</label>
                    </div>
                </div>
                <!-- Contrasena input -->
                <div class="form-group">
                    <div class="form-outline mb-4">
                        <input type="password" id="form1Example2" name="password" class="form-control bg-dark text-white" autocomplete=off required/>
                        <label class="form-label text-white font-weight-light" for="form1Example2">Contraseña</label>
                    </div>
                </div>
                <!-- Ingresar button -->
                <button type="submit" class="btn btn-primary btn-block font-weight-light">Ingresar</button>
                <!-- Registrarse button -->
                <button type="button" onclick="window.location.href='<?=BASE_DIR?>Users/register'" class="btn btn-outline-success btn-block font-weight-light">Registrate</button>
            </form>
        </content>
    </main>
</div>
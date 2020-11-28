
<div class="opaco">
<main class="container h-100 d-flex justify-content-center align-items-center ">
    
    <content  class="formu2">

    <div>
        <h1 class="font-weight-light">Iniciar Sesión</h1>
    
   
    <?php if (isset($error)) { ?>
        <div class="alert bg-danger text-white" role="alert">
        <?=$error;?>
        </div>
    <?php } ?>
    <form action="" method="POST">
        <!-- Email input -->
        <div class="form-group">
            <div class="form-outline mb-4">
                <input type="text" id="form1Example1" name="username" class="form-control bg-dark text-white" autocomplete=off required/>
                <label class="form-label text-white font-weight-light" for="form1Example1">Nombre de Usuario</label>
            </div>
        </div>

        <!-- Password input -->
        <div class="form-group">
            <div class="form-outline mb-4">
                <input type="password" id="form1Example2" name="password" class="form-control bg-dark text-white" autocomplete=off required/>
                <label class="form-label text-white font-weight-light" for="form1Example2">Contraseña</label>
            </div>
        </div>
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block font-weight-light">Ingresar</button>
        <button type="button" onclick="window.location.href='<?=BASE_DIR?>Users/register'" class="btn btn-outline-success btn-block font-weight-light">Registrate</button>
    </form>
    </div>
    
    </content>
</main>
</div>
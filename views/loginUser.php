
<div class="opaco">
<main class="container h-100 d-flex justify-content-center align-items-center ">
    
    <content  class="formu2">

    <div>
        <h1>LOGIN</h1>
    
   
    <?php if (isset($error)) { ?>
        <div class="alert bg-danger text-white" role="alert">
        <?=$error;?>
        </div>
    <?php } ?>
    <form action="" method="POST">
        <!-- Email input -->
        <div class="form-outline mb-4">
            <input type="text" id="form1Example1" name="username" class="form-control bg-dark text-white" autocomplete=off required/>
            <label class="form-label text-white" for="form1Example1">Nombre de Usuario</label>
        </div>

        <!-- Password input -->
        <div class="form-outline mb-4">
            <input type="password" id="form1Example2" name="password" class="form-control bg-dark text-white" required/>
            <label class="form-label text-white" for="form1Example2">Contraseña</label>
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
        <button type="submit" class="btn btn-outline-success btn-block">Registrarte</button>
    </form>
    </div>
    
    </content>
</main>
</div>
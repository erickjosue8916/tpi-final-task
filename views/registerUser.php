<div class="opaco">
<main class="container h-auto min-vh-100 justify-content-center align-items-center">
  <content class="formu2">
    <h1>Registro</h1>
    <?php if (isset($error)) {?>
      <div class="alert bg-danger text-white" role="alert">
        <?=$error;?>
      </div>
    <?php } ?>
    <form class="login" action="<?=BASE_DIR?>Users/register" method="POST">
      <!-- 2 column grid layout with text inputs for the first and last names -->
      <div class="row mb-4">
        <div class="col">
          <div class="form-outline">
            <input type="text" id="form3Example1" name="nombre" class="form-control" required="required"/>
            <label class="form-label" for="form3Example1">Nombre</label>
          </div>
        </div>
        <div class="col">
          <div class="form-outline">
            <input type="text" id="form3Example2" name="apellido" class="form-control" required="required"/>
            <label class="form-label" for="form3Example2">Apellido</label>
          </div>
        </div>
      </div>
      
      <div class="form-outline mb-4">
        <input type="email" id="form3Example1" name="email" class="form-control" required="required"/>
        <label class="form-label" for="form3Example1">Correo</label>
      </div>

      <div class="form-outline mb-4">
        <input type="text" id="form3Example2" name="telefono" class="form-control" required="required"/>
        <label class="form-label" for="form3Example2">Telefono</label>
      </div>

      <div class="form-outline mb-4">
        <input type="text" id="form3Example3" name="direccion" class="form-control" required="required"/>
        <label class="form-label" for="form3Example3">Direccion</label>
      </div>

      <!-- Email input -->
      <div class="form-outline mb-4">
        <input type="text" id="form3Example4" name="username" class="form-control" required="required"/>
        <label class="form-label" for="form3Example4">Usuario</label>
      </div>


      <!-- Password input -->
      <div class="form-outline mb-4">
        <input type="password" id="form3Example5" name="password" class="form-control" required="required"/>
        <label class="form-label" for="form3Example5">Password</label>
      </div>

      <!-- Submit button -->
      <button type="submit" class="btn btn-primary btn-block mb-4">
        Sign up
      </button>
  </content>
</main>
</div>
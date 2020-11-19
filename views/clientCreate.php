
<main class="container h-100 d-flex justify-content-center align-items-center">
  <content>
    <h1>Nuevo Cliente</h1>
    <?php if (isset($error)) {?>
      <div class="alert bg-danger text-white" role="alert">
        <?=$error;?>
      </div>
    <?php } ?>
    <form action="" method="POST">
      <!-- 2 column grid layout with text inputs for the first and last names -->
      <div class="row mb-4">
        <div class="col">
          <div class="form-outline">
            <input type="text" id="form3Example1" name="name" class="form-control" />
            <label class="form-label" for="form3Example1">First name</label>
          </div>
        </div>
        <div class="col">
          <div class="form-outline">
            <input type="text" id="form3Example2" name="lastname" class="form-control" />
            <label class="form-label" for="form3Example2">Last name</label>
          </div>
        </div>
      </div>

      <!-- Email input -->
      <div class="form-outline mb-4">
        <input type="text" id="form3Example3" name="address" class="form-control" />
        <label class="form-label" for="form3Example3">Direccion</label>
      </div>

      <div class="form-outline mb-4">
        <input type="email" id="form3Example3" name="email" class="form-control" />
        <label class="form-label" for="form3Example3">Email</label>
      </div>

      <!-- Submit button -->
      <button type="submit" class="btn btn-primary btn-block mb-4">
        Crear
      </button>
  </content>
</main>
<div class="fondo">
	<main class="container h-100 d-flex justify-content-center align-items-center">
		<content class="formu2 pt-2">
			<h2 class="font-weight-light">Registrar Administrador</h2>
			<div class="row">
				<div class="col">
					<?php if (isset($error)) {?>
						<div class="alert bg-danger text-white" role="alert">
							<?=$error;?>
						</div>
					<?php } ?>
					<form action="<?=BASE_DIR?>Users/registerAdmin" method="POST">
						<div class="row mb-4">
							<div class="col">
								<!-- Nombre input -->
								<div class="form-outline">
									<input type="text" id="form3Example1" name="nombre" class="form-control bg-dark text-white" required="required"/>
									<label class="form-label text-white font-weight-light" for="form3Example1">Nombre</label>
								</div>
							</div>
							<div class="col">
								<!-- Apellido input -->
								<div class="form-outline">
									<input type="text" id="form3Example2" name="apellido" class="form-control bg-dark text-white" required="required"/>
									<label class="form-label text-white font-weight-light" for="form3Example2">Apellido</label>
								</div>
							</div>
						</div>
						
						<!-- Correo input -->
						<div class="form-outline mb-4">
							<input type="email" id="form3Example1" name="email" class="form-control bg-dark text-white" required="required"/>
							<label class="form-label text-white font-weight-light" for="form3Example1">Correo</label>
						</div>

						<!-- Telefono input -->
						<div class="form-outline mb-4">
							<input type="text" id="form3Example2" name="telefono" class="form-control bg-dark text-white" required="required"/>
							<label class="form-label text-white font-weight-light" for="form3Example2">Telefono</label>
						</div>

						<!-- Direccion input -->
						<div class="form-outline mb-4">
							<input type="text" id="form3Example3" name="direccion" class="form-control bg-dark text-white" required="required"/>
							<label class="form-label text-white font-weight-light" for="form3Example3">Direccion</label>
						</div>

						<!-- Username input -->
						<div class="form-outline mb-4">
							<input type="text" id="form3Example4" name="username" class="form-control bg-dark text-white" required="required"/>
							<label class="form-label text-white font-weight-light" for="form3Example4">Nombre de Usuario</label>
						</div>

						<!-- Password input -->
						<div class="form-outline mb-4">
							<input type="password" id="form3Example5" name="password" class="form-control bg-dark text-white" required="required"/>
							<label class="form-label text-white font-weight-light" for="form3Example5">Contraseña</label>
						</div>

						<!-- Registrarse button -->
						<button type="submit" class="btn btn-success btn-block mb-4">Registrarse</button>
					</form>
				</div>
			</div>
		</content>
	</main>
</div>
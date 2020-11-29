<?php
if ($_COOKIE["sessionId"]) {
  session_start();
} else {
  header("Location: "  . BASE_DIR . "Users/login");
}
?>
<div class="fondo">
<main class="container h-100 d-flex justify-content-center align-items-center">
    <div>
    <h1 class="font-weight-light text-white display-4">Bienvenido de nuevo <?=$_SESSION["nombre"]?> <?=$_SESSION["apellido"]?>!</h1>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus nisi mollitia eveniet consequuntur maiores? Autem quos, dolorum dolorem dolore adipisci, laudantium et id, mollitia quis nulla totam suscipit? Atque, expedita.</p>
    </div>
</main>
</div>


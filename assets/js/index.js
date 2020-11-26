async function guardarAlquiler () {
  
}

async function guardarCompra () {
  
}

async function setReaction(params) {
  
}

async function changeReaction (peliculaId) {
  const url = `${baseDir}ajax/reaccion.php?pelicula_id=${peliculaId}`
  $result = await (await fetch(url, {})).text()
  console.log($result)
  await chargeProducts()
}

async function chargeProducts() {
  const element = document.getElementById('peliculas')
  const request = await fetch(`${baseDir}ajax/peliculas.php`, {})
  const peliculasHtml = await request.text()
  // console.log(peliculasHtml)
  element.innerHTML = peliculasHtml
}

(async () => {
  const peliculasDOM = document.getElementById('peliculas')
  if (peliculasDOM) {
    await chargeProducts(peliculasDOM)
  }
})()

//Controla el boton del carrito
$(document).ready(function() {
  $("#fab").click(function() {
    $("#content").addClass("fabOpen");
    $(".fabContent").addClass("d-block");
    $(".fa-shopping-cart").toggleClass("fabContentICO");
  });
  $("#close").click(function() {
    $("#content").removeClass("fabOpen");
    $(".fabContent").removeClass("d-block");
    $(".fa-shopping-cart").toggleClass("fabContentICO");
  });
});

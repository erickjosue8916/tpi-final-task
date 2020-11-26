let checkoutObject = {
  details: []
}
function getProductInChekout({id, imagen, nombre, precioAlquiler, precioVenta}) {
  let html = `
<div class="row">
  <div class="col-6">
    <img src="${baseDir}assets/img/movies/${imagen}" class="img-responsive mt-2" alt="">
  </div>
  <div class="col-6">
    <p class="font-weight-bold text-white">${nombre}</p>
    <!-- Precios de venta y alquiler de la pelicula -->
    <label class="font-weight-light text-white">Comprar <p class="font-weight-bold text-success">${precioAlquiler}</p></label><br>
    <label class="font-weight-light text-white">Alquilar <p class="font-weight-bold text-success">${precioVenta}</p></label>
  </div>
</div>`
console.log(html)
  return html
}

async function guardarAlquiler () {
  
}

async function guardarCompra () {
  
}

function addToShopping (id, imagen, nombre, precioAlquiler, precioVenta) {
  
  checkoutObject.details.push({id,nombre,imagen,precioAlquiler,precioVenta})
  const elementsString = checkoutObject.details.map(detail => {
    return getProductInChekout(detail)
  }) 
  const html = elementsString.join('<hr>')
  console.log(html)
  const element = document.getElementById('chechoutDetails');
  element.innerHTML = html
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
  const peliculasDOM = document.getElementById('peliculas');
  const filtroNombre = document.getElementById('buscarNombre')
  let aux = "";
  if (peliculasDOM) {

    await chargeProducts(peliculasDOM)

    /* if(filtroNombre && filtroNombre.value){
      aux+= "&filter[titulo]=" + filtroNombre.value;
    }
    console.log(aux);
    //const request = await fetch(`${baseDir}ajax/peliculas.php${aux}`, {})
    const request = await fetch(`${baseDir}ajax/peliculas.php`, {})
    const peliculasHtml = await request.text()
    console.log(peliculasHtml)
    peliculasDOM.innerHTML = peliculasHtml */

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

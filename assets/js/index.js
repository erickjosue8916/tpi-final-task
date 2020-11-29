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
    <label class="font-weight-light text-white">Alquilar <p class="font-weight-bold text-success">${precioAlquiler}</p></label><br>
    <label class="font-weight-light text-white">Comprar <p class="font-weight-bold text-success">${precioVenta}</p></label>
  </div>
</div>`
//console.log(html)
  return html
}

async function guardarAlquiler () {
  
}

async function guardarCompra () {
  
}

async function actualizarListadoPeliculas() {
  const filter = document.getElementById('busquedaInput').value || null
  const sort = document.getElementById('ordenInput').value || 'titulo'
  const form = sort == 'titulo' ? 'asc' : 'desc';
  let url = `${baseDir}ajax/peliculas.php?sort[${sort}]=${form}`
  if (filter) url += `&filter[titulo]=${filter}`
  const element = document.getElementById('peliculas')
  const request = await fetch(url, {})
  const peliculasHtml = await request.text()
  // console.log(peliculasHtml)
  element.innerHTML = peliculasHtml
}

async function crearTransaccion() {
  //const tipo = document.getElementById('accion').value
  const tipo = getRadioValue("accion");
  const fecha = moment().format('YYYY-MM-DD')
  const fechaEntrega = moment().add(7, 'days').format('YYYY-MM-DD'); 

  const estado = (tipo === 'Compra') ? 'Cancelado' : 'Pendiente'
  checkoutObject.tipo = tipo
  checkoutObject.fecha = fecha
  checkoutObject.fechaEntrega = fechaEntrega
  checkoutObject.estado = estado
  setTotalCarrito()
  const request = await fetch(`${baseDir}ajax/transacciones.php?data=${JSON.stringify(checkoutObject)}`, {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json'
    }
    // body: JSON.stringify(checkoutObject)
  })
  if (tipo === 'Compra') alert('Compra realizada')
  else alert(`Alquiler aprobado. La entrega debe ser realizada para ${fechaEntrega} de no ser asi se aplicara un cargo de $ 5.00`)
  const peliculasHtml = await request.text()
  console.log(peliculasHtml);
  const element = document.getElementById('chechoutDetails');
  element.innerHTML = ''
  checkoutObject.details = []
  checkoutObject.total = 0
  const totalElement = document.getElementById('totalCarrito')
  totalElement.innerText = `$ 0.00`
}

function setTotalCarrito() {
  let tipo = getRadioValue("accion");
  checkoutObject.total = checkoutObject.details.reduce((prev, pelicula) => {
    if (tipo === "Compra") prev += pelicula.precioVenta
    else prev += pelicula.precioAlquiler
    return prev
  }, 0)
  const totalElement = document.getElementById('totalCarrito')
  totalElement.innerText = `$ ${checkoutObject.total}`
}

function addToShopping (id, imagen, nombre, precioAlquiler, precioVenta) {
  const moviesInCheckoutIds = checkoutObject.details.map(movie => movie.id_pelicula)
  if (moviesInCheckoutIds.includes(id)) return
  checkoutObject.details.push({id_pelicula: id,nombre,imagen,precioAlquiler,precioVenta})
  const elementsString = checkoutObject.details.map(detail => {
    return getProductInChekout(detail)
  }) 
  const html = elementsString.join('<hr>')
  setTotalCarrito()
  //console.log(html)
  const element = document.getElementById('chechoutDetails');
  element.innerHTML = html
}

async function changeReaction (peliculaId) {
  const url = `${baseDir}ajax/reaccion.php?pelicula_id=${peliculaId}`
  $result = await (await fetch(url, {})).text()
  //console.log($result)
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

function getRadioValue(groupName) {
  var _result;
  try {
      var o_radio_group = document.getElementsByName(groupName);
      for (var a = 0; a < o_radio_group.length; a++) {
          if (o_radio_group[a].checked) {
              _result = o_radio_group[a].value;
              break;
          }
      }
  } catch (e) { }
  return _result;
}
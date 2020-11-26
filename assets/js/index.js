async function guardarAlquiler () {
  
}

async function guardarCompra () {
  
}
(async () => {
  const peliculasDOM = document.getElementById('peliculas');
  const filtroNombre = document.getElementById('buscarNombre')
  let aux = "";
  if (peliculasDOM) {
    if(filtroNombre && filtroNombre.value){
      aux+= "&filter[titulo]=" + filtroNombre.value;
    }
    console.log(aux);
    //const request = await fetch(`${baseDir}ajax/peliculas.php${aux}`, {})
    const request = await fetch(`${baseDir}ajax/peliculas.php`, {})
    const peliculasHtml = await request.text()
    console.log(peliculasHtml)
    peliculasDOM.innerHTML = peliculasHtml
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

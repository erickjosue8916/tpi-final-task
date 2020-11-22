(async () => {
  const peliculasDOM = document.getElementById('peliculas')
  if (peliculasDOM) {
    const request = await fetch(`${baseDir}ajax/peliculas.php`, {})
    const peliculasHtml = await request.text()
    console.log(peliculasHtml)
    peliculasDOM.innerHTML = peliculasHtml
  }
})()
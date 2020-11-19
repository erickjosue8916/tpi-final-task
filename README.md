# PARCIAL MVC
- Al final se perdio la imagen de banner no se por que pero ya lo habia mandado un update antes y si estaba
- No me quedo tiempo para bajar la imagenes y audio, son los mismos cambiados de nombre

# ENVIRONMENT
 VARIABLE | EXAMPLE | DESCRIPTION 
----------|---------|------------  
BASE_DIR  | http://127.0.0.1/tpi/parcial/ | base dir to project
DEFAULT_CONTROLLER | controllers/ | don't touch
DEFAULT_ACTION | showHome | method in default controller
DB_USER | root | database, username 
DB_PASSWORD | your_password | database, user password
DB_HOST | 127.0.0.1 | database, host
DB_NAME | name_db | database, name


## GUIA de trabajo

- Definir modelos segun base de datos
- Crear Plantilla (disenio base)
    - Header deber cambiar en base al rol de la persona logeada, si no es administrador quitar ciertas opciones limitadas solo para este tipo de usuario
- Crear vistas necesarias (listar aqui)
    - Home 
    - Peliculas (colocar controles de filtrado, y ordenamiento)
        - Usuario logeado
            - Se ordenaran en base a las que les a dado like (colocar controles)
            - Debe haber un boton que permita agregar al carrito (si es el usuario quien compra)
            - El carrito debe ser una ventana la cual se active con un boton, esta ventana mostrara el detalle de las peliculas y preguntara si estas seran alquiladas o rentadas, haciendo el calculo de la venta 
        - Usuario no logeado: Solo vera el listado de peliculas
    - Administrador: 
        - Crear los formularios para el login, y registro de los distintos registros

# NOTA
Lo correcto seria utilizar ajax para el llenado de los elementos pero ocuparia el diseño individual

# Documentacion de metodos
    /*
        function nombreMetodo().
            - definir en una sola linea lo que hace el metodo
            - especificar en esta linea si recibe algun parametro
            - especificar en esta linea si el metodo retorna algo
    */
Ejemplo:
    /*
        function get_Clientes().
            - metodo utilizado para obtener todos los registros de la BD
            - no recibe ningun parametro
            - retorna un arreglo de datos
    */
    public function get_Clientes()
    {
        $query = "SELECT * FROM clientes";
        $statement = $this->conn->prepare($query);
            
        if($statement->execute())
        {
            $this->clientes = $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        return $this->clientes;
    }


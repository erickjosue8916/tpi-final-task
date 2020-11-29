<?php

class Transacciones extends MySqlConnection
{

    const TABLE_NAME = 'transacciones';
    private $filterFields = ['fecha', 'idUsuario', 'estado', 'tipo'];
    private $sortFields = ['fecha', 'estado', 'tipo'];


    private $fecha;
    private $total;
    private $idUsuario;
    private $estado;
    private $tipo;

    public function getFecha()
    {
        return $this->fecha;
    }
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
        return $this;
    }
    public function getTotal()
    {
        return $this->total;
    }
    public function setTotal($total)
    {
        $this->total = $total;
        return $this;
    }
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
        return $this;
    }
    public function getEstado()
    {
        return $this->estado;
    }
    public function setEstado($estado)
    {
        $this->estado = $estado;
        return $this;
    }
    public function getTipo()
    {
        return $this->tipo;
    }
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
        return $this;
    }

    public function __construct()
    {
        parent::__construct();
    }

    // listado de transacciones
    public function list($page = 1, $limit = 20, $filter = [], $sort = [])
    {
        $result = [
            'transacciones' => [],
            'error' => ''
        ];
        $offset = ($page - 1) * $limit;
        $sql = "SELECT t.id_transaccion, t.fecha_transaccion, u.nombre, u.email, t.total_transaccion, t.estado, t.tipo_transaccion FROM " . self::TABLE_NAME . " t "; //Adecuar el sql
        $sql .= " LEFT JOIN usuarios u on u.id_usuarios = t.id_usuario ";
        $sql .= $this->createSqlFilter($filter);
        $sql .= $this->createSqlSort($sort);
        $sql .= " limit $limit offset $offset";
        $stmt = $this->db->prepare($sql);
        $this->setPrepareValues($stmt, $filter);

        echo $this->createSqlFilter($filter);
        echo $this->createSqlSort($filter);

        if ($stmt->execute()) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($result['transacciones'], $row);
            }
        } else {
            $result['error'] = 'Server Error';
        }
        return json_encode($result);
    }

    // crea sentencia sql para aplicar filtros
    private function createSqlFilter($filter)
    {
        $sql = "";
        $filters = $this->filterFields; // filtros disponibles
        if (count($filter)) {
            $i = 0;
            foreach ($filter as $key => $value) {
                $searchInFilters = array_search($key, $filters);

                if ($searchInFilters === false) $searchInFilters = -1;
                if ($searchInFilters >= 0) {
                    $sql .= ($i == 0) ? " WHERE " : " AND ";
                    switch ($key) {
                        case 'fecha':
                            $sql .= "t.fecha_transaccion LIKE :fecha";
                            break;
                        case 'idUsuario':
                            $sql .= "t.id_usuario LIKE :id_usuario";
                            break;
                        case 'estado':
                            $sql .= "t.estado LIKE :estado";
                            break;
                        case 'tipo':
                            $sql .= "t.tipo_transaccion LIKE :tipo";
                            break;
                    }
                }
                $i++;
            }
        }
        return $sql;
    }

    // colocar los valores a los filtros creados (sentencias preparadas)
    private function setPrepareValues($stmt, $filter)
    {
        $filters = $this->filterFields;
        foreach ($filter as $key => $value) {
            $searchInFilters = array_search($key, $filters);
            if ($searchInFilters === false) $searchInFilters = -1;
            if ($searchInFilters >= 0) {
                switch ($key) {
                    case 'fecha':
                        $fecha = "$value";
                        $stmt->bindParam(':fecha', $fecha);
                        break;
                    case 'idUsuario':
                        $idUsuario = $value;
                        $stmt->bindParam(':id_usuario', $idUsuario);
                        break;
                    case 'estado':
                        $estado = $value;
                        $stmt->bindParam(':estado', $estado);
                        break;
                    case 'tipo':
                        $tipo = $value;
                        $stmt->bindParam(':tipo', $tipo);
                        break;

                    default:
                        # code...
                        break;
                }
            }
            // $i++;
        }
    }

    // crear sentencia para ordenar
    private function createSqlSort($rules)
    {
        $sql = "";
        $fields = $this->sortFields; // campos disponibles para ordenar
        if (count($rules)) {
            $i = 0;
            foreach ($rules as $key => $value) {
                $searchInFilters = array_search($key, $fields);
                if ($searchInFilters === false) $searchInFilters = -1;
                //echo "<br>";
                if ($searchInFilters >= 0) {
                    $value = strtoupper($value);
                    if ($value == 'ASC' || $value == 'DESC') $sql .= ($i == 0) ? " ORDER BY " : " , ";
                    switch ($key) {
                        case 'fecha':
                            if ($value == 'ASC' || $value == 'DESC') $sql .= " t.fecha " . $value . " ";
                            break;
                        case 'estado':
                            if ($value == 'ASC' || $value == 'DESC') $sql .= " t.estado " . $value . " ";
                            break;
                        case 'tipo':
                            if ($value == 'ASC' || $value == 'DESC') $sql .= " t.tipo " . $value . " ";
                            break;

                        default:
                            # code...
                            break;
                    }
                }
                $i++;
            }
        }
        return $sql;
    }

    public function update($id)
    {
        $result = [
            'id_transaccion' => 0,
            'success' => false,
            'error' => ''
        ];
        //"UPDATE " . self::TABLE_NAME . " SET fecha_transaccion=:fecha_transaccion,total_transaccion=:total_transaccion,id_usuario=:id_usuario,estado=:estado,tipo_transaccion=:tipo_transaccion WHERE id_transaccion=:id_transaccion"
        $sql = "UPDATE " . self::TABLE_NAME . " SET fecha_transaccion=:fecha,total_transaccion=:total,id_usuario=:id_usuario,estado=:estado,tipo_transaccion=:tipo WHERE id_transaccion=:id_transaccion";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":fecha", $this->getFecha());
        $stmt->bindValue(":total", $this->getTotal());
        $stmt->bindValue(":id_usuario", $this->getIdUsuario());
        $stmt->bindValue(":estado", $this->getEstado());
        $stmt->bindValue(":tipo", $this->getTipo());
        $stmt->bindValue(":id_transaccion", $id);
        try {
            $stmt->execute();
            $edited_id = $id;
            $result['id_transaccion'] = $edited_id;
            $result['success'] = true;
        } catch (\Throwable $th) {
            $result['error'] = "$th";
        }
        //return json_encode($result);
        return $result;
    }

    public function changeState($id)
    {
        $result = [
            'id_transaccion' => 0,
            'success' => false,
            'error' => ''
        ];

        //"UPDATE " . self::TABLE_NAME . " SET fecha_transaccion=:fecha_transaccion,total_transaccion=:total_transaccion,id_usuario=:id_usuario,estado=:estado,tipo_transaccion=:tipo_transaccion WHERE id_transaccion=:id_transaccion"
        $sql = "UPDATE " . self::TABLE_NAME . " SET estado=:estado WHERE id_transaccion=:id_transaccion";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":estado", $this->getEstado());
        $stmt->bindValue(":id_transaccion", $id);
        try {
            $stmt->execute();
            $edited_id = $id;
            $result['id_transaccion'] = $edited_id;
            $result['success'] = true;
        } catch (\Throwable $th) {
            $result['error'] = "$th";
        }
        //return json_encode($result);
        return $result;
    }

    public function create()
    {
        $result = [
            'id_transaccion' => 0,
            'success' => false,
            'error' => ''
        ];
        $sql = "INSERT INTO " . self::TABLE_NAME . " (fecha_transaccion, total_transaccion, id_usuario, estado, tipo_transaccion) VALUES (:fecha, :total, :id_usuario, :estado, :tipo) ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":fecha", $this->getFecha());
        $stmt->bindValue(":total", $this->getTotal());
        $stmt->bindValue(":id_usuario", $this->getIdUsuario());
        $stmt->bindValue(":estado", $this->getEstado());
        $stmt->bindValue(":tipo", $this->getTipo());
        try {
            $stmt->execute();
            $last_id = $this->db->lastInsertId();
            $result['id_transaccion'] = $last_id;
            $result['success'] = true;
        } catch (\Throwable $th) {
            $result['error'] = "$th";
        }
        return json_encode($result);
    }

    // obtener detalles de una transaccion
    public function details($id)
    {
        $result = [
            'transacciones' => [],
            'error' => ''
        ];

        $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE id_transaccion = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id);
        if ($stmt->execute()) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($result['transacciones'], $row);
            }
        } else {
            $result['error'] = 'Server Error';
        }
        return json_encode($result);
    }

    // Eliminar una transaccion
    public function delete($id)
    {
        $result = [
            'success' => false,
            'error' => ''
        ];

        $sql = "DELETE FROM " . self::TABLE_NAME . " WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id);
        if ($stmt->execute()) {
            $result['success'] = true;
        } else {
            $result['error'] = 'Server Error';
        }
        return json_encode($result);
    }

    // marcar como cancelada una transaccion (Alquileres)
    public function markAsCancelled($id, $total)
    {
        $result = [
            'id_transaccion' => 0,
            'success' => false,
            'error' => ''
        ];
        //"UPDATE " . self::TABLE_NAME . " SET fecha_transaccion=:fecha_transaccion,total_transaccion=:total_transaccion,id_usuario=:id_usuario,estado=:estado,tipo_transaccion=:tipo_transaccion WHERE id_transaccion=:id_transaccion"
        $sql = "UPDATE " . self::TABLE_NAME . " SET total_transaccion=:total,estado=:estado WHERE id_transaccion=:id_transaccion";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id_transaccion", $id);
        $stmt->bindValue(":total", $total);
        $stmt->bindValue(":estado", 'Cancelado');
        try {
            $stmt->execute();
            $edited_id = $id;
            $result['id_transaccion'] = $edited_id;
            $result['success'] = true;
        } catch (\Throwable $th) {
            $result['error'] = "$th";
        }
        //return json_encode($result);
        return $result;
    }
}

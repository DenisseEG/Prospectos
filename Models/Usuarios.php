<?php


class Usuarios  extends Mysql
{
    public $intIdUsuario;
    public $intRolId;
    public $strNombre;
    public $strApllPaterno;
    public $strApllMaterno;
    public $strCorreo;
    public $strContrasena;
    public $intEstatus;

    public function __construct()
    {
        parent::__construct();
    }

    public function getUsers()
    {
        $query = 'SELECT u.*, r.nombre as nombre_rol FROM usuario u
                INNER JOIN rol r
                ON u.rol_id = r.id_rol
                WHERE u.estatus != 0';
        return $this->selectAll($query);
    }

    public function getUser(int $id_usuario)
    {
        $this->intIdUsuario = $id_usuario;
        $query = "SELECT u.*, DATE_FORMAT(u.fecha_creado, '%d-%m-%Y') as fecha, r.nombre as nombre_rol FROM usuario u
                INNER JOIN rol r
                ON u.rol_id = r.id_rol
                WHERE id_usuario = '{$this->intIdUsuario}'";
        return $this->select($query);
    }

    public function insertUser(int $rol_id, string $nombre, string $apll_paterno, string $apll_materno, string $correo, string $contrasena, int $estatus)
    {
        $this->intRolId = $rol_id;
        $this->strNombre = $nombre;
        $this->strApllPaterno = $apll_paterno;
        $this->strApllMaterno = $apll_materno;
        $this->strCorreo = $correo;
        $this->strContrasena = $contrasena;
        $this->intEstatus = $estatus;

        $query_select = "SELECT * FROM usuario WHERE correo = '{$this->strCorreo}'";
        $request_select = $this->selectAll($query_select);

        if(empty($request_select)){
            $query = 'INSERT INTO usuario(rol_id, nombre, apellido_paterno, apellido_materno, correo, contrasena, estatus) VALUES(?, ?, ?, ?, ?, ?, ?)';
            $data = [$this->intRolId, $this->strNombre, $this->strApllPaterno, $this->strApllMaterno, $this->strCorreo, $this->strContrasena, $this->intEstatus];
            $request = $this->insert($query, $data);
        }else{
            $request = 'duplicate';
        }
        return $request;
    }

    public function updateUser(int $id_usuario ,int $rol_id, string $nombre, string $apll_paterno, string $apll_materno, string $correo, string $contrasena, int $estatus)
    {
        $this->intIdUsuario = $id_usuario;
        $this->intRolId = $rol_id;
        $this->strNombre = $nombre;
        $this->strApllPaterno = $apll_paterno;
        $this->strApllMaterno = $apll_materno;
        $this->strCorreo = $correo;
        $this->strContrasena = $contrasena;
        $this->intEstatus = $estatus;

        $query_select = "SELECT * FROM usuario WHERE correo = '{$this->strCorreo}' AND id_usuario != '{$this->intIdUsuario}'";
        $request_select = $this->selectAll($query_select);

        if(empty($request_select)){
            if($this->strContrasena == ''){
                $query = "UPDATE usuario SET rol_id = ?, nombre = ?, apellido_paterno = ?, apellido_materno = ?, correo = ?, estatus = ? WHERE id_usuario = '{$this->intIdUsuario}'";
                $data = [$this->intRolId, $this->strNombre, $this->strApllPaterno, $this->strApllMaterno, $this->strCorreo, $this->intEstatus];
            }else{
                $query = "UPDATE usuario SET rol_id = ?, nombre = ?, apellido_paterno = ?, apellido_materno = ?, correo = ?, contrasena = ?, estatus = ? WHERE id_usuario = '{$this->intIdUsuario}'";
                $data = [$this->intRolId, $this->strNombre, $this->strApllPaterno, $this->strApllMaterno, $this->strCorreo, $this->strContrasena, $this->intEstatus];
            }

            $request = $this->update($query, $data);
        }else{
            $request = 'duplicate';
        }
        return $request;
    }

    public function deleteUser(int $id_usuario)
    {
        $this->intIdUsuario = $id_usuario;

        $query = "UPDATE usuario SET estatus = ? WHERE id_usuario = '{$this->intIdUsuario}'";
        $data = [0];
        $request = $this->update($query, $data);

        if($request){
            $request = 'ok';
        }else{
            $request = 'error';
        }

        return $request;
    }
}
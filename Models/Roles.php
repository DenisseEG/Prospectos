<?php


class Roles extends Mysql
{
    public $intIdRol;
    public $strRol;
    public $strDescripcion;
    public $intEstatus;

    public function __construct()
    {
        parent::__construct();
    }

    public function getRoles()
    {
        $query = 'SELECT * FROM rol WHERE estatus != 0';
        return $this->selectAll($query);
    }

    public function getRolesUser()
    {
        $query = 'SELECT * FROM rol WHERE estatus = 1';
        return $this->selectAll($query);
    }

    public function getRole(int $id_rol)
    {
        $this->intIdRol = $id_rol;
        $query = "SELECT * FROM rol WHERE id_rol = '{$this->intIdRol}'";
        return $this->select($query);
    }

    public function insertRole(string $rol, string $descripcion, int $estatus)
    {
        $this->strRol = $rol;
        $this->strDescripcion = $descripcion;
        $this->intEstatus = $estatus;

        $query_select = "SELECT * FROM rol WHERE nombre = '{$this->strRol}'";
        $request_select = $this->selectAll($query_select);

        if(empty($request_select)){
            $query = 'INSERT INTO rol(nombre,descripcion,estatus) VALUES(?, ?, ?)';
            $data = [$this->strRol, $this->strDescripcion, $this->intEstatus];
            $request = $this->insert($query, $data);
        }else{
            $request = 'duplicate';
        }
        return $request;
    }

    public function updateRole(int $id_rol, string $rol, string $descripcion, int $estatus)
    {
        $this->intIdRol = $id_rol;
        $this->strRol = $rol;
        $this->strDescripcion = $descripcion;
        $this->intEstatus = $estatus;
        $response = [
            'request' => 0,
            'msg' => ''
        ];

        $query_select = "SELECT * FROM rol WHERE nombre = '{$this->strRol}' AND id_rol != '{$this->intIdRol}'";
        $request_select = $this->selectAll($query_select);

        $query_users = "SELECT * FROM usuario WHERE rol_id = '{$this->intIdRol}'";
        $request_users = $this->selectAll($query_users);

        if(empty($request_select)){
            if(count($request_users) > 0 && $this->intEstatus == 2){
                $query = "UPDATE rol SET nombre = ?, descripcion = ? WHERE id_rol = '{$this->intIdRol}'";
                $data = [$this->strRol, $this->strDescripcion];
                $response['msg'] = 'exist';
            }else{
                $query = "UPDATE rol SET nombre = ?, descripcion = ?, estatus = ? WHERE id_rol = '{$this->intIdRol}'";
                $data = [$this->strRol, $this->strDescripcion, $this->intEstatus];
                $response['msg'] = 'success';
            }
            $request = $this->update($query, $data);
            $response['request'] = $request;
        }else{
            $response['msg'] = 'duplicate';
        }
        return $response;
    }

    public function deleteRole(int $id_rol)
    {
        $this->intIdRol = $id_rol;
        $query_select = "SELECT * FROM usuario WHERE rol_id = '{$this->intIdRol}'";
        $request_select = $this->selectAll($query_select);

        if(empty($request_select)){
            $query = "UPDATE rol SET estatus = ? WHERE id_rol = '{$this->intIdRol}'";
            $data = [0];
            $request = $this->update($query, $data);

            if($request){
                $request = 'ok';
            }else{
                $request = 'error';
            }
        }else{
            $request = 'exist';
        }
        return $request;
    }
}
<?php


class Permisos extends Mysql
{
    public $intIdPermiso;
    public $intRolId;
    public $intModelId;
    public $intLeer;
    public $intEscribir;
    public $intActualizar;
    public $intEliminar;
    public $intEvaluar;

    public function __construct()
    {
        parent::__construct();
    }

    public function getModules()
    {
        $query = 'SELECT * FROM modulo WHERE estatus != 0';
        return $this->selectAll($query);
    }

    public function getPermissions(int $rol_id)
    {
        $this->intRolId = $rol_id;
        $query = "SELECT * FROM permisos WHERE rol_id = '{$this->intRolId}'";
        return $this->selectAll($query);
    }

    public function deletePermissions(int $rol_id)
    {
        $this->intRolId = $rol_id;
        $query = "DELETE FROM permisos WHERE rol_id = '{$this->intRolId}'";
        return $this->delete($query);
    }

    public function insertPermissions(int $rol_id, int $modulo_id, int $leer, int $escribir, int $actualizar, int $eliminar, int $evaluar)
    {
        $this->intRolId = $rol_id;
        $this->intModelId = $modulo_id;
        $this->intLeer = $leer;
        $this->intEscribir = $escribir;
        $this->intActualizar = $actualizar;
        $this->intEliminar = $eliminar;
        $this->intEvaluar = $evaluar;

        $query = 'INSERT INTO permisos(rol_id,modulo_id,leer,escribir,actualizar,eliminar,evaluar) VALUES(?,?,?,?,?,?,?)';
        $data = [$this->intRolId, $this->intModelId, $this->intLeer, $this->intEscribir,  $this->intActualizar, $this->intEliminar, $this->intEvaluar];
        return $this->insert($query, $data);
    }

    public function modulePermissions(int $id_rol)
    {
        $this->intRolId = $id_rol;
        $array_permissions = [];

        $query = "SELECT p.*, m.titulo as modulo FROM permisos p
                INNER JOIN modulo m
                ON p.modulo_id = m.id_modulo
                WHERE p.rol_id = '{$this->intRolId}'";
        $request = $this->selectAll($query);

        foreach($request as &$data){
            $array_permissions[$data['modulo_id']] = $data;
        }

        return $array_permissions;
    }

}
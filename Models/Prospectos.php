<?php


class Prospectos extends Mysql
{
    public $intIdProspecto;
    public $intUsuarioId;
    public $strNombre;
    public $strApllPaterno;
    public $strApllMaterno;
    public $strCalle;
    public $intNumero;
    public $strColonia;
    public $intCodigoPostal;
    public $intTelefono;
    public $strRfc;
    public $intEstatusProspecto;
    public $strObservaciones;

    public function __construct()
    {
        parent::__construct();
    }

    public function getClients()
    {
        $query = 'SELECT * FROM prospecto WHERE estatus != 0';
        return $this->selectAll($query);
    }

    public function getClient(int $id_prospecto)
    {
        $this->intIdProspecto = $id_prospecto;
        $query = "SELECT p.*, DATE_FORMAT(p.fecha_creado, '%d-%m-%Y') as fecha, u.nombre as usuario_nombre, u.apellido_paterno as usuario_apellido_paterno, u.apellido_materno as usuario_apellido_materno 
                FROM prospecto p 
                INNER JOIN usuario u
                ON p.usuario_id = u.id_usuario
                WHERE id_prospecto = '{$this->intIdProspecto}'";
        return $this->select($query);
    }

    public function insertClient(int $usuario_id, string $nombre, string $apll_paterno, string $apll_materno, string $calle, int $numero, string $colonia, int $codigo_postal, int $telefono, string $rfc)
    {
        $this->intUsuarioId = $usuario_id;
        $this->strNombre = $nombre;
        $this->strApllPaterno = $apll_paterno;
        $this->strApllMaterno = $apll_materno;
        $this->strCalle = $calle;
        $this->intNumero = $numero;
        $this->strColonia = $colonia;
        $this->intCodigoPostal = $codigo_postal;
        $this->intTelefono = $telefono;
        $this->strRfc = $rfc;

        $query_select = "SELECT * FROM prospecto WHERE rfc = '{$this->strRfc}'";
        $request_select = $this->selectAll($query_select);

        if(empty($request_select)){
            $query = 'INSERT INTO prospecto(usuario_id, nombre, apellido_paterno, apellido_materno, calle, numero, colonia, codigo_postal, telefono, rfc) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $data = [$this->intUsuarioId, $this->strNombre, $this->strApllPaterno, $this->strApllMaterno, $this->strCalle, $this->intNumero, $this->strColonia, $this->intCodigoPostal, $this->intTelefono, $this->strRfc];
            $request = $this->insert($query, $data);
        }else{
            $request = 'duplicate';
        }
        return $request;
    }

    public function updateClient(int $id_prospecto, string $nombre, string $apll_paterno, string $apll_materno, string $calle, int $numero, string $colonia, int $codigo_postal, int $telefono, string $rfc)
    {
        $this->intIdProspecto = $id_prospecto;
        $this->strNombre = $nombre;
        $this->strApllPaterno = $apll_paterno;
        $this->strApllMaterno = $apll_materno;
        $this->strCalle = $calle;
        $this->intNumero = $numero;
        $this->strColonia = $colonia;
        $this->intCodigoPostal = $codigo_postal;
        $this->intTelefono = $telefono;
        $this->strRfc = $rfc;

        $query_select = "SELECT * FROM prospecto WHERE rfc = '{$this->strRfc}' AND id_prospecto != '{$this->intIdProspecto}'";
        $request_select = $this->selectAll($query_select);

        if(empty($request_select)){
            $query = "UPDATE prospecto SET nombre = ?, apellido_paterno = ?, apellido_materno = ?, calle = ?, numero = ?, colonia = ?, codigo_postal = ?, telefono = ?, rfc = ? WHERE id_prospecto = '{$this->intIdProspecto}'";
            $data = [$this->strNombre, $this->strApllPaterno, $this->strApllMaterno, $this->strCalle, $this->intNumero, $this->strColonia, $this->intCodigoPostal, $this->intTelefono, $this->strRfc];
            $request = $this->update($query, $data);
        }else{
            $request = 'duplicate';
        }
        return $request;
    }

    public function deleteClient(int $id_prospecto)
    {
        $this->intIdProspecto = $id_prospecto;

        $query = "UPDATE prospecto SET estatus = ? WHERE id_prospecto = '{$this->intIdProspecto}'";
        $data = [0];
        $request = $this->update($query, $data);

        if($request){
            $request = 'ok';
        }else{
            $request = 'error';
        }

        return $request;
    }

    public function approveClient(int $id_prospecto)
    {
        $this->intIdProspecto = $id_prospecto;

        $query = "UPDATE prospecto SET estatus_prospecto = ? WHERE id_prospecto = '{$this->intIdProspecto}'";
        $data = ['Autorizado'];
        $request = $this->update($query, $data);

        if($request){
            $request = 'ok';
        }else{
            $request = 'error';
        }

        return $request;
    }

    public function rejectClient(int $id_prospecto, string $observaciones)
    {
        $this->intIdProspecto = $id_prospecto;
        $this->strObservaciones = $observaciones;

        $query = "UPDATE prospecto SET estatus_prospecto = ?, observaciones = ? WHERE id_prospecto = '{$this->intIdProspecto}'";
        $data = ['Rechazado', $this->strObservaciones];
        $request = $this->update($query, $data);

        if($request){
            $request = 'ok';
        }else{
            $request = 'error';
        }

        return $request;
    }

    public function countStatus()
    {
        $query = 'SELECT estatus_prospecto, count(estatus_prospecto) as total FROM prospecto GROUP BY estatus_prospecto';
        return $this->selectAll($query);
    }
}
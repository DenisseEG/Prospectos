<?php


class Login extends Mysql
{
    private $intIdUsuario;
    private $strCorreo;
    private $strContrasena;
    private $strToken;

    public function __construct()
    {
        parent::__construct();
    }

    public function loginUser(string $correo, string $contrasena)
    {
        $this->strCorreo = $correo;
        $this->strContrasena = $contrasena;

        $query = "SELECT id_usuario, estatus FROM usuario WHERE correo = '{$this->strCorreo}' AND contrasena = '{$this->strContrasena}' AND estatus != 0";
        return $this->select($query);
    }

    public function sessionLogin(int $id_user)
    {
        $this->intIdUsuario = $id_user;

        $query = "SELECT u.*, r.nombre as nombre_rol FROM usuario u 
                INNER JOIN rol r
                ON u.rol_id = r.id_rol
                WHERE u.id_usuario = '{$this->intIdUsuario}'";
        return $this->select($query);
    }
}
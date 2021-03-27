<?php

class user
{
    private $conn;
    private $tableName = "users";

    public $id_users;
    public $userName_users;
    public $email_users;
    public $displayName_users;
    public $password_users;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //Funcion para leer toda la tabla de users
    function read()
    {
        //Guardamos en la variable el query
        $query = "SELECT * FROM  $this->tableName ORDER BY id_users";

        //Preparamos el query
        $state = $this->conn->prepare($query);

        //Ejecutamos el query
        $state->execute();

        //return del statement
        return $state;
    }

    function readOne()
    {
        //Guardamos en la variable el query
        $query = "SELECT * FROM  $this->tableName ORDER BY id_users";

        //Preparamos el query
        $state = $this->conn->prepare($query);

        //Ejecutamos el query
        $state->execute();

        //return del statement
        return $state;
    }

    function create()
    {
    }

    function update()
    {
    }

    function delete()
    {
    }
}

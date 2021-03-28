<?php

class User
{
    // database comm line and table name
    private $comm;
    private $table_name = "users";

    // table fields
    public $id;
    public $username;
    public $email;
    public $displayname;
    public $password;
    public $deleted;

    public function __construct($db)
    {
        $this->comm = $db;
    }

    function create(){
      
        // insertion query
        $query = "INSERT INTO " . $this->table_name . " SET
            username=:username, email=:email, displayname=:displayname, password=:password, deleted=0";
      
        $statement = $this->comm->prepare($query);
      
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->displayname=htmlspecialchars(strip_tags($this->displayname));
        $this->password=htmlspecialchars(strip_tags($this->password));
      
        $statement->bindParam(":username", $this->username);
        $statement->bindParam(":email", $this->email);
        $statement->bindParam(":displayname", $this->displayname);
        $statement->bindParam(":password", $this->password);
        
        if($statement->execute()) return true;
      
        return false;
          
    }

    function read(){
      
        // single-reading query
        $query = "SELECT id, username, email, displayname, password, deleted
            FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";
      
        $statement = $this->comm->prepare($query);
        
        $statement->bindParam(":id", $this->id);
        $statement->bindParam(1, $this->id);
      
        $statement->execute();
      
        return $statement;
    }

    function update(){
      
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    username = :username,
                    email = :email,
                    displayname = :displayname,
                    password = :password
                WHERE
                    id = :id";
      
        $statement = $this->comm->prepare($query);
      
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->displayname=htmlspecialchars(strip_tags($this->displayname));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->id=htmlspecialchars(strip_tags($this->id));
      
        $statement->bindParam(":username", $this->username);
        $statement->bindParam(":email", $this->email);
        $statement->bindParam(":displayname", $this->displayname);
        $statement->bindParam(":password", $this->password);
        $statement->bindParam(":id", $this->id);
      
        if($statement->execute()) return true;
      
        return false;
    }

    function delete() {

        // "delete" query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    deleted = 1
                WHERE
                    id = :id";
      
        $statement = $this->comm->prepare($query);
      
        $this->id=htmlspecialchars(strip_tags($this->id));
      
        $statement->bindParam(":id", $this->id);
      
        if($statement->execute()) return true;
      
        return false;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getDisplayname()
    {
        return $this->displayname;
    }

    /**
     * @param mixed $displayname
     */
    public function setDisplayname($displayname)
    {
        $this->displayname = $displayname;
    }
    
    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($user)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * @param mixed $deleted
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

}
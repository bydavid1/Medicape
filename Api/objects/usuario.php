<?php
class Usuario{

// database connection and table name
    private $conn;
    private $table_name = "users";

// object properties
    public $iduser;
    public $user_Name;
    public $user_Password;
    public $email;
    public $user_type;
    public $reference;

// constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

// read Exam
    function read()
    {
    // select all query
    $query = "SELECT
                iduser, user_Name, user_Password, email, user_type
            FROM
                " . $this->table_name;
    // prepare query statement
    $stmt = $this->conn->prepare($query);
    // execute query
    $stmt->execute();

    return $stmt;
    }

// createExam
    function create()
    {
    // query to insert record
    $query = "INSERT INTO " . $this->table_name . " SET  user_Name=:user_Name, user_Password=:user_Password, email=:email, user_type=:user_type";

    echo $query;
    // prepare query
    $stmt = $this->conn->prepare($query);

    // bind values
    $stmt->bindParam(":user_Name", $this->user_Name);
    $stmt->bindParam(":user_Password", $this->user_Password);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":user_type", $this->user_type);
    
    // execute query
    if($stmt->execute())
    {
        return true;
    }

    return false;
    }


    function update()
    {

    // update query
        $query = "UPDATE
                " . $this->table_name . "
            SET
            user_Name=:user_Name, 
            user_Password=:user_Password, 
            email=:email, 
            user_type=:user_type 
            WHERE
            iduser=:iduser";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // bind new values
    $stmt->bindParam(":user_Name", $this->user_Name);
    $stmt->bindParam(":user_Password", $this->user_Password);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":user_type", $this->user_type);
    $stmt->bindParam(":iduser", $this->iduser);   

    // execute the query
    if($stmt->execute())
    {
        return true;
    }
    return false;
    }

//deleteExam
    function delete()
    {

    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE iduser = ?";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // bind id of record to delete
    $stmt->bindParam(1, $this->iduser);

    // execute query
    if($stmt->execute())
    {
        return true;
    }
    return false;

    }

//readOneExam
    function readOne()
    {

        // query to read single record
        $query = "SELECT
                    iduser, user_Name, user_Password, email, user_type               
                    FROM
                    " . $this->table_name ." 
                WHERE
                    iduser = ?
                LIMIT
                    0,1";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->iduser);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->user_Name = $row['user_Name'];
        $this->user_Password = $row['user_Password'];
        $this->email = $row['email'];
        $this->user_type = $row['user_type'];
    
        
    }

//UserExists
    function userExists(){
        $type = "user";
        $query = "SELECT iduser, reference
                FROM " . $this->table_name . "
                WHERE user_type = '".$type."'AND user_Name = ? AND user_Password = ?
                LIMIT 0,1";
    
        $stmt = $this->conn->prepare( $query );
    

        $stmt->bindParam(1, $this->user_Name);
        $stmt->bindParam(2, $this->user_Password);

        $stmt->execute();
    

        $num = $stmt->rowCount();
    
        if($num>0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            $this->reference = $row['reference'];

        }else{
            return false;
        }
    }

   
    function adminExist(){
        $type = "user";
        $query = "SELECT user_type, reference
                FROM " . $this->table_name . "
                WHERE user_type <> '".$type."'AND user_Name = ? AND user_Password = ?
                LIMIT 0,1";
    
        $stmt = $this->conn->prepare( $query );
    

        $stmt->bindParam(1, $this->user_Name);
        $stmt->bindParam(2, $this->user_Password);

        $stmt->execute();
    

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->user_type = $row['user_type'];
    }
function checkUser()
    {
    
        $query = "SELECT iduser
                FROM " . $this->table_name . "
                WHERE user_Name = ? 
                LIMIT 0,1";
    
        $stmt = $this->conn->prepare( $query );
    

        $stmt->bindParam(1, $this->user_Name);


        $stmt->execute();
    

        $num = $stmt->rowCount();
    
        if($num>0){
        return true;
        }
    
        return false;
    }


    function UpdatePassword()
    {
        $query = "UPDATE
        " . $this->table_name . "
        SET
        user_Password=:user_Password
        WHERE
        iduser=:iduser";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // bind new values
    $stmt->bindParam(":user_Password", $this->user_Password);

    $stmt->bindParam(":iduser", $this->iduser);   

// execute the query
    if($stmt->execute())
    {
    return true;
    }
    return false;
    }






    

}
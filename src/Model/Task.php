<?php

namespace App\Model;

use App\Engine\Db;

class Task{
    private $db;

    public function __construct(){
        $this->db = new Db();
        $this->db->query(
            'CREATE TABLE IF NOT EXISTS tasks (
                id INT AUTO_INCREMENT, 
                username varchar(30) NOT NULL, 
                email varchar(255) NOT NULL, 
                textbody text NOT NULL,
                status BOOLEAN NOT NULL DEFAULT 0, 
                PRIMARY KEY(id))
            '
        );
    }
    public function getTask($id){
        $stmt = $this->db->prepare("SELECT * FROM tasks where id=:id");
        $stmt->bindValue(":id", $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function editTask($id,$username, $email, $textbody,$status){
        $stmt = $this->db->prepare("UPDATE tasks set 
            username=:username,
            email=:email,
            textbody=:textbody,
            status=:status
            WHERE id=:id
            ");
        $stmt->bindValue(':username',$username,\PDO::PARAM_STR);
        $stmt->bindValue(':email', $email,\PDO::PARAM_STR);
        $stmt->bindValue(":textbody", $textbody, \PDO::PARAM_STR);
        $stmt->bindValue(":status", $status, \PDO::PARAM_BOOL);
        $stmt->bindValue(":id", $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function getAll(){
        $stmt = $this->db->query("SELECT * FROM tasks");
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
    public function getAllOffset($offset,$order=null, $asc=null){

        $query = "SELECT * FROM tasks %orderby% %ascdesc% LIMIT 3 OFFSET :offset";
        if(in_array($order,array("username", "email", "textbody","status"))){
            $query=str_replace("%orderby%", "ORDER BY ".$order,$query);
        }else{
            $query=str_replace("%orderby%", "",$query);
        }
        if(in_array($asc, array("asc", "desc"))){
            $query=str_replace("%ascdesc%", strtoupper($asc),$query);
        }else{
            $query=str_replace("%ascdesc%", "",$query);
        }
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":offset", $offset, \PDO::PARAM_INT);
        $stmt->execute();
        $result=$stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function create($username, $email, $textbody){
        $stmt = $this->db->prepare(
            "INSERT INTO tasks(username, email, textbody)
            VALUES (:username, :email, :textbody)"
        );
        $stmt->bindValue(":username", $username, \PDO::PARAM_STR);
        $stmt->bindValue(":email", $email, \PDO::PARAM_STR);
        $stmt->bindValue(":textbody", $textbody, \PDO::PARAM_STR);
        // $stmt->bindValue(":status", $status, \PDO::PARAM_BOOL);

        return $stmt->execute();
    }
}
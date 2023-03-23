<?php

namespace App\Models;

use App\Database;

class LoginModel
{    
    public static function read($id = null, $email = null, $password = null, $updateDate = false) {
        if (empty($email) || empty($password)) {
            \App\message('Campos de preenchimento obrigatório!', true);
            return false;
        }

        $and = '';

        if (!empty($id)) {
            $and = 'AND id = :id';
        }

        $sqlRead = sprintf("SELECT id,name,email,lastlogin FROM tb_users WHERE email = :email AND password = :password %s", $and);

        $dataBase = new Database;
        $stmtRead = $dataBase->prepare($sqlRead);

        $stmtRead->bindParam(':email', $email);
        $stmtRead->bindParam(':password', $password);

        if (!empty($and)) {
            $stmtRead->bindParam(':id', $id, \PDO::PARAM_INT);
        }

        $stmtRead->execute();

        $user = $stmtRead->fetchAll(\PDO::FETCH_ASSOC);

        if ($updateDate){
            if (count($user) > 0) {
                $sqlUpdate = "UPDATE tb_users SET lastlogin = :lastlogin WHERE id = :id";

                $stmtUpdate = $dataBase->prepare($sqlUpdate);

                $stmtUpdate->bindValue(':lastlogin', date('Y-m-d H:i:s'));
                $stmtUpdate->bindParam(':id', $user[0]['id'], \PDO::PARAM_INT);

                $stmtUpdate->execute();
            }
        }
        
        return $user;
    }
}
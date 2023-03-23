<?php

namespace App\Models;

use App\Database;

class CategoriesModel
{
    public static function create($name, $active)
    {
        $sql = 'INSERT INTO tb_categories (name, active) VALUES(:name, :active)';

        $dataBase = new Database;
        $stmt = $dataBase->prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':active', $active);

        if ($stmt->execute()) {
            return true;
        } else {
            \App\message('Erro ao cadastrar categoria!', true, $stmt->errorInfo());
            return false;
        }
    }

    public static function read($id = null, $active = true)
    {
        $where = '';

        if (!empty($id)) {
            if ($active) {
                $where = 'AND id = :id';
            } else {
                $where = 'WHERE id = :id';
            }
        }

        if (!$active) {
            $sql = sprintf("SELECT id,name,active FROM tb_categories %s ORDER BY id ASC", $where);
        } else {
            $sql = sprintf("SELECT id,name,active FROM tb_categories WHERE active = 1 %s ORDER BY id ASC", $where);
        }

        $dataBase = new Database;
        $stmt = $dataBase->prepare($sql);

        if (!empty($where)) {
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        }

        $stmt->execute();

        $categories = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $categories;
    }

    public static function update($id, $name, $active)
    {
        if (empty($id)) {
            \App\message('Id não informado!', true);
            return false;
        }

        $sql = 'UPDATE tb_categories SET name = :name, active = :active WHERE id = :id';

        $dataBase = new Database;
        $stmt = $dataBase->prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':active', $active);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            \App\message('Erro ao atualizar categoria!', true, $stmt->errorInfo());
            return false;
        }
    }

    public static function delete($id)
    {
        if (empty($id)) {
            echo "Id não informado!";
            exit;
        }

        $sql = 'DELETE FROM tb_categories WHERE id = :id AND blocked = 0';

        $dataBase = new Database;
        $stmt = $dataBase->prepare($sql);

        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                header('Location: ' . APP_PATH . '/error/1');
                exit;
            }
        } else {
            \App\message('Erro ao remover categoria!', true, $stmt->errorInfo());
            return false;
        }
    }
}

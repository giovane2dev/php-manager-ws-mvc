<?php

namespace App\Models;

use App\Database;

class SubcategoriesModel
{
    public static function create($category_id, $name, $active)
    {
        $sql = 'INSERT INTO tb_subcategories (category_id, name, active) VALUES(:category_id, :name, :active)';

        $dataBase = new Database;
        $stmt = $dataBase->prepare($sql);

        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':active', $active);

        if ($stmt->execute()) {
            return true;
        } else {
            \App\message('Erro ao cadastrar subcategoria!', true, $stmt->errorInfo());
            return false;
        }
    }

    public static function read($id = null, $category_id = null, $active = 'active = 1')
    {
        $andId = '';
        $andCategoyId = '';

        if (!empty($id)) {
            $andId = 'AND id = :id';
        }

        if (!empty($category_id)) {
            $andCategoyId = 'AND category_id = :category_id';
        }

        $sql = sprintf("SELECT id,category_id,name,active FROM tb_subcategories WHERE %s %s %s ORDER BY id DESC", $active, $andId, $andCategoyId);

        $dataBase = new Database;
        $stmt = $dataBase->prepare($sql);

        if (!empty($andId)) {
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        }

        if (!empty($andCategoyId)) {
            $stmt->bindParam(':category_id', $category_id, \PDO::PARAM_INT);
        }

        $stmt->execute();

        $categories = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $categories;
    }

    public static function update($id, $category_id, $name, $active)
    {
        if (empty($id)) {
            \App\message('Id não informado!', true);
            return false;
        }

        $sql = 'UPDATE tb_subcategories SET category_id = :category_id, name = :name, active = :active WHERE id = :id';

        $dataBase = new Database;
        $stmt = $dataBase->prepare($sql);

        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':active', $active);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            \App\message('Erro ao atualizar subcategoria!', true, $stmt->errorInfo());
            return false;
        }
    }

    public static function delete($id)
    {
        if (empty($id)) {
            echo "Id não informado!";
            exit;
        }

        $sql = 'DELETE FROM tb_subcategories WHERE id = :id AND blocked = 0';

        $dataBase = new Database;
        $stmt = $dataBase->prepare($sql);

        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                header('Location: ' . APP_PATH . '/error/2');
                exit;
            }
        } else {
            \App\message('Erro ao remover subcategoria!', true, $stmt->errorInfo());
            return false;
        }
    }
}

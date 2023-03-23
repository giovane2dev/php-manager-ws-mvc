<?php

namespace App\Models;

use App\Database;

class NewsModel
{
    public static function create(
        $date,
        $subcategory_id,
        $icon,
        $image,
        $title,
        $hyperlink,
        $description,
        $body,
        $class,
        $active
    ) {
        if ($subcategory_id == 0 || empty($date) || empty($title)) {
            \App\message('Campos de preenchimento obrigatório!', true);
            return false;
        }

        $newDate = explode('/', $date);
        $curr_date = $newDate[0];
        $curr_month = $newDate[1];
        $curr_year = $newDate[2];
        $newDate = sprintf('%s-%s-%s', $curr_year, $curr_month, $curr_date);

        if (isset($image)) {
            $ext = strtolower(substr($image, -4));
            $new_name = time() . $ext;
            $dir = 'uploads/images/';

            if ($ext != '.jpg' && $ext != '.jpeg' && $ext != '.png') {
                \App\message('Formato de imagem inválido!', true);
                exit;
            }

            if (move_uploaded_file($_FILES['image']['tmp_name'], $dir . $new_name)) {
                $imageName = $new_name;
            } else {
                $imageName = null;

                \App\message('Upload de imagem gerou erro no cadastro!', true);
                exit;
            }
        } else {
            $imageName = null;
        }

        // $isoDate = dateConvert($date);

        $sql = '
        INSERT INTO tb_news 
        (date, subcategory_id, icon, image, title, hyperlink, description, body, class, active) 
        VALUES (:date, :subcategory_id, :icon, :image, :title, :hyperlink, :description, :body, :class, :active)';

        $dataBase = new Database;
        $stmt = $dataBase->prepare($sql);

        $stmt->bindParam(':date', $newDate);
        $stmt->bindParam(':subcategory_id', $subcategory_id);
        $stmt->bindParam(':icon', $icon);
        $stmt->bindParam(':image', $imageName);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':hyperlink', $hyperlink);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':body', $body);
        $stmt->bindParam(':class', $class);
        $stmt->bindParam(':active', $active);

        if ($stmt->execute()) {
            return true;
        } else {
            \App\message('Erro ao cadastrar conteúdo!', true, $stmt->errorInfo());
            return false;
        }
    }

    public static function read($id = null, $category_id = null)
    {
        $where = '';

        if (!empty($id)) {
            if (!empty($category_id)) {
                $where = 'WHERE B.category_id = :category_id AND A.id = :id';
            } else {
                $where = 'WHERE A.id = :id';
            }
        } else {
            if (!empty($category_id)) {
                $where = 'WHERE B.category_id = :category_id';
            }
        }

        $sql = sprintf('
        SELECT
        A.id,A.date,
        C.id AS category_id,
        C.name AS category_name,
        A.subcategory_id,
        B.name AS subcategory_name,
        A.icon,
        A.image,
        A.title,
        A.hyperlink,
        A.description,
        A.body,
        A.class,
        A.active 
        FROM tb_news A INNER JOIN tb_subcategories B ON A.subcategory_id = B.id
        INNER JOIN tb_categories C ON B.category_id = C.id %s ORDER BY A.id DESC', $where);

        $dataBase = new Database;
        $stmt = $dataBase->prepare($sql);

        if (!empty($id)) {
            if (!empty($category_id)) {
                $stmt->bindParam(':category_id', $category_id);
                $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            } else {
                $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            }
        } else {
            if (!empty($category_id)) {
                $stmt->bindParam(':category_id', $category_id);
            }
        }

        $stmt->execute();

        $news = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $news;
    }

    public static function update(
        $id,
        $date,
        $subcategory_id,
        $icon,
        $image,
        $imageStr,
        $title,
        $hyperlink,
        $description,
        $body,
        $class,
        $active
    ) {
        if (empty($id)) {
            \App\message('Id não informado!', true);
            return false;
        }

        if ($subcategory_id == 0 || empty($date) || empty($title)) {
            \App\message('Campos de preenchimento obrigatório!', true);
            return false;
        }

        $newDate = explode('/', $date);
        $curr_date = $newDate[0];
        $curr_month = $newDate[1];
        $curr_year = $newDate[2];
        $newDate = sprintf('%s-%s-%s', $curr_year, $curr_month, $curr_date);

        $imageName = $imageStr ? $imageStr : null;

        if (isset($image)) {
            $ext = strtolower(substr($image, -4));
            $new_name = time() . $ext;
            $dir = 'uploads/images/';

            if ($ext != '.jpg' && $ext != '.jpeg' && $ext != '.png') {
                \App\message('Formato de imagem inválido!', true);
                exit;
            }

            if (move_uploaded_file($_FILES['image']['tmp_name'], $dir . $new_name)) {

                if (!empty($imageName)) {
                    unlink($dir . $imageName);
                }

                echo "<script>";
                echo "$('#imageStr').val('$new_name');";
                echo "</script>";

                $imageName = $new_name;
            } else {
                \App\message('Upload de imagem gerou erro no cadastro!', true);
                exit;
            }
        }

        // $isoDate = dateConvert($date);

        $sql = 'UPDATE tb_news SET 
        date = :date,
        subcategory_id = :subcategory_id,
        icon = :icon,
        image = :image,
        title = :title,
        hyperlink = :hyperlink,
        description = :description,
        body = :body,
        class = :class,
        active = :active WHERE id = :id';

        $dataBase = new Database;
        $stmt = $dataBase->prepare($sql);

        $stmt->bindParam(':date', $newDate);
        $stmt->bindParam(':subcategory_id', $subcategory_id);
        $stmt->bindParam(':icon', $icon);
        $stmt->bindParam(':image', $imageName);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':hyperlink', $hyperlink);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':body', $body);
        $stmt->bindParam(':class', $class);
        $stmt->bindParam(':active', $active);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            \App\message('Erro ao atualizar conteúdo!', true, $stmt->errorInfo());
            return false;
        }
    }

    public static function delete($id)
    {
        if (empty($id)) {
            echo "Id não informado!";
            exit;
        }

        $news = NewsModel::read($id);

        $dir = 'uploads/images/';

        foreach ($news as $new) {
            if (!empty($new['image'])) {
                unlink($dir . $new['image']);
            }
        }

        $sql = 'DELETE FROM tb_news WHERE id = :id';

        $dataBase = new Database;
        $stmt = $dataBase->prepare($sql);

        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            \App\message('Erro ao remover conteúdo!', true, $stmt->errorInfo());
            return false;
        }
    }
}

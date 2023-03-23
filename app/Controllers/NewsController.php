<?php

namespace App\Controllers;

use \App\Models\NewsModel;
use \App\Models\SubcategoriesModel;

class NewsController
{
    /* CREATE */

    // create news
    // create news page
    public function createNews($category_id)
    {
        $subcategories = SubcategoriesModel::read(null, $category_id);

        \App\View::make('News/Create', ['subcategories' => $subcategories], $category_id);
    }

    // create news
    // create news page -> process
    public function storeCreateNews()
    {
        $date = isset($_POST['date']) ? $_POST['date'] : null;
        $subcategory_id = isset($_POST['subcategory_id']) ? $_POST['subcategory_id'] : null;
        $icon = isset($_POST['icon']) ? $_POST['icon'] : null;
        $image = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : null;
        $title = isset($_POST['title']) ? $_POST['title'] : null;
        $hyperlink = isset($_POST['hyperlink']) ? $_POST['hyperlink'] : null;
        $description = isset($_POST['description']) ? $_POST['description'] : null;
        $body = isset($_POST['body']) ? $_POST['body'] : null;
        $class = isset($_POST['class']) ? $_POST['class'] : null;
        $active = isset($_POST['active']) ? 1 : 0;

        if (NewsModel::create($date, $subcategory_id, $icon, $image, $title, $hyperlink, $description, $body, $class, $active)) {
            // header('Location: /');
            echo "<script>";
            echo "$('#form')[0].reset();";
            echo "$('.jqte_editor').html('');";
            echo "$('.icon').html('');";
            echo "$('.drop').css('background-image', 'none');";
            echo "</script>";

            \App\message('Conteúdo cadastrado com sucesso!');
            exit;
        }
    }

    /* READ */

    public function readNews($category_id)
    {
        $categoryId = $category_id == "all" ? null : $category_id;

        $news = NewsModel::read(null, $categoryId);

        \App\View::make('News/Read', ['news' => $news], $category_id);
    }

    /* UPDATE */

    // update news
    // update news page
    public function updateNews($id, $category_id)
    {
        $news = NewsModel::read($id)[0];
        $subcategories = SubcategoriesModel::read(null, $category_id);

        \App\View::make('News/Update', ['new' => $news, 'subcategories' => $subcategories]);
    }

    // update news
    // update news page -> process
    public function storeUpdateNews()
    {
        $id = $_POST['id'];
        $date = isset($_POST['date']) ? $_POST['date'] : null;
        $subcategory_id = isset($_POST['subcategory_id']) ? $_POST['subcategory_id'] : null;
        $icon = isset($_POST['icon']) ? $_POST['icon'] : null;
        $image = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : null;
        $imageStr = isset($_POST['imageStr']) ? $_POST['imageStr'] : null;
        $title = isset($_POST['title']) ? $_POST['title'] : null;
        $hyperlink = isset($_POST['hyperlink']) ? $_POST['hyperlink'] : null;
        $description = isset($_POST['description']) ? $_POST['description'] : null;
        $body = isset($_POST['body']) ? $_POST['body'] : null;
        $class = isset($_POST['class']) ? $_POST['class'] : null;
        $active = isset($_POST['active']) ? 1 : 0;

        if (NewsModel::update($id, $date, $subcategory_id, $icon, $image, $imageStr, $title, $hyperlink, $description, $body, $class, $active)) {
            // header('Location: /');
            \App\message('Conteúdo atualizado com sucesso!');
            exit;
        }
    }

    /* DELETE */

    // delete news
    // delete news page
    public function deleteNews($id, $category_id)
    {
        if (NewsModel::delete($id)) {
            header('Location: /managerws/news/' . $category_id);
            exit;
        }
    }
}

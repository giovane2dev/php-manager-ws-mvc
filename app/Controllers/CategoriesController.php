<?php

namespace App\Controllers;

use \App\Models\CategoriesModel;

class CategoriesController
{
    /* CREATE */

    // create categories
    // create categories page
    public function createCategories() {
        \App\View::make('Categories/Create');
    }

    // create categories
    // create categories page -> process
    public function storeCreateCategories() {
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $active = isset($_POST['active']) ? 1 : 0;

        if (CategoriesModel::create($name, $active)) {
            // header('Location: /');
            echo "<script>";
            echo "$('#form')[0].reset();";
            echo "</script>";
            
            $newsOptions = CategoriesModel::read(null, true);
            $subcategoriesOptions = CategoriesModel::read(null, false);

            \App\setCategoriesMenu('#newsOptions',$newsOptions);
            \App\setSubCategoriesMenu('#subcategoriesOptions',$subcategoriesOptions);

            \App\message('Categoria cadastrada com sucesso!');
            exit;
        }
    }

    /* READ */

    public function readCategories() {
        $categories = CategoriesModel::read(null, false);

        \App\View::make('Categories/Read', [ 'categories' => $categories]);
    }

    /* UPDATE */

    // update categories
    // update categories page
    public function updateCategories($id) {
        $categories = CategoriesModel::read($id, false)[0];

        \App\View::make('Categories/Update', [ 'category' => $categories]);
    }

    // update categories
    // update categories page -> process
    public function storeUpdateCategories() {
        $id = $_POST['id'];
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $active = isset($_POST['active']) ? 1 : 0;

        if (CategoriesModel::update($id, $name, $active)) {
            // header('Location: /');

            $categories = CategoriesModel::read(null, true);
            $subcategoriesOptions = CategoriesModel::read(null, false);

            \App\setCategoriesMenu('#newsOptions',$categories);
            \App\setCategoriesMenu('#subcategoriesOptions',$subcategoriesOptions);

            \App\message('Categoria atualizada com sucesso!');
            exit;
        }
    }

    /* DELETE */

    // delete categories
    // delete categories page
    public function deleteCategories($id) {
        if (CategoriesModel::delete($id)) {            
            header('Location: /managerws/categories');
            exit;
        }
    }
}
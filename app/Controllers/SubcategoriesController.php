<?php

namespace App\Controllers;

use \App\Models\CategoriesModel;
use \App\Models\SubcategoriesModel;

class SubcategoriesController
{
    /* CREATE */

    // create subcategories
    // create subcategories page
    public function createSubcategories($category_id) {
        $category = CategoriesModel::read($category_id, false)[0];
        
        \App\View::make('Subcategories/Create', [ 'category' => $category]);
    }

    // create subcategories
    // create subcategories page -> process
    public function storeCreateSubcategories() {
        $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : null;
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $active = isset($_POST['active']) ? 1 : 0;

        if (SubcategoriesModel::create($category_id, $name, $active)) {
            // header('Location: /');          

            \App\message('Subcategoria cadastrada com sucesso!');
            exit;
        }
    }

    /* READ */

    public function readSubcategories($category_id) {
        $categoryId = $category_id == "all" ? null : $category_id;
        
        $subcategories = SubcategoriesModel::read(null, $categoryId, 'active <> -1');

        \App\View::make('Subcategories/Read', [ 'subcategories' => $subcategories], $category_id);
    }

    /* UPDATE */

    // update subcategories
    // update subcategories page
    public function updateSubcategories($id) {
        $categories = CategoriesModel::read(null, false);
        $subcategory = SubcategoriesModel::read($id, null, 'active <> -1')[0];

        \App\View::make('Subcategories/Update', [ 'categories' => $categories, 'subcategory' => $subcategory ]);
    }

    // update subcategories
    // update subcategories page -> process
    public function storeUpdateSubcategories() {
        $id = $_POST['id'];
        $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : null;
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $active = isset($_POST['active']) ? 1 : 0;

        if (SubcategoriesModel::update($id, $category_id, $name, $active)) {
            // header('Location: /');

            \App\message('Subcategoria atualizada com sucesso!');
            exit;
        }
    }

    /* DELETE */

    // delete subcategories
    // delete subcategories page
    public function deleteSubcategories($id) {
        if (SubcategoriesModel::delete($id)) {            
            header('Location: /managerws/subcategories/all');
            exit;
        }
    }
}
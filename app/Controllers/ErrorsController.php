<?php

namespace App\Controllers;

class ErrorsController
{
    /* READ */

    public function readErros($id) {
        switch ($id) {
            case 1:
                \App\View::make('Errors/DeleteCategoryBlocked');
                break;
            case 2:
                \App\View::make('Errors/DeleteSubcategoryBlocked');
                break;
        }
    }
}

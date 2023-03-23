<?php

namespace App;

function viewsPath() {
    return BASE_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR;
}

function formatDate($format, $datetime) {
    $result = null;
    $date = explode(" ", $datetime);
    $newDate = explode("-", $date[0]);
    
    if (strstr(':', $datetime) === true){
        $newTime = explode(":", $date[1]);
    }    
    
    $day = $newDate[2];

    switch ($newDate[1]) {
        case 1:
            $month = "Janeiro";
            break;
        case 2:
            $month = "Fevereiro";
            break;
        case 3:
            $month = "Março";
            break;
        case 4:
            $month = "Abril";
            break;
        case 5:
            $month = "Maio";
            break;
        case 6:
            $month = "Junho";
            break;
        case 7:
            $month = "Julho";
            break;
        case 8:
            $month = "Agosto";
            break;
        case 9:
            $month = "Setembro";
            break;
        case 10:
            $month = "Outubro";
            break;
        case 11:
            $month = "Novembro";
            break;
        case 12:
            $month = "Dezembro";
            break;
    }

    $year = $newDate[0];

    if ($format == "[LONGER]") {
        $result = "{$day} de {$month} de {$year} às {$newTime[0]}:{$newTime[1]}h";
    } else
    if ($format == "[SMALL]") {
        $result = $day . " " . substr($month, 0, 3) . " " . substr($year, 2, 2);
    } else
    if ($format == "[VALUE]") {
        $result = sprintf('%s/%s/%s',$newDate[2], $newDate[1], $newDate[0]);
    } else
    if ($format == "[TIMEONLY]") {
        $Time = explode(":", $date[1]);
        $result = $Time[0] . ':' .$Time[1];
    }
    return $result;
}

function message($text, $error = false, $msgError = '') {
    if (!$error) {
        echo sprintf("<div role=\"alert\" class=\"alert alert-success\"><span><strong>Atenção!</strong> %s</span></div>", $text);
    } else {
        echo sprintf("<div role=\"alert\" class=\"alert alert-warning\"><span><strong>Atenção!</strong> %s - %s</span></div>", $text, print_r($msgError));
    }
}

function setCategoriesMenu($idElement = '', $categories = array()) {
    $stringBuilder = null;
    
    foreach ($categories as $category) {
        $stringBuilder .= "<a class=\"dropdown-item\" href=\"" . APP_PATH . "/news/{$category['id']}\">{$category['name']}</a>";
    }
    
    echo "<script>$('{$idElement}').html('{$stringBuilder}');</script>";
}

function setSubCategoriesMenu($idElement = '', $subCategories = array()) {
    $stringBuilder = null;
    
    foreach ($subCategories as $subCategory) {
        $stringBuilder .= "<a class=\"dropdown-item\" href=\"" . APP_PATH . "/subcategories/{$subCategory['id']}\">{$subCategory['name']}</a>";
    }
    
    echo "<script>$('{$idElement}').html('{$stringBuilder}');</script>";
}

function getURI() {
    $source = substr($_SERVER["REQUEST_URI"], 1, strlen($_SERVER["REQUEST_URI"]) - 1);
    $search = '/';
    $pos = stripos($source, $search);
    $pageName = substr($source, $pos + 1, strlen($source) - $pos);
    $pos = stripos($pageName, $search);
    if (!$pos === false) {
        $pos = stripos($pageName, $search);
        $pageName = substr($pageName, 0, $pos);
    }
    return $pageName;
}
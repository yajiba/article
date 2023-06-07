<?php

// Entry point of the application

// Load the necessary files
require_once 'config.php';
require_once 'model/model.php';
require_once 'views/view.php';
require_once 'controller/controller.php';


// Create instances of the model, view, and controller
$model = new Model();
$view = new View();
$controller = new Controller($model, $view);

// Handle the user's request
include 'route.php';
include 'views/template/header.php';
$controller->pageRequest();
include 'views/template/footer.php';

?>
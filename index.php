<?php
    require './controllers/BaseController.php';
    require './core/Database.php';
    require './models/BaseModel.php';

    $controllerName = ucfirst(strtolower($_REQUEST['controller'] ?? 'Home')) . 'Controller';
    $actionName = strtolower($_REQUEST['action'] ?? 'login');
    require "./controllers/$controllerName.php";

    $controllerObj = new $controllerName();
    $controllerObj->$actionName();
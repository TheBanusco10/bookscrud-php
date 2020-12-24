<?php

require_once 'Controller/Controller.php';
require_once 'Model/Model.php';

$model = new Model();
$controller = new Controller($model);

$controller->invoke();

<?php
namespace app\views\signup;

use app\View;
use app\models\helpers\Session;
use app\models\signup\Profile;

$model = new Profile(null, new Session);
$model->validate();
$model->template = "/src/templates/signup.php";
$view = new View($model);
$view->render();
?>
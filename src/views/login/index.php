<?php
namespace app\views\login;

use app\View;
use app\models\helpers\Session;
use app\models\login\Index as Login;

$session = new Session;
$model = new Login(null, $session);

if ($model->tokenExists("login_tkn", INPUT_POST))
  $model->validate();

$model->main();
$model->template = "/src/templates/login.php";
$view = new View($model);
$view->render();
?>
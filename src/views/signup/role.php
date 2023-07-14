<?php
namespace app\views\signup;

use app\View;
use app\models\helpers\Session;
use app\models\signup\Role;

$session = new Session;

if (empty($_SESSION["signup_profile_tkn"])) {
  header("Location: http://localhost/signup/profile", true, 303);
  exit;
}

$model = new Role(null, $session);

if ($model->tokenExists("signup_role_tkn", INPUT_POST))
  $model->validate();

$model->main();
$model->template = "/src/templates/signup.php";
$view = new View($model);
$view->render();
?>
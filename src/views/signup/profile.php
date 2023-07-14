<?php
namespace app\views\signup;

use app\View;
use app\models\helpers\Session;
use app\models\signup\Profile;

$model = new Profile(null, new Session);

if ($model->tokenExists("signup_profile_tkn", INPUT_POST))
  $model->validate();

$model->main();
$model->template = "/src/templates/signup.php";
$view = new View($model);
$view->render();
?>
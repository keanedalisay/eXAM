<?php
namespace app\views\entry\login;

use app\views\entry\Entry;

class Index extends Entry
{
  public function addForm(): void
  {
    $form = <<<html
            
            <form>
              <label>
                Email
                <input type="email" pattern="[\w\d\-\.]+@[\w\d]+(\.[\w\d]+)+" name="login_email">
              </label>
              <label>
                Password
                <input type="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$">
              </label>
              <label>
                <input type="checkbox" name="login_save" value="1">
                Remember me
              </label>
              <button>Submit</button>
            </form>
    html;
    $this->addTag($form);
  }
}

$login = new Index;
$login->updateHead(["title" => "eXAM | Log-In", "tags" => ""]);
$login->updateHeader(["is_log_in" => true]);
$login->addHeading("Welcome back.");
$login->addForm();
$login->render();
?>
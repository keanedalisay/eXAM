<?php
namespace app\views\login;

use app\views\View;

class Index extends View
{
  public function updateHead()
  {
    $this->head->addTag(<<<html
    <title>eXAM | Log-In</title>
    html);
  }
  public function updateHeader()
  {
    $this->header->addNavLink(<<<html
    
              <li>Log-In</li>
              <li>Sign-Up</li>
    html);
  }
  public function addHeading()
  {
    $this->addTag(<<<html
    <h1>Welcome back.</h1>
    html);
  }
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
$login->updateHead();
$login->updateHeader();
$login->addHeading();
$login->addForm();
$login->render();
?>
<?php
namespace app\views\signup;

use app\views\View;

class Profile extends View
{
  public function updateHead()
  {
    $this->head->addTag(<<<html
    <title>eXAM | Sign-Up</title>
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
    <h1>Who are you?</h1>
    html);
  }

  public function addForm(): void
  {
    $form = <<<html
            
            <form>
              <fieldset>
                <label>
                  First Name
                  <input type="text" name="signup_fst_name">
                </label>
                <label>
                  Last Name
                  <input type="text" name="signup_lst_name">
                </label>
                <label>
                  Email
                  <input type="email" pattern="[\w\d\-\.]+@[\w\d]+(\.[\w\d]+)+" name="signup_email">
                </label>
              </fieldset>
              <fieldset>
                <button>Next</button>
              </fieldset>
            </form>
    html;
    $this->addTag($form);
  }
}

$signup_profile = new Profile;
$signup_profile->updateHead();
$signup_profile->updateHeader();
$signup_profile->addHeading();
$signup_profile->addForm();
$signup_profile->render();
?>
<?php
namespace app\views\entry\signup;

use app\views\entry\Entry;

class Profile extends Entry
{
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
$signup_profile->updateHead(["title" => "eXAM | Sign-Up", "tags" => ""]);
$signup_profile->updateHeader(["is_log_in" => false]);
$signup_profile->addHeading("Who are you?");
$signup_profile->addForm();
$signup_profile->render();
?>
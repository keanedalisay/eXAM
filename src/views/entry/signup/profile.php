<?php
namespace app\views\entry\signup;

use app\views\entry\Entry;

class Profile extends Entry
{
  public function addForm(): void
  {
    $form = <<<html
            
            <form class="form">
              <fieldset class="entries">
                <label class="entry">
                  <span class="entry-lbl"> First Name </span>
                  <input class="entry-input" type="text" name="signup_fst_name">
                </label>
                <label class="entry">
                  <span class="entry-lbl"> Last Name </span>
                  <input class="entry-input" type="text" name="signup_lst_name">
                </label>
                <label class="entry entry--email">
                  <span class="entry-lbl"> Email </span>
                  <input class="entry-input" type="email" pattern="[\w\d\-\.]+@[\w\d]+(\.[\w\d]+)+" name="signup_email">
                </label>
              </fieldset>
              <fieldset class="btns">
                <button class="btns-submit" type="submit">Next</button>
              </fieldset>            
            </form>
    html;
    $this->addTag($form);
  }
}

$signup_profile = new Profile;
$signup_profile->updateHead(
  [
    "title" => "eXAM | Sign-Up",
    "tags" => <<<html
  
      <link href="/styles/entry/entry.css" rel="stylesheet">
html
  ]
);
$signup_profile->updateHeader(["is_log_in" => false]);
$signup_profile->addHeading("Who are you?");
$signup_profile->addForm();
$signup_profile->render();
?>
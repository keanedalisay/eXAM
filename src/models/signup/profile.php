<?php
namespace app\models\signup;

use app\Model;
use app\models\helpers\
{
  DB,
  Session,
  Validate
};

class Profile extends Model
{
  use Validate {
    tokenExists as public;
  }

  public function __construct(DB $db = null, Session $session = null)
  {
    parent::__construct($db, $session);
    $this->retrieveSession();

    if (empty($_SESSION["saved_profile_tkn"])) {
      $this->saved_profile_tkn = $this->generateToken();
      $this->session->saved_profile_tkn = $this->saved_profile_tkn;
      return;
    }
  }

  public function validate()
  {
    if ($this->tokenIsValid("saved_profile_tkn", "signup_profile_tkn", $_POST)) {
      if ($this->fieldsNotEmpty() && $this->fieldsValidate()) {
        $this->retrieveRequest(INPUT_POST);
        $this->saveToSession();
        header("Location: http://localhost/signup/role", true, 303);
        exit;
      }

      $this->retrieveRequest(INPUT_POST);
      return;
    }

    $this->session->unset();
    header("Location: http://localhost/signup/profile", true, 303);
    exit;
  }

  private function saveToSession()
  {
    $this->session->signup_profile_tkn = $this->signup_profile_tkn;

    $this->session->signup_fst_name = $this->signup_fst_name;
    $this->session->signup_lst_name = $this->signup_lst_name;
    $this->session->signup_email = $this->signup_email;
  }

  private function fieldsNotEmpty()
  {
    $this->invalid_fst_name = "false";
    $this->invalid_lst_name = "false";
    $this->invalid_email = "false";

    if (empty($_POST["signup_fst_name"])) {
      $this->invalid_fst_name = "true";
      $this->err_fst_name = "Please enter your first name.";
    }

    if (empty($_POST["signup_lst_name"])) {
      $this->invalid_lst_name = "true";
      $this->err_lst_name = "Please enter your last name.";
    }

    if (empty($_POST["signup_email"])) {
      $this->invalid_email = "true";
      $this->err_email = "Please enter your email.";
    }

    return (bool) preg_match(
      "/(false).*(false).*(false)/",
      $this->invalid_fst_name .
      $this->invalid_lst_name .
      $this->invalid_email
    );
  }

  private function fieldsValidate()
  {
    if (!filter_input(INPUT_POST, "signup_email", FILTER_VALIDATE_EMAIL)) {
      $this->invalid_email = "true";
      $this->err_email = "Your email format is not valid.";
      return false;
    }

    $this->invalid_email = "false";
    return true;
  }

  public function main()
  {
    $this->main_tags = <<<html
        <h1 class="hdng">Who are you?</h1>
        <form class="form" action="/signup/profile" method="POST">
            <fieldset class="entries">
                <label class="entry">
                    <span class="entry-lbl"> First Name </span>
                    <input class="entry-input" type="text" aria-invalid="{$this->invalid_fst_name}" aria-errormessage="err_fst_name" name="signup_fst_name" value="{$this->signup_fst_name}">
                    <span class="entry-err" id="err_fst_name">{$this->err_fst_name}</span> 
                </label>
                <label class="entry">
                    <span class="entry-lbl"> Last Name </span>
                    <input class="entry-input" type="text" aria-invalid="{$this->invalid_lst_name}" aria-errormessage="err_lst_name" name="signup_lst_name" value="{$this->signup_lst_name}">
                    <span class="entry-err" id="err_lst_name">{$this->err_lst_name}</span> 
                </label>
                <label class="entry entry--email">
                    <span class="entry-lbl"> Email </span>
                    <input class="entry-input" type="email" aria-invalid="{$this->invalid_email}" aria-errormessage="err_email" name="signup_email" value="{$this->signup_email}">
                    <span class="entry-err" id="err_email">{$this->err_email}</span> 
                </label>
                <input type="hidden" name="signup_profile_tkn" value="{$this->saved_profile_tkn}">
            </fieldset>
            <fieldset class="btns">
                <button class="btns-next" type="submit">Next</button>
            </fieldset>            
        </form>
        html;
  }
}
?>
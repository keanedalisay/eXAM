<?php
namespace app\models\login;

use app\Model;
use app\models\helpers\
{
  DB,
  Session,
  Validate
};

class Index extends Model
{
  use Validate {
    tokenExists as public;
  }

  public function __construct(DB $db = null, Session $session = null)
  {
    parent::__construct($db, $session);
    $this->retrieveSession();

    $this->invalid_email = "false";
    $this->invalid_pswrd = "false";

    if (empty($_SESSION["saved_login_tkn"])) {
      $this->saved_login_tkn = $this->generateToken();
      $this->session->saved_login_tkn = $this->saved_login_tkn;
      return;
    }
  }

  public function validate()
  {
    if ($this->tokenIsValid("saved_login_tkn", "login_tkn", $_POST)) {
      if ($this->fieldsNotEmpty() && $this->fieldsValidate()) {
        $this->retrieveRequest(INPUT_POST);
        $this->saveToSession();
        header("Location: http://localhost/dashboard", true, 303);
        exit;
      }

      $this->retrieveRequest(INPUT_POST);
      return;
    }

    $this->session->unset();
    header("Location: http://localhost/login", true, 303);
    exit;
  }

  private function saveToSession()
  {
    $this->session->login_tkn = $this->login_tkn;
    $this->session->login_save = filter_has_var(INPUT_POST, "login_save") ? $this->login_save : "false";
  }

  private function fieldsNotEmpty()
  {
    if (empty($_POST["login_email"])) {
      $this->invalid_email = "true";
      $this->err_email = "Please enter your email.";
    }

    if (empty($_POST["login_pswrd"])) {
      $this->invalid_pswrd = "true";
      $this->err_pswrd = "Please enter your password.";
    }

    return (bool) preg_match(
      "/(false).*(false)/",
      $this->invalid_email .
      $this->invalid_pswrd
    );
  }

  private function fieldsValidate()
  {
    if (!filter_input(INPUT_POST, "login_email", FILTER_VALIDATE_EMAIL)) {
      $this->invalid_email = "true";
      $this->err_email = "Your email format is not valid.";
      return false;
    }
    
    return true;
  }

  public function main()
  {
    $this->main_tags = <<<html
        <h1>Welcome back.</h1>
        <form action="/login" method="POST">
            <fieldset class="entries">
                <input type="hidden" name="login_tkn" value="{$this->saved_login_tkn}">
                <label class="entry">
                    <span class="entry-lbl">Email</span>
                    <input class="entry-input" type="email"  aria-invalid="{$this->invalid_email}" aria-errormessage="err_email" name="login_email" value="{$this->login_email}">
                    <span class="entry-err" id="err_email">{$this->err_email}</span> 
                </label>
                <label class="entry">
                    <span class="entry-lbl">Password</span>
                    <input class="entry-input" type="password" aria-invalid="{$this->invalid_pswrd}" aria-errormessage="err_pswrd" name="login_pswrd" value="{$this->login_pswrd}">
                    <span class="entry-err" id="err_pswrd">{$this->err_pswrd}</span>
                </label>
                <label class="entry entry--rmbr">
                    <input class="entry-checkbox entry-checkbox--rmbr" type="checkbox" name="login_save" value="true" {$this->save_login}>
                    <figure class="checkbox">  
                    <svg class="check" version="1.0" xmlns="http://www.w3.org/2000/svg"
                        width="471.000000pt" height="352.000000pt" viewBox="0 0 471.000000 352.000000"
                        preserveAspectRatio="xMidYMid meet">
                    
                        <g class="check-shape"transform="translate(0.000000,352.000000) scale(0.100000,-0.100000)"
                        fill="#000000" stroke="none">
                        <path d="M4075 3454 c-60 -9 -141 -36 -200 -67 -51 -26 -207 -178 -1057 -1026
                        l-998 -995 -452 450 c-410 407 -459 453 -520 483 -72 34 -177 61 -244 61 -174
                        1 -357 -101 -456 -254 -109 -169 -109 -405 1 -572 58 -89 1351 -1372 1416
                        -1406 162 -85 348 -83 520 4 52 27 221 191 1264 1236 814 815 1216 1225 1243
                        1266 109 170 109 404 -1 572 -71 108 -174 189 -287 224 -64 19 -178 31 -229
                        24z"/>
                        </g>
                    </svg>
                    </figure>
                    <span class="entry-lbl entry-lbl--rmbr">Remember me</span>
                </label>
            </fieldset>
            <fieldset class="btns">
                <button class="btns-submit" type="submit">Log-In</button>
            </fieldset>
        </form>
        html;
  }
}
?>
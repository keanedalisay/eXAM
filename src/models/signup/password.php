<?php
namespace app\models\signup;

use app\Model;
use app\models\helpers\
{
  DB,
  Session,
  Validate
};

class Password extends Model
{
  use Validate {
    tokenExists as public;
  }

  public function __construct(DB $db = null, Session $session = null)
  {
    parent::__construct($db, $session);
    $this->retrieveSession();

    $this->invalid_pswrd = "false";
    $this->invalid_cnfrm_pswrd = "false";
    $this->err_cnfrm_pswrd_id = "err_cnfrm_pswrd";

    if (filter_has_var(INPUT_POST, "login_save")) {
        $this->save_login = "checked";
    }

    if (empty($_SESSION["saved_pswrd_tkn"])) {
      $this->saved_pswrd_tkn = $this->generateToken();
      $this->session->saved_pswrd_tkn = $this->saved_pswrd_tkn;
      return;
    }
  }

  public function validate()
  {
    if ($this->tokenIsValid("saved_pswrd_tkn", "signup_pswrd_tkn", $_POST)) {
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
    header("Location: http://localhost/signup/profile", true, 303);
    exit;
  }

  private function savetoSession()
  {
    $this->session->signup_pswrd_tkn = $this->signup_pswrd_tkn;
    $this->session->signup_pswrd = password_hash($this->signup_pswrd, PASSWORD_ARGON2ID);
    $this->session->login_save = filter_has_var(INPUT_POST, "login_save") ? $this->login_save : "false";
  }

  private function fieldsNotEmpty()
  {
    $pswrd_is_empty = empty(filter_input(INPUT_POST, "signup_pswrd", FILTER_SANITIZE_SPECIAL_CHARS));
    $cnfrm_pswrd_is_empty = empty(filter_input(INPUT_POST, "signup_cnfrm_pswrd", FILTER_SANITIZE_SPECIAL_CHARS));

    if ($pswrd_is_empty) {
      $this->invalid_pswrd = "true";
      $this->err_role = "Please enter your password.";
    }

    if ($cnfrm_pswrd_is_empty) {
        $this->invalid_cnfrm_pswrd = "true";
        $this->err_cnfrm_pswrd = "Please enter the same password for confirmation.";
    }

    return (bool) preg_match(
        "/(false).*(false)/",
        $this->invalid_pswrd.
        $this->invalid_cnfrm_pswrd
    );
  }

  private function fieldsValidate(){
    $pswrd = filter_input(INPUT_POST, "signup_pswrd", FILTER_SANITIZE_SPECIAL_CHARS);
    $cnfrm_pswrd = filter_input(INPUT_POST, "signup_cnfrm_pswrd", FILTER_SANITIZE_SPECIAL_CHARS);

    if ($pswrd !== $cnfrm_pswrd) {
        $this->invalid_pswrd = "true";
        $this->invalid_cnfrm_pswrd = "true";
        $this->err_cnfrm_pswrd_id = "err_pswrd";
        $this->err_pswrd = "Your password does not equal your confirmation password.";
        return false;
    } 

    return true;
  }


  public function main()
  {
    $this->main_tags = <<<html
        <h1>Your password?</h1>
        <form action="/signup/password" method="POST">
            <input type="hidden" name="signup_pswrd_tkn" value="{$this->saved_pswrd_tkn}">
            <fieldset class="entries">
              <label class="entry">
                <span class="entry-lbl">Password</span>
                <input class="entry-input" type="password" aria-invalid="{$this->invalid_pswrd}" aria-errormessage="err_pswrd" name="signup_pswrd" value="{$this->signup_pswrd}">
                <span class="entry-err" id="err_pswrd">{$this->err_pswrd}</span> 
              </label>
              <label class="entry">
                <span class="entry-lbl">Confirm Password</span>
                <input class="entry-input" type="password" aria-invalid="{$this->invalid_cnfrm_pswrd}" aria-errormessage="{$this->err_cnfrm_pswrd_id}" name="signup_cnfrm_pswrd" value="{$this->signup_cnfrm_pswrd}">
                <span class="entry-err" id="err_cnfrm_pswrd">{$this->err_cnfrm_pswrd}</span>
              </label>
              <label class="entry entry--rmbr">
                <input class="entry-checkbox entry-checkbox--rmbr" type="checkbox" name="login_save" value="true" {$this->save_login}>
                <figure class="checkbox">  
                  <svg class="check" version="1.0" xmlns="http://www.w3.org/2000/svg"
                  width="471.000000pt" height="352.000000pt" viewBox="0 0 471.000000 352.000000"
                  preserveAspectRatio="xMidYMid meet">
                
                  <g class="check-shape" transform="translate(0.000000,352.000000) scale(0.100000,-0.100000)"
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
                <span class="entry-lbl entry-lbl--rmbr"> Remember me </span>
              </label>
            </fieldset>
            <fieldset class="terms">
              <p class="terms-detail">By signing up, you agree to the <a href="">Terms and Conditions</a> set by Alphabet Inc.</p>
              <p class="terms-detail">Please read our <a href="">Privacy Policy</a> to get an overview of the data we collect and how securely we store it.</p>
            </fieldset>
            <fieldset class="btns">
              <button class="btns-submit"type="submit">Sign-In</button>
              <a class="btns-back" href="/signup/role">Back</a>
            </fieldset>
        </form>
    html;
  }
}
?>
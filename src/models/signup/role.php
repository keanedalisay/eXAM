<?php
namespace app\models\signup;

use app\Model;
use app\models\helpers\
{
  DB,
  Session,
  Validate
};

class Role extends Model
{
  use Validate {
    tokenExists as public;
  }

  public function __construct(DB $db = null, Session $session = null)
  {
    parent::__construct($db, $session);
    $this->retrieveSession();

    $this->invalid_role = "false";

    if (empty($_SESSION["saved_role_tkn"])) {
      $this->saved_role_tkn = $this->generateToken();
      $this->session->saved_role_tkn = $this->saved_role_tkn;
      return;
    }

    if (isset($_SESSION["signup_role"])) {
      $_SESSION["signup_role"] === "student"
        ? $this->student = "checked"
        : $this->teacher = "checked";
    }
  }

  public function validate()
  {
    if ($this->tokenIsValid("saved_role_tkn", "signup_role_tkn", $_POST)) {
      if ($this->fieldsNotEmpty()) {
        $this->retrieveRequest(INPUT_POST);
        $this->saveToSession();
        header("Location: http://localhost/signup/password", true, 303);
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
    $this->session->signup_role_tkn = $this->signup_role_tkn;
    $this->session->signup_role = $this->signup_role;
  }

  private function fieldsNotEmpty()
  {
    if (empty(filter_input(INPUT_POST, "signup_role"))) {
      $this->invalid_role = "true";
      $this->err_role = "Please choose a role based on your current occupation to determine the types of features available for you.";
      return false;
    }

    return true;
  }

  public function main()
  {
    $this->main_tags = <<<html
        <h1 class="h1--roles">Are you currently a?</h1>
        <h2 class="role_err" id="err_role">{$this->err_role}</h2>
            <form class="form--roles" action="/signup/role" method="POST">
               <input type="hidden" name="signup_role_tkn" value="{$this->saved_role_tkn}">
               <fieldset class="roles">
                 <label class="role">
                   <input class="role-radio" type="radio" aria-invalid="{$this->invalid_role}" aria-errormessage="err_role" name="signup_role" value="student" {$this->student}>
                   <figure class="role-icon">
                     <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                     width="441.000000pt" height="380.000000pt" viewBox="0 0 441.000000 380.000000"
                     preserveAspectRatio="xMidYMid meet">
                  
                     <g transform="translate(0.000000,380.000000) scale(0.100000,-0.100000)"
                     fill="#000000" stroke="none">
                     <path d="M1195 3288 c-619 -224 -1059 -389 -1072 -401 -27 -24 -29 -63 -6 -96
                     10 -15 100 -65 240 -133 122 -60 223 -110 223 -112 0 -2 -16 -37 -35 -77 -58
                     -123 -76 -212 -82 -396 l-6 -163 -27 0 c-15 0 -42 -10 -61 -23 l-34 -23 -3
                     -147 c-3 -162 5 -192 56 -224 15 -9 28 -17 29 -18 1 0 -40 -293 -91 -650 -52
                     -358 -92 -651 -91 -653 2 -2 25 11 53 27 57 36 72 38 72 13 0 -11 8 -26 18
                     -35 30 -27 68 -21 110 17 l37 34 42 -39 c23 -21 52 -39 64 -39 21 0 82 53 90
                     79 4 11 17 9 64 -13 32 -14 60 -24 62 -22 2 2 -39 290 -92 640 l-95 636 45 43
                     45 44 0 144 c0 134 -2 147 -21 168 -27 29 -60 41 -111 41 -28 0 -39 4 -35 13
                     2 6 40 131 83 277 43 146 79 266 80 268 0 1 147 -63 325 -143 328 -148 1138
                     -465 1188 -465 14 0 235 87 491 194 515 215 1528 688 1568 732 28 32 28 66 0
                     98 -18 19 -262 115 -1037 406 -557 209 -1018 380 -1025 379 -6 0 -483 -172
                     -1061 -381z"/>
                     <path d="M1100 2060 c-11 -11 -20 -23 -20 -27 0 -5 -29 -302 -64 -662 -42
                     -429 -61 -662 -56 -677 10 -27 39 -44 72 -44 13 0 53 21 89 46 114 81 318 204
                     422 255 79 39 109 49 132 44 61 -12 210 -125 423 -321 77 -72 120 -104 136
                     -104 13 0 48 18 77 41 206 157 327 239 442 297 95 49 154 50 248 6 79 -38 218
                     -130 313 -208 85 -69 131 -74 160 -17 12 22 11 113 -10 611 -12 322 -25 613
                     -26 647 -5 74 -25 103 -73 103 -20 0 -223 -85 -541 -225 -280 -124 -518 -228
                     -529 -231 -13 -3 -220 85 -565 241 -349 157 -557 245 -577 245 -20 0 -41 -8
                     -53 -20z"/>
                     </g>
                     </svg>
                   </figure>
                   <span class="role-lbl">Student</span>
                 </label>
                 <label class="role">
                   <input class="role-radio" type="radio" aria-invalid="{$this->invalid_role}" aria-errormessage="err_role" name="signup_role" value="teacher" {$this->teacher}>
                   <figure class="role-icon">
                     <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                       width="387.000000pt" height="449.000000pt" viewBox="0 0 387.000000 449.000000"
                       preserveAspectRatio="xMidYMid meet">
                       <g transform="translate(0.000000,449.000000) scale(0.100000,-0.100000)"
                       fill="#000000" stroke="none">
                       <path d="M1375 4359 c-65 -15 -258 -81 -279 -95 -62 -43 -70 -113 -27 -249 43
                       -135 60 -173 109 -248 124 -190 380 -299 602 -257 29 6 55 9 56 7 2 -2 -1 -32
                       -6 -67 -5 -36 -12 -95 -15 -132 l-6 -66 -45 20 c-145 64 -414 95 -594 69 -644
                       -95 -1087 -667 -1021 -1319 59 -579 325 -1267 631 -1630 127 -150 292 -264
                       431 -297 176 -41 453 8 666 119 l83 43 83 -43 c213 -111 490 -160 666 -119
                       339 80 672 522 896 1189 154 461 205 842 149 1114 -114 553 -602 952 -1163
                       952 -156 0 -362 -39 -453 -86 l-28 -15 0 44 c0 64 29 221 57 307 35 110 104
                       243 174 340 53 72 63 93 66 135 7 86 -57 155 -143 155 -56 0 -97 -30 -164
                       -119 -47 -63 -56 -71 -65 -56 -87 149 -237 262 -398 300 -68 16 -200 18 -262
                       4z m1378 -1474 c171 -36 333 -158 427 -320 42 -73 47 -120 18 -174 -30 -57
                       -77 -84 -138 -78 -62 5 -96 30 -133 96 -65 116 -153 176 -278 192 -40 5 -86
                       18 -104 29 -64 40 -85 137 -42 201 44 67 116 83 250 54z"/>
                       </g>
                     </svg>
                   </figure>
                   <span class="role-lbl">Teacher</span>
                 </label>
               </fieldset>
               <fieldset class="btns">
                 <button class="btns-next" type="submit">Next</button>
                 <a class="btns-back" href="/signup/profile">Back</a>
               </fieldset>
             </form>
        html;
  }
}
?>
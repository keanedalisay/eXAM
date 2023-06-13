<?php
namespace app\views\signup;

use app\views\View;

class Password extends View
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
    <h1>Your password?</h1>
    html);
  }

  public function addForm(): void
  {
    $form = <<<html
            
            <form>
              <fieldset>
                <label>
                  Password
                  <input type="password" name="signup_pswrd">
                </label>
                <label>
                  Confirm
                  <input type="password" name="signup_cnfrm_pswrd">
                </label>
                <label>
                  <figure>  
                    <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                    width="471.000000pt" height="352.000000pt" viewBox="0 0 471.000000 352.000000"
                    preserveAspectRatio="xMidYMid meet">
                  
                    <g transform="translate(0.000000,352.000000) scale(0.100000,-0.100000)"
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
                  <input type="checkbox" name="login_save" value="1">
                  Remember me
                </label>
              </fieldset>
              <fieldset>
                <p>By signing up, you agree to the <a>Terms and Conditions</a> set by Alphabet Inc.</p>
                <p>Please read our <a>Privacy Policy</a> to get an overview of the data we collect and how securely we store it.</p>
                <button>Back</button>
                <button>Submit</button>
              </fieldset>
            </form>
    html;
    $this->addTag($form);
  }
}

$signup_pswrd = new Password;
$signup_pswrd->updateHead();
$signup_pswrd->updateHeader();
$signup_pswrd->addHeading();
$signup_pswrd->addForm();
$signup_pswrd->render();

?>
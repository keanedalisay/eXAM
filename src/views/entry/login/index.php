<?php
namespace app\views\entry\login;

use app\views\entry\Entry;

class Index extends Entry
{
  public function addForm(): void
  {
    $form = <<<html
            
            <form class="form">
              <fieldset class="entries">
                <label class="entry">
                <span class="entry-lbl">Email</span>
                <input class="entry-input" type="email" pattern="[\w\d\-\.]+@[\w\d]+(\.[\w\d]+)+" name="login_email" required>
                </label>
                <label class="entry">
                  <span class="entry-lbl">Password</span>
                  <input class="entry-input" type="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" required>
                </label>
                <label class="entry entry--rmbr">
                  <input class="entry-checkbox entry-checkbox--rmbr" type="checkbox" name="login_save" value="1">
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
                <button class="btns-submit" type="submit">Submit</button>
              </fieldset>
            </form>
    html;
    $this->addTag($form);
  }
}

$login = new Index;
$login->updateHead(
  [
    "title" => "eXAM | Log-In",
    "tags" => <<<html

    <link href="/styles/entry/entry.css" rel="stylesheet">
html
  ]
);
$login->updateHeader(["is_log_in" => true]);
$login->addHeading("Welcome back.");
$login->addForm();
$login->render();
?>
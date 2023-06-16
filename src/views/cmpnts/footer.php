<?php
namespace app\views\cmpnts;

use app\views\cmpnts\Cmpnt;

class Footer extends Cmpnt
{
  public function render()
  {
    $crnt_year = date("Y");
    echo <<<html

        <footer class="ftr">
          <small class="ftr-notice">Copyright &copy; <time> $crnt_year </time> Alphabet Inc. All rights reserved.</small>
        </footer>
    html;
  }
}
?>
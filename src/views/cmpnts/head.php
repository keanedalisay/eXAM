<?php

namespace app\views\cmpnts;

use app\views\cmpnts\Cmpnt;

class Head extends Cmpnt
{
  public function render()
  {
    echo <<<html
      
      <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width,initial-scale=1.0'>
        <meta name='author' content='Keane Dalisay'>
        <meta name='application-name' content='eXAM'>
        $this->tags
      </head>
    html;
  }
}
?>
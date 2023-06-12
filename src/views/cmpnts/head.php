<?php

namespace app\views\cmpnts;

use app\views\cmpnts\Cmpnt;

class Head extends Cmpnt
{
  public function __construct()
  {
    array_push($this->tags, "<meta charset='UTF-8'>");
    array_push($this->tags, "<meta name='viewport' content='width=device-width;initial-scale=1.0'>");
    array_push($this->tags, "<meta name='author' content='Keane Dalisay'>");
    array_push($this->tags, "<meta name='application-name' content='eXAM'>");
  }

  public function render(): void
  {
    echo "<head>";
    foreach ($this->tags as $tag) {
      echo $tag;
    }
    echo "</head>";
  }
}
?>
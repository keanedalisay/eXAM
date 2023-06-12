<?php
namespace app\views\cmpnts;

use app\views\cmpnts\Cmpnt;

class Footer extends Cmpnt
{
  public function __construct()
  {
    array_push($this->tags, "<small>Copyright &copy;");
    array_push($this->tags, "<time></time>");
    array_push($this->tags, "Alphabet Inc. All rights reserved.</small>");
  }
  private function setYear(): void
  {
    array_walk($this->tags, function (&$val) {
      if (preg_match("/(<time).*/", $val))
        $val = "<time> " . date("Y") . " </time>";
    });
  }
  public function render(): void
  {
    $this->setYear();
    echo "<footer>";
    foreach ($this->tags as $tag) {
      echo $tag;
    }
    echo "</footer>";
  }
}
?>
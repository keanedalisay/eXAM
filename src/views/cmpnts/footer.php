<?php
namespace app\views\cmpnts;

class Footer
{
  private array $tags = [
    "<small>Copyright &copy;",
    "<time></time>",
    "Alphabet Inc. All rights reserved.</small>"
  ];

  private function setYear()
  {
    array_walk($this->tags, function (&$val) {
      if (preg_match("/(<time).*/", $val))
        $val = "<time> " . date("Y") . " </time>";
    });
  }
  public function render()
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
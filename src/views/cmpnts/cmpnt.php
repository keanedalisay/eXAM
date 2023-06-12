<?php
namespace app\views\cmpnts;

abstract class Cmpnt
{
  public string $tags = "";
  public function addTag(string $tag): void
  {
    $this->tags .= $tag;
  }
  abstract public function render();
}
?>
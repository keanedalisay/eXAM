<?php
namespace app\views\cmpnts;

abstract class Cmpnt
{
  protected array $tags = [];
  public function addTag(string $tag): void
  {
    array_push($this->tags, $tag);
  }

  abstract public function render();
}
?>
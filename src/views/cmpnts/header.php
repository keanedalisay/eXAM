<?php
namespace app\views\cmpnts;

use app\views\cmpnts\Cmpnt;

class Header extends Cmpnt
{
  public function __construct()
  {
    array_push($this->tags, "<img src='assets/eXAM_logo.svg'
    alt='The word 'exam' as the web app logo with the 'x' represented with a pencil and ruler' loading='lazy'>");
  }

  public function addNavLink(...$tags): void
  {
    array_push($this->tags, "<nav><ul>");
    foreach ($tags as $tag) {
      array_push($this->tags, "<li>" . $tag . "</li>");
    }
    array_push($this->tags, "</ul></nav>");
  }

  public function render(): void
  {
    echo "<header>";
    foreach ($this->tags as $tag) {
      echo $tag;
    }
    echo "</header>";
  }
}
?>
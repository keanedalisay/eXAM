<?php

namespace app\views\cmpnts;

class Head
{
  private array $tags = [
    " <meta charset='UTF-8'>",
    " <meta name='viewport' content='width=device-width;initial-scale=1.0'>",
    " <meta name='author' content='Keane Dalisay'>",
    " <meta name='application-name' content='eXAM'>"
  ];

  public function addTag(string $tag): void
  {
    array_push($this->tags, $tag);
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
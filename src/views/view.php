<?php
namespace app\views;

use app\views\cmpnts\{Head, Header, Footer};

abstract class View
{
  protected string $tags = "";
  protected Head $head;
  protected Header $header;
  protected Footer $footer;

  public function __construct()
  {
    $this->head = new Head();
    $this->header = new Header();
    $this->footer = new Footer();
  }

  public function addTag(string $tag): void
  {
    $this->tags .= $tag;
  }
  abstract public function updateHeader();

  public function render()
  {
    echo <<<html
    <!DOCTYPE html>
    <html lang="en">
    html;
    $this->head->render();
    echo <<<html
      
      <body> 
    html;
    $this->header->render();
    echo <<<html
          
          <main>
            $this->tags
          </main>
    html;
    $this->footer->render();
    echo <<<html
      
      </body>
    </html>
    html;
  }
}
?>
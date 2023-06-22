<?php
namespace app;

use app\cmpnts\{Head, Header, Main, Footer};

class View
{
  protected Head $head;
  protected Header $header;
  protected Footer $footer;

  protected Main $main;
  public function __construct(Head $head, Header $header, Main $main, Footer $footer)
  {
    $this->head = $head;
    $this->header = $header;
    $this->main = $main;
    $this->footer = $footer;
  }

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
    $this->main->render();
    $this->footer->render();
    echo <<<html
    
      </body>
    </html>
    html;
  }
}
?>
<?php
namespace app\views\cmpnts;

use app\views\cmpnts\Cmpnt;

class Header extends Cmpnt
{
  public function addNavLink(string $tags): void
  {
    $this->addTag(<<<html
          
          <nav>
            <ul>
              $tags
            </ul>
          </nav>
    html);
  }
  public function render()
  {
    echo <<<html
    
        <header>
          <img src='assets/eXAM_logo.svg' alt='The word 'exam' as the web app logo with the 'x' represented with a pencil and ruler' loading='lazy'>
          $this->tags
        </header>
    html;
  }
}
?>
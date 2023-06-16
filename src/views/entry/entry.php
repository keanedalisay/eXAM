<?php
namespace app\views\entry;

use app\views\View;

abstract class Entry extends View
{
  public function updateHead(array $options)
  {
    if (
      array_key_exists("title", $options)
      && array_key_exists("tags", $options)
    ) {
      $this->head->addTag(<<<html

        <title>{$options["title"]}</title>
        {$options["tags"]}
    html);
      return;
    }

    throw new \LogicException("The array argument \$options is missing either the \"title\" or \"tags\" key.");
  }

  public function updateHeader(array $options)
  {
    if (array_key_exists("is_log_in", $options)) {
      $log_in = "link";
      $sign_up = "link";
      if ($options["is_log_in"])
        $log_in .= " link-isInPage";
      else
        $sign_up .= " link-isInPage";

      $this->header->addNavLink(<<<html
      
                <li class="{$log_in}"><a class="" href="/login">Log-In</a></li>
                <li class="{$sign_up}"><a class="" href="/signup/profile">Sign-Up</a></li>
      html);
      return;
    }

    throw new \LogicException("The array argument \$options is missing the \"is_log_in\" key.");
  }

  public function addHeading(string $text)
  {
    $this->addTag(<<<html
    <h1 class="hdng">{$text}</h1>
    html);
  }

  abstract public function addForm();
}
?>
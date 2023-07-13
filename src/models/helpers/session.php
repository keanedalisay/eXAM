<?php
namespace app\models\helpers;

class Session
{
  private $name;
  private function open()
  {
    session_name($this->name);
    session_start();
  }
  public function __construct(string $name = "CREDS")
  {
    $this->name = $name;
    if (session_status() === PHP_SESSION_NONE)
      $this->open();
  }

  public function config(array $options)
  {
    session_set_cookie_params($options);
  }

  public function unset()
  {
    session_unset();
  }

  public function __get(string $prop)
  {
    if (array_key_exists($prop, $_SESSION))
      return $_SESSION[$prop];

    throw new \OutOfRangeException("The session property \"\$_SESSION[$prop]\" does not exist!");
  }

  public function __set(string $key, string $value)
  {
    $_SESSION[$key] = $value;
  }
  
  public function array(int $method){
    $filtered_values = filter_input_array($method, FILTER_SANITIZE_SPECIAL_CHARS);
    foreach($filtered_values as $key => $value){
      $_SESSION[$key] = $value;
    }
  }

}
?>
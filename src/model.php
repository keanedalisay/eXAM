<?php
namespace app;

use app\models\helpers\{DB, Session};

class Model
{
  protected array $values = [];

  protected $db;
  protected $session;

  public function __construct(DB $db = null, Session $session = null)
  {
    $this->db = $db;
    $this->session = $session;
  }

  public function __get($prop)
  {
    if (!array_key_exists($prop, $this->values))
      $this->values[$prop] = null;
    return $this->values[$prop];
  }

  public function __set($prop, $val)
  {
    $this->values[$prop] = $val;
  }
}
?>
<?php
namespace app\models;


class Model
{
  protected $values = [];

  public function __construct(array $req_vals)
  {
    foreach ($req_vals as $key => $val) {
      $this->values[$key] = $val;
    }
  }

  public function __get($prop)
  {
    if (!array_key_exists($prop, $this->values))
      $this->values[$prop] = null;

    return $this->values[$prop];
  }

  public function __set($prop, $val)
  {
    if (array_key_exists($prop, $this->values)) {
      new \LogicException("The property \"Model->$prop\" already exists!");
    }
    $this->values[$prop] = $val;
  }
}
?>
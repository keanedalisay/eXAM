<?php
namespace app;

class View
{
  private Model $model;
  public function __construct(Model $model){
    $this->model = $model;
  }

  public function render(){
    require_once str_ireplace(["\\"], ["/"], dirname(__FILE__, 2) . $this->model->template);
  }
}
?>
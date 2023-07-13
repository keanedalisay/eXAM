<?php
namespace app\models\helpers;

trait Validate
{
  private function generateToken()
  {
    return bin2hex(random_bytes(random_int(10, 20)));
  }

  private function tokenExists(string $tkn_name, $method)
  {
    if (is_array($method))
      return array_key_exists($tkn_name, $method);
    else if (is_int($method))
      return filter_has_var($method, "{$tkn_name}");

    throw new \BadMethodCallException("The argument you provided to \$method parameter \"\$method = {$method} 
        is neither an associative array or integer from a constant like INPUT_POST.\"");
  }


  private function tokenIsValid(string $sess_tkn, string $req_tkn, array $req_var)
  {
    return $this->session->$sess_tkn === filter_var($req_var[$req_tkn], FILTER_SANITIZE_SPECIAL_CHARS);
  }

  private function retrieveRequest(int $method)
  {
    $filtered_values = filter_input_array($method, FILTER_SANITIZE_SPECIAL_CHARS);
    foreach ($filtered_values as $key => $val) {
      $this->values[$key] = $val;
    }
  }

  private function retrieveSession()
  {
    foreach ($_SESSION as $key => $val) {
      $this->values[$key] = htmlspecialchars($val);
    }
  }

  abstract public function validate();
}
?>
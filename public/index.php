<?php
spl_autoload_register(function (string $class) {
  require_once str_ireplace(["app", "\\"], ["\\src", "/"], dirname(__FILE__, 2) . strtolower($class)) . ".php";
});

class Router
{
  private array $uris = [
    "/login" => "/src/views/entry/login/index.php",
    "/signup/profile" => "/src/views/entry/signup/profile.php",
    "/signup/role" => "/src/views/entry/signup/role.php",
    "/signup/password" => "/src/views/entry/signup/password.php"
  ];

  public function route()
  {
    $request_uri = htmlspecialchars($_SERVER["REQUEST_URI"]);
    if (array_key_exists($request_uri, $this->uris)) {
      require_once str_ireplace(["\\"], ["/"], dirname(__FILE__, 2) . $this->uris[$request_uri]);
      return;
    }
    header("HTTP/1.1 404 Not Found");
  }
}

$router = new Router;
$router->route();
?>

  public function links()
  {
    $links = <<<html
    <link href="/styles/entry/entry.css" rel="stylesheet">
    html;
    if ($this->isSignUp)
      $links .= <<<html
      <link href="/styles/entry/signup.css" rel="stylesheet">
    html;
    $this->addTag($links);
  }
}
?>
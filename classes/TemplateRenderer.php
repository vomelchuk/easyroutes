<?php
  require_once './Twig/Autoloader.php';
  Twig_Autoloader::register();
  
  class TemplateRenderer
  {
    public $loader; 
    public $environment; 

    public function __construct($templateDirs = array())
    {
      $templateDirs = array_merge(
        array('./templates'), 
        $templateDirs
      );
      $this->loader = new Twig_Loader_Filesystem($templateDirs);
      $this->environment = new Twig_Environment($this->loader);
    }

    public function render($templateFile, array $variables)
    {
      return $this->environment->render($templateFile, $variables);
    }
  }

?>
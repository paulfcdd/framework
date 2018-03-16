<?php


namespace App;


class Twig
{
    /** @var \Twig_Loader_Filesystem  */
    public $loader;
    /** @var \Twig_Environment  */
    public $twig;
    /** @var App  */
    public $app;
    /**
     * Twig constructor.
     */
    public function __construct()
    {
        $this->app = new App();
        $this->loader = new \Twig_Loader_Filesystem(BASE_DIR . $this->app->getParameter( 'twig_templates'));
        $this->twig = new \Twig_Environment($this->loader, [
            'cache' => BASE_DIR . $this->app->getParameter('twig_cache')
        ]);
    }

    /**
     * @param string $view
     * @param array|null $parameters
     * @return string
     */
    public function render(string $view, array $parameters = null) {

        try {
            echo $this->twig->render($view, $parameters);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
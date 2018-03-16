<?php


namespace App;

use Symfony\Component\Yaml\Yaml;

define('BASE_DIR', __DIR__ . '/..');

class App
{
    /**
     * @return mixed
     */
    public final function run(){
        $router = new Router();
        return $router->match();
    }

    /**
     * @param string $view
     * @param array|null $parameters
     * @return string
     */
    public final function render(string $view, array $parameters = null) {
        $twig = new Twig();
        return $twig->render($view, $parameters);
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     * @throws \Doctrine\ORM\ORMException
     */
    public final function entityManager() {
        $doctrine = new Doctrine();
        return $doctrine->entityManager();
    }

    /**
     * @param string $parameter
     * @return mixed
     */
    public final function getParameter(string $parameter) {
        $file = Yaml::parseFile(BASE_DIR . '/config/config.yml');
        $parameters = $file['parameters'];
        return $parameters[$parameter];
    }
}
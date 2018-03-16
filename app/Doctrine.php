<?php


namespace App;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Yaml\Yaml;

class Doctrine
{
    /** @var array  */
    protected $path;
    /** @var array */
    protected $dbParamsPath;
    /** @var bool  */
    protected $devMode = false;

    /**
     * Doctrine constructor.
     */
    public function __construct()
    {
        $this->dbParamsPath = BASE_DIR . '/config/db.yml';
        $this->path = array(BASE_DIR . '/src/Entity');
    }

    /**
     * @return bool
     */
    public function isDevMode(): bool
    {
        return $this->devMode;
    }

    /**
     * @param bool $devMode
     * @return Doctrine
     */
    public function setDevMode(bool $devMode): Doctrine
    {
        $this->devMode = $devMode;
        return $this;
    }

    /**
     * @return array
     */
    public function getDbParams() {
        $dbParams = Yaml::parseFile($this->dbParamsPath);
        return $dbParams;
    }

    /**
     * @return EntityManager
     * @throws \Doctrine\ORM\ORMException
     */
    public function entityManager() {
        $entityManager = EntityManager::create($this->getDbParams(), $this->config());
        return $entityManager;
    }

    /**
     * @return \Doctrine\ORM\Configuration
     */
    protected function config() {
        $config = Setup::createAnnotationMetadataConfiguration($this->path, $this->isDevMode());
        return $config;
    }


}
<?php

namespace Map\ModularSlim\Config;

use Dflydev\DotAccessData\Data;
use Exception;
use Map\ModularSlim\Kernel;

class Config
{
    const VERSION = '0.0.1';

    /**
     * @var Data
     */
    private Data $data;

    /**
     * @param string $path Path to project configuration directory
     */
    public function __construct(string $path)
    {
        $this->data = new Data();
        $pathConfig = $path . '/path.php';
        $paths = require $pathConfig;
        $this->set('project.path', $paths);
        $this->set('project.path.config', $path);
        $this->set('project.version', Kernel::VERSION);

        if (! isset($_ENV['environment'])) {
            $_ENV['environment'] = 'prod';
        }

        $this->set('server.env', $_ENV);
        $this->set('environment', $this->get('server.env.environment'));
    }

    /**
     * Create some base entries for a module
     *
     * @param string $name
     * @return void
     */
    public function addModule(string $name) : void
    {
        $moduleRoot = $this->data->get('project.path.root') . '/modules/' . $name;
        $moduleConfig = $moduleRoot . '/config';

        $this->data->set($name . 'path.root', $moduleRoot);
        $this->data->set($name . 'path.config', $moduleConfig);
    }

    public function set($key, $value) : void
    {
        $this->data->set($key, $value);
    }

    /**
     * Retrieve a configuration value
     *
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     */
    public function get(string $key, mixed $default = null) : mixed
    {
        return $this->data->get($key, $default);
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key) : bool
    {
        return $this->data->has($key);
    }
}

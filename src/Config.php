<?php
declare(strict_types=1);

namespace DummyConfigLoader;

final class Config
{
    /** @var  string */
    private $context_directory;
    private $config_content = [];
    
    /**
     * Config constructor.
     *
     * @param string $context_directory
     *
     * @throws \Exception
     */
    public function __construct($context_directory)
    {
        $this->context_directory = $context_directory;
        
        if (!is_dir($context_directory)) {
            throw new \Exception("Config cannot find this folder: " . $context_directory);
        }
        
        if (!is_readable($context_directory)) {
            throw new \Exception("Config cannot read this folder: " . $context_directory);
        }
    }
    
    
    /**
     * get config value or fallback gracefully
     *
     *
     * @param string $key
     * @param null   $default
     *
     * @throws \Exception
     *
     * @return mixed|null
     */
    public function get(string $key, $default = null)
    {
        // 1. split keys
        $keys = explode(".", $key);
        
        // 2. locate file
        $config_file = $this->context_directory . DIRECTORY_SEPARATOR . array_shift($keys) . ".php";
        
        // 3. load file contents
        if (!isset($this->config_content[$config_file])) {
            if (!is_file($config_file)) {
                throw new \Exception("Config file was not found: " . $config_file);
            }
            $config_content = require($config_file);
        } else {
            $config_content = $this->config_content[$config_file];
        }
        
        // 4. locate desired key
        try {
            return $this->getNestedVar($config_content, $keys);
        } catch (\Exception $e) {
            return $default; // fallback if unable to locate desired key
        }
        
    }
    
    /**
     * getNestedVar
     * Source: http://stackoverflow.com/a/2287029/1637031
     *
     *
     * @param $context
     * @param $pieces
     *
     * @throws \Exception
     *
     * @return mixed|null
     */
    private function getNestedVar(&$context, $pieces)
    {
        foreach ($pieces as $piece) {
            if (!is_array($context) || !array_key_exists($piece, $context)) {
                // error occurred
                throw new \Exception("This key was not found in this content");
            }
            $context = &$context[$piece];
        }
        
        return $context;
    }
}
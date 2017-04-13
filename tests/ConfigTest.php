<?php
declare(strict_types=1);


use DummyConfigLoader\Config;
use PHPUnit\Framework\TestCase;

final class ConfigTest extends TestCase
{
    function test_it_returns_values()
    {
        $config = new Config(__DIR__ . "/resources");
        $this->assertEquals('default', $config->get('test_config.driver'));
        $this->assertEquals('mysql', $config->get('test_config.database.default'));
    }
    
    function test_it_returns_full_file_content()
    {
        $config = new Config(__DIR__ . "/resources");
        $file_content = [
            "driver" => "default",
            "database" => [
                "default" => "mysql",
            ],
        ];
        $this->assertEquals($file_content, $config->get('test_config'));
    }
    
    function test_it_gracefully_falls_back()
    {
        $config = new Config(__DIR__ . "/resources");
        $value  = $config->get('test_config.a', '12');
        $this->assertEquals('12', $value);
    }
    
    function test_it_failes_if_wrong_file()
    {
        $this->expectException(Exception::class);
        $config = new Config(__DIR__ . "/resources");
        $value  = $config->get('some', '12');
    }
}
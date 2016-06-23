<?php

namespace Hangman\Service\Config;

use Symfony\Component\Yaml\Yaml;

class Config
{
    protected static $config;

    private function loadConfiguration()
    {
        if (self::$config == null) {
            self::$config = Yaml::parse(
                file_get_contents('./config/game_config.yml')
            );
        }

        return self::$config;
    }

    /**
     * Get the configuration value by key
     *
     * @param string $key
     */
    public static function getConfig($key)
    {
        return self::loadConfiguration()[$key];
    }
}

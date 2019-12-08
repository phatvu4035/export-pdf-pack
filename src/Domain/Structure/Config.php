<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Domain\Structure;

/**
 * Class Config
 * @package Dotcm\ExportPDF\Domain\Structure
 */
class Config
{
    /**
     * @var array config for pdf
     */
    protected $config;

    /**
     * Config constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * @param string $key
     * @return array|mixed
     */
    public function getConfig(string $key = '')
    {
        if ($key) {
            return $this->config[$key];
        }

        return $this->config;
    }
}

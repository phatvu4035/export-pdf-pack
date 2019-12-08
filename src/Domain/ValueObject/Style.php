<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Domain\ValueObject;

/**
 * Class Style
 * @package Dotcm\ExportPDF\Domain\ValueObject
 */
final class Style
{
    /**
     * @var string style value
     */
    protected $value;

    /**
     * @var array allowed value for style
     */
    private $allowedValue = ['D', 'F', 'DF', '', 'FD'];

    public function __construct($value)
    {
        if (!in_array($value, $this->allowedValue)) {
            throw new \Exception('Value must be one of the value F, D, FD, DF or leave empty.');
        }
        $this->value = $value;
    }

    /**
     * @return string style value
     */
    public function value()
    {
        return $this->value;
    }
}

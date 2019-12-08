<?php


namespace Dotcm\ExportPDF\Domain\ValueObject;


/**
 * Class Reseth
 * @package Dotcm\ExportPDF\Domain\ValueObject
 */
final class Reseth
{
    /**
     * @var bool
     */
    protected $value;

    /**
     * Reseth constructor.
     * @param bool $value
     */
    public function __construct(bool $value)
    {
        $this->value = $value;
    }

    /**
     * @return bool value of reseth
     */
    public function value()
    {
        return $this->value;
    }
}

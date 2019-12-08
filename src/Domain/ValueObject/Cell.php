<?php


namespace Dotcm\ExportPDF\Domain\ValueObject;


/**
 * Class Cell
 * @package Dotcm\ExportPDF\Domain\ValueObject
 */
final class Cell
{
    /**
     * @var bool cell value
     */
    protected $value;

    /**
     * Cell constructor.
     * @param bool $value
     */
    public function __construct(bool $value = false)
    {
        $this->value;
    }

    /**
     * @return bool cell value
     */
    public function value()
    {
        return $this->value;
    }
}

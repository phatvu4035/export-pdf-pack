<?php


namespace Dotcm\ExportPDF\Domain\ValueObject;


/**
 * Class LnTCPDF
 * @package Dotcm\ExportPDF\Domain\ValueObject
 */
final class LnTCPDF
{
    /**
     * @var bool
     */
    protected $value = false;

    /**
     * LnTCPDF constructor.
     * @param bool $value
     */
    public function __construct(bool $value)
    {
        $this->value = $value;
    }

    /**
     * @return bool LnTcPDF value
     */
    public function value()
    {
        return $this->value;
    }
}

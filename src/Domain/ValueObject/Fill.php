<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Domain\ValueObject;

/**
 * Fill value
 */
class Fill
{
    /**
     * @var bool fill value
     */
    protected $value;

    /**
     * Fill constructor.
     * @param bool $value
     */
    public function __construct(bool $value)
    {
        $this->value = $value;
    }

    /**
     * @return bool|bool fill value
     */
    public function value()
    {
        return $this->value;
    }
}

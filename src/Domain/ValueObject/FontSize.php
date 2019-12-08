<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Domain\ValueObject;

/**
 * Font size
 */
final class FontSize
{
    /**
     * @var int font size value
     */
    protected $value;

    /**
     * FontSize constructor.
     * @param int $value
     */
    public function __construct(int $value = null)
    {
        $this->value = $value;
    }

    /**
     * @return int font size value
     */
    public function value()
    {
        return $this->value;
    }
}

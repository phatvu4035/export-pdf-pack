<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Domain\ValueObject;

/**
 * Class Border value
 * @package Dotcm\ExportPDF\Domain\ValueObject
 */
final class Border
{
    /**
     * @var string border value
     */
    protected $value;

    /**
     * @var array allowed value
     */
    private $allowedValuePattern = '01LTRB';

    /**
     * Border constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        if (preg_match('/[^' . $this->allowedValuePattern . ']/', $value)) {
            throw new \Exception('Value must be 0, 1, some or all of these character L, T, R, B');
        }
        $this->value = $value;
    }

    /**
     * @return string border value
     */
    public function value()
    {
        return $this->value;
    }
}

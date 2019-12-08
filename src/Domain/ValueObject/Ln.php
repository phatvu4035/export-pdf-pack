<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Domain\ValueObject;

/**
 * Ln value
 */
final class Ln
{
    /**
     * @var int ln value
     */
    protected $value;

    /**
     * @var array line value must be one of the value in array
     */
    private $allowedValue = [0, 1, 2];

    /**
     * Ln constructor.
     * @param int $value
     */
    public function __construct(int $value)
    {
        if (!in_array($value, $this->allowedValue)) {
            throw new \Exception('Value must be one of the value 0, 1, 2');
        }
        $this->value = $value;
    }

    /**
     * @return int ln value
     */
    public function value()
    {
        return $this->value;
    }
}

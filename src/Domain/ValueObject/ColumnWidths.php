<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Domain\ValueObject;

/**
 * Class ColumnWidths
 * @package Dotcm\ExportPDF\Domain\ValueObject
 */
final class ColumnWidths
{
    /**
     * @var array values of column width
     */
    protected $value = [];

    /**
     * ColumnWidths constructor.
     * @param  array      $value
     * @throws \Exception
     */
    public function __construct(array $value = [])
    {
        foreach ($value as $col) {
            if (is_string($col)) {
                throw new \Exception('Only allowed float number');
            }
        }
        $this->value = $value;
    }

    /**
     * @return array colums width
     */
    public function value()
    {
        return $this->value;
    }
}

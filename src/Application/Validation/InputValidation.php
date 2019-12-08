<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Application\Validation;

use Exception;

class InputValidation
{
    public function checkFileExist($file): void
    {
        if (!file_exists($file)) {
            throw new Exception('File dont exist in ' . $file);
        }
    }
    public function checkValidateDataConfig($config): void
    {
        foreach ($config as $key => $row) {
            if (!isset($row['function'])) {
                throw new Exception('Function dont exist in ' . print_r($row, true));
            }

            if (isset($row['font_size']) && !$this->checkNumber($row['font_size'])) {
                throw new Exception('Font size must be integer or float in ' . print_r($row, true));
            }

            if (isset($row['x']) && !$this->checkFloatNumber($row['x'])) {
                throw new Exception('X  must be number in ' . print_r($row, true));
            }

            if (isset($row['y']) && !$this->checkFloatNumber($row['y'])) {
                throw new Exception('Y  must be integer or float in ' . print_r($row, true));
            }

            if (isset($row['x1']) && !$this->checkFloatNumber($row['x1'])) {
                throw new Exception('X1  must be integer or float in ' . print_r($row, true));
            }

            if (isset($row['y1']) && !$this->checkFloatNumber($row['y1'])) {
                throw new Exception('Y1  must be integer or float in ' . print_r($row, true));
            }

            if (isset($row['x2']) && !$this->checkFloatNumber($row['x2'])) {
                throw new Exception('X2  must be integer or float in ' . print_r($row, true));
            }

            if (isset($row['y2']) && !$this->checkFloatNumber($row['y2'])) {
                throw new Exception('Y2  must be number in ' . print_r($row, true));
            }

            if (isset($row['width']) && !$this->checkFloatNumber($row['width'])) {
                throw new Exception('Hidth  must be integer or float in ' . print_r($row, true));
            }

            if (isset($row['height']) && !$this->checkFloatNumber($row['height'])) {
                throw new Exception('Height  must be integer or float in ' . print_r($row, true));
            }

            if (isset($row['fill']) && !is_bool($row['fill'])) {
                throw new Exception('Fill  must be boolean in ' . print_r($row, true));
            }

            if (isset($row['header_height']) && !$this->checkFloatNumber($row['header_height'])) {
                throw new Exception('Header Height  must be array in ' . print_r($row, true));
            }

            if (isset($row['row_height']) && !$this->checkFloatNumber($row['row_height'])) {
                throw new Exception('Row Height  must be array in ' . print_r($row, true));
            }

            if (isset($row['fill']) && !is_bool($row['fill'])) {
                throw new Exception('Fill  must be boolean in ' . print_r($row, true));
            }
        }
    }

    protected function checkNumber($num)
    {
        if (preg_match('/^[0-9]+$/', $num)) {
            return true;
        }

        return false;
    }

    protected function checkFloatNumber($num)
    {
        if (preg_match('/^-?(?:\d+|\d*\.\d+)$/', $num) || preg_match('/^[0-9]+$/', $num)) {
            return true;
        }

        return false;
    }
}

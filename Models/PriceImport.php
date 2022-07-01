<?php

declare(strict_types=1);

namespace Models;

require_once 'PriceImportInterface.php';

use Exception;

class PriceImport implements PriceImportInterface
{
    /** @var string */
    private $filename;

    /**
     * PriceImport constructor.
     * @param string $filename
     */
    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    /**
     * Get price data from CSV
     *
     * @return array
     * @throws Exception
     */
    public function getPriceData(): array
    {
        $file = file_get_contents($this->filename);
        $rows = explode("\n", $file);
        if (count($rows) < 2) {
            throw new Exception('Not enough price data');
        }

        $header = explode(',', $rows[0]);
        if (!empty(array_diff($header, ['code', 'quantity', 'price']))) {
            throw new Exception('Invalid columns');
        }
        unset($rows[0]);

        $data = [];
        foreach ($rows as $row) {
            $rowData = array_combine($header, explode(',', $row));
            $data[$rowData['code']][$rowData['quantity']] = $rowData['price'];
        }
        return $data;
    }
}

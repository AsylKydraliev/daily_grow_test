<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClientsImport implements ToArray, WithHeadingRow
{
    /**
     * @param array $row
     * @return array
     */
    public function array(array $row): array
    {
        return $row;
    }
}

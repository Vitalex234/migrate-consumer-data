<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomersFailureExport implements FromArray, WithHeadings
{
    protected $failures;

    /**
     * @param array $failures
     */
    public function __construct(array $failures)
    {
        $this->failures = $failures;
    }

    /**
     * @return array
     */
    public function array(): array
    {
        $failuresWithAttr = array_map(function ($item) {
            $item['values'][] = $item['attribute'];
            return $item['values'];
        }, $this->failures);

        return $failuresWithAttr;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        $keys = array_keys(head($this->failures)['values']);
        $keys[] = 'error';

        return $keys;
    }
}

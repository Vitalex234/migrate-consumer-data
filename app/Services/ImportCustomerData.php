<?php

namespace App\Services;

use App\Exports\CustomersFailureExport;
use App\Imports\CustomersImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportCustomerData
{

    /**
     * @param $filePath
     * @return void
     */
    public function run($filename)
    {
        $customerImport = new CustomersImport();
        $customerImport->import($filename);

        $failures = $customerImport->failures()->jsonSerialize();

        Excel::store(new CustomersFailureExport($failures), 'failures.xlsx');
    }
}

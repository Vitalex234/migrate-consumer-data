<?php

namespace App\Imports;

use App\Models\Customer;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use LVR\CountryCode\Three;

class CustomersImport implements
    ToModel,
    WithHeadingRow,
    WithValidation,
    WithUpserts,
    SkipsOnFailure,
    SkipsOnError,
    SkipsEmptyRows,
    WithCustomCsvSettings
{
    use Importable;
    use SkipsFailures;
    use SkipsErrors;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Customer([
            'name' => $row['name'],
            'surname' => $row['surname'],
            'email' => $row['email'],
            'age' => $row['age'],
            'location' => $row['location'],
            'country-code' => $row['country_code']
        ]);
    }

    /**
     * @param $data
     * @param $index
     * @return array
     */
    public function prepareForValidation($data, $index)
    {
        $data = array_map('trim', $data);
        $data['age'] = date('Y-m-d', strtotime($data['age']));

        $length = Str::length($data['location']);

        if ($length <= 5 || $length > 255) {
            $data['location'] = 'Unknown';
        }

        return $data;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'surname' => 'max:255',
            'email' => 'required|email:rfc,dns|max:255',
            'age' => 'date|before:-18 years|after: -99 years',
            'location' => 'min:5|max:255',
            'country_code' => ['max:3', new Three]
        ];
    }

    /**
     * @return string
     */
    public function uniqueBy()
    {
        return 'email';
    }

    public function getCsvSettings(): array
    {
        return [
            'input_encoding' => 'UTF-8',
            'delimiter' => "\t"
        ];
    }
}

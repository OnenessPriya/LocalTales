<?php

namespace App\Exports;

use App\Models\Deal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
// used for autosizing columns
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DealExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Deal::all();
    }

    public function map($categories): array
    {
        return [

            $categories->title,
            $categories->address,
            $categories->lat,
            $categories->lon,

            $categories->pin,
            $categories->expiry_date,
            $categories->short_description,
            $categories->description,
            $categories->price,
            $categories->promo_code,
            $categories->how_to_redeem,

        ];
    }

    public function headings(): array
    {
        return ['Title','Address','Lat','Long','Pincode','Expiry Date', 'Short Description','Description', 'Price','Promo Code','How to Redeem'];
    }

}


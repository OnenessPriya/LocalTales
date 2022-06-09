<?php

namespace App\Exports;

use App\Models\Directory;
use App\Models\MarketProduct;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
// used for autosizing columns
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ItemExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return MarketProduct::all();
    }

    public function map($categories): array
    {
        return [

            $categories->name,
            $categories->short_desc,
            $categories->desc,
            $categories->price,
            $categories->offer_price,
            $categories->slug,
            $categories->meta_title,
            $categories->meta_desc,
            $categories->meta_keyword	,

            $categories->pincode,
            $categories->created_at,
        ];
    }

    public function headings(): array
    {
        return [ 'Title', 'Short Description','Description','Price','Offer Price', 'Meta Title','Meta Description','Meta Keyword','PinCode','Created at'];
    }

}


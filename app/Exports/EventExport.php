<?php

namespace App\Exports;

use App\Models\Event;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
// used for autosizing columns
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class EventExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Event::all();
    }

    public function map($categories): array
    {
        return [
            $categories->title,
            $categories->address,
            $categories->lat,
            $categories->lon,

            $categories->pin,
            $categories->start_date,
            $categories->end_date,
            $categories->start_time,
            $categories->end_time,
            $categories->description,
            $categories->contact_email,
            $categories->website,
            $categories->price,
            $categories->is_recurring,
            $categories->no_of_followers,
        ];
    }

    public function headings(): array
    {
        return ['Title','Address','Lat','Long','Pincode','Start Date','End Date','Start Time','End Time','Description', 'Contact Email','Contact Phone','Website','Price','Is Recurring','No of followers'];
    }

}


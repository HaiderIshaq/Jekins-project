<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;

// use Maatwebsite\Excel\Concerns\WithColumnFormatting;


class BillsExport implements FromCollection,WithHeadings,WithColumnWidths,WithStyles,WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $service;

    function __construct($service,$type) {
        
        $this->service = $service;
        $this->type = $type;
        }

        public function styles(Worksheet $sheet)
        {
        $count=count(DB::select('call GetOutstanding(?)', array($this->service)));

            return [
                // Style the first row as bold text.
                1    => ['font' => ['bold' => true]],
                $count+3    => ['font' => ['bold' => true]],
            ];
        }

    // public function columnFormats(): array
    // {
    //     return [
    //         'G' => NumberFormat::FORMAT_TEXT,
    //         'F' => NumberFormat::FORMAT_TEXT,
    //         'H' => NumberFormat::FORMAT_TEXT
    //     ];
    // }

        public function columnWidths(): array
        {
            return [
                'A' => 10,
                'B' => 30,            
                'C' => 30,            
                'D' => 35,            
                'E' => 40,            
                'F' => 15,            
                'G' => 45,            
                'H' => 15,            
                'I' => 15,            
                'J' => 15,            
                'K' => 25               
            ];
        }

        public function title(): string
        {
            return  $this->type;
        }
    public function collection()
    {
        $export=collect([]);
        $recs=DB::select('call GetOutstanding(?)', array($this->service));

        $servicecharges=0;
        $tax=0;
        $totalamount=0;
        foreach($recs as $rec)
        {
            $export->push([
                $rec->id,
                $rec->bill_number,
                date_format(date_create($rec->bill_date),'d-M-Y'),
                $rec->bank_name,
                $rec->branch_name,
                $rec->branch_code,
                $rec->cust_name,
                $rec->city_name,
                $rec->total_amount-$rec->tax,
                number_format($rec->tax),
                $rec->total_amount,

            ]);

               $schar=$rec->total_amount-$rec->tax;
               $servicecharges+=$schar;
               $tax+=$rec->tax==''?0:$rec->tax;
               $totalamount+=$rec->total_amount;

        }

        $export->push([
            '',

        ]);

        $export->push([
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            number_format($servicecharges),
            number_format($tax),
            number_format($totalamount),

        ]);

        $export->all();

        return $export;        
    }

    public function headings(): array
    {
        return [
            "Bill ID",
            "Bill Number",
            "Bill Date",
            "Bank Name",
            "Branch Name",
            "Branch Code",
            "Customer Name",
            "City Name",
            "Service Charges",
            "Tax",
            "Total Amount"
        ];
    }
}

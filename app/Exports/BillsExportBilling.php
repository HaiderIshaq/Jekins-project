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

class BillsExportBilling implements FromCollection,WithHeadings,WithColumnWidths,WithStyles,WithTitle
{
    protected $service;

    function __construct($service,$type,$from,$todate) {
        
        $this->service = $service;
        $this->type = $type;
        $this->from = $from;
        $this->todate = $todate;
        }

        public function styles(Worksheet $sheet)
        {
        $count=count(DB::select('call GetBillingByDate(?,?,?)', array($this->service,$this->from,$this->todate)));

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
                'B' => 35,            
                'C' => 15,            
                'D' => 35,            
                'E' => 30,            
                'F' => 45,            
                'G' => 20,            
                'H' => 20 ,           
                'I' => 20 ,           
                'J' => 20,
                'K' => 20,
            ];
        }

        public function title(): string
        {
            return  $this->type;
        }
    public function collection()
    {
        $export=collect([]);
        $recs=DB::select('call GetBillingByDate(?,?,?)', array($this->service,$this->from,$this->todate));

        $servicecharges=0;
        $tax=0;
        $totalamount=0;
        $net=0;
        $deduction=0;
        $itax=0;
        $bank=0;
        $bank=0;
        $payable=0;
        $wheld=0;
        foreach($recs as $rec)
        {
            $export->push([
                $rec->id,
                $rec->bill_number,
                date_format(date_create($rec->bill_date),'d-M-Y'),
                $rec->bank_name,
                $rec->branch_name,
                $rec->cust_name,
                $rec->city_name,
                $rec->total_amount-$rec->tax,
                $rec->tax,
                $rec->total_amount,
                $rec->status


            ]);

               $servicecharges+= $rec->total_amount-$rec->tax;
               $tax+=$rec->tax;
               $totalamount+=$rec->total_amount;
 
            //    $tax+=$rec->tax==''?0:$rec->tax;
            //    $totalamount+=$rec->total_amount;

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
            number_format($servicecharges),
            number_format($tax),
            number_format($totalamount)
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
            "Customer Name",
            "Region",
            "Service Charges",
            "Tax",
            "Total",
            "Status"
        ];
    }
}

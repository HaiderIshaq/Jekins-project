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

class BillsExportRecieved implements FromCollection,WithHeadings,WithColumnWidths,WithStyles,WithTitle
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
        $count=count(DB::select('call GetRecievedDetails(?,?,?)', array($this->service,$this->from,$this->todate)));

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
                'C' => 20,            
                'D' => 20,            
                'E' => 30,            
                'F' => 45,            
                'G' => 15,            
                'H' => 15 ,           
                'I' => 15 ,           
                'J' => 15 ,           
                'K' => 15 ,           
                'L' => 15 ,           
                'M' => 15 ,           
                'N' => 15 ,           
                'O' => 15 ,           
                'P' => 15 ,           
            ];
        }

        public function title(): string
        {
            return  $this->type;
        }
    public function collection()
    {
        $export=collect([]);
        $recs=DB::select('call GetRecievedDetails(?,?,?)', array($this->service,$this->from,$this->todate));

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
                $rec->bill_date,
                date_format(date_create($rec->recieved_on),'d-M-Y'),
                $rec->bank_name,
                $rec->cust_name,
                $rec->city_name,
                $rec->charges,
                $rec->tax,
                $rec->total_amount,
                $rec->recieved,
                $rec->deduction,
                $rec->itax,
                $rec->bank_charges,
                $rec->stax_payable,
                $rec->stax_whld

            ]);

               $servicecharges+=$rec->charges;
               $tax+=$rec->tax;
               $totalamount+=$rec->total_amount;
               $net+=$rec->recieved;
               $deduction+=$rec->deduction;
               $itax+=$rec->itax;
               $bank+=$rec->bank_charges;
               $payable+=$rec->stax_payable;
               $wheld+=$rec->stax_whld;
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
            number_format($totalamount),
            number_format($net),
            number_format($deduction),
            number_format($itax),
            number_format($bank),
            number_format($payable),
            number_format($wheld)

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
            "Recieved On",
            "Bank Name",
            "Customer Name",
            "Region",
            "Charges",
            "Tax",
            "Total",
            "Net",
            "Deduction",
            "ITAX",
            "Bank Charges",
            "STAX Payable",
            "STAX Wheld"
        ];
    }
}

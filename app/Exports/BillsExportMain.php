<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class BillsExportMain implements  WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */
    function __construct($service,$from,$todate) {
        
        $this->service = $service;
        $this->from = $from;
        $this->todate = $todate;
        }
    public function collection()
    {
        //

        
    }

    public function sheets(): array
    {
        // new BillsExportMain($service), 'bills.xlsx'
     
        return [
            new BillsExport($this->service,"Receivable"),
            new BillsExportRecieved($this->service,"Received",$this->from,$this->todate),
            new BillsExportBilling($this->service,"Billing",$this->from,$this->todate),
            // new InvoiceExportMultiple($this->id,'Home',$this->code,$this->date),
        ];
    }
}

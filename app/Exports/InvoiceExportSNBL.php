<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class InvoiceExportSNBL implements  WithHeadings,WithStyles, WithColumnWidths, WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */
    function __construct($id,$code,$date) {
        $this->id = $id;
        $this->code = $code;
        $this->date = $date;
        }
        public function columnWidths(): array
        {
            return [
                'A' => 40,
                'B' => 45,            
                'C' => 15,            
                'D' => 15,            
                'E' => 15,            
                'F' => 15,            
                'G' => 15,            
                'H' => 15,            
                'I' => 15,            
                'J' => 15,            
                'K' => 15,            
                'L' => 15,            
                'M' => 15,            
                'N' => 15,            
                'O' => 15,            
            ];
        }
    

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]]
        ];
    }

    public function sheets(): array
    {
     
        return [
            new InvoiceExportMultipleSNBL($this->id,'Auto',$this->code,$this->date),
            new InvoiceExportMultipleSNBL($this->id,'Home',$this->code,$this->date),
        ];
    }

    public function headings(): array
    {
        return [
            "App ID",
            "Applicant Name",
            "Product",
            "Regular Visits",
            "Long Visits",
            "Extra Long Visits",
            "Given Date",
            "Handed Over Date",
            "Snaps",
            "Res Outcome",
            "Off Outcome",
            "Other Docs",
            "Snap Charges",
            "Service Charges",
            "Total Amount"
        ];
    }
    public function drawings()
    {


        $drawing = new Drawing();
        $drawing->setName('Logo');
        // $drawing->setDescription('This is my logo');
        // $drawing->setPath(public_path('/img/logo.jpg'));
        // $drawing->setHeight(90);
        $drawing->setCoordinates('B1');

        return $drawing;
    }
   
}

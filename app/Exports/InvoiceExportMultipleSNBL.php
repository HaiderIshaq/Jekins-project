<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use RegistersEventListeners;

class InvoiceExportMultipleSNBL implements  FromCollection,WithHeadings,WithStyles, WithColumnWidths,WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id;
    protected $ptype;
    protected $code;
    protected $date;
    function __construct($id,$ptype,$code,$date) {
        $this->id = $id;
        $this->ptype = $ptype;
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
                'P' => 15,            
            ];
        }
    public function collection()
    {
        $export=collect([]);
        // array_push($export,[' ','Items Count:', '=COUNTA(C2:C'.$Count.')' ,' ','Profit Sum:', '=SUM(D2:D'.$Count.')']);
        $recs=DB::select('call GetInvoiceDetails(?,?)', array($this->id,$this->ptype));
        $rvisits=0;
        $lvisits=0;
        $exlvisits=0;
        $snapcount=0;
        $otherdocscount=0;
        $extratotal=0;
        $snapchargestotal=0;
        $servicechargestotal=0;
        $totalhargestotal=0;
        $totaltax=0;

        // $export->push(
        //     [
        //         'SADADSD',
        //     ]
        // );
        foreach ($recs as $rec) {
            $rvisits+=$rec->regular_visits;
            $lvisits+=$rec->long_visits;
            $exlvisits+=$rec->extra_long_visits;
            $snapcount+=$rec->snaps;
            $otherdocscount+=$rec->other_survey;
            $snapchargestotal+=$rec->snap_charges;
            $servicechargestotal+=$rec->service_charges;
            $totalhargestotal+=$rec->total_amount;
            $totaltax+=$rec->tax;

            $jid=DB::table('verification_jobs')
            ->where('job_id',  $rec->job_number)
            ->select(
                    'id'
                )
            ->get();

            $cnic=DB::table('verification_job_details')
            ->where('job_id',  $jid[0]->id)
            ->select(
                    'applicant_cnic'
                )
            ->get();
            $export->push(
                [
                     $rec->job_number,
                     $rec->applicant_name,
                     $cnic[0]->applicant_cnic,
                     $rec->product_type,
                     number_format($rec->regular_visits),
                     number_format($rec->long_visits),
                     number_format($rec->extra_long_visits),
                     date_format(date_create($rec->created_at),'d.m.y'),
                     date_format(date_create($rec->completed_on),'d.m.y'),
                     number_format($rec->snaps),
                     $rec->res_outcome,
                     $rec->off_outcome,
                    //  $rec->branch_code,
                     number_format($rec->other_survey),
                     number_format($rec->snap_charges),
                     number_format($rec->service_charges),
                     number_format($rec->total_amount)
                ]
            );
          
            $recs3=DB::table('verification_surveys')
            ->where('job_id',  $jid[0]->id)
            ->where('status', 1)
            ->where('surveyor_billing', 'Extra Long')
            ->select(
                DB::raw('COUNT(id) as extralong'),
                DB::raw('sum(service_charges) as extra_total'),
    
                )
            ->get();

            $extratotal+=$recs3[0]->extra_total;

        }

        $export->push(
            [
                '',
            ]
        );
        $export->push(
            [
                '',
                 '',
                 '',
                 '',
                 number_format($rvisits),
                 number_format($lvisits),
                 number_format($exlvisits),
                 '',
                 '',
                 number_format($snapcount),
                 '',
                 '',
                 number_format($otherdocscount),
                 number_format($snapchargestotal),
                 number_format($servicechargestotal),
                 number_format($totalhargestotal)
            ]
        );
        $export->push(
            [
                '',
            ]
        );
        $export->push(
            [
                '',
            ]
        );
        $export->push(
            [
                'Title',
                'Summary',
                'Count',
                'Rate',
                'Amount',
            ]
        );

        $bank = DB::table('bill')
        ->where('invoice_id',$this->id)
        ->select('bank')
        ->get();

        $bankrate = DB::table('verification_rates')
        ->where('bank_id',$bank[0]->bank)
        ->select('*')
        ->get();
        $export->push(
            [
                'Total Regular Visits',
                '',
                $rvisits,
                $bankrate[0]->regular,
                number_format($bankrate[0]->regular*$rvisits)
            ]
        );
        $export->push(
            
            [
                'Total Long Visits',
                '',
                $lvisits,
                $bankrate[0]->lon,
                number_format($bankrate[0]->lon*$lvisits),
            ]
        );
      
        $export->push(
            
            [
                'Total Extra Long Visits',
                '',
                $exlvisits,
                '',
                $extratotal,
                ''
            ]
        );
       
        $export->push(
            [
                'Total Visits',
                '',
                $rvisits+$lvisits+$exlvisits,
                '',
                number_format($servicechargestotal)
            ]
        );

        $export->push(
            [
                'Total Snaps',
                '',
                $snapcount,
                '',
                number_format($snapchargestotal),
            ]
        );
        $export->push(
            [
                'Total Tax',
                '',
                '',
                '',
                number_format($totaltax)
            ]
        );
        $export->push(
            [
                'Net Total',
                '',
                '',
                '',
                number_format($totalhargestotal)
            ]
        );
        
        $export->all();
        return $export;


    //    return collect(DB::select('call GetInvoiceDetails(?,?)', array($this->id,$this->ptype)));
    }

    public function title(): string
    {
        return  $this->ptype;
    }

    public function styles(Worksheet $sheet)
    {
        // $id=16; 
        $count=count(DB::select('call GetInvoiceDetails(?,?)', array($this->id,$this->ptype)));

        $strcount=$count+8;
        $endcount=$count+15;
        $start='A'.$strcount;
        $end='E'.$endcount;
        $sheet->getStyle($start.':'.$end)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ]
            ]);
            $sheet->mergeCells('A1:P1');
            $sheet->mergeCells('A2:P2');
            // $sheet->cell('A1:O1',function($cell){
            //     $cell->setAlignment('center');
            //     $cell->setFontWeight('bold');
            //     });
        return [
            // Style the first row as bold text.
            1    => [
                'font' => ['bold' => true,'size' => 25],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ]
            ],
            2    => [
                'font' => ['bold' => true,'size' => 25],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ]
            ],
            3    => ['font' => ['bold' => true]],
            $count+5    => ['font' => ['bold' => true]],
            $count+8    => ['font' => ['bold' => true]],
        ];
    }

    

    public function headings(): array
    {
        return [
            ['KG Traders (Pvt) Ltd.'],
            ['MIS REPORT FOR ' .strtoupper($this->date). ' ('.strtoupper($this->code).' '.strtoupper($this->ptype).')'],
            [
                "App ID",
                "Applicant Name",
                "Applicant CNIC",
                "Product",
                "Regular Visits",
                "Long Visits",
                "Extra Long Visits",
                "Given Date",
                "Handed Over Date",
                "Snaps",
                "Res Outcome",
                "Off Outcome",
                // "Branch Code",
                "Other Docs",
                "Snap Charges",
                "Service Charges",
                "Total Amount"
            ]
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

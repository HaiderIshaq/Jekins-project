<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bill_Ibr extends Model
{
    protected $table = 'bill';

    public static function getTotal($region, $service)
    {

        $records = DB::table('bill')
            ->selectRaw('sum(total_amount) as balance')
            ->where('recievable', $region)
            ->whereIn('status', ["Receivable", "Pending"])
            ->where('service', $service)
            ->groupBy('recievable')
            ->get();

        if (empty($records) || count($records) == 0) {
            return 0;
        } else {
            return $records[0]->balance;
        }
    }
    public static function getJobsTotal($region, $service)
    {

        $records = DB::table('c_jobs')
            ->selectRaw('count(id) as balance')
            ->where('region_id', $region)
            ->whereIn('status', [0, 2])
            ->where('service', $service)
            ->groupBy('region_id')
            ->get();

        if (empty($records) || count($records) == 0) {
            return 0;
        } else {
            return $records[0]->balance;
        }
    }

    public static function updateBalanceLog()
    {

        $regions = Bill_Ibr::getRegions();
        $services = ["Livestock","Verification","Prism"];
        // $services = ["Supervision"];

        foreach ($services as $service) {

            foreach ($regions as $region) {


                $stats = DB::table('stats_logs')->where([['service', '=', $service], ['region', '=', $region], ['date', '=', date('Y-m-d')]])
                    ->exists();

                if ($stats) {


                    $balance = Bill_Ibr::getTotal($region, $service);
                    $bills = Bill_Ibr::getOutstandingJob($region, $service);

                    DB::table('stats_logs')
                        ->where([['service', '=', $service], ['region', '=', $region], ['date', '=', date('Y-m-d')]])
                        ->update(
                            [
                                'balance' => $balance,
                                'bills' => $bills
                            ]
                        );

                    // echo 'Record Found';
                } else {


                    $balance = Bill_Ibr::getTotal($region, $service);
                    $bills = Bill_Ibr::getOutstandingJob($region, $service);

                    DB::table('stats_logs')->insert([

                        'date' => date('Y-m-d'),
                        'balance' => $balance,
                        'bills' => $bills,
                        'region' => $region,
                        'service' => $service,
                    ]);

                    // echo 'No Record Find';
                }
            }
        }
    }

    public static function updateJobBalanceLog()
    {

        $regions = Bill_Ibr::getRegions();
        $services = ["Livestock","Verification"];
        // $services = ["Supervision"];

        foreach ($services as $service) {

            foreach ($regions as $region) {


                $stats = DB::table('stats_log_jobs')->where([['service', '=', $service], ['region', '=', $region], ['date', '=', date('Y-m-d')]])
                    ->exists();

                if ($stats) {


                    $balance = Bill_Ibr::getJobsTotal($region, $service);
                    $jobs = Bill_Ibr::getOutstandingForJobs($region, $service);

                    DB::table('stats_log_jobs')
                        ->where([['service', '=', $service], ['region', '=', $region], ['date', '=', date('Y-m-d')]])
                        ->update(
                            [
                                'balance' => $balance,
                                'jobs' => $jobs
                            ]
                        );

                    // echo 'Record Found';
                } else {


                    $balance = Bill_Ibr::getJobsTotal($region, $service);
                    $jobs = Bill_Ibr::getOutstandingForJobs($region, $service);

                    DB::table('stats_log_jobs')->insert([

                        'date' => date('Y-m-d'),
                        'balance' => $balance,
                        'jobs' => $jobs,
                        'region' => $region,
                        'service' => $service,
                    ]);

                    // echo 'No Record Find';
                }
            }
        }
    }

    public static function getOutstandingJob($region, $service)
    {
        $records1 = DB::table('bill')
            ->selectRaw('id')
            ->where('recievable', $region)
            ->whereIn('status', ["Receivable", "Pending"])
            ->where('service', $service)
            ->get();

        if (empty($records1) || count($records1) == 0) {
            return '';
        } else {
            $collection = collect();

            foreach ($records1 as $record) {


                $collection->push(

                    $record->id

                );
            }

            $collection->all();


            $ids = implode(",", (array) $collection->all());
            return $ids;
        }
    }
    public static function getOutstandingForJobs($region, $service)
    {
        $records1 = DB::table('c_jobs')
            ->selectRaw('id')
            ->where('region_id', $region)
            ->whereIn('status', [0, 2])
            ->where('service', $service)
            ->get();

        if (empty($records1) || count($records1) == 0) {
            return '';
        } else {
            $collection = collect();

            foreach ($records1 as $record) {

  
                $collection->push(

                    $record->id

                );
            }

            $collection->all();


            $ids = implode(",", (array) $collection->all());
            return $ids;
        }
    }
    public static function getRegions()
    {

        $records = DB::table('c_region')
            ->selectRaw('reg_id')
            ->get();

        $collection = collect();

        foreach ($records as $record) {


            $collection->push(

                $record->reg_id

            );
        }

        return $collection->all();
    }
}

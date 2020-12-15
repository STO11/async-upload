<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\People;
use App\Models\PeoplePhone;
use DB;


class uploadPeoples implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $file_path;

    //try 3 times
    public $tries = 3;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file_path)
    {
        $this->file_path =  $file_path;
    }

    /**
     * Execute the job.
     * Create or Update registers
     * @return void
     */
    public function handle()
    {
        DB::beginTransaction();
        $peoplesXml = simplexml_load_file($this->file_path);
        if ($peoplesXml->count()) {
            foreach ($peoplesXml as $peopleXml) {
                $people = People::updateOrCreate([
                    'person_id' => (int) $peopleXml->personid->__toString(),
                ], [
                    'person_name' => $peopleXml->personname->__toString()
                ]);
                if ($peopleXml->phones->count()) {
                    foreach ($peopleXml->phones as $phones) {
                        if ($phones->phone->count()) {
                            foreach ($phones->phone as $phone) {
                                PeoplePhone::updateOrCreate([
                                    'person_id' => $people->person_id,
                                    'phone' => $phone->__toString(),
                                ]);
                            }
                        }
                    }
                }
            }
        }
        DB::commit();
    }
}

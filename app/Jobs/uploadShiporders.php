<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Shiporder;
use DB;
use App\Models\Shipto;
use App\Models\ShiporderItem;

class uploadShiporders implements ShouldQueue
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
     *
     * @return void
     */
    public function handle()
    {
        DB::beginTransaction();
            $shiporderXml = simplexml_load_file($this->file_path);
            if ($shiporderXml->count()) {
                foreach ($shiporderXml as $shiporderXml) {
                    $shiporder = Shiporder::updateOrCreate([
                        'order_id' => (int) $shiporderXml->orderid->__toString(),
                    ], [
                        'person_id' => $shiporderXml->orderperson->__toString()
                    ]);
                    
                    if($shiporder){
                        if($shiporderXml->items->count()) {
                            foreach($shiporderXml->items as $itens){
                                if($itens->item->count()){
                                    foreach($itens->item as $item){
                                        ShiporderItem::updateOrCreate([
                                            'order_id' => $shiporder->order_id,
                                            'title' => $item->title->__toString(),
                                        ],[
                                            'note' => $item->note->__toString(),
                                            'quantity' =>  $item->quantity->__toString(),
                                            'price' => (double) $item->price->__toString(),
                                        ]);
                                    }
                                }
                            }
                        }

                        if($shiporderXml->shipto->count()) {
                            foreach($shiporderXml->shipto as $shipto){
                                Shipto::updateOrCreate([
                                    'order_id' => $shiporder->order_id,
                                ],[
                                    'name' => $shipto->name->__toString(),
                                    'address' => $shipto->address->__toString(),
                                    'city' =>  $shipto->city->__toString(),
                                    'country' => $shipto->country->__toString(),
                                ]);
                            }
                        }
                    }
                }
            }
        DB::commit();
    }
}

<?php

namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shiporder;
use App\Jobs\uploadShiporders;

class ShipordersUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ['shiporders'];
        $shiporders = Shiporder::orderBy('id', 'desc')->get();
        return view('panel.upload-shiporders.index', compact($data));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        return view('panel.upload-shiporders.edit', compact($data));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required'
        ]);
        try {
            $shiporder = new Shiporder();
            //valid extesion
            if(!$shiporder->checkExtension($request->file())) 
                throw new \Exception('Invalid extension'); 
            //store file in storage/app/public
            $upload = $shiporder->moveFile($request->file());
            if ($upload) {
                $shiporder->resolveErrorLine36TagNoClosed($upload);
                uploadShiporders::dispatch($upload)->delay(now()->addSecond(1)); // async function 1 second delay job
                $shiporder->runWork(); //inicialize jobs
                return redirect()->route('panel.upload-shiporders.index')->with('msg', 'File successfully imported.')->with('error', false);
            }
            return redirect()->back()->with('msg', 'Unable to save data')->with('error', true)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('msg', $e->getMessage())->with('error', true)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $people = Shiporder::find($id);
            if ($people) $people->delete();
            return redirect()->route('panel.upload-shiporders.index')->with('msg', 'Registration successfully deleted!');
        } catch (\Exception $e) {
            return redirect()->route('panel.upload-shiporders.index')->with('msg', 'Could not delete the record!');
        }
    }
}

<?php

namespace App\Http\Controllers\Files;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Files\Milk;
use App\Model\Files\Container;
use App\Model\Requesting;
use App\Model\Users\Donor;
use Illuminate\Http\Response;

class MilkController extends Controller
{

    public function index()
    {
        $milks = Milk::with(['donors.user', 'containers.requesting.client.user'])->paginate(10)->jsonSerialize();

        return response($milks, Response::HTTP_OK);
    }

    public function not_available()
    {
        $container = Container::with(['milk.donors.user', 'requesting.client.user'])
        ->whereNotNull('requesting_id')
        ->paginate(10)
        ->jsonSerialize();

        return response($container, Response::HTTP_OK);
    }

    public function pending()
    {
        $container = Container::with(['milk.donors.user', 'requesting.client.user'])
        ->whereNull('received_at')
        ->paginate(10)
        ->jsonSerialize();

        return response($container, Response::HTTP_OK);
    }

    public function milk2(){
        $milks = Container::whereNull('requesting_id')->paginate(20)->jsonSerialize();
        
        return response($milks, Response::HTTP_OK);
    }

    public function givemilk(Request $request, $id)
    {
        $milk = Container::findOrFail($id);
        $milk->requesting_id = $request->requesting_id;
        
        $milk->save();

        return response(null, Response::HTTP_OK);
    }
    public function store(Request $request)
    {

        $this->validate($request, [
            'batch_number' => 'required|max:191',


        ]);
        $milk = Milk::create([
            'batch_number' => $request['batch_number'],

        ]);

        // $milk->donors()->sync($request->donors);

        return response(null, Response::HTTP_OK);
    }

    public function show($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        $milk = Milk::findOrFail($id);

        $this->validate($request, [
            'batch_number' => 'required|max:191',
            'expiration_date' => 'required',
        ]);

        $milk->update($request->all());

        return response(null, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $milk = Milk::find($id);
        $milk->delete();
        return response(null, Response::HTTP_OK);
    }

    public function donors()
    {
        $donors = Donor::with('user')->get();

        return response()->json($donors);
    }
    
    public function newmilk(Request $request)
    {
        $milk = Milk::count();
        $newmilk = new Milk;

        if($milk > 0){
            $milk = Milk::orderBy('id', 'desc')->first();
            $milk_batch_number = $milk->batch_number;

            $newmilk->batch_number = $milk_batch_number + 1;
            
        } else{
            
            $newmilk->batch_number = 1;
            
        }
        
        $newmilk->save();
        // $milk = Milk::create([
        //     'batch_number' => $request['batch_number'],
        // ]);

        return response(null, Response::HTTP_OK);
    }

    public function adddonor(Request $request, $id)
    {
        $milk = Milk::findOrFail($request->milkid);
        $milk->donors()->attach($id);
        return response(null, Response::HTTP_OK);
    }

    public function addcontainer(Request $request)
    {
        $this->validate($request, [
            'number' => 'required|max:191',
        ]);

        //check if number exist in a batch

        
        $container = Container::create([
            'number' => $request->number,
            'milk_id' => $request->milkid,
        ]);

        return response(null, Response::HTTP_OK);
    }

    public function expire(Request $request)
    {
        $date_now = Carbon::today();
        $milk = Milk::where('expiration_date', $date_now)->get();
        $milk->expired = 1;
        $milk->save();

        return response(null, Response::HTTP_OK);
    }
}

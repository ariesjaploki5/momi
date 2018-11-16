<?php

namespace App\Http\Controllers\Files;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Files\Milk;
use App\Model\Files\Container;
use App\Model\Requesting;
use App\Model\Users\Donor;
use Illuminate\Http\Response;

class ContainerController extends Controller
{
    public function index()
    {
        $container = Container::with(['milk.donor.user', 'requesting.client.user'])->whereNull('requesting_id')->get();

        return response()->json($container);
    }

    public function priority()
    {
        $priority = Container::where('type', 'priority')->get();
        return response()->json($priority);
    }

    public function regular()
    {
        $regular = Container::where('type', 'regular')->get();
        return response()->json($regular);
    }

    public function show($id)
    {

    }

    public function store(Request $request)
    {

    }

    public function update(Request $request, $id)
    {
        

    }

    public function change($id)
    {
        $container = Container::findOrFail($id);

        if ($container->type === 'priority') {
            $container->type = 'regular';
            $container->save();

        } else {
            $container->type = 'priority';
            $container->save();

        }

        return response(null, Response::HTTP_ACCEPTED);
    }
    public function delete(Request $request, $id)
    {

    }
    
}

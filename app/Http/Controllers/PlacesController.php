<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PlacesController
 *
 * @package App\Http\Controllers
 */
class PlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $places = \DB::table((new Place)->getTable())
            ->orderByDesc(Place::ID)->paginate(10);

        return view('places.index', [
            'places' => $places,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('places.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function store(Request $request): Response
    {
        $place = new Place;
        $place->address = $request->post(Place::ADDRESS);
        $place->lat = $request->post(Place::LATITUDE);
        $place->lng = $request->post(Place::LONGITUDE);
        $place->save();

        return redirect()->route('places.index')->with('success', 'New Place has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return string
     */
    public function destroy($id): string
    {
        $place = (new Place)->find($id);
        try {
            $place->delete();
        } catch (\Exception $e) {
            return 'Error while deleting Place ' . $place->address . ':' . PHP_EOL
                . $e->getMessage();
        }

        return 'Place ' . $place->address . ' has been deleted';
    }
}

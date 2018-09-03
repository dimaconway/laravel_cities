<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
    /** @var int */
    private const PER_PAGE = 9;

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return View|Response
     */
    public function index(Request $request)
    {
        if ($request->has(Place::ADDRESS)) {
            return $this->processFilterRequest($request);
        }

        $places = (new Place)->orderBy(Place::ADDRESS)
            ->paginate(self::PER_PAGE);

        return view('places.index', [
            'places'              => $places,
            'addressessForFilter' => Place::getAddressesForFilter(),
        ]);
    }

    /**
     * @param Request $request
     *
     * @return Response|View
     */
    private function processFilterRequest(Request $request)
    {
        /** @noinspection BadExceptionsProcessingInspection */
        try {
            $placeFromFilter = Place::whereAddress($request->get(Place::ADDRESS))->firstOrFail();

            $places = Place::getOrderedByDistanceToPlace($placeFromFilter)
                ->paginate(self::PER_PAGE);

            return view('places.index', [
                'placeFromFilter'     => $placeFromFilter,
                'places'              => $places->appends($request->except('page')),
                'addressessForFilter' => Place::getAddressesForFilter(),
            ]);
        } /** @noinspection BadExceptionsProcessingInspection */
        catch (ModelNotFoundException $e) {
            return redirect()->route('places.index')
                ->withErrors([
                    'message' => 'No such Place with address ' . $request->get(Place::ADDRESS),
                ]);
        }
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

        return redirect()
            ->route('places.index')
            ->with('success', 'New Place ' . $place->address . ' has been added');
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

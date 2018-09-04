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
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): Response
    {
        $this->validateRequest($request);

        $place = new Place;
        $place->address = $request->post(Place::ADDRESS);
        $place->lat = $request->post(Place::LATITUDE);
        $place->lng = $request->post(Place::LONGITUDE);
        $place->save();

        return redirect()->route('places.show', [
            'place' => $place,
        ])->with('success', 'Place ' . $place->address . ' has been created');
    }

    /**
     * @param Request $request
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    private function validateRequest(Request $request): void
    {
        \Validator::make($request->all(), [
            Place::ADDRESS   => 'required|string',
            Place::LATITUDE  => [
                'required',
                'regex:/^-?(90|[1-8]?[0-9]|0+)(\.\d*)?$/',
            ],
            Place::LONGITUDE => [
                'required',
                'regex:/^-?(180|1[0-7][0-9]|[1-9]?[0-9]|0+)(\.\d*)?$/',
            ],
        ])->setAttributeNames([
            Place::LATITUDE  => 'Latitude',
            Place::LONGITUDE => 'Longitude',
        ])->validate();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return View
     */
    public function show(int $id): View
    {
        return view('places.show', [
            'place' => (new Place)->find($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return View
     */
    public function edit(int $id): View
    {
        return view('places.edit', [
            'place' => Place::whereKey($id)->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, int $id): Response
    {
        $this->validateRequest($request);

        $place = (new Place)->find($id);
        $place->address = $request->input(Place::ADDRESS);
        $place->lat = $request->input(Place::LATITUDE);
        $place->lng = $request->input(Place::LONGITUDE);
        $place->save();

        return redirect()->route('places.show', [
            'place' => $place,
        ])->with('success', 'Place has been updated');
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
        $message = 'Place ' . $place->address . ' has been deleted';
        try {
            $place->delete();
        } catch (\Exception $e) {
            $message = 'Error while deleting Place ' . $place->address . ':' . PHP_EOL
                . $e->getMessage();
        }

        return json_encode([
            'message' => $message,
            'url'     => route('places.index'),
        ]);
    }
}

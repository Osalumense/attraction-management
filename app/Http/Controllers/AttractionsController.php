<?php

namespace App\Http\Controllers;

use App\Models\Attractions;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\AttractionsService;
use App\Services\WeatherService;
use App\Http\Requests\AttractionRequest;
use App\Services\Mail\AttractionMailService;
use App\Events\AttractionCreated;

class AttractionsController extends Controller
{

    /**
     * @var attractionsService
     * @var mailService
     * @var weatherService
     */
    protected AttractionsService $attractionsService;
    protected AttractionMailService $mailService;
    protected WeatherService $weatherService;

    public function __construct(AttractionsService $attractionsService, AttractionMailService $mailService, WeatherService $weatherService)
    {
        $this->attractionsService = $attractionsService;
        $this->mailService = $mailService;
        $this->weatherService = $weatherService;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $attractions = $this->attractionsService->getAllAttractions($request);
        return view('attractions.index', compact('attractions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('attractions.create');
    }

    /**
     * Store an attraction.
     */
    public function store(AttractionRequest $request)
    {
        try {
            if (Attractions::checkIfAttractionExists($request->name)) {
                return redirect()->back()->with('error', 'Attraction name already exists');
            }
            $attraction = $this->attractionsService->createAttraction($request);
            if(!isset($attraction)) {
                return redirect()->route('attractions.index')->with('error', 'An error occurred in creating attraction');
            }
            // Send email notification
            $adminEmail = 'admin@example.com'; //Test email
            $this->mailService->sendAttractionCreatedEmail($adminEmail, $attraction, $attraction->image_path);

            //Broadcast event
            broadcast(new AttractionCreated($attraction));
            return redirect()->route('attractions.index')->with('success', 'Attraction created successfully');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $attractions = $this->attractionsService->getAttractionById((int)$id);
        $weather = (isset($attractions) && $attractions->location !== "") ? $this->weatherService->getWeather($attractions->location) : null;
        return view('attractions.view', compact('attractions', 'weather'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $attractions = $this->attractionsService->getAttractionById((int)$id);
        return view('attractions.edit', compact('attractions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttractionRequest $request, $id)
    {
        try {
            $this->attractionsService->updateAttraction($id, $request);
            return redirect()->route('attractions.index')->with('success', 'Attraction updated successfully!');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }        
    }

    /**
     * Remove the specified attraction.
     */
    public function destroy($id)
    {
        try {
            $deleteAttraction = $this->attractionsService->deleteAttraction($id);
            $status = false;
            $message = '';
            if(!$deleteAttraction) {
                $message = 'Attraction not found';
            } else {
                $message =  'Attraction deleted successfully!';
                $status = true;
            }
            return response()->json([
                'message' => $message,
                'success' => $status
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'message' => 'An error occurred: ' . $e->getMessage(),
                'success' => false,
            ]);
        }
    }
}

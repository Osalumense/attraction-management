<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Attractions;
use Illuminate\Http\Request;
use App\Http\Requests\AttractionRequest;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class AttractionsService
{
    /**
     * Get a paginated list of attractions with optional search and filters.
     *
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getAllAttractions(Request $request): LengthAwarePaginator
    {
        $search = $request->input('search');
        $location = $request->input('location');
        $min_price = $request->input('min_price');
        $max_price = $request->input('max_price');

        $query = Attractions::query();

        $query->where(function ($q) use ($search, $location, $min_price, $max_price) {
            if ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            }
    
            if ($location) {
                $q->orWhere('location', 'like', '%' . $location . '%');
            }
    
            if ($min_price) {
                $q->orWhere('price', '>=', $min_price);
            }
    
            if ($max_price) {
                $q->orWhere('price', '<=', $max_price);
            }
        });

        return $query->paginate(10);
    }

    /**
     * Get an attraction by its ID.
     * @param integer $id
     */
    public function getAttractionById(int $id):?Attractions
    {
        return Attractions::find($id);
    }

    /**
     * Create a new attraction.
     * @param array $data
     * @return Attractions
     */
    public function createAttraction(AttractionRequest $request): Attractions
    {
        $data = $request->validated();
        $image = $request->file('image_path');
        if (isset($image)) {
            $cloudinaryImage = $request->file('image_path')->storeOnCloudinary('uploads');
            $data['image_path']  = $cloudinaryImage->getSecurePath();
            $data['image_public_id'] = $cloudinaryImage->getPublicId();

            // $filename = $this->generateUniqueFilename($data['name'], $image->getClientOriginalExtension());
            // $image->move('images/attractions/', $filename);
        }

        $attraction = Attractions::create($data);
        return $attraction;
    }

    /**
     * Update an existing attraction.
     * @param integer $id
     * @param array $data
     * @return Attractions
     * 
     */
    public function updateAttraction(int $id, AttractionRequest $request): Attractions
    {
        $attraction = Attractions::find($id);
        $data = $request->validated();
        $image = $request->file('image_path');
        if (isset($image)) {
            Cloudinary::destroy($attraction->image_public_id);
            $cloudinaryImage = $request->file('image_path')->storeOnCloudinary('uploads');
            $data['image_path']  = $cloudinaryImage->getSecurePath();
            $data['image_public_id'] = $cloudinaryImage->getPublicId();
        }
        $attraction->update($data);

        return $attraction;
    }

    /**
     * Delete an attraction by its ID.
     * @param integer $id
     * @return boolean
     */
    public function deleteAttraction(int $id): bool
    {
        $attraction = Attractions::find($id);
        if (isset($image)) {
            Cloudinary::destroy($attraction->image_public_id);
        }
        if (!isset($attraction)) {
            return false;
        }
        $attraction->delete();
        return true;
    }
}
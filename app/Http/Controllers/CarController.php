<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of cars. Public endpoint.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Car::query();

        // Basic query scopes
        if ($request->has('status') && $request->status === 'available') {
            $query->available();
        } elseif ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('brand')) {
            $query->filterByBrand($request->brand);
        }

        if ($request->has('price_min') || $request->has('price_max')) {
            $query->filterByPriceRange($request->price_min, $request->price_max);
        }

        if ($request->has('year')) {
            $query->where('year', $request->year);
        }

        $cars = $query->paginate(15);

        return $this->successResponse(
            CarResource::collection($cars),
            'Cars retrieved successfully',
            200,
            [
                'current_page' => $cars->currentPage(),
                'last_page' => $cars->lastPage(),
                'per_page' => $cars->perPage(),
                'total' => $cars->total(),
            ]
        );
    }

    /**
     * Store a newly created car in storage.
     */
    public function store(StoreCarRequest $request): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('cars', 'public');
            $data['image_url'] = $path;
        }

        $car = Car::create($data);

        return $this->successResponse(new CarResource($car), 'Car created successfully', 201);
    }

    /**
     * Display the specified car. Public endpoint.
     */
    public function show(Car $car): JsonResponse
    {
        return $this->successResponse(new CarResource($car), 'Car retrieved successfully');
    }

    /**
     * Update the specified car in storage.
     */
    public function update(UpdateCarRequest $request, Car $car): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($car->image_url && Storage::disk('public')->exists($car->image_url)) {
                Storage::disk('public')->delete($car->image_url);
            }
            $path = $request->file('image')->store('cars', 'public');
            $data['image_url'] = $path;
        }

        $car->update($data);

        return $this->successResponse(new CarResource($car), 'Car updated successfully');
    }

    /**
     * Remove the specified car from storage.
     */
    public function destroy(Car $car): JsonResponse
    {
        // Because Cars use SoftDeletes, we should NOT delete the image from the disk.
        // If the car is restored, the image URL would otherwise point to a missing file.
        $car->delete();

        return $this->successResponse(null, 'Car deleted successfully');
    }
}

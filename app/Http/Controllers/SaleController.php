<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Http\Resources\SaleResource;
use App\Models\Sale;
use App\Models\Car;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index(): JsonResponse
    {
        $sales = Sale::with(['car', 'customer'])->paginate(15);

        return $this->successResponse(
            SaleResource::collection($sales),
            'Sales retrieved successfully',
            200,
            [
                'current_page' => $sales->currentPage(),
                'last_page' => $sales->lastPage(),
                'per_page' => $sales->perPage(),
                'total' => $sales->total(),
            ]
        );
    }

    public function store(StoreSaleRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $sale = Sale::create($request->validated());

            // Mark car as sold
            $car = Car::find($request->car_id);
            if ($car) {
                $car->update(['status' => 'sold']);
            }

            DB::commit();

            return $this->successResponse(new SaleResource($sale->load(['car', 'customer'])), 'Sale created successfully', 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorResponse('Failed to create sale: ' . $e->getMessage(), 500);
        }
    }

    public function show(Sale $sale): JsonResponse
    {
        return $this->successResponse(new SaleResource($sale->load(['car', 'customer'])), 'Sale retrieved successfully');
    }

    public function update(UpdateSaleRequest $request, Sale $sale): JsonResponse
    {
        $sale->update($request->validated());

        return $this->successResponse(new SaleResource($sale->load(['car', 'customer'])), 'Sale updated successfully');
    }

    public function destroy(Sale $sale): JsonResponse
    {
        $sale->delete();

        return $this->successResponse(null, 'Sale deleted successfully');
    }
}

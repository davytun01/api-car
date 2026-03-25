<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    public function index(): JsonResponse
    {
        $customers = Customer::paginate(15);

        return $this->successResponse(
            CustomerResource::collection($customers),
            'Customers retrieved successfully',
            200,
            [
                'current_page' => $customers->currentPage(),
                'last_page' => $customers->lastPage(),
                'per_page' => $customers->perPage(),
                'total' => $customers->total(),
            ]
        );
    }

    public function store(StoreCustomerRequest $request): JsonResponse
    {
        $customer = Customer::create($request->validated());

        return $this->successResponse(new CustomerResource($customer), 'Customer created successfully', 201);
    }

    public function show(Customer $customer): JsonResponse
    {
        return $this->successResponse(new CustomerResource($customer), 'Customer retrieved successfully');
    }

    public function update(UpdateCustomerRequest $request, Customer $customer): JsonResponse
    {
        $customer->update($request->validated());

        return $this->successResponse(new CustomerResource($customer), 'Customer updated successfully');
    }

    public function destroy(Customer $customer): JsonResponse
    {
        $customer->delete();

        return $this->successResponse(null, 'Customer deleted successfully');
    }
}

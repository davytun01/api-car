<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInquiryRequest;
use App\Http\Requests\UpdateInquiryRequest;
use App\Http\Resources\InquiryResource;
use App\Models\Inquiry;
use Illuminate\Http\JsonResponse;

class InquiryController extends Controller
{
    public function index(): JsonResponse
    {
        $inquiries = Inquiry::with(['customer', 'car'])->paginate(15);

        return $this->successResponse(
            InquiryResource::collection($inquiries),
            'Inquiries retrieved successfully',
            200,
            [
                'current_page' => $inquiries->currentPage(),
                'last_page' => $inquiries->lastPage(),
                'per_page' => $inquiries->perPage(),
                'total' => $inquiries->total(),
            ]
        );
    }

    public function store(StoreInquiryRequest $request): JsonResponse
    {
        $inquiry = Inquiry::create($request->validated());

        return $this->successResponse(new InquiryResource($inquiry->load(['customer', 'car'])), 'Inquiry created successfully', 201);
    }

    public function show(Inquiry $inquiry): JsonResponse
    {
        return $this->successResponse(new InquiryResource($inquiry->load(['customer', 'car'])), 'Inquiry retrieved successfully');
    }

    public function update(UpdateInquiryRequest $request, Inquiry $inquiry): JsonResponse
    {
        $inquiry->update($request->validated());

        return $this->successResponse(new InquiryResource($inquiry->load(['customer', 'car'])), 'Inquiry updated successfully');
    }

    public function destroy(Inquiry $inquiry): JsonResponse
    {
        $inquiry->delete();

        return $this->successResponse(null, 'Inquiry deleted successfully');
    }
}

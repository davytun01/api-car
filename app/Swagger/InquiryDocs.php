<?php

namespace App\Swagger;

use OpenApi\Attributes as OA;

class InquiryDocs
{
    #[OA\Get(
        path: "/api/inquiries",
        summary: "Display a listing of inquiries",
        security: [["bearerAuth" => []]],
        tags: ["Inquiries"],
        parameters: [
            new OA\Parameter(
                name: "page",
                description: "Page number",
                in: "query",
                required: false,
                schema: new OA\Schema(type: "integer", default: 1)
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Inquiries retrieved successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "success", type: "boolean", example: true),
                        new OA\Property(property: "message", type: "string", example: "Inquiries retrieved successfully"),
                        new OA\Property(property: "data", type: "array", items: new OA\Items(
                            properties: [
                                new OA\Property(property: "id", type: "integer", example: 1),
                                new OA\Property(property: "customer_id", type: "integer", example: 1),
                                new OA\Property(property: "car_id", type: "integer", example: 1),
                                new OA\Property(property: "message", type: "string", example: "I am interested in this car."),
                                new OA\Property(property: "status", type: "string", example: "pending")
                            ]
                        )),
                        new OA\Property(property: "meta", properties: [
                            new OA\Property(property: "current_page", type: "integer", example: 1),
                            new OA\Property(property: "last_page", type: "integer", example: 10),
                            new OA\Property(property: "per_page", type: "integer", example: 15),
                            new OA\Property(property: "total", type: "integer", example: 150)
                        ], type: "object")
                    ]
                )
            )
        ]
    )]
    public function index() {}

    #[OA\Post(
        path: "/api/inquiries",
        summary: "Store a newly created inquiry",
        security: [["bearerAuth" => []]],
        tags: ["Inquiries"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["customer_id", "car_id"],
                properties: [
                    new OA\Property(property: "customer_id", type: "integer", example: 1),
                    new OA\Property(property: "car_id", type: "integer", example: 2),
                    new OA\Property(property: "message", type: "string", example: "Is this still available?"),
                    new OA\Property(property: "status", type: "string", example: "pending")
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: "Inquiry created successfully"),
            new OA\Response(response: 422, description: "Validation error")
        ]
    )]
    public function store() {}

    #[OA\Get(
        path: "/api/inquiries/{inquiry}",
        summary: "Display the specified inquiry",
        security: [["bearerAuth" => []]],
        tags: ["Inquiries"],
        parameters: [
            new OA\Parameter(
                name: "inquiry",
                description: "Inquiry ID",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Inquiry retrieved successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "success", type: "boolean", example: true),
                        new OA\Property(property: "message", type: "string", example: "Inquiry retrieved successfully"),
                        new OA\Property(property: "data", properties: [
                            new OA\Property(property: "id", type: "integer", example: 1),
                            new OA\Property(property: "customer_id", type: "integer", example: 1),
                            new OA\Property(property: "car_id", type: "integer", example: 1),
                            new OA\Property(property: "message", type: "string", example: "I am interested in this car."),
                            new OA\Property(property: "status", type: "string", example: "pending")
                        ], type: "object")
                    ]
                )
            ),
            new OA\Response(response: 404, description: "Inquiry not found")
        ]
    )]
    public function show() {}

    #[OA\Put(
        path: "/api/inquiries/{inquiry}",
        summary: "Update the specified inquiry",
        security: [["bearerAuth" => []]],
        tags: ["Inquiries"],
        parameters: [
            new OA\Parameter(
                name: "inquiry",
                description: "Inquiry ID",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "customer_id", type: "integer", example: 1),
                    new OA\Property(property: "car_id", type: "integer", example: 2),
                    new OA\Property(property: "message", type: "string", example: "Update: Is this still available?"),
                    new OA\Property(property: "status", type: "string", example: "resolved")
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: "Inquiry updated successfully"),
            new OA\Response(response: 404, description: "Inquiry not found"),
            new OA\Response(response: 422, description: "Validation error")
        ]
    )]
    public function update() {}

    #[OA\Delete(
        path: "/api/inquiries/{inquiry}",
        summary: "Remove the specified inquiry",
        security: [["bearerAuth" => []]],
        tags: ["Inquiries"],
        parameters: [
            new OA\Parameter(
                name: "inquiry",
                description: "Inquiry ID",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(response: 200, description: "Inquiry deleted successfully"),
            new OA\Response(response: 404, description: "Inquiry not found")
        ]
    )]
    public function destroy() {}
}

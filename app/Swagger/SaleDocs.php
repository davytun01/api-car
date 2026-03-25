<?php

namespace App\Swagger;

use OpenApi\Attributes as OA;

class SaleDocs
{
    #[OA\Get(
        path: "/api/sales",
        summary: "Display a listing of sales",
        security: [["bearerAuth" => []]],
        tags: ["Sales"],
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
                description: "Sales retrieved successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "success", type: "boolean", example: true),
                        new OA\Property(property: "message", type: "string", example: "Sales retrieved successfully"),
                        new OA\Property(property: "data", type: "array", items: new OA\Items(
                            properties: [
                                new OA\Property(property: "id", type: "integer", example: 1),
                                new OA\Property(property: "car_id", type: "integer", example: 1),
                                new OA\Property(property: "customer_id", type: "integer", example: 1),
                                new OA\Property(property: "sale_price", type: "number", format: "float", example: 24000.00),
                                new OA\Property(property: "sale_date", type: "string", format: "date", example: "2023-10-25")
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
        path: "/api/sales",
        summary: "Store a newly created sale",
        security: [["bearerAuth" => []]],
        tags: ["Sales"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["car_id", "customer_id", "sale_price", "sale_date"],
                properties: [
                    new OA\Property(property: "car_id", type: "integer", example: 1),
                    new OA\Property(property: "customer_id", type: "integer", example: 1),
                    new OA\Property(property: "sale_price", type: "number", format: "float", example: 24500.50),
                    new OA\Property(property: "sale_date", type: "string", format: "date", example: "2023-10-25")
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: "Sale created successfully"),
            new OA\Response(response: 422, description: "Validation error"),
            new OA\Response(response: 500, description: "Failed to create sale")
        ]
    )]
    public function store() {}

    #[OA\Get(
        path: "/api/sales/{sale}",
        summary: "Display the specified sale",
        security: [["bearerAuth" => []]],
        tags: ["Sales"],
        parameters: [
            new OA\Parameter(
                name: "sale",
                description: "Sale ID",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Sale retrieved successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "success", type: "boolean", example: true),
                        new OA\Property(property: "message", type: "string", example: "Sale retrieved successfully"),
                        new OA\Property(property: "data", properties: [
                            new OA\Property(property: "id", type: "integer", example: 1),
                            new OA\Property(property: "car_id", type: "integer", example: 1),
                            new OA\Property(property: "customer_id", type: "integer", example: 1),
                            new OA\Property(property: "sale_price", type: "number", format: "float", example: 24000.00),
                            new OA\Property(property: "sale_date", type: "string", format: "date", example: "2023-10-25")
                        ], type: "object")
                    ]
                )
            ),
            new OA\Response(response: 404, description: "Sale not found")
        ]
    )]
    public function show() {}

    #[OA\Put(
        path: "/api/sales/{sale}",
        summary: "Update the specified sale",
        security: [["bearerAuth" => []]],
        tags: ["Sales"],
        parameters: [
            new OA\Parameter(
                name: "sale",
                description: "Sale ID",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "car_id", type: "integer", example: 1),
                    new OA\Property(property: "customer_id", type: "integer", example: 1),
                    new OA\Property(property: "sale_price", type: "number", format: "float", example: 23000.00),
                    new OA\Property(property: "sale_date", type: "string", format: "date", example: "2023-10-26")
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: "Sale updated successfully"),
            new OA\Response(response: 404, description: "Sale not found"),
            new OA\Response(response: 422, description: "Validation error")
        ]
    )]
    public function update() {}

    #[OA\Delete(
        path: "/api/sales/{sale}",
        summary: "Remove the specified sale",
        security: [["bearerAuth" => []]],
        tags: ["Sales"],
        parameters: [
            new OA\Parameter(
                name: "sale",
                description: "Sale ID",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(response: 200, description: "Sale deleted successfully"),
            new OA\Response(response: 404, description: "Sale not found")
        ]
    )]
    public function destroy() {}
}

<?php

namespace App\Swagger;

use OpenApi\Attributes as OA;

class CarDocs
{
    #[OA\Get(
        path: "/api/cars",
        summary: "Display a listing of cars",
        tags: ["Cars"],
        parameters: [
            new OA\Parameter(
                name: "status",
                description: "Filter by status (e.g., available)",
                in: "query",
                required: false,
                schema: new OA\Schema(type: "string", enum: ["available", "sold", "reserved"])
            ),
            new OA\Parameter(
                name: "brand",
                description: "Filter by brand",
                in: "query",
                required: false,
                schema: new OA\Schema(type: "string")
            ),
            new OA\Parameter(
                name: "price_min",
                description: "Minimum price",
                in: "query",
                required: false,
                schema: new OA\Schema(type: "number")
            ),
            new OA\Parameter(
                name: "price_max",
                description: "Maximum price",
                in: "query",
                required: false,
                schema: new OA\Schema(type: "number")
            ),
            new OA\Parameter(
                name: "year",
                description: "Filter by year",
                in: "query",
                required: false,
                schema: new OA\Schema(type: "integer")
            ),
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
                description: "Cars retrieved successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "success", type: "boolean", example: true),
                        new OA\Property(property: "message", type: "string", example: "Cars retrieved successfully"),
                        new OA\Property(property: "data", type: "array", items: new OA\Items(
                            properties: [
                                new OA\Property(property: "id", type: "integer", example: 1),
                                new OA\Property(property: "brand", type: "string", example: "Toyota"),
                                new OA\Property(property: "model", type: "string", example: "Camry"),
                                new OA\Property(property: "year", type: "integer", example: 2021),
                                new OA\Property(property: "price", type: "number", format: "float", example: 25000.00),
                                new OA\Property(property: "status", type: "string", example: "available")
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
        path: "/api/cars",
        summary: "Store a newly created car",
        security: [["bearerAuth" => []]],
        tags: ["Cars"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\MediaType(
                mediaType: "multipart/form-data",
                schema: new OA\Schema(
                    required: ["brand", "model", "year", "price", "status"],
                    properties: [
                        new OA\Property(property: "brand", type: "string", example: "Toyota"),
                        new OA\Property(property: "model", type: "string", example: "Camry"),
                        new OA\Property(property: "year", type: "integer", example: 2021),
                        new OA\Property(property: "price", type: "number", format: "float", example: 25000.00),
                        new OA\Property(property: "status", type: "string", example: "available"),
                        new OA\Property(property: "image", type: "string", format: "binary")
                    ]
                )
            )
        ),
        responses: [
            new OA\Response(response: 201, description: "Car created successfully"),
            new OA\Response(response: 422, description: "Validation error")
        ]
    )]
    public function store() {}

    #[OA\Get(
        path: "/api/cars/{car}",
        summary: "Display the specified car",
        tags: ["Cars"],
        parameters: [
            new OA\Parameter(
                name: "car",
                description: "Car ID",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Car retrieved successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "success", type: "boolean", example: true),
                        new OA\Property(property: "message", type: "string", example: "Car retrieved successfully"),
                        new OA\Property(property: "data", properties: [
                            new OA\Property(property: "id", type: "integer", example: 1),
                            new OA\Property(property: "brand", type: "string", example: "Toyota"),
                            new OA\Property(property: "model", type: "string", example: "Camry"),
                            new OA\Property(property: "year", type: "integer", example: 2021),
                            new OA\Property(property: "price", type: "number", format: "float", example: 25000.00),
                            new OA\Property(property: "status", type: "string", example: "available")
                        ], type: "object")
                    ]
                )
            ),
            new OA\Response(response: 404, description: "Car not found")
        ]
    )]
    public function show() {}

    #[OA\Put(
        path: "/api/cars/{car}",
        summary: "Update the specified car",
        security: [["bearerAuth" => []]],
        tags: ["Cars"],
        parameters: [
            new OA\Parameter(
                name: "car",
                description: "Car ID",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\MediaType(
                mediaType: "multipart/form-data",
                schema: new OA\Schema(
                    properties: [
                        new OA\Property(property: "_method", type: "string", description: "Since multipart/form-data does not support PUT, send POST with _method=PUT", example: "PUT"),
                        new OA\Property(property: "brand", type: "string", example: "Toyota"),
                        new OA\Property(property: "model", type: "string", example: "Camry"),
                        new OA\Property(property: "year", type: "integer", example: 2021),
                        new OA\Property(property: "price", type: "number", format: "float", example: 25000.00),
                        new OA\Property(property: "status", type: "string", example: "available"),
                        new OA\Property(property: "image", type: "string", format: "binary")
                    ]
                )
            )
        ),
        responses: [
            new OA\Response(response: 200, description: "Car updated successfully"),
            new OA\Response(response: 404, description: "Car not found"),
            new OA\Response(response: 422, description: "Validation error")
        ]
    )]
    public function update() {}

    #[OA\Delete(
        path: "/api/cars/{car}",
        summary: "Remove the specified car",
        security: [["bearerAuth" => []]],
        tags: ["Cars"],
        parameters: [
            new OA\Parameter(
                name: "car",
                description: "Car ID",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(response: 200, description: "Car deleted successfully"),
            new OA\Response(response: 404, description: "Car not found")
        ]
    )]
    public function destroy() {}
}

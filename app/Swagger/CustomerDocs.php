<?php

namespace App\Swagger;

use OpenApi\Attributes as OA;

class CustomerDocs
{
    #[OA\Get(
        path: "/api/customers",
        summary: "Display a listing of customers",
        security: [["bearerAuth" => []]],
        tags: ["Customers"],
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
                description: "Customers retrieved successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "success", type: "boolean", example: true),
                        new OA\Property(property: "message", type: "string", example: "Customers retrieved successfully"),
                        new OA\Property(property: "data", type: "array", items: new OA\Items(
                            properties: [
                                new OA\Property(property: "id", type: "integer", example: 1),
                                new OA\Property(property: "name", type: "string", example: "John Doe"),
                                new OA\Property(property: "email", type: "string", example: "john@example.com"),
                                new OA\Property(property: "phone", type: "string", example: "123456789")
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
        path: "/api/customers",
        summary: "Store a newly created customer",
        security: [["bearerAuth" => []]],
        tags: ["Customers"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["name", "email"],
                properties: [
                    new OA\Property(property: "name", type: "string", example: "Jane Doe"),
                    new OA\Property(property: "email", type: "string", format: "email", example: "jane@example.com"),
                    new OA\Property(property: "phone", type: "string", example: "987654321")
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: "Customer created successfully"),
            new OA\Response(response: 422, description: "Validation error")
        ]
    )]
    public function store() {}

    #[OA\Get(
        path: "/api/customers/{customer}",
        summary: "Display the specified customer",
        security: [["bearerAuth" => []]],
        tags: ["Customers"],
        parameters: [
            new OA\Parameter(
                name: "customer",
                description: "Customer ID",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Customer retrieved successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "success", type: "boolean", example: true),
                        new OA\Property(property: "message", type: "string", example: "Customer retrieved successfully"),
                        new OA\Property(property: "data", properties: [
                            new OA\Property(property: "id", type: "integer", example: 1),
                            new OA\Property(property: "name", type: "string", example: "John Doe"),
                            new OA\Property(property: "email", type: "string", example: "john@example.com"),
                            new OA\Property(property: "phone", type: "string", example: "123456789")
                        ], type: "object")
                    ]
                )
            ),
            new OA\Response(response: 404, description: "Customer not found")
        ]
    )]
    public function show() {}

    #[OA\Put(
        path: "/api/customers/{customer}",
        summary: "Update the specified customer",
        security: [["bearerAuth" => []]],
        tags: ["Customers"],
        parameters: [
            new OA\Parameter(
                name: "customer",
                description: "Customer ID",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "name", type: "string", example: "Jane Doe Updated"),
                    new OA\Property(property: "email", type: "string", format: "email", example: "jane_updated@example.com"),
                    new OA\Property(property: "phone", type: "string", example: "111222333")
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: "Customer updated successfully"),
            new OA\Response(response: 404, description: "Customer not found"),
            new OA\Response(response: 422, description: "Validation error")
        ]
    )]
    public function update() {}

    #[OA\Delete(
        path: "/api/customers/{customer}",
        summary: "Remove the specified customer",
        security: [["bearerAuth" => []]],
        tags: ["Customers"],
        parameters: [
            new OA\Parameter(
                name: "customer",
                description: "Customer ID",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(response: 200, description: "Customer deleted successfully"),
            new OA\Response(response: 404, description: "Customer not found")
        ]
    )]
    public function destroy() {}
}

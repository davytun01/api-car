<?php

namespace App\Swagger;

use OpenApi\Attributes as OA;

class AppointmentDocs
{
    #[OA\Post(
        path: "/api/appointments",
        summary: "Store a newly created appointment (Public for guests)",
        tags: ["Appointments"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["name", "email", "requested_date"],
                properties: [
                    new OA\Property(property: "name", type: "string", example: "Jane Doe"),
                    new OA\Property(property: "email", type: "string", format: "email", example: "jane@example.com"),
                    new OA\Property(property: "phone", type: "string", example: "987654321"),
                    new OA\Property(property: "requested_date", type: "string", format: "date-time", example: "2023-11-25T14:30:00Z"),
                    new OA\Property(property: "message", type: "string", example: "I am interested in test driving the Camry."),
                    new OA\Property(property: "car_id", type: "integer", example: 1)
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Appointment requested successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "success", type: "boolean", example: true),
                        new OA\Property(property: "message", type: "string", example: "Appointment requested successfully"),
                        new OA\Property(property: "data", properties: [
                            new OA\Property(property: "id", type: "integer", example: 1),
                            new OA\Property(property: "name", type: "string", example: "Jane Doe"),
                            new OA\Property(property: "email", type: "string", example: "jane@example.com"),
                            new OA\Property(property: "phone", type: "string", example: "987654321"),
                            new OA\Property(property: "requested_date", type: "string", format: "date-time", example: "2023-11-25T14:30:00.000000Z"),
                            new OA\Property(property: "message", type: "string", example: "I am interested in test driving the Camry."),
                            new OA\Property(property: "status", type: "string", example: "pending"),
                            new OA\Property(property: "car_id", type: "integer", example: 1)
                        ], type: "object")
                    ]
                )
            ),
            new OA\Response(response: 422, description: "Validation error")
        ]
    )]
    public function store() {}
}

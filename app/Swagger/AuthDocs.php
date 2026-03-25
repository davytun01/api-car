<?php

namespace App\Swagger;

use OpenApi\Attributes as OA;

class AuthDocs
{
    #[OA\Post(
        path: "/api/login",
        summary: "Login user and create token",
        tags: ["Auth"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["email", "password"],
                properties: [
                    new OA\Property(property: "email", type: "string", format: "email", example: "john@example.com"),
                    new OA\Property(property: "password", type: "string", format: "password", example: "secret123")
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "User logged in successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "success", type: "boolean", example: true),
                        new OA\Property(property: "message", type: "string", example: "User logged in successfully"),
                        new OA\Property(property: "data", properties: [
                            new OA\Property(property: "user", properties: [
                                new OA\Property(property: "id", type: "integer", example: 1),
                                new OA\Property(property: "name", type: "string", example: "John Doe"),
                                new OA\Property(property: "email", type: "string", example: "john@example.com"),
                                new OA\Property(property: "role", type: "string", example: "sales")
                            ], type: "object"),
                            new OA\Property(property: "access_token", type: "string", example: "1|1234567890abcdef"),
                            new OA\Property(property: "token_type", type: "string", example: "Bearer")
                        ], type: "object")
                    ]
                )
            ),
            new OA\Response(response: 401, description: "Invalid login credentials")
        ]
    )]
    public function login() {}

    #[OA\Post(
        path: "/api/logout",
        summary: "Logout user (Revoke the token)",
        security: [["bearerAuth" => []]],
        tags: ["Auth"],
        responses: [
            new OA\Response(
                response: 200,
                description: "User logged out successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "success", type: "boolean", example: true),
                        new OA\Property(property: "message", type: "string", example: "User logged out successfully"),
                        new OA\Property(property: "data", type: "null")
                    ]
                )
            ),
            new OA\Response(response: 401, description: "Unauthenticated")
        ]
    )]
    public function logout() {}
}

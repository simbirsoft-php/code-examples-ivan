<?php

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Car Service Station API",
 *      description="Description of API",
 * )
 */

/**
 *  @OA\Server(
 *      url="http://localhost:8080/api"
 *  )
 */

/**
 * @OA\SecurityScheme(
 *     type="http",
 *     description="Use your email and api_key",
 *     name="Password Based",
 *     in="header",
 *     scheme="basic",
 *     securityScheme="basic",
 * )
 */

/**
 *
 * @OA\RequestBody(
 *     request="Station",
 *     description="Station request",
 *     required=true,
 *     @OA\MediaType(
 *         mediaType="application/x-www-form-urlencoded",
 *         @OA\Schema(ref="#/components/schemas/Station")
 *     )
 * )
 */

/**
 *
 * @OA\RequestBody(
 *     request="Import",
 *     description="Schedule import",
 *     required=true,
 *     @OA\MediaType(
 *         mediaType="multipart/form-data",
 *         @OA\Schema(
 *             @OA\Property(
 *                 description="file to upload",
 *                 property="file",
 *                 type="file",
 *                 format="file",
 *             ),
 *             required={"file"}
 *         )
 *     )
 * )
 */

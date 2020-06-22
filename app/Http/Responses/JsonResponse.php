<?php

namespace App\Http\Responses;

/**
 * Genera respuestas JSON para una request.
 *
 * @package App\Http\Responses
 */
class JsonResponse
{
    /**
     * Genera resupuesta JSON base.
     *
     * @param $statusCode
     * @param $data
     * @return \Illuminate\Http\JsonResponse|object
     */
    private static function base($statusCode, $data) {
        return response()
            ->json($data)
            ->header('Content-Type', 'application/json')
            ->setStatusCode($statusCode);
    }

    /**
     * Genera respuesta JSON de éxito.
     *
     * @param $data
     * @return \Illuminate\Http\JsonResponse|object
     */
    public static function ok($data) {
        return JsonResponse::base(200, $data);
    }

    /**
     * Genera respuesta JSON de error.
     *
     * @param $data
     * @param $statusCode
     * @return \Illuminate\Http\JsonResponse|object
     */
    public static function error($data, $statusCode) {
        return JsonResponse::base($statusCode, [
            'errors' => $data
        ]);
    }

}

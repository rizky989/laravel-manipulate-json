<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\JsonManipulationService;
use Illuminate\Http\Request;

/**
 * Class ManipulateJsonController
 *
 * Controller for manipulating JSON data.
 */
class ManipulateJsonController extends Controller
{
    /**
     * Manipulate JSON data and return the result as a JSON response.
     *
     * @param Request $request The HTTP request.
     * @param JsonManipulationService $jsonManipulationService The service for manipulating JSON data.
     *
     * @return JsonResponse The JSON response.
     */
    public function __invoke(Request $request, JsonManipulationService $jsonManipulationService)
    {
        // Retrieve JSON data from files
        $data1 = json_decode(file_get_contents('data1.json'), true);
        $data2 = json_decode(file_get_contents('data2.json'), true);

        // Manipulate JSON data using the service
        $manipulatedData = $jsonManipulationService->manipulateJson($data1['data'], $data2['data']);

        // Return the manipulated data as a JSON response
        return response()->json([
            'status' => 1,
            'message' => 'Data Successfully Retrieved.',
            'data' => $manipulatedData,
        ]);
    }
}

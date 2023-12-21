<?php

namespace App\Services;

use App\Services\DataManipulator;

/**
 * Class JsonManipulationService
 *
 * Service for manipulating JSON data.
 */
class JsonManipulationService
{
    /**
     * Manipulate JSON data.
     *
     * @param array $data1 The first set of JSON data.
     * @param array $data2 The second set of JSON data.
     *
     * @return array The manipulated JSON data.
     */
    public function manipulateJson(array $data1, array $data2): array
    {
        // Create a DataManipulator instance to perform data manipulation
        $dataManipulator = new DataManipulator($data1, $data2);

        // Return the manipulated data
        return $dataManipulator->manipulateData();
    }
}

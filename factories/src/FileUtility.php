<?php

namespace App;

use Exception;

class FileUtility
{
    public static function openJson($json_file)
    {
        if (empty($json_file)) {
            warn('The JSON file cannot be empty.');
            throw new Exception('JSON file is required');
        }

        if (!file_exists($json_file)) {
            err('The JSON file does not exist');
            throw new Exception('Invalid file path');
        }

        // Read JSON file
        $json_data = file_get_contents($json_file);

        // Decode JSON to PHP array
        $data = json_decode($json_data, true);

        return $data;
    }
}
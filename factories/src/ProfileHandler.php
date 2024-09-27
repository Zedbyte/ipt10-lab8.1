<?php

namespace App;

use App\FileUtility;
use App\Outputs\DisplayFactory;

class ProfileHandler
{
    public static function display($request)
    {
        // Decode JSON to PHP array
        $json_file = $_ENV['PROFILE_JSON_FILE'];

        // Retrieve the preferred FORMAT from the URL
        $params = $request->params();
        // The default format it 'text'
        $format = 'text';
        if (isset($params['format'])) {
            $format = $params['format'];
        }

        // Open the JSON file
        $data = FileUtility::openJson($json_file);

        // Load the data into an Object
        $profile = new Profile($data);

        // Retrieve the appropriate output handler and render the final output
        $output = DisplayFactory::getInstance($format);
        $output->setData($profile);
        return $output->render();
    }
}

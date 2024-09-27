<?php

namespace App\Outputs;

interface ProfileFormatter
{
    public function setData($profile);

    public function render();
}
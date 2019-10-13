<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\RandomValue;

class RandomValueController extends Controller
{
    protected $randomValue;

    public function __construct(RandomValue $randomValue)
    {
        $this->randomValue = $randomValue;

    }

    public function generate()
    {
        $value = $this->randomValue->generate();
        return $value;
    }

    public function retrieve($retrieveId = NULL)
    {
        // Define requestID
        $number = $this->randomValue->retrieve($retrieveId);
        return $number;
    }
}

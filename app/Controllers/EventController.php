<?php

namespace App\Controllers;

class EventController extends BaseController
{
    public function index()
    {
        return view('events/index');
    }
}
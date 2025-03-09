<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table            = 'events';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['name', 'date', 'location', 'description'];
    protected $validationRules  = [
        'name'     => 'required|max_length[150]',
        'date'     => 'required|valid_date',
        'location' => 'required|max_length[255]',
    ];
}
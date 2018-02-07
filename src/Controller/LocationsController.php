<?php
namespace App\Controller;
use App\Controller\AppController;
class LocationsController extends AppController
{
    public $paginate = [
        'page' => 1,
        'limit' => 10,
        'maxLimit' => 100,
        'fields' => [
            'id', 'name', 'geo'
        ],
        'sortWhitelist' => [
            'id', 'name'
        ]
    ];
}
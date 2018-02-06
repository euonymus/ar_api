<?php
namespace App\Controller;
use App\Controller\AppController;
class LocationsController extends AppController
{
    public $paginate = [
        'page' => 1,
        'limit' => 5,
        'maxLimit' => 100,
        'fields' => [
            'id', 'name', 'geo'
        ],
        'sortWhitelist' => [
            'id', 'name'
        ]
    ];
}
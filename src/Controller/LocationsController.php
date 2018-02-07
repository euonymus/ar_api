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

    public function geo()
    {
        $location = $this->Locations->newEntity();

        if ($this->request->is(['patch', 'post', 'put'])) {
	  $query = $this->Locations->search($this->request->data);
	  $this->set('locations', $this->paginate($query));
	  $this->set('_serialize', ['locations']);
	}
	$this->set(compact('location'));
	$this->set('_serialize', ['location']);
    }
}
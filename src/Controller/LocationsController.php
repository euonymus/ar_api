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
	$this->set(compact('location'));

        //if ($this->request->is(['patch', 'post', 'put'])) {
	  //$query = $this->Locations->search($this->request->data);
	  //$this->set('locations', $this->paginate($query));
	  //$this->set('_serialize', ['locations']);
	//}
	$this->Crud->on('beforePaginate', function(\Cake\Event\Event $event) {
	    $event->getSubject()->query = $this->Locations->search($this->request->data);
        });
	return $this->Crud->execute('index');
    }
}
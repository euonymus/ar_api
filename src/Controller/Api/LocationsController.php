<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
class LocationsController extends AppController
{
    public $paginate = [
        'page' => 1,
        'limit' => 5,
        'maxLimit' => 15,
        'sortWhitelist' => [
            'id', 'name'
        ]
    ];

    public function geo()
    {
	$this->Crud->on('beforePaginate', function(\Cake\Event\Event $event) {
	    if ($this->request->is(['patch', 'post', 'put'])) {
	      $data = $this->request->data;
	    } else {
	      $data = $this->request->query;
	    }
	    $event->getSubject()->query = $this->Locations->search($data);
        });
	return $this->Crud->execute('index');
    }
}
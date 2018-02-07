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
        //if ($this->request->is(['patch', 'post', 'put'])) {
	//  $query = $subject = $this->Locations->search($this->request->data);
	//  $this->set('locations', $this->paginate($query));
	//}
        $this->Crud->on('beforePaginate', function(\Cake\Event\Event $event) {
	  $event->getSubject()->query = $this->Locations->search($this->request->data);
	});
	return $this->Crud->execute('index');
    }
}
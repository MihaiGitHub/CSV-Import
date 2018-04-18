<?php

namespace App\Controller;
use Cake\ORM\TableRegistry;

class PersonsController extends AppController
{
   
    public function index()
    {

    }

    public function view($slug)
    {
        if ($this->request->is('ajax')) {

            $persons = TableRegistry::get('Persons');
            $actives = $persons->find('all')
                 ->where(['group_id' => $this->request->getData('groupid')])
                 ->where(['state' => 'active']);

            return $this->json($actives);
        }

        $this->set('groupid', $slug);
    }

}
<?php

namespace App\Controller;
use Cake\ORM\TableRegistry;

class GroupsController extends AppController
{
   
    public function index()
    {
        $this->loadComponent('Paginator');
        $groups = $this->Paginator->paginate($this->Groups->find());
        $this->set(compact('groups'));
    }

    public function list(){

        if ($this->request->is('ajax')) {
            $groups = $this->Groups->find();
            return $this->json($groups);
        }
    }

    public function uploadcsv(){
        $this->autoRender = false;
        if ($this->request->is('post')) {

            $filename = $_FILES["persons_file"]["tmp_name"];
            $handle = fopen($filename, "r");
            $header = fgetcsv($handle);

            $row = 0;
            $headers = [];
            $filepath = $filename;

            if (($handle = fopen($filepath, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    if (++$row == 1) {

                    $headers = array_flip($data); // Get the column names from the header.
                    continue;

                    } else {

                    if (array_key_exists('last_name', $headers)) {  // checks every record if its a group or persons record

                            $persons = TableRegistry::get('Persons');
                            $person = $persons->find()->where(['person_id' => $data[$headers['person_id']]])->first();

                            if (empty($person)) {

                                $person = $persons->newEntity();
                                
                                $person->person_id = $data[$headers['person_id']];
                                $person->first_name = $data[$headers['first_name']];
                                $person->last_name = $data[$headers['last_name']];
                                $person->email_address = $data[$headers['email_address']];
                                $person->group_id = $data[$headers['group_id']];
                                $person->state = $data[$headers['state']];
                                $person->created = time();
                                
                                if ($persons->save($person)) {
                                    $id = $person->id;
                                    
                                }

                            } else {

                                $person->first_name = $data[$headers['first_name']];
                                $person->last_name = $data[$headers['last_name']];
                                $person->email_address = $data[$headers['email_address']];
                                $person->state = $data[$headers['state']];
                                $person->modified = time();
                                
                                if ($persons->save($person)) {
                                    $id = $person->id;
                                    
                                }

                            }

                    } else {

                            $groups = TableRegistry::get('Groups');
                            $group = $groups->find()->where(['group_id' => $data[$headers['group_id']]])->first();

                            if (empty($group)) {

                                $group = $groups->newEntity();
                                
                                $group->group_id = $data[$headers['group_id']];
                                $group->group_name = $data[$headers['group_name']];
                                $group->created = time();
                                
                                if ($groups->save($group)) {
                                    $id = $group->id;
                                    
                                }

                            } else {

                                $group->group_name = $data[$headers['group_name']];
                                $group->modified = time();
                                
                                if ($groups->save($group)) {
                                    $id = $group->id;
                                    
                                }

                            }

                    }
                }

                
                }
                fclose($handle);
            }

        }
    }

}
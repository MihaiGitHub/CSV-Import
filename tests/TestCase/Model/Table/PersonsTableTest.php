<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PersonsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

class PersonsTableTest extends TestCase
{
    public $fixtures = ['app.persons'];

    public function setUp()
    {
        parent::setUp();
        $this->Persons = TableRegistry::get('Persons');
    }

    public function testFindActives()
    {
        $query = $this->Persons->find('active');
        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();
        $expected = [
            ['id' => 1, 'last_name' => 'Ortiz-Rosado'],
            ['id' => 2, 'last_name' => 'Verlee']
        ];

        $this->assertEquals($expected, $result);
    }
}
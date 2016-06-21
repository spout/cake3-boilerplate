<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ContactsTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator)
    {
        $validator->add('email', 'valid-email', ['rule' => 'email']);
        $validator->notEmpty('subject');
        $validator->notEmpty('message');

        return $validator;
    }

}
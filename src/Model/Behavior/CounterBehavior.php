<?php
namespace App\Model\Behavior;

use Cake\ORM\Behavior;

class CounterBehavior extends Behavior
{
    protected $_defaultConfig = [
        'implementedMethods' => ['incrementCounter' => 'incrementCounter'],
        'field' => 'counter',
    ];

    public function incrementCounter($id)
    {
        $field = $this->config('field');
        $query = $this->_table->query();
        $result = $query
            ->update()
            ->set(
                $query->newExpr(sprintf('%s = %s + 1', $field, $field))
            )
            ->where([
                'id' => $id
            ])
            ->execute();
    }

}
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
        return $query
            ->update()
            ->set(
                $query->newExpr(sprintf('%1$s = %1$s + 1', $field))
            )
            ->where([
                'id' => $id
            ])
            ->execute();
    }

}
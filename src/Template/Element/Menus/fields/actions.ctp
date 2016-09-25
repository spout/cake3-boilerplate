<?php
echo $this->element('Crud/fields/actions', [
    'singularVar' => $singularVar,
    'actions' => [
        'view' => false,
        'edit' => true,
        'delete' => false
    ],
]);
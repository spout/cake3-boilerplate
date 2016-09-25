<?php
echo $this->element('Crud/fields/actions', [
    'singularVar' => $singularVar,
    'actions' => [
        'view' => true,
        'edit' => true,
        'delete' => true
    ],
]);
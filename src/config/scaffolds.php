<?php
return [
    'Contacts' => [
        'fields' => [
            'email' => [
                'title' => __("Email"),
                'label' => __("Email"),
            ],
            'subject' => [
                'title' => __("Subject"),
                'label' => __("Subject")
            ],
            'message' => [
                'title' => __("Message"),
                'label' => __("Message")
            ],
        ],
        'page_title' => [
            'index' => __("Contacts"),
            'add' => __("Add contact"),
            'edit' => __("Edit contact"),
        ],
    ],
    'Contents' => [
        'fields' => [
            'title' => [
                'title' => __("Title"),
                'label' => __("Title")
            ],
            'slug' => [
                'title' => __("Slug"),
                'label' => __("Slug")
            ],
            'content' => [
                'title' => __("Content"),
                'label' => __("Content")
            ],
            'meta_description' => [
                'title' => __("Meta description"),
                'label' => __("Meta description")
            ],
        ],
        'per_action_fields' => [
            'index' => ['title', 'slug'],
            'view' => ['title', 'slug', 'content', 'meta_description'],
            'add' => ['title', 'slug', 'content', 'meta_description'],
            'edit' => ['title', 'slug', 'content', 'meta_description'],
        ],
        'page_title' => [
            'index' => __("Contents"),
            'add' => __("Add content"),
            'edit' => __("Edit content"),
        ],
    ],
    'Menus' => [
        'fields' => [
            'title' => [
                'title' => __("Title"),
                'label' => __("Title")
            ],
            'slug' => [
                'title' => __("Slug"),
                'label' => __("Slug"),
            ],
            'attributes' => [
                'title' => __("Attributes"),
                'label' => __("Attributes"),
            ],
        ],
        'relations' => [
            'MenuItems'
        ],
        'page_title' => [
            'index' => __("Menus"),
            'add' => __("Add menu"),
            'edit' => __("Edit menu"),
        ],
    ],
    'MenuItems' => [
        'fields' => [
            'parent_id' => [
                'title' => __("Parent"),
                'label' => __("Parent")
            ],
            'menu_id' => [
                'title' => __("Menu"),
                'label' => __("Menu"),
            ],
            'model' => [
                'title' => __("Model"),
                'label' => __("Model"),
            ],
            'foreign_key' => [
                'title' => __("Foreign key"),
                'label' => __("Foreign key"),
            ],
            'title' => [
                'title' => __("Title"),
                'label' => __("Title"),
            ],
            'url' => [
                'title' => __("URL"),
                'label' => __("URL"),
            ],
            'attributes' => [
                'title' => __("Attributes"),
                'label' => __("Attributes"),
            ],
        ],
        'page_title' => [
            'index' => __("Menu items"),
            'add' => __("Add menu item"),
            'edit' => __("Edit menu item"),
        ],
    ],
    'Users' => [
        'fields' => [
            'active' => [
                'title' => __("Active"),
                'label' => __("Active"),
            ],
            'is_superuser' => [
                'title' => __("Superuser"),
                'label' => __("Superuser"),
            ],
            'username' => [
                'title' => __("Username"),
                'label' => __("Username"),
            ],
            'email' => [
                'title' => __("Email"),
                'label' => __("Email"),
            ],
            'first_name' => [
                'title' => __("Firstname"),
                'label' => __("Firstname"),
            ],
            'last_name' => [
                'title' => __("Lastname"),
                'label' => __("Lastname"),
            ],
            'role' => [
                'title' => __("Role"),
                'label' => __("Role"),
            ],
        ],
        'page_title' => [
            'index' => __("Users"),
            'add' => __("Add user"),
            'edit' => __("Edit user"),
        ],
    ],
];
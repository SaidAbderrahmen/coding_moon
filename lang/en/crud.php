<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'beekeepers' => [
        'name' => 'Beekeepers',
        'index_title' => 'Beekeepers List',
        'new_title' => 'New Beekeeper',
        'create_title' => 'Create Beekeeper',
        'edit_title' => 'Edit Beekeeper',
        'show_title' => 'Show Beekeeper',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'phone_number' => 'Phone Number',
            'address' => 'Address',
            'password' => 'Password',
        ],
    ],

    'histories' => [
        'name' => 'Histories',
        'index_title' => 'Histories List',
        'new_title' => 'New History',
        'create_title' => 'Create History',
        'edit_title' => 'Edit History',
        'show_title' => 'Show History',
        'inputs' => [
            'action' => 'Action',
            'hive_id' => 'Hive',
            'date' => 'Date',
        ],
    ],

    'hives' => [
        'name' => 'Hives',
        'index_title' => 'Hives List',
        'new_title' => 'New Hive',
        'create_title' => 'Create Hive',
        'edit_title' => 'Edit Hive',
        'show_title' => 'Show Hive',
        'inputs' => [
            'number' => 'Number',
            'total_bees' => 'Total Bees',
            'present_bees' => 'Present Bees',
            'infected_bees' => 'Infected Bees',
            'tempreture' => 'Tempreture',
            'humidity' => 'Humidity',
            'status' => 'Status',
            'beekeeper_id' => 'Beekeeper',
        ],
    ],

    'hive_notifications' => [
        'name' => 'Hive Notifications',
        'index_title' => 'Notifications List',
        'new_title' => 'New Notification',
        'create_title' => 'Create Notification',
        'edit_title' => 'Edit Notification',
        'show_title' => 'Show Notification',
        'inputs' => [
            'event' => 'Event',
            'details' => 'Details',
            'date' => 'Date',
        ],
    ],

    'hive_histories' => [
        'name' => 'Hive Histories',
        'index_title' => 'Histories List',
        'new_title' => 'New History',
        'create_title' => 'Create History',
        'edit_title' => 'Edit History',
        'show_title' => 'Show History',
        'inputs' => [
            'action' => 'Action',
            'date' => 'Date',
        ],
    ],

    'notifications' => [
        'name' => 'Notifications',
        'index_title' => 'Notifications List',
        'new_title' => 'New Notification',
        'create_title' => 'Create Notification',
        'edit_title' => 'Edit Notification',
        'show_title' => 'Show Notification',
        'inputs' => [
            'event' => 'Event',
            'details' => 'Details',
            'hive_id' => 'Hive',
            'date' => 'Date',
        ],
    ],

    'tips' => [
        'name' => 'Tips',
        'index_title' => 'Tips List',
        'new_title' => 'New Tip',
        'create_title' => 'Create Tip',
        'edit_title' => 'Edit Tip',
        'show_title' => 'Show Tip',
        'inputs' => [
            'title' => 'Title',
            'description' => 'Description',
            'file' => 'File',
            'link' => 'Link',
        ],
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ],
    ],

    'beekeeper_hives' => [
        'name' => 'Beekeeper Hives',
        'index_title' => 'Hives List',
        'new_title' => 'New Hive',
        'create_title' => 'Create Hive',
        'edit_title' => 'Edit Hive',
        'show_title' => 'Show Hive',
        'inputs' => [
            'number' => 'Number',
            'total_bees' => 'Total Bees',
            'present_bees' => 'Present Bees',
            'infected_bees' => 'Infected Bees',
            'tempreture' => 'Tempreture',
            'humidity' => 'Humidity',
            'status' => 'Status',
        ],
    ],
];

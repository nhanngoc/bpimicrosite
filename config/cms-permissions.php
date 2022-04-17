<?php

return [
   /*  [
        'name' => 'Email Function',
        'flag' => 'position',
    ],
    [
        'name'        => 'Manager',
        'flag'        => 'position.manager',
        'parent_flag' => 'position'
    ],
    [
        'name'        => 'Account',
        'flag'        => 'position.account',
        'parent_flag' => 'position'
    ],
    [
        'name'        => 'Commercial',
        'flag'        => 'position.commercial',
        'parent_flag' => 'position'
    ],
    [
        'name'        => 'Leader',
        'flag'        => 'position.leader',
        'parent_flag' => 'position'
    ],
    [
        'name'        => 'User',
        'flag'        => 'position.user',
        'parent_flag' => 'position'
    ], 
    [
        'name' => 'Activities Logs',
        'flag' => 'audit-log.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'audit-log.destroy',
        'parent_flag' => 'audit-log.index'
    ], */
    [
        'name' => 'Users',
        'flag' => 'users.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'users.create',
        'parent_flag' => 'users.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'users.edit',
        'parent_flag' => 'users.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'users.destroy',
        'parent_flag' => 'users.index',
    ],

    [
        'name' => 'Roles',
        'flag' => 'roles.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'roles.create',
        'parent_flag' => 'roles.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'roles.edit',
        'parent_flag' => 'roles.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'roles.destroy',
        'parent_flag' => 'roles.index',
    ],
   /*  [
        'name' => 'General Master',
        'flag' => 'general-master.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'general-master.create',
        'parent_flag' => 'general-master.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'general-master.edit',
        'parent_flag' => 'general-master.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'general-master.destroy',
        'parent_flag' => 'general-master.index',
    ], */
   

    // PO permissions
    

];

<?php

return [
    [
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
    ],
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
    [
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
    ],
    [
        'name' => 'Customer/Vendor',
        'flag' => 'customer-vendor.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'customer-vendor.create',
        'parent_flag' => 'customer-vendor.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'customer-vendor.edit',
        'parent_flag' => 'customer-vendor.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'customer-vendor.destroy',
        'parent_flag' => 'customer-vendor.index',
    ],

    // PO permissions
    [
        'name' => 'Approval PO',
        'flag' => 'purchase-order.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'purchase-order.create',
        'parent_flag' => 'purchase-order.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'purchase-order.edit',
        'parent_flag' => 'purchase-order.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'purchase-order.destroy',
        'parent_flag' => 'purchase-order.index',
    ],
    [
        'name'        => 'Approve - Cancel',
        'flag'        => 'purchase-order.show',
        'parent_flag' => 'purchase-order.index',
    ],
    [
        'name' => 'Approval PO ANS',
        'flag' => 'purchase-order.ans.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'purchase-order.ans.create',
        'parent_flag' => 'purchase-order.ans.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'purchase-order.ans.edit',
        'parent_flag' => 'purchase-order.ans.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'purchase-order.ans.destroy',
        'parent_flag' => 'purchase-order.ans.index',
    ],
    [
        'name'        => 'Send SAP',
        'flag'        => 'purchase-order.ans.send-sap',
        'parent_flag' => 'purchase-order.ans.index',
    ],
    [
        'name' => 'Non-approval PO',
        'flag' => 'purchase-order.non-approval.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'purchase-order.non-approval.create',
        'parent_flag' => 'purchase-order.non-approval.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'purchase-order.non-approval.edit',
        'parent_flag' => 'purchase-order.non-approval.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'purchase-order.non-approval.destroy',
        'parent_flag' => 'purchase-order.non-approval.index',
    ],
    [
        'name'        => 'Send SAP',
        'flag'        => 'purchase-order.non-approval.send-sap',
        'parent_flag' => 'purchase-order.non-approval.index',
    ],
    [
        'name' => 'SO System',
        'flag' => 'sale-order.group',
    ],
    [
        'name'        => 'Listing',
        'flag'        => 'sale-order.index',
        'parent_flag' => 'sale-order.group',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'sale-order.create',
        'parent_flag' => 'sale-order.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'sale-order.edit',
        'parent_flag' => 'sale-order.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'sale-order.destroy',
        'parent_flag' => 'sale-order.index',
    ],
    [
        'name'        => 'Items SO',
        'flag'        => 'sale-order.items.index',
        'parent_flag' => 'sale-order.group',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'sale-order.items.create',
        'parent_flag' => 'sale-order.items.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'sale-order.items.edit',
        'parent_flag' => 'sale-order.items.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'sale-order.items.destroy',
        'parent_flag' => 'sale-order.items.index',
    ],
    [
        'name'        => 'Import SO',
        'flag'        => 'sale-order.import',
        'parent_flag' => 'sale-order.group',
    ],
    [
        'name'        => 'User Submit',
        'flag'        => 'sale-order.submit',
        'parent_flag' => 'sale-order.group',
    ],
    [
        'name'        => 'Send SAP',
        'flag'        => 'sale-order.sendToSap',
        'parent_flag' => 'sale-order.group',
    ],

    [
        'name' => 'Tariffs',
        'flag' => 'tariff.index'
    ],
    [
        'name'        => 'Create',
        'flag'        => 'tariff.create',
        'parent_flag' => 'tariff.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'tariff.edit',
        'parent_flag' => 'tariff.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'tariff.destroy',
        'parent_flag' => 'tariff.index',
    ],
];

<?php

return [
    'exclude_roles' => ['Client','Agents'],

    'status' => [
        '0' => 'Pending',
        '1' => 'Approved',
        '2' => 'Rejected',
    ],

    'user_status' => [
        '0' => 'In-Active',
        '1' => 'Active',
    ],

    'group_status' => [
        '0' => 'In-Active',
        '1' => 'Active',
    ],

    'sheet_status' => [
        '0' => 'In-Active',
        '1' => 'Published on live site',
    ],

    "system_role_permission_for" => [
        ""=>"Select",
        "Admin"=> "Admin",
        "Public"=> "Public",
    ],
];

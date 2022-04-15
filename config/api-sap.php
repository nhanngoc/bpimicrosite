<?php

return [
    "SAP" => [
        "URL"            => env("SAP_URL", 'http://10.68.0.72:50000/XISOAPAdapter/MessageServlet'),
        "USER"           => env("SAP_USER", 'piuser'),
        "PASSWORD"       => env("SAP_PASS", 'CJL_2017'),
        "SENDER_SERVICE" => env("SAP_SENDER_SERVICE", 'GMDWH_DEV'),
        "INTERFACE_PO"   => [
            "NAMESPACE"  => env("SAP_INTERFACE_NAMESPACE_PO", 'http://cj.net/MM'),
            "FORMAT_XML" => env("SAP_INTERFACE_PO", 'MM001_SO')
        ],
        "INTERFACE_SO"   => [
            "NAMESPACE"  => env("SAP_INTERFACE_NAMESPACE_SO", 'http://cj.net/FI'),
            "FORMAT_XML" => env("SAP_INTERFACE_SO", 'FI017_SO')
        ]
    ]
];

<?php

return [

    /*
    spec columns
    */
    'columns' => [
        'alpha' => [
            'rows' => ['description', 'email', 'name', 'slug'],
            'class' => 'fa fa-sort-alpha',
        ],
        'amount' => [
            'rows' => ['amount', 'price'],
            'class' => 'fa fa-sort-amount',
        ],
        'numeric' => [
            'rows' => ['created_at', 'updated_at', 'level', 'id', 'phone_number'],
            'class' => 'fa fa-sort-numeric',
        ],
    ],

    'enable_icons' => true,

    'default_icon_set' => 'fa fa-sort',

    'sortable_icon' => 'fa fa-sort',

    'clickable_icon' => false,

    'icon_text_separator' => ' ',

    'asc_suffix' => '-asc',

    'desc_suffix' => '-desc',

    'anchor_class' => null,

    'active_anchor_class' => null,

    'direction_anchor_class_prefix' => null,

    'uri_relation_column_separator' => '.',

    'formatting_function' => 'ucfirst',

    'format_custom_titles' => true,

    'inject_title_as' => null,

    'allow_request_modification' => true,

    'default_direction' => 'asc',

    'default_direction_unsorted' => 'asc',

    'default_first_column' => false,

    'join_type' => 'leftJoin',
];

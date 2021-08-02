<?php

return [
    'actions' => 'Actions',
    'user' => [
        'id' => 'No.',
        'name' => 'Name',
        'email' => 'Email',
        'avatar' => 'Avatar',
        'role' => 'Role',
        'password' => 'Password',
        'password_confirmation' => 'Confirmation password',
    ],
    'rolePermission' => [
        'id' => 'No.',
        'name' => 'Name',
        'description' => 'Description',
    ],
    'category' => [
		'id' => 'ID',
        'name' => 'Name',
	],
    'product' => [
		'id' => 'ID',
        'code' => 'Code',
        'name' => 'Name',
        'image' => 'Image',
        'description' => 'Description',
        'stock_in' => 'Stock in',
        'stock_out' => 'Stock out',
        'inventory' => 'Inventory',
        'price' => 'Price',
        'discount' => 'Discount',
        'status' => 'Status',
	],
    'color' => [
		'id' => 'ID',
        'name' => 'Name',
	],
    'size' => [
		'id' => 'ID',
        'name' => 'Name',
	],
    'product_payment' => [
		'id' => 'ID',
        'total' => 'Total',
        'price' => 'Price',
        'note' => 'Note',
	],
    'product_reject' => [
		'id' => 'ID',
        'total' => 'Total',
        'price' => 'Price',
        'note' => 'Note',
	],
    //{{LANG_TABLE_NOT_DELETE_THIS_LINE}}
    'texts' => [
        'count' => 'Showing {from} to {to} of {count} records|{count} records|One record',
        'first' => 'First',
        'last' => 'Last',
        'filter' => 'Filter:',
        'filterPlaceholder' => 'Search...',
        'limit' => 'Records:',
        'page' => 'Page:',
        'noResults' => 'No matching records',
        'filterBy' => 'Filter by {column}',
        'loading' => 'Loading...',
        'defaultOption' => 'Select {column}',
        'columns' => 'Columns',
    ],
];

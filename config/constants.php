<?php
return [
    'pagination' =>
    [
        'paginate' => 2,
    ],  
    'role' =>
    [
        'admin' => auth()->user()->type=0,
        'user' => auth()->user()->type=1,
    ]
];


<?php
return [
    'pagination' =>
    [
        'paginate' => 50,
    ],
    'role' =>
    [
        'admin' => auth()->user()->type = 0,
        'user' => auth()->user()->type = 1,
    ],
];

<?php

declare(strict_types=1);

namespace darkside666\lvarhivs;

require 'init.php';

use atk4\mastercrud\MasterCRUD;
use atk4\ui\Crud;
use atk4\ui\Header;


Header::addTo($app)->set('Companies');

/*
$mc = $app->add([
    MasterCRUD::class,
    //'ipp' => 5,
    //'quickSearch' => ['name'],
]);
$mc->setModel(
    new Model\Company($app->db),
    [
        'Registers' => [
            ['_crud' => [Crud::class, 'displayFields' => ['item', 'total']]],
        ],
    ]
);
*/

$crud = Crud::addTo($app);
$crud->setModel(new Model\Company($app->db));

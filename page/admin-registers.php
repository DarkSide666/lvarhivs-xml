<?php

declare(strict_types=1);

namespace darkside666\lvarhivs;

require 'init.php';

use atk4\ui\Crud;
use atk4\ui\Header;


Header::addTo($app)->set('Registers');

$crud = Crud::addTo($app);
$crud->setModel(new Model\Register($app->db));

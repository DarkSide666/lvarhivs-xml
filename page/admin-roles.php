<?php

declare(strict_types=1);

namespace darkside666\lvarhivs;

require 'init.php';

use atk4\login\RoleAdmin;
use atk4\ui\Header;


Header::addTo($app)->set('Roles');

$crud = RoleAdmin::addTo($app);
$crud->setModel(new Model\Role($app->db));

<?php

declare(strict_types=1);

namespace darkside666\lvarhivs;

require 'init.php';

use atk4\login\UserAdmin;
use atk4\ui\Header;


Header::addTo($app)->set('Users');
$app->add(new UserAdmin())
    ->setModel(new Model\User($app->db));

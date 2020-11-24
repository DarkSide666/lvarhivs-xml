<?php

declare(strict_types=1);

namespace darkside666\lvarhivs;

require 'init.php';

use atk4\ui\Crud;
use atk4\ui\Header;


if (!isset($_GET['id'])) {
    header('Location: ./index.php');
    exit;
}
$app->stickyGet('id');


$register = new Model\Register($app->db);
$register->load($_GET['id']);
Header::addTo($app)->set($register->getTitle());

$documents = $register->ref('Documents');
$crud = Crud::addTo($app);
$crud->setModel($documents);

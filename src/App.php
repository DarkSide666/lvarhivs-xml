<?php

declare(strict_types=1);

namespace darkside666\lvarhivs;

use atk4\core\ConfigTrait;
use atk4\data\Persistence;
use atk4\login\Acl;
use atk4\login\Auth;
use atk4\ui\Layout;

/**
 * Example implementation of your Authenticated application.
 */
class App extends \atk4\ui\App
{
    use ConfigTrait;

    /** @var Persistence */
    public $db;

    /** @var Auth */
    public $auth;

    /** @var string Project title */
    public $title = 'LV Arhīvs XML';

    protected function init(): void
    {
        parent::init();

        $this->initLayout([Layout\Admin::class]);

        // Load config
        $this->readConfig(__DIR__ . '/../config.php');

        // Connect database
        $this->db = Persistence::connect($this->getConfig('dsn'));

        // Enable authorization
        $this->auth = new Auth();
        $this->auth->setApp($this);

        $m = new Model\User($this->db);
        $this->auth->setModel($m);
        $this->auth->setAcl(new Acl(), $this->db);

        //$this->check(); // authorize

        // Add user menu
        if ($this->auth->isLoggedIn()) {
            $this->auth->addUserMenu();
        }



        // Construct menu
        $this->layout->menuLeft->addItem(['Dashboard', 'icon' => 'info'], ['index']);
        /*
        $this->layout->menuLeft->addItem(['Setup demo database', 'icon' => 'cogs'], ['admin-setup']);

        $g = $this->layout->menuLeft->addGroup(['Forms']);
        $g->addItem(['Sign-up form', 'icon' => 'edit'], ['form-register']);
        $g->addItem(['Login form', 'icon' => 'edit'], ['form-login']);
        $g->addItem(['Forgot password form', 'icon' => 'edit'], ['form-forgot']);
        */

        $g = $this->layout->menuLeft->addGroup(['Settings']);
        $g->addItem(['Users', 'icon' => 'users'], ['admin-users']);
        $g->addItem(['Roles', 'icon' => 'tasks'], ['admin-roles']);
    }
}

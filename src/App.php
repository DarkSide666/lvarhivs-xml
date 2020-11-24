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



        // Construct menu
        $this->layout->menuLeft->addItem(['Dashboard', 'icon' => 'info'], ['index']);

        $g = $this->layout->menuLeft->addGroup(['Settings']);
        $g->addItem(['Companies', 'icon' => 'building'], ['admin-companies']);
        $g->addItem(['Registers', 'icon' => 'table'], ['admin-registers']);
        $g->addItem(['Users', 'icon' => 'users'], ['admin-users']);
        $g->addItem(['Roles', 'icon' => 'tasks'], ['admin-roles']);

        $company = new Model\Company($this->db);
        foreach ($company as $_company) {
            $g = $this->layout->menuLeft->addGroup([$_company->getTitle()]);

            $register = $company->ref('Registers');
            foreach ($register as $_register) {
                $g->addItem([$_register->getTitle(), 'icon' => 'list'], ['register', 'id' => $_register->getId()]);
            }
        }
    }
}

<?php

declare(strict_types=1);

namespace darkside666\lvarhivs\Model;

use atk4\data\Model;

class Company extends Model
{
    public $table = 'company';
    public $caption = 'Iestāde';

    protected function init(): void
    {
        parent::init();

        $this->addField('name', ['required' => true]);
        $this->addField('reg_number', ['required' => true]);

        $this->hasMany('Registers', Register::class);
    }
}

<?php

declare(strict_types=1);

namespace darkside666\lvarhivs\Model;

use atk4\data\Model;

class Register extends Model
{
    public $table = 'register';
    public $caption = 'Reģistrs';

    protected function init(): void
    {
        parent::init();

        $this->hasOne('company_id', [Company::class, 'required' => true]);
        $this->addField('name', ['required' => true]);
        $this->addField('reg_id', ['required' => true]);

        $this->hasMany('Documents', Document::class);
    }
}

<?php

declare(strict_types=1);

namespace darkside666\lvarhivs\Model;

use atk4\data\Model;

class Author extends Model
{
    protected function init(): void
    {
        parent::init();

        $this->addField('name', ['required' => true, 'caption' => 'Nosaukums']);
    }
}

class Document extends Model
{
    public $table = 'document';
    public $caption = 'Dokuments';

    protected function init(): void
    {
        parent::init();

        $this->hasOne('register_id', [Register::class, 'required' => true]);

        $this->addField('npk', ['required' => false, 'caption' => 'NPK', 'ui' => ['editable' => false]]);
        $this->addField('group', ['required' => false, 'caption' => 'Grupa']);
        $this->addField('type', ['required' => false, 'caption' => 'Tips']);
        $this->addField('name', ['required' => true, 'caption' => 'Nosaukums']);
        $this->addField('doc_date', ['type' => 'date', 'required' => true, 'caption' => 'Datums']);
        $this->addField('reg_nr', ['required' => true, 'caption' => 'Reģ.numurs']);

        // Lietas sadaļa
        $this->addField('lietas_nr', ['required' => true, 'caption' => 'Lietas nr.']);
        $this->addField('gus_nr', ['required' => true, 'caption' => 'Glab.vien. uzsk.sar.nr']);
        $this->addField('gv_nr', ['required' => true, 'caption' => 'Glab.vien. npk.sarakstā']);

        $this->addField('sender_reg_nr', ['required' => false, 'caption' => 'Nosūtītāja reģ.numurs']);
        $this->addField('short_desc', ['required' => false, 'caption' => 'Īss apraksts']);

        $this->containsMany('author', [
            'model' => [Author::class],
            'caption' => 'Autori',
            'ui' => [
                'form' => [
                    \atk4\ui\Form\Control\Multiline::class,
                    'options' => [
                        'suiTable' => [
                            'compact' => 'very',
                            'size' => 'small'
                        ],
                    ],
                ],
            ],
        ]);

        $this->addField('reg_date', ['type' => 'date', 'required' => false, 'caption' => 'Reģistrācijas dat.']);
        $this->addField('sent_date', ['type' => 'date', 'required' => false, 'caption' => 'Nosūtīšanas dat.']);
        $this->addField('notes', ['type' => 'text', 'required' => false, 'caption' => 'Piezīmes']);

        $this->onHook(Model::HOOK_BEFORE_SAVE, function($m, $is_update){
            $m->set('npk', 666);
        /*
            if (!$is_update) {
                $npk = (clone $m)->ref('register_id')->action('fx', ['max', 'npk'])->getOne();
                $npk = $npk + 1;
                $m->set('npk', $npk);
            }
        */
        });

        $this->setOrder('npk');
    }
}

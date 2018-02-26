<?php

namespace Foo\Repositories;

class EloquentCarRepository extends AbstractEloquentRepository
{
    /**
     * Class du modèle
     *
     * @var string
     */
    protected $model = \Foo\Models\Car::class;

    /**
     * Class du bean
     *
     * @var string
     */
    protected $bean = \Foo\Beans\Car::class;
}

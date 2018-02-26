<?php

namespace Foo\Repositories;

use Foo\Contracts\CarRepository;

class EloquentCarRepository extends AbstractEloquentRepository implements CarRepository
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

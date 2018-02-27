<?php

namespace Foo\Beans;

class Car extends AbstractBean
{
    /**
     * Les attributs du bean
     *
     * @var array
     */
    protected $attributes = [
        'name' => null,
        'color' => null,
    ];

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';
}

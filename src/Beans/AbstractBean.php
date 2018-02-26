<?php

namespace Foo\Beans;

use Exception;
use Foo\Contracts\Bean;
use Illuminate\Support\Str;

abstract class AbstractBean implements Bean
{
    /**
     * Les attributs du bean
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Constructeur
     *
     * @param array $attrs
     */
    public function __construct(array $attrs = [])
    {
        foreach ($attrs as $key => $value) {
            $this->setAttribute($key, $value);
        }

        if (! in_array($this->getKeyName(), $attrs)) {
            $this->setAttribute($this->getKeyName(), null);
        }
    }

    /**
     * Retourne le nom de la clé primaire
     *
     * @return string
     */
    public function getKeyName()
    {
        return $this->primaryKey;
    }

    /**
     * Retourne la valeur de la clé primaire
     *
     * @return integer
     */
    public function getKey()
    {
        return $this->getAttribute($this->getKeyName());
    }

    /**
     * Magic setter
     *
     * @param string $key
     * @param mixed $value
     */
    public function __set($key, $value)
    {
        return $this->setAttribute($key, $value);
    }

    /**
     * Magic getter
     *
     * @param  string $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->getAttibute($key);
    }

    /**
     * Modifie la valeur du champ
     *
     * @param string $key
     * @param mixed $value
     */
    protected function setAttribute($key, $value)
    {
        $this->hasKey($key);

        if ($this->hasSetMutator($key)) {
            $method = 'set'.Str::studly($key).'Attribute';

            return $this->{$method}($value);
        }

        $this->attributes[$key] = $value;
    }

    /**
     * Retourne la valeur du champ
     *
     * @param  string $key
     * @return mixed
     */
    protected function getAttribute($key)
    {
        $this->hasKey($key);

        return $this->attributes[$key];
    }

    /**
     * Retourne la liste des attributs et leur valeur
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    public function toJson()
    {
        retunr json_encode($this->toArray());
    }

    /**
     * Détermine si la clé existe
     *
     * @param  string  $key
     * @throws \Exception
     * @return void
     */
    protected function hasKey($key)
    {
        $keys = array_keys($this->attributes) + [$this->getKeyName()];

        if (! in_array($key, $keys)) {
            throw new Exception("Unexpected attribute $key");
        }
    }

    /**
     * Détermine si une méthode de mutation existe pour le champ
     *
     * @param  string  $key
     * @return bool
     */
    protected function hasSetMutator($key)
    {
        return method_exists($this, 'set'.Str::studly($key).'Attribute');
    }
}

<?php

namespace Foo\Repositories;

use Exception;
use Foo\Contracts\Bean;
use Foo\Contracts\Repository;

class AbstractEloquentRepository implements Repository
{
    /**
     * Class du modèle
     *
     * @var string
     */
    protected $model;

    /**
     * Class du bean
     *
     * @var string
     */
    protected $bean;

    /**
     * Retourne une liste de bean
     *
     * @return \Foo\Contracts\Bean[]
     */
    public function all()
    {
        $models = $this->model()->get();

        return $models->map(
            function ($model) {
                return $this->makeBean($model->getAttributes());
            }
        )->toArray();
    }

    /**
     * Retourne un bean
     *
     * @param  integer $id
     * @return \Foo\Contracts\Bean
     */
    public function find($id)
    {
        $model = $this->model()->find($id);

        if (! $model) {
            throw new Exception("Model not found");
        }

        return $this->makeBean($model->getAttributes());
    }

    /**
     * Enregistre un bean
     *
     * @param  \Foo\Contracts\Bean $bean
     * @return void
     */
    public function save(Bean $bean)
    {
        $attrs = $bean->getAttributes();

        $exists = ! is_null($bean->getKey());

        if ($exists) {
            $model = $this->model()->find($bean->getKey());

            if (! $model) {
                throw new Exception("Model not found");
            }

            $model->update($attrs);
        } else {
            $model = $this->model()->newInstance($attrs);

            $model->save();
        }

        $model->save();
    }

    /**
     * Supprime un bean
     *
     * @param  \Foo\Contracts\Bean $bean
     * @return void
     */
    public function delete(Bean $bean)
    {
        $this->model()->delete($bean->getKey());
    }

    /**
     * Retourne un bean à partir d'attributs
     *
     * @param  array $attrs
     * @return \Foo\Contracts\Bean
     */
    protected function makeBean(array $attrs)
    {
        $class = $this->bean;

        return new $class($attrs);
    }

    /**
     * Retourne une instance du modèle
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function model()
    {
        return new $this->model;
    }
}

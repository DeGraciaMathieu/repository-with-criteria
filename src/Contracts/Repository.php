<?php

namespace Foo\Contracts;

interface Repository
{
    /**
     * Retourne une liste de bean
     *
     * @return \Foo\Contracts\Bean[]
     */
    public function all();

    /**
     * Retourne un bean
     *
     * @param  integer $id
     * @return \Foo\Contracts\Bean
     */
    public function find($id);

    /**
     * Enregistre un bean
     *
     * @param  \Foo\Contracts\Bean $bean
     * @return void
     */
    public function save(Bean $bean);

    /**
     * Supprime un bean
     *
     * @param  \Foo\Contracts\Bean $bean
     * @return void
     */
    public function delete(Bean $bean);
}

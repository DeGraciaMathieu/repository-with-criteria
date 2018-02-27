<?php

namespace Foo\Contracts;

interface Bean
{
    /**
     * Retourne la valeur de la clé primaire
     *
     * @return integer
     */
    public function getKey();

    /**
     * Retourne le nom de la clé primaire
     *
     * @return string
     */
    public function getKeyName();

    /**
     * Retourne la valeur d'un champ
     *
     * @param  string $key
     * @return mixed
     */
    public function getAttribute($key);

    /**
     * Modifie la valeur d'un champ
     *
     * @param string $key
     * @param mixed  $value
     */
    public function setAttribute($key, $value);

    /**
     * Retourne la liste des attributs et leur valeur
     *
     * @return array
     */
    public function getAttributes();
}

<?php

namespace App\Data;

class SearchData
{
    /**
     * @var string
     */
    public $q = '';

    /**
     * @var $auteur = []
     */
    public $auteur = [];

    /**
     * @var $categorie = []
     */
    public $categorie = [];

    /**
     * @var null/date
     */
    public $datePublicationMax;

    /**
     * @var null/date
     */
    public $datePublicationMin;
}

<?php

namespace Unrtech\BackOfficeBundle\Entity;

/**
 * The Class that regroup all the managed entities
 */
class Entities {

    /**
     * All of the managed entities
     *
     * @var array
     */
    private static $_ENTITIES = array(
        'UnrtechProductBundle:Product',
        'UnrtechProductBundle:Category',
        'UnrtechUserBundle:User',
        'UnrtechUserBundle:Address',
        'UnrtechUserBundle:UserGroup',
        'UnrtechUserBundle:User',
    );

    /**
     * Get all the managed entities
     * 
     * @return array
     */
    public static function getEntities() {
        return Entities::$_ENTITIES;
    }

}

?>

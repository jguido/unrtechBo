<?php

/**
 * Interface for making an Admin Controller
 */
interface ControllerAdmin {

    /**
     * Action that will list all the entities
     */
    public function listAction();

    /**
     * Action that will show the entity
     */
    public function showAction();

    /**
     * Action that will edit the entity
     */
    public function editAction();

    /**
     * Action that will delete the entity
     */
    public function deleteAction();

    /**
     * Return the name of the entity
     */
    public function getEntity();

}


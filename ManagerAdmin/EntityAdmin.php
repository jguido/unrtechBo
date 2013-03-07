<?php

namespace Unrtech\BackOfficeBundle\ManagerAdmin;

/**
 * Calss entityAdmin is made for adding informations for each entity in back office
 */
class EntityAdmin {

    /**
     * The headers
     *
     * @var array All the displayed headers
     */
    private $headers;

    /**
     * The labels
     *
     * @var array All the displayed labels
     */
    private $labels;

    /**
     * The inputs
     *
     * @var type All the displayed inputs in the form
     */
    private $inputs;

    public function __construct($headers, $labels, $inputs) {
        $this->headers = $headers;
        $this->labels = $labels;
        $this->inputs = $inputs;
    }

    /**
     * Get the headers
     * 
     * @return array
     */
    public function getHeaders() {
        return $this->headers;
    }

    /**
     * Get the labels
     * 
     * @return array
     */
    public function getLabels() {
        return $this->labels;
    }

    /**
     * Get the inputs
     * 
     * @return array
     */
    public function getInputs() {
        return $this->inputs;
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Dmcl\AppBundle\Twig\Extension;

/**
 * Description of CeilExtension
 *
 * @author dani
 */
class CeilExtension extends \Twig_Extension {

    public function getName() {
        return "ceil";
    }

    public function getFilters() {
        return array(
            'ceil' => new \Twig_Filter_Method($this, 'ceil'),
        );
    }

    function ceil($value) {
        $ceil = 0;
        if (is_numeric($value)) {
            $ceil=ceil($value/100);
        }
        return $ceil;
    }

}

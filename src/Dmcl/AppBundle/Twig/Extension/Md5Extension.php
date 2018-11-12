<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Dmcl\AppBundle\Twig\Extension;

/**
 * Description of ImagenesExtension
 *
 * @author dani
 */
class Md5Extension extends \Twig_Extension {

    public function getName() {
        return "md5";
    }

    public function getFilters() {
        return array(
            'md5' => new \Twig_Filter_Method($this, 'md5'),
        );
    }

    function md5($cadena) {

        return md5($cadena);
    }

  

}

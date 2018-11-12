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
class SlugExtension extends \Twig_Extension {

    public function getName() {
        return "slug";
    }

    public function getFilters() {
        return array(
            'slug' => new \Twig_Filter_Method($this, 'slug'),
        );
    }

    function slug($cadena) {
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $cadena);
        $slug = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $slug);
        $slug = strtolower(trim($slug, '-'));
        $slug = preg_replace("/[\/_|+ -]+/", '-', $slug);
        return $slug;
    }

}

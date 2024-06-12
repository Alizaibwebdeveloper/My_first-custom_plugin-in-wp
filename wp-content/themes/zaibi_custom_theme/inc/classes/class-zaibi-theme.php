<?php
    
/*

Boostraps the Theme.

@package Zaibi custom theme.



*/

namespace ZAIBI_CUSTOM_THEME\Inc;

use ZAIBI_CUSTOM_THEME\Inc\Traits\singelton;

class ZAIBI_THEME {

    use singelton;

    protected function __construct() {

        // load classes

        $this->setup_hooks();
    }

    protected function setup_hooks() {

        add_action ('wp_enque_scripts','zaibi_enque_scripts');
    }

    public function register_style(){

    }


    public function register_script(){


    }
}
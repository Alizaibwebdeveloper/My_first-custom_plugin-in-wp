<?php
    
/*

Boostraps the Theme.

@package Zaibi custom theme.



*/

namespace ZAIBI_CUSTOM_THEME\Inc;

use ZAIBI_CUSTOM_THEME\Inc\Traits\singleton;

class ZAIBI_THEME {

    use singleton;

    protected function init() {
        // Load classes.
        $this->setup_hooks();
    }

    protected function setup_hooks() {
        add_action('after_setup_theme', [$this, 'setup_theme']);
    }

    public function setup_theme() {
        add_theme_support('title-tag');
        add_theme_support('custom_logo',[
            
            'height' => 100,
            'width' => 100,
            'flex-height' => true,
            'flex-width' => true,
            'header-text' => ['site-title','site-description'],
            
            
        ]);
    }
}
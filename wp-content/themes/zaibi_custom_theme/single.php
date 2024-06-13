<?php
    /*

    Main template file.
    @package Ali zaib  custom theme.


    */ 
    

    get_header();

?>

    <div class="content">
        
     <?php
         
    esc_html_e('single post','zaibi_custom_theme');
     ?>

    </div>

    <?php

    get_footer();
    
    
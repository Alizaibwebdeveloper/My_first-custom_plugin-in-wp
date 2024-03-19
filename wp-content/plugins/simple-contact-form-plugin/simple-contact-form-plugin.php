<?php

 /*
 * Plugin Name:       Simple contact form plugin
 * Plugin URI:        https://example.com/plugins/first_plugin/
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 *  Description:       This is simple contact form plugin which is develop By Ali zaib(Professional wordpress developer)
 * Author:            Ali zaib(Wordpress developer)
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       simple contact form plugin 
 * Domain Path:       /languages
 */

 if(!defined('ABSPATH')){

    exit;
 }

 class SimpleContactForm {

    

    public function __construct() {

        // *********Create a custom Post type***********

        add_action('init', array($this, 'create_custom_post_type'));

        // ***********Add Assets************
        add_action('wp_enqueue_scripts',array($this, 'Load_assets'));

        // ********Add shortcode*********

        add_shortcode('contact_form', array($this, 'load_contact_form_shortcode'));

        // ********Add jquery*********

        add_action('wp_footer',array($this,'load_script'));

        // *********Register Rest Api


    add_action('rest_api_init',array($this,'register_rest_api'));

    }

    public function create_custom_post_type() {
        $args = array(
            'public' => true,
            'has_archive' => true,
            'supports' => array('title'),
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'capability_type' => 'post',
            'labels' => array(
                'name' => 'Contact Forms',
                'singular_name' => 'Contact Form Entry',
            ),
            'menu_icon' => 'dashicons-email',
        );

        register_post_type('simple_contact_form', $args);
    }

    public function load_assets() {
        wp_enqueue_style(
            'simple-contact-form',
            plugin_dir_url(__FILE__) . 'css/simple-contact-form.css', 
            array(),
            '1.0',
            'all'
        );

        wp_enqueue_script('simple-contact-form',
        plugin_dir_url(__FILE__). 'js/simple-contact-form.js',
        array('jquery'),
        '1.0',
        true);
        

      
    }

    public function load_contact_form_shortcode()
{?>

<div class="simple-contact-form col-md-6 m-auto">

<h1>Send Us An email</h1>
<p>Please Fill the Below form</p>

<form id="simple-contact-form" >
  <div class="form-group">
      </div>
      <input type="text" name="name" placeholder="Enter your name" class="form-control mb-3">

    <div class="form-group">
    <input type="email" name="email" placeholder="Enter your email" class="form-control mb-3">
    </div>

    <div class="form-group">
    <input type="tel" name="phone" placeholder="Enter your phone" class="form-control mb-3">
    
    </div>


    <div class="form-group">

    <textarea placeholder="Type your message" name="message" class="mb-3" ></textarea>
    </div>

    <div class="form-group">
    <button type="submit" class="btn btn-success btn-block mb-3 ">Send Message</button>

    </div>

    </form>
    </div>
<?php }
    

    public function load_script()
    {?>
    
    <script>

        var nonce ='<?php echo wp_create_nonce('wp_rest');?>'


    jQuery('#simple-contact-form').submit(function(event){
     event.preventDefault();
     var form = $(this).serialize;
     console.log(form);
        alert('submitted');

        $.ajax({

            url: '<?php echo esc_url_raw(rest_url()); ?>',
          method: 'POST',
       headers: {
       'X-WP-Nonce': nonce
   },
    data: form

            //  success: function(data){
            //     console.log(data);
            //     alert('submitted');
            //  }
        })

    });
    </script>
    
    <?php }

    public function register_rest_api(){

      register_rest_route('simple-contact-form/v1', '/send-email', array(
     'methods'  => 'POST',
        'callback' => array($this, 'handle_contact_form'),
        'permission_callback' => array($this, 'permission_callback'),
      ));

      
    }
    public function handle_contact_form($data){

        $data = $data->get_json_params();
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $message = $data['message'];
}

 }

new SimpleContactForm();


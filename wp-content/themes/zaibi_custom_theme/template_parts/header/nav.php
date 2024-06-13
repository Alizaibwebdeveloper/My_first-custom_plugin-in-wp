<?php
/*
 Header Navigation Template
@package Ali zaib custom theme
*/
?>

<?php
// Get the menu ID for the 'zaibi_header-menu' location
$header_menu_id = get_menu_id('zaibi_header-menu');

// Retrieve the menu items for the given menu ID
$header_menu = wp_get_nav_menu_items($header_menu_id);
?>

<nav class="navbar navbar-expand-lg navbar-light bg-dark">
  <!-- Display the custom logo if it exists -->
  <a class="navbar-brand" href="#">
    <?php if (has_custom_logo()) : ?>
      <div class="site-logo">
        <?php the_custom_logo(); ?>
      </div>
    <?php endif; ?>
  </a>
  
  <!-- Navbar toggler button for collapsing the menu on smaller screens -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <?php 
    // Check if the header menu is not empty and is an array
    if (!empty($header_menu) && is_array($header_menu)) : ?>
      <ul class="navbar-nav mr-auto">
        <?php 
        // Loop through each menu item
        foreach ($header_menu as $menu_item) : 
          // Check if the menu item has no parent (i.e., it is a top-level item)
          if (!$menu_item->menu_item_parent) : 
            // Get the child menu items for the current menu item
            $child_menu_items = get_child_menu_items($header_menu, $menu_item->ID);
            $has_children = !empty($child_menu_items) && is_array($child_menu_items);
        ?>
            <?php 
            // If the menu item has no children, display it as a regular nav item
            if (!$has_children) : ?>
              <li class="nav-item">
                <a class="nav-link text-white" href="<?php echo esc_url($menu_item->url); ?>">
                  <?php echo esc_html($menu_item->title); ?>
                </a>
              </li>
            <?php 
            // If the menu item has children, display it as a dropdown
            else : ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="<?php echo esc_url($menu_item->url); ?>" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php echo esc_html($menu_item->title); ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <?php 
                  // Loop through each child menu item and display it
                  foreach ($child_menu_items as $child_menu) : ?>
                    <a class="dropdown-item " href="<?php echo esc_url($child_menu->url); ?>">
                      <?php echo esc_html($child_menu->title); ?>
                    </a>
                  <?php endforeach; ?>
                </div>
              </li>
            <?php endif; ?>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
    
    <!-- Search form in the navbar -->
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

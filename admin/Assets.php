<?php
namespace CraftRoster\Admin;

/**
 * Class Assets
 * @package CraftRoster\Admin
 */
class Assets {
	
	public function __construct() {		
		add_action('admin_enqueue_scripts', [$this, 'craft_roster_enqueue_scripts'], 999);
	}
	
	public function craft_roster_enqueue_scripts()	{

        // Enqueue Styles
        wp_enqueue_style('craft-roster-admin', CRAFTROSTER_CSS . '/admin.css', [], CRAFTROSTER_VERSION);


        // Enqueue Scripts
        wp_enqueue_script('craft-roster-admin', CRAFTROSTER_JS . '/admin.js', ['jquery'], CRAFTROSTER_VERSION, true);
	}

}
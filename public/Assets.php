<?php
namespace CraftRoster\Public;

/**
 * Class Assets
 * @package CraftRoster\Frontend
 */
class Assets {
	
	public function __construct() {		
		add_action('wp_enqueue_scripts', [$this, 'craft_roster_enqueue_scripts']);
	}
	
	public function craft_roster_enqueue_scripts()	{

        // Enqueue Styles
        wp_enqueue_style('craft-roster-admin', CRAFTROSTER_CSS . '/front.css', [], CRAFTROSTER_VERSION);


        // Enqueue Scripts
        wp_enqueue_script('craft-roster-admin', CRAFTROSTER_JS . '/front.js', ['jquery'], CRAFTROSTER_VERSION, true);
	}

}
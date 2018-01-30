<?php
namespace Showplan;

require_once dirname(__FILE__) . '/../../showplan/includes/compiler.php';
require_once dirname(__FILE__) . '/../../showplan/includes/models/model.php';
require_once dirname(__FILE__) . '/../../showplan/includes/models/station.php';
require_once 'models/song.php';

use \Showplan\Models\Station;
use \Showplan\Models\Song;

// Init WordPress if we're including just this library. 
if (!defined('ABSPATH')) {

	define('SHORTINIT', true);
	define('ABSPATH', dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/');

	require_once ABSPATH . 'wp-load.php';

	if ($_GET['site_id']) {
		switch_to_blog($_GET['site_id']);
	}

	class Controller {
		public static $prefix;
	}

	Controller::$prefix = $wpdb->prefix . 'showplan_';

}

class SongData {

	public static function get_midnight ($opposite_days = 0) {
		$_ts = Compiler::invert_timestamp_localised(time(), get_option('timezone_string'));
		return $_ts - ($_ts % 86400) - 86400 * $opposite_days;
	}

	public function bootstrap () {
		$that = $this;

		add_shortcode( 'showplan-song-history', function ($atts) use ($that) {
			$atts = shortcode_atts(array('station' => 1, 'days' => 10, 'sustainer' => 1, 'images' => 1), $atts);

			\Showplan\Frontend::enqueue_script('showplan_front', plugins_url('js/tabs.js', dirname(__FILE__)), false);
			\Showplan\Frontend::enqueue_style('showplan_front', plugins_url('css/tabs.css', dirname(__FILE__)));
			
			return $_data;
		});

	}

	public function get_songs ($station_id) {
	
		return Song::between($_GET['start_time'], $_GET['end_time']);

	}	

}

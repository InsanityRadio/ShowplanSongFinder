<?php
namespace Showplan;

require_once dirname(__FILE__) . '/../../showplan/includes/controller.php';
require_once 'models/song.php';
require_once 'data.php';

use \Showplan\Models\Song;

/**
 * Controller manages all of the WordPress-specifics. 
 */
class SongController {
	
	public static $prefix;

	/**
	 * Make all necessary WordPress calls to do stuff
	 */
	public static function bootstrap ($FILE) {

		global $wpdb;
		self::$prefix = $wpdb->prefix . 'showplan_';

		$_data = new SongData();
		$_data->bootstrap();

		self::schedule_filter();
		self::schedule_widget_filter();
	}
	
	public static function schedule_widget_filter () {
		
		add_filter('showplan_schedule_widget_description', function ( $value, $show ) {
			
			if ($show->start_time < time()) {
				$url = add_query_arg(array(
					'start' => $show->start_time,
					'end' => $show->end_time
				), get_permalink());
				return $value . '</p><p><a href="' . $url . '">Songs Played</a>';
			}
			return $value;
		}, 10, 2);
		
	}

	public static function schedule_filter () {

		$__GET = array();
		if (($a = strpos($_SERVER['REQUEST_URI'], "?")) !== false) {
			parse_str(substr($_SERVER['REQUEST_URI'], $a + 1), $__GET);
		}

		add_filter('showplan_schedule_inject', function ( $value ) use ($__GET) {
		
			if (!isset($__GET['start']) || !isset($__GET['end'])) {
				return null;
			}
			
			$_songs = Models\Song::between($__GET['start'], $__GET['end']);
			$_data = '<h2>Song Finder</h2>';
			$_data .= '<h3>' . gmdate("j M Y H:i ", $__GET['start']) . ' - ' . gmdate("H:i", $__GET['end']) . '</h3>';
			$_data .= '<div class="showplan-tab showplan-songfinder-view">';
			$_tz = new \DateTimeZone(get_option('timezone_string'));

			foreach ($_songs as $_song) {
				$_ts = strtotime($_song->date);
				$_ts = Compiler::timestamp_to_future_localised($_ts, $_tz);
				$_data .= '<div class="showplan-show showplan-songfinder-song"><div>';
				$_data .= '<div>' . date('H:i:s', $_ts) . '</div>';
				$_data .= '<div></div>';
				$_data .= '<div><h3>' . $_song->raw_song . '</h3><p>' . $_song->raw_artist . '</p></div>';
				$_data .= '</div></div>';
			}

			$_data .= '</div>';
			return $_data;

		});

	}

}

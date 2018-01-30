<?php
namespace Showplan\Models;
//require_once 'model.php';

class Song extends Model {

	protected static $table_name = 'song_history';
	protected static $database;
	protected static $columns = ['id', 'date', 'log_hour', 'nerve_id', 'external_id', 'album_art', 'meta', 'raw_song', 'raw_artist', 'show_id', 'log_date'];

	public static function prefix () {
		return '';
	}

	public static function database () {
		
		if (!static::$database) {
			static::$database = new \wpdb(DB_USER, DB_PASSWORD, 'song_history', DB_HOST);
		}		

		return static::$database;

	}

	public static function between ($start, $end) {

		$start = date('Y-m-d H:i:s', $start);
		$end = date('Y-m-d H:i:s', $end);
		return self::where('log_date', $start, '>=')->where('log_date', $end, '<')->get();

	}
	
	public function get_show () {
		return $this->id != NULL ? Show::find($this->show_id) : $this->_data['show'];
	}

}

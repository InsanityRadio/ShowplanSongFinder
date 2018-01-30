<?php
require_once 'includes/data.php';
require_once dirname(__FILE__) . '/../showplan/includes/data.php';

$start = microtime(true);

$_station_id = $_GET['station_id'];
$_method = $_GET['method'];

$_data = new \Showplan\Data();
$_song_data = new \Showplan\SongData();

$_result = null;

if ($_station_id && $_method && substr($_method, 0, 4) == 'get_') {

	$_result = call_user_func_array(array($_song_data, $_method), [$_station_id]);

}

header('Content-Type: application/json');

echo json_encode(array(
	'station' => $_data->get_station($_station_id),
	'execute_time' => microtime(true) - $start,
	'body' => $_result));

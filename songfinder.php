<?php
/**
 * Plugin Name: Showplan Song Finder
 * Plugin URI: https://github.com/insanityradio/showplan/
 * Version: 0.1
 * Description: Add a song-finder widget that integrates nicely with Showplan
 * Author: Jamie Woods & Insanity Tech
 * Author URI: https://insanityradio.com
 * License: GPL2
 *
 * This program is GPL but; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of.
 */

defined ('ABSPATH') or exit;

require 'includes/controller.php';
use Showplan\SongController;

SongController::bootstrap(__FILE__);

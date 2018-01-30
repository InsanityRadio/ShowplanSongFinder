# <img src="https://raw.githubusercontent.com/InsanityRadio/OnAirController/master/doc/headphones_dark.png" align="left" height=48 /> Showplan Song Finder

## API

TBC. However as a proof of concept, you can currently visit the following URI to dump the next three shows:

`http://localhost:8080/wp-content/plugins/songfinder/api.php?method=get_upcoming&station_id=1`

The database is designed to allow non-complicated reading from anything capable of connecting to a MySQL server. See the `$prefix_compiled_times` table for more (start_time and end_time are always UTC, start_time_local is based on the WordPress site's timezone)

In WordPress you can access various data using short codes. Your theme needs to support shortcodes in widgets in order to use them in widgets.

`[showplan-now-title station=1]` Current show title

`[showplan-now-description station=1]` Current show description

`[showplan-now-hosts station=1]` Current show hosts

`[showplan-now-start station=1]` Current show start time (HH:II)

`[showplan-now-end station=1]` Current show end time (HH:II)

`[showplan-next-... station=1]` Same as above, but for the next show

`[showplan-schedule station=1 images=0 sustainer=1 days=7]` Render a full calendar widget on the frontend

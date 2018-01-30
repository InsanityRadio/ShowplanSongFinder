# <img src="https://raw.githubusercontent.com/InsanityRadio/OnAirController/master/doc/headphones_dark.png" align="left" height=48 /> Showplan SongFinder

Showplan SongFinder is an extension for ShowPlan. It allows you to see the track history.

At the moment, it will simply open a database connection to a database named `song_history` (sorry, shared hosting users!) and query the table `song_history`. This is how Insanity stores recently playing information - this comes from our data engine.

## API

TBC. However as a proof of concept, you can currently visit the following URI to dump the next three shows:

`http://localhost:8080/wp-content/plugins/songfinder/api.php?method=get_songs&station_id=1&start_time=1517140560&end_time=1517183767`


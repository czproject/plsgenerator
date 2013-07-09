PlsGenerator
============

``` php
<?php
$playlist = new Cz\PlsGenerator;

// add track (only $filename is required paramater)
$playlist->addTrack($filename, $title, $length);

// generate (print to page)
echo $playlist; // or echo $playlist->generate();

// or save playlist into file
$playlist->save('playlist.pls');
```


Dynamic online playlist
-----------------------

``` php
<?php
header('Content-type: ' . Cz\PlsGenerator::MIME_TYPE);
header('Content-Disposition: attachment; filename="music.pls"');

$playlist = new Cz\PlsGenerator;

// add tracks
$playlist->addTrack('track1.mp3', 'Oasis - The Masterplan');
$playlist->addTrack('track2.mp3', 'The Cranberries - Zombie');

// send to browser
echo $playlist;
```

-------------------------------------------------

License: New BSD License
<br>Author: Jan Pecha, http://janpecha.iunas.cz/


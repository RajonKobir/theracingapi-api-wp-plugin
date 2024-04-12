<?php

/**
 *  WordPress Shortcode
 */

 require_once 'all-racecards.php';

 add_shortcode('raceResultCreatorShortcode', 'raceResultCreator');

 require_once 'results-today.php';

 add_shortcode('resultsTodayShortcode', 'resultsToday');

 require_once 'results-by-date.php';

 add_shortcode('resultsByDateShortcode', 'resultsByDate');

 require_once 'search-horse-by-name.php';

 add_shortcode('searchHorseByNameShortcode', 'searchHorseByName');



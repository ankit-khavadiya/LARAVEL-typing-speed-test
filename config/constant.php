<?php

if (!defined('ASSET_VERSION'))
    define('ASSET_VERSION', '?v1.0.0');

if(!defined('ERROR_400'))
    define('ERROR_400','Bad request !');

if(!defined('ERROR_401'))
    define('ERROR_401','Session Expired: Please Log In Again !');

if(!defined('ERROR_403'))
    define('ERROR_403','Request forbidden or not permission !');

if(!defined('ERROR_500'))
    define('ERROR_500','Internal server error !');

// TYPING TEST
if (!defined('TEST_DURATIONS'))
    define('TEST_DURATIONS', [15, 30, 60, 120]);

if (!defined('DEFAULT_TEST_DURATION'))
    define('DEFAULT_TEST_DURATION', 60);

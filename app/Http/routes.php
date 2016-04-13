<?php

/**
 * Application Router Loader
 */

$files = File::allFiles(app_path() . '/Http/Routes');

foreach ($files as $file) {
    require $file;
}
<?php
 namespace UCSS\App; use UCSS\Speed\CSS; class Dashboard { public static function get_data() { $data = array(); $data['cache_data'] = CSS::get_cache_data(); return $data; } public static function add_notices() { } } 
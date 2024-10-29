<?php
 namespace UCSS\Speed; use UCSS\App\Config; use Wa72\Url\Url; use MatthiasMullie\Minify; class CSS { public static $cache_directory = "speedify-ucss"; public static $hostname; public static $mode; public static $default_include_patterns = array(); public static function init() { self::$hostname = parse_url(site_url(), PHP_URL_HOST); self::$mode = Config::get('speed_css','css_mode'); if((self::$mode == "enabled" || self::$mode == "stats" || self::$mode == "preview") && !is_admin()) { add_action( 'wp_enqueue_scripts', array(__CLASS__,'public_enqueue_scripts') ); } } public static function process_css( $array, $source_url, $post_id = null, $post_types = null ) { $lookup = array(); $cache_dir = self::get_cache_path_from_url($source_url); !is_dir($cache_dir) && mkdir($cache_dir, 0755, true); $urls = array_keys((array)$array); foreach($array AS $url=>$csstxt) { $minifier = new Minify\CSS($csstxt); $csstxt = $minifier->minify(); $csstxt = self::rewrite_absolute_urls($csstxt, $url); $original_filename = ($url); $new_filename = md5($csstxt) . ".css"; $cache_file_path = self::get_root_cache_path() . "/". $new_filename; if(!file_exists($cache_file_path)) { file_put_contents($cache_file_path, $csstxt); } $lookup[$original_filename] = $new_filename; } $data = array( 'lookup' => $lookup, 'source_url' => $source_url, 'post_id' => $post_id, 'post_types' => $post_types ); file_put_contents($cache_dir . "lookup.json", (string)json_encode($data)); if($post_id) { $post_object = get_post( $post_id ); self::remove_non_cache_purge_clean_hooks_from_post_updated(); do_action( 'post_updated', (int) $post_id, $post_object, $post_object ); } } private static function remove_non_cache_purge_clean_hooks_from_post_updated() { global $wp_filter; $pattern = '/cache|purge|clean/i'; if (isset($wp_filter['post_updated'])) { $hooks = $wp_filter['post_updated']; foreach ($hooks->callbacks as $priority => $functions) { foreach ($functions as $hook_key => $function) { $function_name = ''; if (is_string($function['function'])) { $function_name = $function['function']; } elseif (is_array($function['function'])) { $class_name = is_object($function['function'][0]) ? get_class($function['function'][0]) : $function['function'][0]; $method_name = $function['function'][1]; $function_name = $class_name . '::' . $method_name; } if (!preg_match($pattern, $function_name)) { remove_action('post_updated', $function['function'], $priority); } } } } } public static function rewrite_css($output) { if(self::$mode == "disabled") { return $output; } if(self::$mode == "preview" && !current_user_can( 'manage_options' )) { return $output; } $current_url = $_SERVER['REQUEST_URI']; if(function_exists('weglot_get_current_full_url')) { $current_url = weglot_get_current_full_url(); } $lookup_file = self::get_lookup_file( $current_url ); if(!file_exists($lookup_file)) { return $output; } $lookup = json_decode((string)file_get_contents($lookup_file)); $lookup = $lookup->lookup; if(is_object($lookup)) { $sheets = self::get_stylesheets($output); foreach($sheets[0] AS $key => $tag) { if(!isset($sheets[1][$key])) { continue; } $sheet_url = $sheets[1][$key]; $baseurl = Url::parse($sheet_url); $sheet_url_lookup = $baseurl->makeAbsolute($baseurl)->write(); $sheet_url_lookup = preg_replace("@^//@", isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https://' : 'http://', trim($sheet_url_lookup)); if(isset($lookup->$sheet_url_lookup)) { if(self::$mode == "stats") { $new_tag = str_replace("<link ","<link data-ucss-processed='true' ",$tag); } else { if($lookup->$sheet_url_lookup == md5("").".css") { $new_tag = ""; } else { $new_tag = str_replace($sheet_url,self::get_root_cache_url() . "/" . $lookup->$sheet_url_lookup,$tag); } } $output = str_replace($tag,$new_tag,$output); } } } return $output; } public static function public_enqueue_scripts() { $default_patterns = self::$default_include_patterns; $include_patterns = Config::get('speed_css','include_patterns'); if($include_patterns) { $include_patterns_array = explode("\n",$include_patterns); } else { $include_patterns_array = $default_patterns; } $include_pattern = json_encode($include_patterns_array); wp_enqueue_script( 'speed-css', UCSS_PLUGIN_URL . 'assets/speed_css/speed_css.min.js', array( 'jquery' ), UCSS_VER, true ); wp_localize_script( 'speed-css', 'speed_css_vars', array( 'cache_directory' => self::$cache_directory, 'include_patterns' => $include_pattern ) ); } public static function get_stylesheets($html) { $pattern = '/<link[^>]*\srel=[\'"]stylesheet[\'"][^>]*\shref=[\'"]([^\'"]+)[\'"][^>]*>/i'; preg_match_all($pattern, $html, $stylesheets); if(isset($stylesheets[0])) { return $stylesheets; } else { return array(); } } public static function get_lookup_file($url) { $file = self::get_cache_path_from_url($url) . "lookup.json"; return $file; } public static function get_cache_path_from_url($url) { $file_relative_path = parse_url($url, PHP_URL_PATH); $file_path = self::get_root_cache_path() . $file_relative_path; return $file_path; } public static function get_root_cache_path() { return ABSPATH . "wp-content/cache/".self::$cache_directory."/" . self::$hostname; } public static function get_root_cache_url() { return site_url() . "/wp-content/cache/".self::$cache_directory."/" . self::$hostname; } private static function rewrite_absolute_urls($content, $base_url) { $regex = '/url\(\s*[\'"]?([^\'")]+)[\'"]?\s*\)|@import\s+[\'"]([^\'"]+\.[^\s]+)[\'"]/'; $content = preg_replace_callback( $regex, function ($match) use ($base_url) { $match = array_values(array_filter($match)); $url_string = $match[0]; $relative_url = $match[1]; $absolute_url = Url::parse($relative_url); $absolute_url->makeAbsolute(Url::parse($base_url)); return str_replace($relative_url, $absolute_url, $url_string); }, $content ); return $content; } public static function get_relative_path($path) { $dir = self::get_root_cache_path(); $relativePath = str_replace($dir, '', $path); $relativePath = trim($relativePath, '/'); if($relativePath === '') { $relativePath = '/'; } return $relativePath; } public static function get_posttypes($types) { $types = (array)$types; foreach($types AS $key=>$value) { if(preg_match("@home|(-(template|id|child|parent))@",$value)) { unset($types[$key]); } } return array_values($types); } public static function get_master_data() { $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator(self::get_root_cache_path())); $pluginStats = []; $urlGroups = []; $totalPages = 0; $master_data = array(); foreach ($iterator as $file) { if ($file->isFile() && $file->getFilename() === 'lookup.json') { $allData = json_decode(file_get_contents($file->getPathname()), true); $post_types = (array)self::get_posttypes($allData['post_types']); $rootPath = self::get_relative_path($file->getPath()); if(in_array("single",$post_types)) { $rootPath = str_replace(basename($rootPath),"{slug}",$rootPath); } $master_data[$rootPath] = array(); $master_data[$rootPath]['post_types'] = $post_types; $master_data[$rootPath]['post_id'] = $allData['post_id']; $lookupData = $allData['lookup'] ?? []; foreach ($lookupData as $url => $cssFile) { $plugin = self::get_plugin_from_url($url); if($plugin == "unknown") { continue; } if (basename($cssFile) === md5("") . ".css") { if(isset($master_data[$rootPath]['empty'][$plugin])) { $master_data[$rootPath]['empty'][$plugin]['count']++; $master_data[$rootPath]['empty'][$plugin]['plugins'][] = basename($url); } else { $master_data[$rootPath]['empty'][$plugin]['count'] = 1; $master_data[$rootPath]['empty'][$plugin]['plugins'][] = basename($url); } } else { if(isset($master_data[$rootPath]['used'][$plugin])) { $master_data[$rootPath]['used'][$plugin]['count']++; $master_data[$rootPath]['used'][$plugin]['plugins'][] = basename($url); } else { $master_data[$rootPath]['used'][$plugin]['count'] = 1; $master_data[$rootPath]['used'][$plugin]['plugins'][] = basename($url); } } } } } ksort($master_data); return $master_data; } public static function get_all_plugins() { $pluginDirectory = WP_PLUGIN_DIR; $plugins = []; if (is_dir($pluginDirectory)) { $pluginDir = new \DirectoryIterator($pluginDirectory); foreach ($pluginDir as $fileinfo) { if ($fileinfo->isDir() && !$fileinfo->isDot() && substr($fileinfo->getFilename(), 0, 1) !== '_') { $dirname = $fileinfo->getFilename(); if(substr($dirname,0,1)!=".") { $plugins[] = $dirname; } } } } return $plugins; } private static function get_by_path($master_data) { $plugin_data = array(); foreach($master_data AS $path=>$data) { ksort($data['used']); ksort($data['empty']); $plugin_data[$path] = array("sortkey"=>$path, "found_urls"=>$data['used'], "empty_urls"=>$data['empty'], 'empty_css_count' => count($data['empty']), 'found_css_count' => count($data['used']), ); } return $plugin_data; } private static function get_by_plugin($master_data) { $plugin_data = array(); foreach($master_data AS $path=>$data) { foreach($data['used'] AS $plugin=>$count) { if(!isset($plugin_data[$plugin])) { $plugin_data[$plugin] = array('sortkey' => $plugin, 'empty_css_count' => 0, 'found_css_count' => 0, 'empty_urls' => [], 'found_urls' => [] ); } $plugin_data[$plugin]['found_css_count']++; $plugin_data[$plugin]['found_urls'][$path] = $count; } foreach($data['empty'] AS $plugin=>$count) { if(!isset($plugin_data[$plugin])) { $plugin_data[$plugin] = array('sortkey' => $plugin, 'empty_css_count' => 0, 'found_css_count' => 0, 'empty_urls' => [], 'found_urls' => [] ); } $plugin_data[$plugin]['empty_css_count']++; $plugin_data[$plugin]['empty_urls'][$path] = $count; } } $all_plugins = self::get_all_plugins(); foreach($all_plugins AS $plugin) { if(!isset($plugin_data[$plugin])) { $plugin_data[$plugin] = array('sortkey' => $plugin, 'empty_css_count' => 0, 'found_css_count' => 0, 'empty_urls' => [], 'found_urls' => [] ); } } ksort($plugin_data); return $plugin_data; } private static function get_by_posttype($master_data) { $plugin_data = array(); foreach($master_data AS $path=>$data) { $post_types = $data['post_types']; foreach($post_types AS $type) { if(!isset($plugin_data[$type]['empty_urls'])) { $plugin_data[$type] = array('sortkey' => $type, 'empty_css_count' => 0, 'found_css_count' => 0, 'empty_urls' => [], 'found_urls' => [] ); } $plugin_data[$type]['found_urls'] = ($plugin_data[$type]['found_urls'] + $data['used']); $plugin_data[$type]['empty_urls'] = ($plugin_data[$type]['empty_urls'] + $data['empty']); $plugin_data[$type]['empty_css_count'] = count($plugin_data[$type]['empty_urls']); $plugin_data[$type]['found_css_count'] = count($plugin_data[$type]['found_urls']); ksort($plugin_data[$type]['found_urls']); ksort($plugin_data[$type]['empty_urls']); } } return $plugin_data; } public static function get_stats_data() { $master_data = self::get_master_data(); $data['by_path'] = self::get_by_path($master_data); $data['by_plugin'] = self::get_by_plugin($master_data); $data['by_post_type'] = self::get_by_posttype($master_data); return [ 'plugin_stats' => $data, ]; } private static function get_root_path( $path ) { $parts = explode('/', trim($path, '/')); $return = $parts[0] . (count($parts) > 1 ? '/' : ''); if($return === '') { $return = '/'; } return $return; } public static function get_plugin_from_url($url) { $parsedUrl = parse_url($url); $path = $parsedUrl['path']; $pathParts = explode('/', $path); $pluginIndex = array_search('plugins', $pathParts); if ($pluginIndex !== false && isset($pathParts[$pluginIndex + 1])) { return $pathParts[$pluginIndex + 1]; } return 'unknown'; } public static function get_cache_data() { $dir = self::get_root_cache_path(); !is_dir($dir) && mkdir($dir, 0755, true); $cssFiles = glob($dir . '/*.css'); $cssFileCount = count($cssFiles); $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir)); $lookupFileCount = 0; foreach ($iterator as $file) { if ($file->isFile() && $file->getFilename() === 'lookup.json') { $lookupFileCount++; } } $data['num_css_files'] = $cssFileCount; $data['num_lookup_files'] = $lookupFileCount; return $data; } public static function clear_cache() { $dir = self::get_root_cache_path(); self::deleteAllFilesAndSubfolders($dir); if(defined('FLYING_PRESS_CACHE_DIR')) { self::deleteAllFilesAndSubfolders(FLYING_PRESS_CACHE_DIR); } } public static function deleteAllFilesAndSubfolders($dir) { if (!is_dir($dir)) { return; } $iterator = new \RecursiveIteratorIterator( new \RecursiveDirectoryIterator($dir, \RecursiveDirectoryIterator::SKIP_DOTS), \RecursiveIteratorIterator::CHILD_FIRST ); foreach ($iterator as $file) { if ($file->isDir()) { rmdir($file->getRealPath()); } else { unlink($file->getRealPath()); } } } } 
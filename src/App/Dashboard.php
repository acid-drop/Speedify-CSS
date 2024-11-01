<?php

namespace UCSS\App;

use UCSS\Speed\CSS;

/**
 * Handles the display of the UCSS dashboard. 
 * 
 * @package UCSS
 */
class Dashboard {


  /**
   * Returns data for the dashboard.
   *
   * @return array
   *
   */
  public static function get_data() {

    $data = array();
    $data['cache_data'] = CSS::get_cache_data();

    return $data;

  }

  /**
   * Displays admin notices 
   *
   *
   * @return void
   */
  public static function add_notices() {





  }



}

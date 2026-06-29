<?php

//add_action('init', 'create_tables_for_auto_translates', 1 );

function create_tables_for_auto_translates() {
  global $wpdb;
  
  //$create_tables = carbon_get_theme_option_lng('create_translate_tables');
  
  //if ($create_tables=='1')
  {
    $charset_collate = $wpdb->get_charset_collate();
    
    if($wpdb->get_var("SHOW TABLES LIKE '".TRANSLATE_ENTITIES_TABLE."'") != TRANSLATE_ENTITIES_TABLE)
    {
      $sql = "CREATE TABLE ".TRANSLATE_ENTITIES_TABLE." (
              id int NOT NULL AUTO_INCREMENT,
              lng_from varchar(2) DEFAULT NULL,
              lng_to varchar(2) DEFAULT NULL,
              entity_id varchar(255) DEFAULT 0,
              entity_type enum('post', 'term', 'theme_carbon', 'theme_static', 'menu') DEFAULT NULL,
              translate_strings text DEFAULT NULL,
              associations_strings text DEFAULT NULL,
              PRIMARY KEY (id),
              KEY lng_from (lng_from),
              KEY lng_to (lng_to),
              KEY entity_type (`entity_id`(191),`entity_type`)
              ) ".$charset_collate.";";
      require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
      dbDelta( $sql );
    }  

    if($wpdb->get_var("SHOW TABLES LIKE '".TRANSLATE_STRINGS_TABLE."'") != TRANSLATE_STRINGS_TABLE)
    {
      $sql = "CREATE TABLE ".TRANSLATE_STRINGS_TABLE." (
              id int NOT NULL AUTO_INCREMENT,
              lng_from varchar(2) DEFAULT NULL,
              lng_to varchar(2) DEFAULT NULL,
              source_text longtext COLLATE utf8mb4_bin DEFAULT NULL,
              fragments text DEFAULT NULL,
              PRIMARY KEY (id),
              KEY lng_from (lng_from),
              KEY lng_to (lng_to),
              KEY source_text (`source_text`(191))
              ) ".$charset_collate.";";
      require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
      dbDelta( $sql );
    }  

    if($wpdb->get_var("SHOW TABLES LIKE '".TRANSLATE_FRAGMENTS_TABLE."'") != TRANSLATE_FRAGMENTS_TABLE)
    {
      $sql = "CREATE TABLE ".TRANSLATE_FRAGMENTS_TABLE." (
              id int NOT NULL AUTO_INCREMENT,
              lng_from varchar(2) DEFAULT NULL,
              lng_to varchar(2) DEFAULT NULL,
              source_text longtext COLLATE utf8mb4_bin DEFAULT NULL,
              translate longtext COLLATE utf8mb4_bin DEFAULT NULL,
              translated int DEFAULT 0,
              resp_id varchar(255) DEFAULT NULL,
              updated_ts int DEFAULT 0,
              PRIMARY KEY (id),
              KEY lng_from (lng_from),
              KEY lng_to (lng_to),
              KEY translated (translated),
              KEY source_text (`source_text`(191)),
              KEY translate (`translate`(191)),
              KEY updated_ts (updated_ts)
             ) ".$charset_collate.";";
      require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
      dbDelta( $sql );
    }
    
    //carbon_set_theme_option('create_translate_tables', 0);
  }  
}

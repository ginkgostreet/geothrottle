<?php

return array(
  'geocode_daily_limit' => array(
    'group_name' => 'CiviCRM Preferences',
    'group' => 'mapping',
    'name' => 'geocode_daily_limit',
    'type' => 'Number',
    'default' => 2000,
    'add' => '4.6',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Geocoding Job Daily Limit',
    'help_text' => 'How many api requests is the background job limited to per day',
  ),
  'geocode_index' => array(
    'group_name' => 'CiviCRM Preferences',
    'group' => 'mapping',
    'name' => 'geocode_index',
    'type' => 'Number',
    'default' => 0,
    'add' => '4.6',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Geocoding Index',
    'help_text' => 'This is mostly for internal use and iterates based on moving through the contact database.',
  )
);
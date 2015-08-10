<?php

/**
 * Job.Geothrottle API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRM/API+Architecture+Standards
 */
function _civicrm_api3_job_geothrottle_spec(&$spec) {
}

/**
 * Job.Geothrottle API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_job_geothrottle($params) {
  $limit = civicrm_api3('Setting', 'getvalue', array(
    'name' => "geocode_daily_limit",
  ));

  if (!is_numeric($limit)) {
    throw new API_Exception('Could not fetch geocoding limit', 4);
  }

  $index = civicrm_api3('Setting', 'getvalue', array(
    'name' => "geocode_index",
  ));
  if (!is_numeric($index)) {
    throw new API_Exception('Could not fetch geocoding index', 5);
  }

  $result = civicrm_api3('Setting', 'create', array(
    'domain_id' => "current_domain",
    'geocode_index' => $index + $limit,
  ));
  if ($result['is_error'] != 0) {
    throw new API_Exception('Unable to update geocoding Index', 6);
  }

  $result = civicrm_api3('job', 'geocode', array(
    'geocoding' => 1,
    'parse' => 0,
    'start' => $index + 1,
    'end' => $index + $limit,
    'throttle' => 1,

  ));

  return civicrm_api3_create_success($result, $params, 'Job', 'Geothrottle');
}

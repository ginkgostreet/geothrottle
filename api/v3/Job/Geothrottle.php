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
  if (true) {


    //$dao =& CRM_Core_DAO::executeQuery($sql, $values);
    $limit = civicrm_api3('Setting', 'getvalue', array(
      'name' => "geocode_daily_limit",
    ));

    $index = civicrm_api3('Setting', 'getvalue', array(
      'name' => "geocode_index",
    ));

    $result = civicrm_api3('Setting', 'create', array(
      'domain_id' => "current_domain",
      'geocode_index' => $index + $limit,
    ));

    $result = civicrm_api3('job', 'geocode', array(
      'geocoding' => 1,
      'parse' => 0,
      'start' => $index + 1,
      'end' => $index + $limit,
      'throttle' => 1,

    ));

    return civicrm_api3_create_success($result, $params, 'Job', 'Geothrottle');
  } else {
    throw new API_Exception('`field_id, `sid` and `title` are required fields', 4);
  }
}

<?php

/**
 * Civicrmzapier.Submit API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC/API+Architecture+Standards
 */
function _civicrm_api3_civicrmzapier_Submit_spec(&$spec) {
  $spec['magicword']['api.required'] = 1;
}

/**
 * Civicrmzapier.Submit API will be called and executed by Civirules
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_civicrmzapier_Submit($params) {


    $returnValues = CRM_Zapiercivicrm_Survey::sendSurvey();

    return civicrm_api3_create_success($returnValues, $params, 'CiviRuleAction', 'submit');


}


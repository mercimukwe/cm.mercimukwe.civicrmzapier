<?php

require_once('CRM/Civicrmzapier/Zapier.php');

/**
 * Civicrmzapier.Submit API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC/API+Architecture+Standards
 */
function _civicrm_api3_civicrmzapier_Submit_spec(&$spec) {
 // $spec['contact_id']['api.required'] = 1;
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

    if(array_key_exists('id', $params)){


        $zapier = new CRM_Zapiercivicrm_Zapier();


        $zapier->config("https://zapier.com/hooks/catch/1212097/u90dpo/",
                                                 'api_key'
                                                ,"T3KxLDWdkJtND3P9" ,
                                                 30
                                                );

//        CRM_Core_Error::debug('this is what the object 11 has', $params);

        //We send the request from the parent class... we can do that from the child  class
        // CRM_Zapiercivicrm_Survey::sendSurvey();


        $zapier->sendRequest($params);

        // we get the response value to see if the request was sent
        $zapier->receiveResponse();


//        CRM_Core_Error::debug('return values in API ', $returnvals);
//        exit();

        //return civicrm_api3_create_success($returnValues, $params, 'NewEntity', 'NewAction');

    } else {

        throw new API_Exception('API call not successfull' .$params);
    }

}


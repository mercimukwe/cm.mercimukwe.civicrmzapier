<?php

Class CRM_CivirulesActions_Contribution_SurveyRequest extends CRM_Civirules_Action {


    public static $contributionDetails;

    public function getExtraDataInputUrl($ruleActionId) {
        return FALSE;
    }

    /**
     * method used to collect the data from the entity and stores in the $contributionDetail property
     * @param CRM_Civirules_TriggerData_TriggerData $triggerData
     *
     */

    public function processAction(CRM_Civirules_TriggerData_TriggerData $triggerData){

        self::$contributionDetails = $triggerData->getEntityData('Contribution');

    }

    // we now return the contribution details for usage by the generic Zapier class

    /**
     * @return $contributionDetails
     */
    public static function getContributionDetails()
    {
        return self::$contributionDetails;
    }

}

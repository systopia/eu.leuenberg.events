<?php
/*-------------------------------------------------------+
| SYSTOPIA CPCE Event Integration                        |
| Copyright (C) 2022 SYSTOPIA                            |
| Author: A. Bugey (bugey@systopia.de)                   |
+--------------------------------------------------------+
| This program is released as free software under the    |
| Affero GPL license. You can redistribute it and/or     |
| modify it under the terms of this license which you    |
| can read by viewing the included agpl.txt or online    |
| at www.gnu.org/licenses/agpl.html. Removal of this     |
| copyright header is strictly prohibited without        |
| written permission from the original author(s).        |
+--------------------------------------------------------*/

use Civi\RemoteParticipant\Event\GetParticipantFormEventBase as GetParticipantFormEventBase;
use Civi\RemoteParticipant\Event\ValidateEvent as ValidateEvent;
use CRM_Events_ExtensionUtil as E;

/**
 * Implements profile 'Council Session'
 */
class CRM_Remoteevent_RegistrationProfile_CouncilSession extends CRM_Remoteevent_RegistrationProfile
{

    // FIELD MAPPINGS

    const CONTACT_MAPPING = [
        'first_name'      => 'first_name',
        'last_name'       => 'last_name',
        'email'           => 'email',
        // ...
    ];

    /** @var string[] participant fields */
    const PARTICIPANT_MAPPING = [
        'arrival_date'    => 'participant_travelinfo.event_travelinfo_arrival_date',
        'arrival_time'    => 'participant_travelinfo.event_travelinfo_arrival_time',
        // ...
    ];



    /**
     * Get the human-readable name of the profile represented
     *
     * @return string label
     */
    public function getLabel()
    {
        // default is the internal name
        return E::ts("Council Session");
    }

    /**
     * Get the internal name of the profile represented
     *
     * @return string name
     */
    public function getName()
    {
        return 'CouncilSession';
    }

    /**
     * @param string $locale
     *   the locale to use, defaults to null (current locale)
     *
     * @return array field specs
     * @see CRM_Remoteevent_RegistrationProfile::getFields()
     *
     */
    public function getFields($locale = null)
    {
        $l10n = CRM_Remoteevent_Localisation::getLocalisation($locale);
        $fields = [
            'contact_base' => [
                'type' => 'fieldset',
                'name' => 'contact_base',
                'label' => $l10n->localise("Persönliche Daten"),
                'weight' => 10,
                'description' => '',
            ],
            'first_name' => [
                'name' => 'first_name',
                'type' => 'Text',
                'validation' => '',
                'weight' => 40,
                'required' => 1,
                'label' => $l10n->localise('Vorname'),
                'parent' => 'contact_base',
            ],
            'last_name' => [
                'name' => 'last_name',
                'type' => 'Text',
                'validation' => '',
                'weight' => 50,
                'required' => 1,
                'label' => $l10n->localise('Nachname'),
                'parent' => 'contact_base',
            ],
            'email' => [
                'name' => 'email',
                'type' => 'Text',
                'validation' => 'Email',
                'weight' => 90,
                'required' => 1,
                'label' => $l10n->localise('E-Mail'),
                'parent' => 'contact_base',
            ],
        ];

        // todo: add fields

        return $fields;
    }

    /**
     * This function will tell you which entity/entities the given field
     *   will relate to. It would mostly be Contact or Participant (or both)
     *
     * @param string $field_key
     *   the field key as used by this profile
     *
     * @return array
     *   list of entities
     */
    public function getFieldEntities($field_key)
    {
        if (key_exists($field_key, self::PARTICIPANT_MAPPING)) { // Syntax error, unexpected '[', expecting '(' on line 129
            return ['Participant'];
        } else {
            return ['Contact'];
        }
    }

    /**
     * Add the default values to the form data, so people using this profile
     *  don't have to enter everything themselves
     *
     * @param GetParticipantFormEventBase $resultsEvent
     *   the locale to use, defaults to null none. Use 'default' for current
     *
     */
    public function addDefaultValues(GetParticipantFormEventBase $resultsEvent)
    {
        if ($resultsEvent->getContactID()) {
            // get contact field list from that
            $field_list = array_flip(self::CONTACT_MAPPING);
            CRM_Events_CustomData::resolveCustomFields($field_list);

            // adn then use the generic function
            $this->addDefaultContactValues($resultsEvent, array_keys($field_list), $field_list);
        }
    }

    /**
     * Validate the profile fields individually.
     * This only validates the mere data types,
     *   more complex validation (e.g. over multiple fields)
     *   have to be performed by the profile implementations
     *
     * @param ValidateEvent $validationEvent
     *      event triggered by the RemoteParticipant.validate or submit API call
     */
    public function validateSubmission($validationEvent)
    {
        parent::validateSubmission($validationEvent);

        // validate that the parish matches the district
        $submission = $validationEvent->getSubmission();

        // todo: add our own validation like this:
//        if (!empty($submission['church_parish']) && !empty($submission['church_district'])) {
//            // the first 6 digits of the parish should match the district
//            if ($submission['church_district'] != substr($submission['church_parish'], 0, 6)) {
//                $l10n = $validationEvent->getLocalisation();
//                $validationEvent->addValidationError(
//                    'church_parish',
//                    $l10n->localise(
//                        "Diese Kirchengemeinde gehört nicht zum gewählten Kirchenkreis."
//                    )
//                );
//            }
//        }
    }


}

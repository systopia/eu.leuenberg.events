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
 * Implements profile 'Board Session'
 */
class CRM_Remoteevent_RegistrationProfile_BoardSession extends CRM_Remoteevent_RegistrationProfile
{

    // FIELD MAPPINGS

    const CONTACT_MAPPING = [
        'prefix'                 => 'prefix',
        'title '                 => 'title',
        'first_name'             => 'first_name',
        'last_name'              => 'last_name',
        'street_address'         => 'street_address',
        'supplemental_address_1' => 'supplemental_address_1',
        'supplemental_address_2' => 'supplemental_address_2',
        'postal_code'            => 'postal_code',
        'city'                   => 'city',
        'country'                => 'country',
        'email'                  => 'email',
        'phone'                  => 'phone',

    ];

    /** @var string[] participant fields */
    const PARTICIPANT_MAPPING = [
        'participation'              => 'participant_additional_info.participation',
        'preferred_language_1'       => 'participant_additional_info.preferred_language_1',
        'preferred_language_2'       => 'participant_additional_info.preferred_language_2',
        'remarks'                    => 'participant_additional_info.remarks',
        'arrival_date'               => 'participant_additional_info.arrival_date',
        'arrival_time'               => 'participant_additional_info.arrival_time',
        'arrival_place'              => 'participant_additional_info.arrival_place',
        'departure_date'             => 'participant_additional_info.departure_date',
        'departure_time'             => 'participant_additional_info.departure_time',
        'departure_place'            => 'participant_additional_info.departure_place',
        'first_meal'                 => 'participant_additional_info.first_meal',
        'last_meal'                  => 'participant_additional_info.last_meal',
        'accommodation'              => 'participant_additional_info.accommodation',
        'accompanying_person'        => 'participant_additional_info.accompanying_person',
        'special_diet_boolean'       => 'participant_additional_info.special_diet_boolean',
        'special_diet_text'          => 'participant_additional_info.special_diet_text',
        'confirmation_participation' => 'participant_additional_info.confirmation_participation',
    ];

    /**
     * Get the human-readable name of the profile represented
     *
     * @return string label
     */
    public function getLabel()
    {
        // default is the internal name
        return E::ts("Board Session");
    }

    /**
     * Get the internal name of the profile represented
     *
     * @return string name
     */
    public function getName()
    {
        return 'BoardSession';
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
            // 'general_information' => [
            //     'type' => 'fieldset',
            //     'name' => 'general_information',
            //     'label' => $l10n->localise("General"),
            //     'weight' => 10,
            //     'description' => '',
            // ],
            // 'participation' => [
            //     'name' => 'participation',
            //     'type' => 'Boolean',
            //     'validation' => '',
            //     'weight' => 40,
            //     'required' => 1,
            //     'label' => $l10n->localise('Participation'),
            //     'parent' => 'general_information',
            // ],

            'contact_base' => [
                'type' => 'fieldset',
                'name' => 'contact_base',
                'label' => $l10n->localise("Personal Data"),
                'weight' => 10,
                'description' => '',
            ],
            'prefix' => [
                'name' => 'prefix',
                'type' => 'Select',
                'validation' => '',
                'weight' => 90,
                'required' => 0,
                'options' => $this->getOptions('prefix', $locale),
                'label' => $l10n->localise('Prefix'),
                'parent' => 'contact_base',
            ],
            'title' => [
                'name' => 'title',
                'type' => 'Select',
                'validation' => '',
                'weight' => 100,
                'required' => 0,
                'options' => $this->getOptions('title', $locale),
                'label' => $l10n->localise('Title'),
                'parent' => 'contact_base',
            ],
            'first_name' => [
                'name' => 'first_name',
                'type' => 'Text',
                'validation' => '',
                'weight' => 110,
                'maxlength'   => 64,
                'required' => 1,
                'label' => $l10n->localise('First Name'),
                'parent' => 'contact_base',
            ],
            'last_name' => [
                'name' => 'last_name',
                'type' => 'Text',
                'validation' => '',
                'weight' => 120,
                'maxlength'   => 64,
                'required' => 1,
                'label' => $l10n->localise('Last Name'),
                'parent' => 'contact_base',
            ],
            'street_address' => [
                'name' => 'street_address',
                'type' => 'Text',
                'validation' => '',
                'weight' => 130,
                'maxlength'   => 96,
                'required' => 1,
                'label' => $l10n->localise('Street'),
                'parent' => 'contact_base',
            ],
            'supplemental_address_1' => [
                'name' => 'supplemental_address_1',
                'type' => 'Text',
                'validation' => '',
                'weight' => 140,
                'maxlength'   => 96,
                'required' => 1,
                'label' => $l10n->localise('Street'),
                'parent' => 'contact_base',
            ],
            'supplemental_address_2' => [
                'name' => 'supplemental_address_2',
                'type' => 'Text',
                'validation' => '',
                'weight' => 150,
                'maxlength'   => 96,
                'required' => 1,
                'label' => $l10n->localise('Street'),
                'parent' => 'contact_base',
            ],
            'postal_code' => [
                'name' => 'postal_code',
                'type' => 'Text',
                'validation' => '',
                'weight' => 160,
                'maxlength'   => 64,
                'required' => 1,
                'label' => $l10n->localise('Postal Code'),
                'parent' => 'contact_base',
            ],
            'email' => [
                'name' => 'email',
                'type' => 'Text',
                'validation' => 'Email',
                'weight' => 170,
                'maxlength'   => 254,
                'required' => 1,
                'label' => $l10n->localise('Email'),
                'parent' => 'contact_base',
            ],
            'phone' => [
                'name' => 'phone',
                'type' => 'Text',
                'validation' => '',
                'weight' => 180,
                'maxlength'   => 32,
                'required' => 1,
                'label' => $l10n->localise('Phone'),
                'parent' => 'contact_base',
            ],
            'preferred_language_1' => [
                'name' => 'preferred_language_1',
                'type' => 'Select',
                'validation' => '',
                'weight' => 190,
                'required' => 0,
                'options' => $this->getOptions('language_event', $locale),
                'label' => $l10n->localise('Preferred language 1'),
                'parent' => 'contact_base',
            ],
            'preferred_language_2' => [
                'name' => 'preferred_language_2',
                'type' => 'Select',
                'validation' => '',
                'weight' => 200,
                'required' => 0,
                'options' => $this->getOptions('language_event', $locale),
                'label' => $l10n->localise('Preferred language 2'),
                'parent' => 'contact_base',
            ],
            'remarks' => [
                'name' => 'remarks',
                'type'=> 'TextArea',
                'validation' => '',
                'weight' => 210,
                'maxlength'   => 255,
                'required' => 1,
                'label' => $l10n->localise('Remarks'),
                'parent' => 'contact_base',
            ],

            'travel_information' => [
                'type' => 'fieldset',
                'name' => 'travel_information',
                'label' => $l10n->localise("Travel Information"),
                'weight' => 20,
                'description' => '',
            ],
            'arrival_date' => [
                'name' => 'arrival_date',
                'type' => 'Date',
                'validation' => 'Date',
                'weight' => 220,
                'required' => 1,
                'label' => $l10n->localise('Date of arrival'),
                'parent' => 'travel_information',
            ],
            'arrival_time' => [
                'name' => 'arrival_time',
                'type' => 'Text',
                'validation' => '',
                'weight' => 230,
                'maxlength'   => 96,
                'required' => 1,
                'label' => $l10n->localise('Time of arrival'),
                'parent' => 'travel_information',
            ],
            'arrival_place' => [
                'name' => 'arrival_place',
                'type' => 'Text',
                'validation' => '',
                'weight' => 240,
                'maxlength'   => 255,
                'required' => 1,
                'label' => $l10n->localise('Place of arrival (e.g. airport, train station, hotel)'),
                'parent' => 'travel_information',
            ],
            'departure_date' => [
                'name' => 'departure_date',
                'type' => 'Date',
                'validation' => 'Date',
                'weight' => 250,
                'required' => 1,
                'label' => $l10n->localise('Date of departure'),
                'parent' => 'travel_information',
            ],
            'departure_time' => [
                'name' => 'departure_time',
                'type' => 'Text',
                'validation' => '',
                'weight' => 260,
                'maxlength'   => 96,
                'required' => 1,
                'label' => $l10n->localise('Time of departure'),
                'parent' => 'travel_information',
            ],
            'departure_place' => [
                'name' => 'departure_place',
                'type' => 'Text',
                'validation' => '',
                'weight' => 270,
                'maxlength'   => 255,
                'required' => 1,
                'label' => $l10n->localise('Place of departure (e.g. airport, train station, hotel)'),
                'parent' => 'travel_information',
            ],
            'first_meal' => [
                'name' => 'first_meal',
                'type' => 'Select',
                'validation' => '',
                'weight' => 280,
                'required' => 0,
                'options' => $this->getOptions('meals', $locale),
                'label' => $l10n->localise('First meal'),
                'parent' => 'travel_information',
            ],
            'last_meal' => [
                'name' => 'last_meal',
                'type' => 'Select',
                'validation' => '',
                'weight' => 290,
                'required' => 0,
                'options' => $this->getOptions('meals', $locale),
                'label' => $l10n->localise('Last meal'),
                'parent' => 'travel_information',
            ],

            'hotel_information' => [
                'type' => 'fieldset',
                'name' => 'hotel_information',
                'label' => $l10n->localise("Hotel"),
                'weight' => 30,
                'description' => '',
            ],
            'accommodation' => [
                'name' => 'accommodation',
                'type' => 'Select',
                'validation' => '',
                'weight' => 300,
                'required' => 1,
                'options' => $this->getOptions('accommodation', $locale),
                'label' => $l10n->localise('Accommodation'),
                'parent' => 'hotel_information',
            ],
            'accompanying_person' => [
                'name' => 'accompanying_person',
                'type' => 'Text',
                'validation' => '',
                'weight' => 310,
                'maxlength'   => 255,
                'required' => 1,
                'label' => $l10n->localise('Accompanying person - special needs'),
                'parent' => 'hotel_information',
            ],
            'special_diet_boolean' => [
                'name' => 'special_diet_boolean',
                'type' => 'Boolean',
                'validation' => '',
                'weight' => 320,
                'required' => 1,
                'label' => $l10n->localise('Special diet'),
                'parent' => 'hotel_information',
            ],
            'special_diet_text' => [
                'name' => 'special_diet_text',
                'type' => 'Text',
                'validation' => '',
                'weight' => 330,
                'maxlength'   => 255,
                'required' => 1,
                'label' => $l10n->localise('If yes, what?'),
                'parent' => 'hotel_information',
            ],

            'miscellaneous' => [
                'type' => 'fieldset',
                'name' => 'miscellaneous',
                'label' => $l10n->localise("Miscellaneous"),
                'weight' => 40,
                'description' => '',
            ],
            'confirmation_participation' => [
                'name' => 'confirmation_participation',
                'type' => 'Boolean',
                'validation' => '',
                'weight' => 340,
                'required' => 1,
                'label' => $l10n->localise('Confirmation of participation'),
                'parent' => 'miscellaneous',
            ],
        ];

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

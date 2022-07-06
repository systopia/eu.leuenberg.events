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

use CRM_Events_ExtensionUtil as E;

/**
 * Collection of upgrade steps.
 */
class CRM_Events_Upgrader extends CRM_Events_Upgrader_Base
{
    /**
     * Installer: create custom data structures
     */
    public function install()
    {
        $customData = new CRM_Events_CustomData(E::LONG_NAME);

        // option groups
        $customData->syncOptionGroup(E::path('resources/option_group_remote_registration_profiles.json'));

        // custom groups
        // todo: $customData->syncCustomGroup(E::path('resources/custom_group_event_additional.json'));
    }

//    public function upgrade_0003()
//    {
//        $customData = new CRM_Remoteevent_CustomData(E::LONG_NAME);
//        $customData->syncOptionGroup(E::path('resources/option_group_event_type.json'));
//        $customData->syncCustomGroup(E::path('resources/custom_group_contact_ekir.json'));
//        return true;
//    }

}

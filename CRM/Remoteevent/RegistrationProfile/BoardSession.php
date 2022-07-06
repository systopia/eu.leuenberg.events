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
class CRM_Remoteevent_RegistrationProfile_BoardSession extends CRM_Remoteevent_RegistrationProfile_CouncilSession
{
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
}

<?php
/**
 * @version $Id$
 -------------------------------------------------------------------------

 LICENSE

 This file is part of Behaviors plugin for GLPI.

 Behaviors is free software: you can redistribute it and/or modify
 it under the terms of the GNU Affero General Public License as published by
 the Free Software Foundation, either version 3 of the License, or
 (at your option) any later version.

 Behaviors is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 GNU Affero General Public License for more details.

 You should have received a copy of the GNU Affero General Public License
 along with Behaviors. If not, see <http://www.gnu.org/licenses/>.

 @package   behaviors
 @author    Remi Collet
 @copyright Copyright (c) 2010-2011 Behaviors plugin team
 @license   AGPL License 3.0 or (at your option) any later version
            http://www.gnu.org/licenses/agpl-3.0-standalone.html
 @link      https://forge.indepnet.net/projects/behaviors
 @link      http://www.glpi-project.org/
 @since     2011

 --------------------------------------------------------------------------
*/

class PluginBehaviorsGroup_Ticket {

   static function afterAdd(Group_Ticket $item) {
      global $DB, $LANG;

      //logDebug("PluginBehaviorsGroup_Ticket::afterAdd()", $item);
      $config = PluginBehaviorsConfig::getInstance();

      if ($config->getField('add_notif')) {
         if ($item->getField('type') == Ticket::ASSIGN) {
            $ticket = new Ticket();
            if ($ticket->getFromDB($item->getField('tickets_id'))) {
               NotificationEvent::raiseEvent('plugin_behaviors_ticketnewgrp', $ticket);
            }
         }
      }
   }
}
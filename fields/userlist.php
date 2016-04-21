<?php
/**
 * @author		Tobias Zulauf (http://www.jah-tz.de)
 * @copyright	Copyright (C) 2013 - 2016 Tobias Zulauf (jah-tz.de). All rights reserved.
 * @license		GNU General Public License, http://www.gnu.org/copyleft/gpl.html
 * @version		3-1
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

defined('JPATH_PLATFORM') or die;

JFormHelper::loadFieldClass('list');

/**
 * Field to load a drop down list of available user
 *
 * @since  3-1
 */
class JFormFieldUserList extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  3-1
	 */
	protected $type = 'UserList';

	/**
	 * Cached array of the users.
	 *
	 * @var    array
	 * @since  3-1
	 */
	protected static $options = array();

	/**
	 * Method to get the options to populate list
	 *
	 * @return  array  The field option objects.
	 *
	 * @since   3-1
	 */
	protected function getOptions()
	{
		// Hash for caching
		$hash = md5($this->element);

		if (!isset(static::$options[$hash]))
		{
			static::$options[$hash] = parent::getOptions();

			$options = array();

			$db = JFactory::getDbo();
			$query = $db->getQuery(true)
				->select('id AS value')
				->select('username AS text')
				->from('#__users')
				->group('id, username');
			$db->setQuery($query);

			try
			{
				$options = $db->loadObjectList();
			}
			catch (RuntimeException $e)
			{
				JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');
				$options = array();
			}

			static::$options[$hash] = array_merge(static::$options[$hash], $options);
		}

		return static::$options[$hash];
	}
}
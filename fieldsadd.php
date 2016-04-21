<?php
/**
 * @author      Tobias Zulauf (http://www.jah-tz.de)
 * @copyright   Copyright (C) 2013 - 2016 Tobias Zulauf (jah-tz.de). All rights reserved.
 * @license     GNU General Public License, http://www.gnu.org/copyleft/gpl.html
 * @version     3-1
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

defined('_JEXEC') or die;

/**
 * The Plugin Fields Add
 *
 * @since  3-1
 */
class plgContentFieldsAdd extends JPlugin
{
	/**
	 * The application object.
	 *
	 * @var    JApplicationBase
	 * @since  3-1
	 */
	protected $app;

	/**
	 * Load the language file on instantiation.
	 *
	 * @var    boolean
	 * @since  3-1
	 */
	protected $autoloadLanguage = true;

	/**
	 * Check on before display
	 *
	 * @param   string   $context  The context of the content being passed to the plugin
	 * @param   object   &$row     The article object
	 * @param   mixed    &$params  The article params
	 * @param   integer  $page     The 'page' number
	 *
	 * @return  mixed  void or true
	 * @since   3-1
	 */
	public function onContentBeforeDisplay($context, &$row, &$params, $page = 0)
	{
		// Hier möchte ich den wert abfragen. Sollte ja eigentlich im $params drinstehen oder?
	}

	/**
	 * Prepare form and add my field.
	 *
	 * @param   JForm  $form  The form to be altered.
	 * @param   mixed  $data  The associated data for the form.
	 *
	 * @return  boolean
	 *
	 * @since   3-1
	 */
	public function onContentPrepareForm($form, $data)
	{
		$option = $this->app->input->get('option');

		if ($option == 'com_content')
		{
			JForm::addFormPath(__DIR__ . '/forms');
			$form->loadFile('content', false);
		}

		return true;
	}
}

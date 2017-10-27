<?php
/**
 * ExpressionEngine Cookie Plugin (https://expressionengine.com)
 *
 * @link      https://expressionengine.com/
 * @copyright Copyright (c) 2016–2017, EllisLab, Inc. (https://ellislab.com)
 * @license   https://opensource.org/licenses/MIT MIT
 */

/**
 * EllisLab Cookie plugin class
 */
class Cookie {

	/*
	 * @var  string  The plugin return data, not used since this plugin requires a method
	 */
	public $return_data;

	/**
	 * Set Cookie value
	 *
	 * @access	public
	 * @return	void
	 */
	public function set()
	{
		$name = ee()->TMPL->fetch_param('name');
		$value = ee()->TMPL->fetch_param('value');
		$expire = ee()->TMPL->fetch_param('expire');

		ee()->input->set_cookie($name, $value, $expire);
	}

	// ----------------------------------------------------------------------

	/**
	 * Get Cookie value
	 *
	 * Runs XSS Clean by default, since this value is being output to a template
	 *
	 * @access	public
	 * @return	string
	 */
	public function get()
	{
		$name = ee()->TMPL->fetch_param('name');
		$sanitize = get_bool_from_string(ee()->TMPL->fetch_param('sanitize', 'yes'));

		$cookie = ee()->input->cookie($name, $sanitize);

		if (ee()->TMPL->fetch_param('htmlentities') !== 'no')
		{
			$cookie = (string) ee('Format')->make('Text', $cookie)->convertToEntities();
		}

		return $cookie;
	}

	// ----------------------------------------------------------------------

	/**
	 * Delete Cookie
	 *
	 * @access	public
	 * @return	void
	 */
	public function delete()
	{
		$name = ee()->TMPL->fetch_param('name');

		ee()->input->delete_cookie($name);
	}
}
// END CLASS

// EOF

<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 *
 * @category   Customer
 * @package    Clockworkgeek_Rememberme
 * @author     Daniel Deady <daniel@clockworkgeek.com>
 * @copyright  Copyright (c) 2010, Daniel Deady
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Clockworkgeek_Rememberme_Model_Cookie extends Mage_Core_Model_Cookie
{

	/**
	 * Set cookie
	 * Override period if asked to
	 *
	 * @param string $name The cookie name
	 * @param string $value The cookie value
	 * @param int $period Lifetime period
	 * @param string $path
	 * @param string $domain
	 * @param int|bool $secure
	 * @return Mage_Core_Model_Cookie
	 */
	public function set($name, $value, $period = null, $path = null, $domain = null, $secure = null, $httponly = null)
	{
		if (is_null($period)) {
			// use $_SESSION directly as session classes may not be initialised yet
			$session = ( isset($_SESSION['rememberme']) ? (bool)$_SESSION['rememberme'] : false );
			$login = Mage::app()->getRequest()->getPost('login');
			$rememberme = ( isset($login['rememberme']) ? (bool)$login['rememberme'] : false );
			$period = $session || $rememberme; // true = one year
		}
		return parent::set($name, $value, $period, $path, $domain, $secure, $httponly);
	}

	/**
	 * Add our flag on login
	 */
	public function setSessionRemembrance()
	{
		if (isset($_SESSION) && !isset($_SESSION['rememberme'])) {
			$login = Mage::app()->getRequest()->getPost('login');
			$_SESSION['rememberme'] = isset($login['rememberme']) && $login['rememberme'];
		}
	}

	/**
	 * Remove our flag on logout
	 */
	public function unsetSessionRemembrance()
	{
		if (isset($_SESSION['rememberme'])) unset($_SESSION['rememberme']);
	}

}


<?php

/**
 * Change the following URL based on your server configuration
 * Make sure the URL ends with a slash so that we can use relative URLs in test cases
 */
define('TEST_BASE_URL','http://vortex.virtual/index-test.php/');

/**
 * The base class for functional test cases.
 * In this class, we set the base URL for the test application.
 * We also provide some common methods to be used by concrete test classes.
 */
class WebTestCase extends CWebTestCase
{
	public static $browsers = array(
      	array(
	        'name'    => 'Firefox On Windows',
	        'browser' => '*firefox',
	        'host'    => '192.168.56.1',
    	),
 	);

	protected function setUp()
	{
		parent::setUp();
		//$this->setBrowser('*firefox');
		$this->setBrowserUrl(TEST_BASE_URL);
	}
}

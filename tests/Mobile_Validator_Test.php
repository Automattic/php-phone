<?php

namespace Automattic\Phone;

class Mobile_Validator_Test extends \PHPUnit_Framework_TestCase {
	public function testNormalize() {
		$mobile_validator = new Mobile_Validator();

		// Intentionally failing.
		$this->assertFalse(true);
	}
}

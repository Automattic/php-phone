<?php

namespace Automattic\Phone;

class Mobile_Validator_Test extends \PHPUnit_Framework_TestCase {
	private $mobile_validator;

	protected function setUp() {
		$this->mobile_validator = new Mobile_Validator();
	}

	public function test_input_parameter_1() {
		$number = '(852) 569-8900';
		$result = $this->mobile_validator->normalize( $number );
		$this->assertEmpty( $result );
	}

	public function test_input_parameter_2() {
		$number = '+1 (817) 569-8900';
		$result = array( '+18175698900', 'USA' );

		$this->assertEquals( $this->mobile_validator->normalize( $number ), $result );
	}

	public function test_input_parameter_3() {
		$number = '+852 6569-8900';
		$result = array( '+85265698900', 'HKG' );

		$this->assertEquals( $this->mobile_validator->normalize( $number ), $result );
	}

	public function test_input_parameter_4() {
		$number = '+852 6569-8900';
		$country = 'HKG';
		$result = ['+85265698900', 'HKG'];

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}
}

<?php

namespace Automattic\Phone;

class Mobile_Validator_Test extends \PHPUnit_Framework_TestCase {
	private $mobile_validator;

	protected function setUp() {
		$this->mobile_validator = new Mobile_Validator();
	}

	public function test_input_parameter_1() {
		$number = '(852) 569-8900';
		$expected = $this->mobile_validator->normalize( $number );
		$this->assertEmpty( $expected );
	}

	public function test_input_parameter_2() {
		$number = '+1 (817) 569-8900';
		$expected = array( '+18175698900', 'USA' );

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number ) );
	}

	public function test_input_parameter_3() {
		$number = '+852 6569-8900';
		$expected = array( '+85265698900', 'HKG' );

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number ) );
	}

	public function test_input_parameter_4() {
		$number = '+852 6569-8900';
		$country = 'HKG';
		$expected = array( '+85265698900', 'HKG' );

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_USA_phone_1() {
		$number = '(852) 569-8900';
		$country = '';
		$expected = array();

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_USA_phone_2() {
		$number = '+1 (817) 569-8900';
		$country = '';
		$expected = array( '+18175698900', 'USA' );

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_USA_phone_3() {
		$number = '+1 (817) 569-8900';
		$country = null;
		$expected = array( '+18175698900', 'USA' );

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_USA_phone_4() {
		$number = '2121234567';
		$country = '';
		$expected = array( '+12121234567', 'USA' );

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_USA_phone_5() {
		$number = '22-6569-8900';
		$country = '';
		$expected = array();

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_USA_phone_6() {
		$number = '22-5569-8900';
		$country = '';
		$expected = array( '+12255698900', 'USA' );

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_USA_phone_7() {
		$number = '+1 (817) 569-8900';
		$country = 'United States';
		$expected = array( '+18175698900', 'USA' );

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_USA_phone_8() {
		$number = '+1 (817) 569-8900';
		$country = 'United States ';
		$expected = array ( '+18175698900', 'USA' );

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_USA_phone_9() {
		$number = '+1 (817) 569-8900';
		$country = 'USA';
		$expected = array( '+18175698900', 'USA' );

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_USA_phone_10() {
		$number = '+1 (817) 569-8900';
		$country = 'USA ';
		$expected = array( '+18175698900', 'USA' );

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_USA_phone_11() {
		$number = '+1 (817) 569-8900';
		$country = 'US';
		$expected = array( '+18175698900', 'USA' );

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_USA_phone_12() {
		$number = '+1 (817) 569-8900';
		$country = ' US';
		$expected = array( '+18175698900', 'USA' );

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_USA_phone_13() {
		$number = '+1 (817) 569-8900';
		$country = 'HKG';
		$expected = array();

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_MEX_phone_1() {
		$number = '+52 1 762 100 9517';
		$country = null;
		$expected = array( '+5217621009517', 'MEX' );

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_MEX_phone_2() {
		$number = '+52 1 762 100 9517';
		$country = 'MEX';
		$expected = array( '+5217621009517', 'MEX' );

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_MEX_phone_3() {
		$number = '+52 1 762 100 9517';
		$country = 'USA';
		$expected = array();

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_MEX_phone_4() {
		$number = '+52 1 762 100 9517';
		$country = 'Mexico';
		$expected = array( '+5217621009517', 'MEX' );

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_MEX_phone_5() {
		$number = '+52 1 762 100 9517';
		$country = 'United States';
		$expected = array();

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_MEX_phone_6() {
		$number = '+52 62 100 9517';
		$country = null;
		$expected = array();

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_MEX_phone_7() {
		$number = '+52 62 100 9517';
		$country = 'MEX';
		$expected = array();

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_MEX_phone_8() {
		$number = '+52 62 100 9517';
		$country = 'USA';
		$expected = array();

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_MEX_phone_9() {
		$number = '+52 62 100 9517';
		$country = 'Mexico';
		$expected = array();

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_MEX_phone_10() {
		$number = '+52 62 100 9517';
		$country = 'United States';
		$expected = array();

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_MEX_phone_11() {
		$number = '52762 100 9517';
		$country = null;
		$expected = array();

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_MEX_phone_12() {
		$number = '762 100 9517';
		$country = 'MEX';
		$expected = array( '+527621009517', 'MEX' );

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_MEX_phone_13() {
		$number = '762 100 9517';
		$country = 'MEXINVALID';
		$expected = array();

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_MEX_phone_14() {
		$number = '762 100 9517';
		$country = 'Mexico';
		$expected = array( '+527621009517', 'MEX' );

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_MEX_phone_15() {
		$number = '762 100 9517';
		$country = 'Mexico Invalid';
		$expected = array();

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_HKG_phone_quick_test_1() {
		$number = '6123-6123';
		$country = 'HKG';
		$expected = array( '+85261236123', 'HKG' );

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_BRA_phone_quick_test_1() {
		$number = '+55 11 9 6123 1234';
		$country = 'BRA';
		$expected = array( '+5511961231234', 'BRA' );

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_BRA_phone_quick_test_2() {
		$number = '+55 11 6123 1234'; // as 9 is missing
		$country = 'BRA';
		$expected = array();

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_BRA_phone_quick_test_3() {
		$number = '+55 11 8 6123 1234'; // prefix must be 9 after area code
		$country = 'BRA';
		$expected = array();

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_BRA_phone_quick_test_4() {
		$number = '+55 69 8 6123 1234'; // we don't check prefix for area code 69
		$country = 'BRA';
		$expected = array( '+5569861231234', 'BRA' );

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_PRI_phone_quick_test_1() {
		$number = '+1-787-672-9999';
		$country = 'PRI';
		$expected = array( '+17876729999', 'PRI' );

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_PRI_phone_quick_test_2() {
		$number = '17876729999';
		$country = 'PRI';
		$expected = array( '+17876729999', 'PRI' );

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_PRI_phone_quick_test_3() {
		$number = '7876729999';
		$country = 'PRI';
		$expected = array( '+17876729999', 'PRI' );

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_RUS_phone_quick_test_1() {
		$number = '89234567890';// remove the 8, treat it as 9234567890
		$country = 'RUS';
		$expected = array( '+79234567890', 'RUS' );

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_RUS_phone_quick_test_2() {
		$number = '+79234567890';
		$country = 'RUS';
		$expected = array( '+79234567890', 'RUS' );

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_RUS_phone_quick_test_3() {
		$number = '+79234567890';
		$country = '';
		$expected = array( '+79234567890', 'RUS' );

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}
	public function test_RUS_phone_quick_test_4() {
		$number = '+70234567890';
		$country = 'RUS';
		$expected = array(); // as 0 is not a valid prefix, must be 9

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_RUS_phone_quick_test_5() {
		$number = '+79234567890';
		$country = 'USA';
		$expected = array();

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_THA_phone_quick_test_1() {
		$number = '0812345678'; // remove the leading 0
		$country = 'THA';
		$expected = array( '+66812345678', 'THA' );

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_THA_phone_quick_test_2() {
		$number = '0912345678'; // remove the leading 0
		$country = 'THA';
		$expected = array( '+66912345678', 'THA' );

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}

	public function test_THA_phone_quick_test_3() {
		$number = '812345678';
		$country = 'THA';
		$expected = array( '+66812345678', 'THA' );

		$this->assertEquals( $expected, $this->mobile_validator->normalize( $number, $country ) );
	}
}

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
		$result = array( '+85265698900', 'HKG' );

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_USA_phone_1() {
		$number = '(852) 569-8900';
		$country = '';
		$result = array();

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_USA_phone_2() {
		$number = '+1 (817) 569-8900';
		$country = '';
		$result = array( '+18175698900', 'USA' );

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_USA_phone_3() {
		$number = '+1 (817) 569-8900';
		$country = null;
		$result = array( '+18175698900', 'USA' );

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_USA_phone_4() {
		$number = '2121234567';
		$country = '';
		$result = array( '+12121234567', 'USA' );

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_USA_phone_5() {
		$number = '22-6569-8900';
		$country = '';
		$result = array();

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_USA_phone_6() {
		$number = '22-5569-8900';
		$country = '';
		$result = array( '+12255698900', 'USA' );

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_USA_phone_7() {
		$number = '+1 (817) 569-8900';
		$country = 'United States';
		$result = array( '+18175698900', 'USA' );

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_USA_phone_8() {
		$number = '+1 (817) 569-8900';
		$country = 'United States ';
		$result = array ( '+18175698900', 'USA' );

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_USA_phone_9() {
		$number = '+1 (817) 569-8900';
		$country = 'USA';
		$result = array( '+18175698900', 'USA' );

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_USA_phone_10() {
		$number = '+1 (817) 569-8900';
		$country = 'USA ';
		$result = array( '+18175698900', 'USA' );

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_USA_phone_11() {
		$number = '+1 (817) 569-8900';
		$country = 'US';
		$result = array( '+18175698900', 'USA' );

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_USA_phone_12() {
		$number = '+1 (817) 569-8900';
		$country = ' US';
		$result = array( '+18175698900', 'USA' );

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_USA_phone_13() {
		$number = '+1 (817) 569-8900';
		$country = 'HKG';
		$result = array();

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_MEX_phone_1() {
		$number = '+52 1 762 100 9517';
		$country = null;
		$result = array( '+5217621009517', 'MEX' );

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_MEX_phone_2() {
		$number = '+52 1 762 100 9517';
		$country = 'MEX';
		$result = array( '+5217621009517', 'MEX' );

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_MEX_phone_3() {
		$number = '+52 1 762 100 9517';
		$country = 'USA';
		$result = array();

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_MEX_phone_4() {
		$number = '+52 1 762 100 9517';
		$country = 'Mexico';
		$result = array( '+5217621009517', 'MEX' );

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_MEX_phone_5() {
		$number = '+52 1 762 100 9517';
		$country = 'United States';
		$result = array();

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_MEX_phone_6() {
		$number = '+52 62 100 9517';
		$country = null;
		$result = array();

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_MEX_phone_7() {
		$number = '+52 62 100 9517';
		$country = 'MEX';
		$result = array();

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_MEX_phone_8() {
		$number = '+52 62 100 9517';
		$country = 'USA';
		$result = array();

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_MEX_phone_9() {
		$number = '+52 62 100 9517';
		$country = 'Mexico';
		$result = array();

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_MEX_phone_10() {
		$number = '+52 62 100 9517';
		$country = 'United States';
		$result = array();

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_MEX_phone_11() {
		$number = '52762 100 9517';
		$country = null;
		$result = array();

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_MEX_phone_12() {
		$number = '762 100 9517';
		$country = 'MEX';
		$result = array( '+527621009517', 'MEX' );

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_MEX_phone_13() {
		$number = '762 100 9517';
		$country = 'MEXINVALID';
		$result = array();

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_MEX_phone_14() {
		$number = '762 100 9517';
		$country = 'Mexico';
		$result = array( '+527621009517', 'MEX' );

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_MEX_phone_15() {
		$number = '762 100 9517';
		$country = 'Mexico Invalid';
		$result = array();

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_HKG_phone_quick_test_1() {
		$number = '6123-6123';
		$country = 'HKG';
		$result = array( '+85261236123', 'HKG' );

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_BRA_phone_quick_test_1() {
		$number = '+55 11 9 6123 1234';
		$country = 'BRA';
		$result = array( '+5511961231234', 'BRA' );

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_BRA_phone_quick_test_2() {
		$number = '+55 11 6123 1234'; // as 9 is missing
		$country = 'BRA';
		$result = array();

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_BRA_phone_quick_test_3() {
		$number = '+55 11 8 6123 1234'; // prefix must be 9 after area code
		$country = 'BRA';
		$result = array();

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_BRA_phone_quick_test_4() {
		$number = '+55 69 8 6123 1234'; // we don't check prefix for area code 69
		$country = 'BRA';
		$result = array( '+5569861231234', 'BRA' );

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_PRI_phone_quick_test_1() {
		$number = '+1-787-672-9999';
		$country = 'PRI';
		$result = array( '+17876729999', 'PRI' );

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_PRI_phone_quick_test_2() {
		$number = '17876729999';
		$country = 'PRI';
		$result = array( '+17876729999', 'PRI' );

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_PRI_phone_quick_test_3() {
		$number = '7876729999';
		$country = 'PRI';
		$result = array( '+17876729999', 'PRI' );

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_RUS_phone_quick_test_1() {
		$number = '89234567890';// remove the 8, treat it as 9234567890
		$country = 'RUS';
		$result = array( '+79234567890', 'RUS' );

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_RUS_phone_quick_test_2() {
		$number = '+79234567890';
		$country = 'RUS';
		$result = array( '+79234567890', 'RUS' );

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_RUS_phone_quick_test_3() {
		$number = '+79234567890';
		$country = '';
		$result = array( '+79234567890', 'RUS' );

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}
	public function test_RUS_phone_quick_test_4() {
		$number = '+70234567890';
		$country = 'RUS';
		$result = array(); // as 0 is not a valid prefix, must be 9

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_RUS_phone_quick_test_5() {
		$number = '+79234567890';
		$country = 'USA';
		$result = array();

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_THA_phone_quick_test_1() {
		$number = '0812345678'; // remove the leading 0
		$country = 'THA';
		$result = array( '+66812345678', 'THA' );

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_THA_phone_quick_test_2() {
		$number = '0912345678'; // remove the leading 0
		$country = 'THA';
		$result = array( '+66912345678', 'THA' );

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}

	public function test_THA_phone_quick_test_3() {
		$number = '812345678';
		$country = 'THA';
		$result = array( '+66812345678', 'THA' );

		$this->assertEquals( $this->mobile_validator->normalize( $number, $country ), $result );
	}
}

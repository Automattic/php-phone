<?php

namespace Automattic\Phone;

class Mobile_Validator_Test extends \PHPUnit_Framework_TestCase {
	private $mobile_validator;

	protected function setUp() {
		$this->mobile_validator = new Mobile_Validator();
	}

	private function check_normalize( $test_data ) {
		foreach ( $test_data as $test_entry ) {
			$number   = $test_entry[0];
			$country  = $test_entry[1];
			$expected = $test_entry[2];
			$actual   = $this->mobile_validator->normalize( $number, $country );

			$this->assertEquals( $expected, $actual );
		}
	}

	private $data_test_input_parameter = array(
		array( '(852) 569-8900'   , null, array() ),
		array( '+1 (817) 569-8900', null, array( '+18175698900', 'USA' ) ),
		array( '+852 6569-8900'   , null, array( '+85265698900', 'HKG' ) ),
		array( '+852 6569-8900'   , 'HKG', array( '+85265698900', 'HKG' ) ),
	);

	public function test_input_parameter() {
		$this->check_normalize ( $this->data_test_input_parameter );
	}

	private $data_test_USA = array(
		array( '(852) 569-8900'   , ''               , array() ),
		array( '+1 (817) 569-8900', ''               , array( '+18175698900', 'USA' ) ),
		array( '+1 (817) 569-8900', null             , array( '+18175698900', 'USA' ) ),
		array( '2121234567'       , ''               , array( '+12121234567', 'USA' ) ),
		array( '22-6569-8900'     , ''               , array() ),
		array( '22-5569-8900'     , ''               , array( '+12255698900', 'USA' ) ),
		array( '+1 (817) 569-8900', 'United States'  , array( '+18175698900', 'USA' ) ),
		array( '+1 (817) 569-8900', 'United States ' , array( '+18175698900', 'USA' ) ),
		array( '+1 (817) 569-8900', 'USA'            , array( '+18175698900', 'USA' ) ),
		array( '+1 (817) 569-8900', 'USA '           , array( '+18175698900', 'USA' ) ),
		array( '+1 (817) 569-8900', 'US'             , array( '+18175698900', 'USA' ) ),
		array( '+1 (817) 569-8900', ' US'            , array( '+18175698900', 'USA' ) ),
		array( '+1 (817) 569-8900', 'HKG'            , array() ),
	);

	public function test_USA_phone() {
		$this->check_normalize ( $this->data_test_USA );
	}

	private $data_test_MEX = array(
		array( '+52 1 762 100 9517', null            , array( '+5217621009517', 'MEX' ) ),
		array( '+52 1 762 100 9517', 'MEX'           , array( '+5217621009517', 'MEX' ) ),
		array( '+52 1 762 100 9517', 'USA'           , array() ),
		array( '+52 1 762 100 9517', 'Mexico'        , array( '+5217621009517', 'MEX' ) ),
		array( '+52 1 762 100 9517', 'United States' , array() ),
		array( '+52 62 100 9517'   , null            , array() ),
		array( '+52 62 100 9517'   , 'MEX'           , array() ),
		array( '+52 62 100 9517'   , 'USA'           , array() ),
		array( '+52 62 100 9517'   , 'Mexico'        , array() ),
		array( '+52 62 100 9517'   , 'United States' , array() ),
		array( '52762 100 9517'    , null            , array() ),
		array( '762 100 9517'      , 'MEX'           , array( '+527621009517', 'MEX' ) ),
		array( '762 100 9517'      , 'MEXINVALID'    , array() ),
		array( '762 100 9517'      , 'Mexico'        , array( '+527621009517', 'MEX' ) ),
		array( '762 100 9517'      , 'Mexico Invalid', array() ),
	);

	public function test_MEX_phone() {
		$this->check_normalize ( $this->data_test_MEX );
	}

	private $data_test_HKG = array (
		array( '6123-6123', 'HKG', array( '+85261236123', 'HKG' ) ),
	);

	public function test_HKG_phone() {
		$this->check_normalize ( $this->data_test_HKG );
	}

	private $data_test_BRA = array(
		array( '+55 11 9 6123 1234', 'BRA', array( '+5511961231234', 'BRA' ) ),
		// as 9 is missing
		array( '+55 11 6123 1234'  , 'BRA', array() ),
		// prefix must be 9 after area code
		array( '+55 11 8 6123 1234', 'BRA', array() ),
		// we don't check prefix for area code 69
		array( '+55 69 8 6123 1234', 'BRA', array( '+5569861231234', 'BRA' ) ),
	);

	public function test_BRA_phone() {
		$this->check_normalize( $this->data_test_BRA );
	}

	private $data_test_PRI = array(
		array( '+1-787-672-9999', 'PRI', array( '+17876729999', 'PRI' ) ),
		array( '17876729999'    , 'PRI', array( '+17876729999', 'PRI' ) ),
		array( '7876729999'     , 'PRI', array( '+17876729999', 'PRI' ) ),
	);

	public function test_PRI_phone() {
		$this->check_normalize( $this->data_test_PRI );
	}

	private $data_test_RUS = array(
		// remove the 8, treat it as 9234567890
		array( '89234567890' , 'RUS', array( '+79234567890', 'RUS' ) ),
		array( '+79234567890', 'RUS', array( '+79234567890', 'RUS' ) ),
		array( '+79234567890', ''   , array( '+79234567890', 'RUS' ) ),

		// as 0 is not a valid prefix, must be 9
		array( '+70234567890', 'RUS', array() ),
		array( '+79234567890', 'USA', array() ),
	);
	public function test_RUS_phone() {
		$this->check_normalize( $this->data_test_RUS );
	}

	private $data_test_THA = array(
		// remove the leading 0
		array( '0812345678', 'THA', array( '+66812345678', 'THA' ) ),
		array( '0912345678', 'THA', array( '+66912345678', 'THA' ) ),
		array( '812345678' , 'THA', array( '+66812345678', 'THA' ) ),
	);

	public function test_THA_phone() {
		$this->check_normalize( $this->data_test_THA );
	}
}

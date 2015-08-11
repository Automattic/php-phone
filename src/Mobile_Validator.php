<?php

namespace Automattic\Phone;

require_once( __DIR__ . '/Iso3166.php' );

class Mobile_Validator {
	function normalize( $phone_number ) {
		return array( "", "" );
	}
}

<?php

namespace Automattic\Phone;

require_once( __DIR__ . '/Iso3166.php' );

class Mobile_Validator {
	private function get_iso3166_entry( $country_name ) {
		switch ( strlen( $country_name ) ) {
		case 0:
			return Iso3166::$data[0];

		case 2:
			foreach ( Iso3166::$data as $iso3166_entry ){
				if ( strtoupper( $country_name ) == $iso3166_entry["alpha2"] ) {
					return $iso3166_entry;
				}
			}

		case 3:
			foreach ( Iso3166::$data as $iso3166_entry ) {
				if ( strtoupper( $country_name ) == $iso3166_entry["alpha3"] ) {
					return $iso3166_entry;
				}
			}

		default:
			foreach ( Iso3166::$data as $iso3166_entry ) {
				if (strtoupper( $country_name ) == strtoupper( $iso3166_entry["country_name"] ) ) {
					return $iso3166_entry;
				}
			}
		}

		return null;
	}

	private function get_iso3166_by_phone( $phone ) {
	}

	private function validate_phone_iso3166( $phone, $iso3166_entry ) {
	}

	function normalize( $phone_number, $country ) {

		return array( "", "" );
	}
}

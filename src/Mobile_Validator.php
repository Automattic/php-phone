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

	private function get_iso3166_by_phone( $phone_number ) {
		foreach ( Iso3166::$data as $iso3166_entry ) {
			// comment originated from node-phone:
			// if the country doesn't have mobile prefixes (e.g. about 20 countries, like
			// Argentina), then return the first match, as we can do no better
			if ( empty( $iso3166_entry["mobile_begin_with"] ) ) {
				return $iso3166_entry;
			}

			foreach ( $iso3166_entry["phone_number_lengths"] as $number_length ) {
				$country_code = $iso3166_entry["country_code"];

				if ( preg_match( "/^$country_code/", $phone_number) &&
					 strlen( $phone_number ) == strlen( $country_code ) + $number_length ) {
					return $iso3166_entry;
				}

				// comment originated from node-phone:
				// it match.. but may have more than one result.
				// e.g. USA and Canada. need to check mobile_begin_with
				foreach ( $iso3166_entry["mobile_begin_with"] as $mobile_prefix ) {
					if ( preg_match( "/^$country_code$mobile_prefix/", $phone_number ) ) {
						return $iso3166_entry;
					}
				}
			}
		}

		return null;
	}

	private function validate_phone_iso3166( $phone, $iso3166_entry ) {
	}

	function normalize( $phone_number, $country ) {

		return array( "", "" );
	}
}

# php-phone
The PHP port of [node-phone](https://github.com/Automattic/node-phone).

# Test
We use [PHPUnit](https://phpunit.de/) for unit testing. 
After installing PHPUnit, execute the following command under the project root to launch the test suite:

```phpunit --bootstrap src/Mobile_Validator.php ./tests```

# References
[How to call abroad](http://www.howtocallabroad.com/codes.html)  
Read this to get a general knowledge about how to call abroad. 
Also, the following important terms: `country code`, `exit code`, `trunk code`.

[ITU E.164 Official Documentation](https://www.itu.int/rec/T-REC-E.164-201011-I/en)  
Reading of its **Annex A** section is recommended for the rule clarification.

[Telephone Numbering Plan from Wikipedia](https://en.wikipedia.org/wiki/Telephone_numbering_plan)  
Here is a cite that especially relevent:

> The International Telecommunication Union (ITU) has established a comprehensive numbering plan, designated E.164, for uniform interoperability of the networks of its member state or regional administrations. It is an open numbering plan, however, imposing a maximum length of 15 digits to telephone numbers. The standard defines a country calling code (country code) for each state or region which is prefixed to each national numbering plan telephone number for international destination routing.

[List of mobile phone number series by country](https://en.wikipedia.org/wiki/List_of_mobile_phone_number_series_by_country)  
This is the only organized table I found about prefixes of mobile phone number in different countries.
However, whether it is reliable is remained in questions.

[ISO 3166](http://www.iso.org/iso/home/standards/country_codes.htm)  
Note that the **country code of ISO3166** has nothing to do with the **country code of E.164**.
The former is internationally-recognized identifiers for countries, which can be:

* two letters (alpha-2)
* three letters (alpha-3)
* three digit numeric code (numeric-3)

For example, the country code of United States is **US** for alpha-2, **USA** for alpha-3, and **840** for numeric-3.

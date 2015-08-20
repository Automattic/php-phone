# php-phone
The PHP port of [node-phone](https://github.com/Automattic/node-phone).

# Input & Output

## Input

- `phone number`: The mobile phone number to be validated and be normalized.
- `country name` (optional): The name of the country which the given number should belong to. It can be the following three forms:
    * ISO3166 alpha-2 code
    * ISO3166 alpha-3 code
    * ISO3166 country name

For clarification of ISO-3166 terms, please check the **Reference** section below.

## Output

- Success: An array containing the following two elements
    - 0: **E.164-formated phone number**. I.e. **+(country code)(phone number)**
    - 1: **alpha3** code of the country
- Error: An empty array `array()`

# Algorithm

1. Search for the associated **ISO3166 identifiers and mobile number spec** entry. Denoted as **spec entry** in short in the following paragraphs.
    1. If a country name is given, use it to search for **spec entry**.
    1. If no country name is given while the phone number is prefixed with a **+** sign, search for **spec entry** by trying to match the **mobile prefixes** for each **spec entry**.
    1. If neither the two above, take it as USA.
    1. Note that the **spec entry** contains the following field:
        * ISO3166 alpha-2 code
        * ISO3166 alpha-3 code
        * ISO3166 country name
        * Possible mobile number prefixes
        * Possible mobile number lengths
1. Remove all non-digit characters in the **phone number**.
1. Apply location-specific preprocessing routines to the number. More specifically,
    * Remove all leading zeros except for **GAB**, **CIV** and **COG**.
        * [How to call GAB(Gabon)](http://www.howtocallabroad.com/gabon/)
        * [How to call CIV(Côte D'Ivoire)](http://www.howtocallabroad.com/ivory-coast/)
        * [How to call COG(Congo)](http://www.howtocallabroad.com/congo/)
    * If it is Russian number and begins with 89. Remove the 8. 
        *[See this thread](https://www.lonelyplanet.com/thorntree/forums/europe-eastern-europe-the-caucasus/russia/russian-mobile-number)
1. Validate the processed number via the **spec entry**
    * Check if the length is in the **possible mobile number lengths**.
    * Check if the number's prefix is in the **possible mobile number prefixes**.
1. If it is considered valid, return the final number as **+(country code)(proccessed number)** and the **alpha-3** code in the **spec entry**.

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

<?php
/*
 * Copyright (c) Ouzo contributors, http://ouzoframework.org
 * This file is made available under the MIT License (view the LICENSE file for more information).
 */
use Ouzo\Utilities\Strings;

class StringsTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldConvertUnderscoreToCamelCase()
    {
        //given
        $string = 'lannisters_always_pay_their_debts';

        //when
        $camelcase = Strings::underscoreToCamelCase($string);

        //then
        $this->assertEquals('LannistersAlwaysPayTheirDebts', $camelcase);
    }

    /**
     * @test
     */
    public function shouldPreserveCamelcaseInUnderscoreToCamelCase()
    {
        //given
        $string = 'lannistersAlways_pay_their_debts';

        //when
        $camelcase = Strings::underscoreToCamelCase($string);

        //then
        $this->assertEquals('LannistersAlwaysPayTheirDebts', $camelcase);
    }

    /**
     * @test
     */
    public function shouldConvertCamelCaseToUnderscore()
    {
        //given
        $string = 'LannistersAlwaysPayTheirDebts';

        //when
        $underscored = Strings::camelCaseToUnderscore($string);

        //then
        $this->assertEquals('lannisters_always_pay_their_debts', $underscored);
    }

    /**
     * @test
     */
    public function shouldConvertCamelCaseWithUnderscoreToUnderscore()
    {
        //given
        $string = 'LannistersAlwaysPay_Their_Debts';

        //when
        $underscored = Strings::camelCaseToUnderscore($string);

        //then
        $this->assertEquals('lannisters_always_pay_their_debts', $underscored);
    }

    /**
     * @test
     */
    public function shouldRemovePrefix()
    {
        //given
        $string = 'prefixRest';

        //when
        $withoutPrefix = Strings::removePrefix($string, 'prefix');

        //then
        $this->assertEquals('Rest', $withoutPrefix);
    }

    /**
     * @test
     */
    public function shouldRemovePrefixWhenStringIsEqualToPrefix()
    {
        //given
        $string = 'prefix';

        //when
        $withoutPrefix = Strings::removePrefix($string, 'prefix');

        //then
        $this->assertEquals('', $withoutPrefix);
    }

    /**
     * @test
     */
    public function shouldRemovePrefixes()
    {
        //given
        $string = 'prefixRest';

        //when
        $withoutPrefix = Strings::removePrefixes($string, array('pre', 'fix'));

        //then
        $this->assertEquals('Rest', $withoutPrefix);
    }

    /**
     * @test
     */
    public function shouldReturnTrueIfStringStartsWithPrefix()
    {
        //given
        $string = 'prefixRest';

        //when
        $result = Strings::startsWith($string, 'prefix');

        //then
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function startsWithShouldReturnFalseForEmptyString()
    {
        //when
        $result = Strings::startsWith(null, 'prefix');

        //then
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function startsWithShouldReturnFalseForEmptyPrefix()
    {
        //when
        $result = Strings::startsWith('string', null);

        //then
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function shouldReturnFalseIfStringDoesNotStartWithPrefix()
    {
        //given
        $string = 'prefixRest';

        //when
        $result = Strings::startsWith($string, 'invalid');

        //then
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function shouldReturnTrueIfStringEndsWithPrefix()
    {
        //given
        $string = 'StringSuffix';

        //when
        $result = Strings::endsWith($string, 'Suffix');

        //then
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function shouldReturnFalseIfStringDoesNotEndWithPrefix()
    {
        //given
        $string = 'String';

        //when
        $result = Strings::endsWith($string, 'Suffix');

        //then
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function endsWithShouldReturnFalseForEmptyString()
    {
        //when
        $result = Strings::endsWith(null, 'prefix');

        //then
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function endsWithShouldReturnFalseForEmptyPrefix()
    {
        //when
        $result = Strings::endsWith('string', null);

        //then
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function shouldCheckEqualityIgnoringCase()
    {
        $this->assertTrue(Strings::equalsIgnoreCase('', ''));
        $this->assertTrue(Strings::equalsIgnoreCase('ABC123', 'ABC123'));
        $this->assertTrue(Strings::equalsIgnoreCase('ABC123', 'abc123'));
        $this->assertFalse(Strings::equalsIgnoreCase('ABC123', 'abc123a'));
        $this->assertFalse(Strings::equalsIgnoreCase('ABC123', 'abc1234'));
        $this->assertFalse(Strings::equalsIgnoreCase('', 'abc123'));
        $this->assertFalse(Strings::equalsIgnoreCase('ABC123', ''));
        $this->assertTrue(Strings::equalsIgnoreCase(null, ''));
        $this->assertTrue(Strings::equalsIgnoreCase('', null));
        $this->assertTrue(Strings::equalsIgnoreCase(null, null));
        $this->assertFalse(Strings::equalsIgnoreCase('null', null));
    }

    /**
     * @test
     */
    public function shouldRemovePartOfString()
    {
        //given
        $string = 'winter is coming???!!!';

        //when
        $result = Strings::remove($string, '???');

        //then
        $this->assertEquals('winter is coming!!!', $result);
    }

    /**
     * @test
     */
    public function shouldTableizeSimpleClassName()
    {
        //given
        $class = "Dragon";

        //when
        $table = Strings::tableize($class);

        //then
        $this->assertEquals("dragons", $table);
    }

    /**
     * @test
     */
    public function shouldTableizeMultipartClassName()
    {
        //given
        $class = "BigFoot";

        //when
        $table = Strings::tableize($class);

        //then
        $this->assertEquals("big_feet", $table);
    }

    /**
     * @test
     */
    public function shouldTableizeEmptyString()
    {
        //given
        $class = "";

        //when
        $table = Strings::tableize($class);

        //then
        $this->assertEquals("", $table);
    }

    /**
     * @test
     */
    public function shouldAppendSuffix()
    {
        //given
        $string = 'Daenerys';

        //when
        $stringWithSuffix = Strings::appendSuffix($string, ' Targaryen');

        //then
        $this->assertEquals('Daenerys Targaryen', $stringWithSuffix);
    }

    /**
     * @test
     */
    public function shouldAppendSuffixIfNecessary()
    {
        // when
        $modified = Strings::appendIfMissing('You know nothing, Jon Snow', ', Jon Snow');
        $original = Strings::appendIfMissing('You know nothing', ', Jon Snow');

        // then
        $this->assertEquals($original, 'You know nothing, Jon Snow');
        $this->assertEquals($modified, 'You know nothing, Jon Snow');
    }

    /**
     * @test
     */
    public function shouldAppendPrefixIfNecessary()
    {
        // when
        $original = Strings::prependIfMissing('Khal Drogo', 'Khal ');
        $modified = Strings::prependIfMissing('Drogo', 'Khal ');

        // then
        $this->assertEquals($original, 'Khal Drogo');
        $this->assertEquals($modified, 'Khal Drogo');
    }


    /**
     * @test
     */
    public function shouldEscapeNewLines()
    {
        //given
        $string = "My name is <strong>Reek</strong> \nit rhymes with leek";

        //when
        $escaped = Strings::escapeNewLines($string);

        //then
        $this->assertEquals("My name is &lt;strong&gt;Reek&lt;/strong&gt; <br />\nit rhymes with leek", $escaped);
    }

    /**
     * @test
     */
    public function shouldReturnTrueForObjectWithTheSameStringRepresentation()
    {
        $this->assertTrue(Strings::equal('123', 123));
        $this->assertTrue(Strings::equal(123, '123'));
    }

    /**
     * @test
     */
    public function shouldReturnFalseForObjectWithDifferentStringRepresentation()
    {
        $this->assertFalse(Strings::equal('0123', 123));
        $this->assertFalse(Strings::equal(123, '0123'));
    }

    /**
     * @test
     */
    public function shouldReturnFalseForNotBlankString()
    {
        $this->assertFalse(Strings::isBlank('0'));
        $this->assertFalse(Strings::isBlank('a '));
    }

    /**
     * @test
     */
    public function shouldReturnTrueForBlankString()
    {
        $this->assertTrue(Strings::isBlank(''));
        $this->assertTrue(Strings::isBlank(' '));
        $this->assertTrue(Strings::isBlank("\t\n\r"));
    }

    /**
     * @test
     */
    public function shouldTestIfStringIsNotBlank()
    {
        $this->assertTrue(Strings::isNotBlank('a '));
        $this->assertFalse(Strings::isNotBlank("\t\n\r"));
    }

    /**
     * @test
     */
    public function shouldAbbreviateString()
    {
        //given
        $string = 'ouzo is great';

        //when
        $abbreviated = Strings::abbreviate($string, 5);

        //then
        $this->assertEquals("ouzo ...", $abbreviated);
    }

    /**
     * @test
     */
    public function shouldNotAbbreviateStringShorterThanLimit()
    {
        //given
        $string = 'ouzo is great';

        //when
        $abbreviated = Strings::abbreviate($string, 13);

        //then
        $this->assertEquals($string, $abbreviated);
    }

    /**
     * @test
     */
    public function shouldConvertEntitiesWithUtfChars()
    {
        //given
        $string = '<strong>someting</strong> with ó';

        //when
        $entities = Strings::htmlEntities($string);

        //then
        $this->assertEquals('&lt;strong&gt;someting&lt;/strong&gt; with ó', $entities);
    }

    /**
     * @test
     */
    public function shouldConvertEntitiesWithInvalidChars()
    {
        //given
        $string = quoted_printable_decode('po=B3=B9czenie');

        //when
        $entities = Strings::htmlEntities($string);

        //then
        $this->assertNotEmpty($entities);
    }

    /**
     * @test
     */
    public function shouldTrimString()
    {
        //given
        $string = '  sdf ';

        //when
        $result = Strings::trimToNull($string);

        //then
        $this->assertEquals('sdf', $result);
    }

    /**
     * @test
     */
    public function shouldTrimStringToNull()
    {
        //given
        $string = '   ';

        //when
        $result = Strings::trimToNull($string);

        //then
        $this->assertNull($result);
    }

    /**
     * @test
     */
    public function shouldTrimNull()
    {
        //given
        $string = null;

        //when
        $result = Strings::trimToNull($string);

        //then
        $this->assertNull($result);
    }

    /**
     * @test
     */
    public function shouldAppendPrefix()
    {
        //given
        $string = 'Targaryen';

        //when
        $stringWithSuffix = Strings::appendPrefix($string, 'Daenerys ');

        //then
        $this->assertEquals('Daenerys Targaryen', $stringWithSuffix);
    }

    /**
     * @test
     */
    public function shouldSprintfStringWithAssocArrayAsParam()
    {
        //given
        $sprintfString = "This is %{what}! %{what}? This is %{place}!";
        $assocArray = array(
            'what' => 'madness',
            'place' => 'Sparta'
        );

        //when
        $resultString = Strings::sprintAssoc($sprintfString, $assocArray);

        //then
        $this->assertEquals('This is madness! madness? This is Sparta!', $resultString);
    }

    /**
     * @test
     */
    public function shouldSprintfStringAndReplaceWithEmptyIfNoPlaceholderFound()
    {
        //given
        $sprintfString = "This is %{what}! This is %{place}! No, this is invalid %{invalid_placeholder} placeholder!";
        $assocArray = array(
            'what' => 'madness',
            'place' => 'Sparta'
        );

        //when
        $resultString = Strings::sprintAssocDefault($sprintfString, $assocArray);

        //then
        $this->assertEquals('This is madness! This is Sparta! No, this is invalid  placeholder!', $resultString);
    }

    /**
     * @test
     */
    public function shouldCheckIsStringContainsSubstring()
    {
        //given
        $string = 'Fear cuts deeper than swords';

        //when
        $contains = Strings::contains($string, 'deeper');

        //then
        $this->assertTrue($contains);
    }

    /**
     * @test
     */
    public function shouldGetSubstringBeforeSeparator()
    {
        //given
        $string = 'winter is coming???!!!';

        //when
        $result = Strings::substringBefore($string, '?');

        //then
        $this->assertEquals('winter is coming', $result);
    }

    /**
     * @test
     */
    public function shouldReturnStringIfSeparatorNotFound()
    {
        //given
        $string = 'winter is coming';

        //when
        $result = Strings::substringBefore($string, ',');

        //then
        $this->assertEquals('winter is coming', $result);
    }

    /**
     * @test
     */
    public function shouldGetSubstringAfterSeparator()
    {
        //given
        $string = 'abc+efg+hij';

        //when
        $result = Strings::substringAfter($string, '+');

        //then
        $this->assertEquals('efg+hij', $result);
    }

    /**
     * @test
     */
    public function shouldReturnEmptyStringInSubstringAfterSeparatorWhenSeparatorIsAtTheEnd()
    {
        //given
        $string = 'abc+';

        //when
        $result = Strings::substringAfter($string, '+');

        //then
        $this->assertEquals('', $result);
    }

    /**
     * @test
     */
    public function shouldReturnStringInSubstringAfterSeparatorWhenSeparatorIsNotFound()
    {
        //given
        $string = 'abc';

        //when
        $result = Strings::substringAfter($string, '-');

        //then
        $this->assertEquals('abc', $result);
    }

    /**
     * @test
     */
    public function shouldReturnNullForNull()
    {
        //given
        $string = null;

        //when
        $result = Strings::substringBefore(null, ',');

        //then
        $this->assertNull($result);
    }

    /**
     * @test
     */
    public function shouldRemoveSuffix()
    {
        //given
        $string = 'JohnSnow';

        //when
        $withoutSuffix = Strings::removeSuffix($string, 'Snow');

        //then
        $this->assertEquals('John', $withoutSuffix);
    }

    /**
     * @test
     */
    public function shouldReplaceNthString()
    {
        //given
        $subject = 'name = ? AND description =    ?';

        //when
        $replaceNth = Strings::replaceNth($subject, '\\=\\s*\\?', 'IS NULL', 1);

        //then
        $this->assertEquals('name = ? AND description IS NULL', $replaceNth);
    }

    /**
     * @test
     */
    public function shouldRemoveAccents()
    {
        //given
        $string = 'String with śżźćółŹĘ ÀÁÂ';

        //when
        $removeAccent = Strings::removeAccent($string);

        //then
        $this->assertEquals('String with szzcolZE AAA', $removeAccent);
    }

    /**
     * @test
     */
    public function shouldUpperCaseFirstLetter()
    {
        //given
        $string = "łukasz";

        //when
        $uppercaseFirst = Strings::uppercaseFirst($string);

        //then
        $this->assertEquals('Łukasz', $uppercaseFirst);
    }

    /**
     * @test
     */
    public function shouldStartWithSecondIntegerParam()
    {
        //given
        $string = "48123";

        //when
        $startsWith = Strings::startsWith($string, 48);

        //then
        $this->assertTrue($startsWith);
    }

    /**
     * @test
     */
    public function shouldEndWithSecondIntegerParam()
    {
        //given
        $string = "1231";

        //when
        $endsWith = Strings::endsWith($string, 1);

        //then
        $this->assertTrue($endsWith);
    }
}

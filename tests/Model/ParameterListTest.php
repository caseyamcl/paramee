<?php
/**
 * Paramee Library
 *
 * @license http://opensource.org/licenses/MIT
 * @link https://github.com/caseyamcl/paramee
 * @package caseyamcl/paramee
 * @author Casey McLaughlin <caseyamcl@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE.md
 *  file that was distributed with this source code.
 *
 *  ------------------------------------------------------------------
 */

namespace Paramee\Model;

use DateTime;
use Paramee\ParamContext\ParamQueryContext;
use Paramee\PreparationStep\CallbackStep;
use PHPUnit\Framework\TestCase;

class ParameterListTest extends TestCase
{
    public function testConstructor(): void
    {
        $obj = new ParameterList('test');
        $this->assertInstanceOf(ParameterList::class, $obj);
    }

    public function testAddCsvValue(): void
    {
        $obj = new ParameterList('test');
        $obj->addCsvValue('test');
        $prepared = $obj->prepare(['test' => 'a,b,c']);
        $this->assertEquals(['a', 'b', 'c'], $prepared->getPreparedValue('test'));
    }

    public function testAddNumber(): void
    {
        $obj = new ParameterList('test');
        $obj->addNumber('test')->setAllowTypeCast(true);
        $prepared = $obj->prepare(['test' => '25.2']);
        $this->assertSame(25.2, $prepared->getPreparedValue('test'));
    }

    public function testAddUuidValue(): void
    {
        $obj = new ParameterList('test');
        $obj->addUuidValue('test');
        $prepared = $obj->prepare(['test' => 'e0959969-28d9-4572-9bf6-f970e4e9696e']);
        $this->assertSame('e0959969-28d9-4572-9bf6-f970e4e9696e', $prepared->getPreparedValue('test'));
    }

    public function testAddInteger(): void
    {
        $obj = new ParameterList('test');
        $obj->addInteger('test');
        $prepared = $obj->prepare(['test' => 12]);
        $this->assertSame(12, $prepared->getPreparedValue('test'));
    }

    public function testAddYesNoValue(): void
    {
        $obj = new ParameterList('test');
        $obj->addYesNoValue('test');
        $prepared = $obj->prepare(['test' => 'on']);
        $this->assertSame(true, $prepared->getPreparedValue('test'));
    }

    public function testAddDateValue(): void
    {
        $obj = new ParameterList('test');
        $obj->addDateValue('test');
        $prepared = $obj->prepare(['test' => '2019-05-12']);
        $this->assertSame('2019-05-12', $prepared->getPreparedValue('test')->format('Y-m-d'));
    }

    public function testAddBinaryValue(): void
    {
        $obj = new ParameterList('test');
        $obj->addBinaryValue('test');
        $prepared = $obj->prepare(['test' => '011011']);
        $this->assertSame('011011', $prepared->getPreparedValue('test'));
    }

    public function testAddDateTimeValue(): void
    {
        $obj = new ParameterList('test');
        $obj->addDateTimeValue('test');
        $prepared = $obj->prepare(['test' => '2017-07-21T17:32:28Z']);
        $this->assertSame(
            '2017-07-21T17:32:28+00:00',
            $prepared->getPreparedValue('test')->format(DateTime::RFC3339)
        );
    }


    public function testAddBoolean(): void
    {
        $obj = new ParameterList('test');
        $obj->addBoolean('test');
        $prepared = $obj->prepare(['test' => true]);
        $this->assertSame(true, $prepared->getPreparedValue('test'));
    }

    public function testAddByteValue(): void
    {
        $obj = new ParameterList('test');
        $obj->addByteValue('test');
        $prepared = $obj->prepare(['test' => base64_encode('test')]);
        $this->assertSame('test', $prepared->getPreparedValue('test'));
    }

    public function testAddAlphaNumericValue(): void
    {
        $obj = new ParameterList('test');
        $obj->addAlphaNumericValue('test');
        $prepared = $obj->prepare(['test' => 'abc123']);
        $this->assertSame('abc123', $prepared->getPreparedValue('test'));
    }

    public function testAddArray(): void
    {
        $obj = new ParameterList('test');
        $param = $obj->addArray('test');
        $param->setUniqueItems(true);
        $param->addPreparationStep(new CallbackStep(function (array $value) {
            return array_map('strtoupper', $value);
        }, 'convert to uppercase'));
        $this->assertSame(['A', 'B', 'C'], $param->prepare(['a','b', 'c']));
    }

    public function testAddObject(): void
    {
        // LEFT OFF HERE...
        $obj = new ParameterList('test', [], new ParamQueryContext());
        $param = $obj->addObject('test');
        $this->assertSame((object) ['a' => 'apple', 'b' => 'banana'], $param->prepare('a=apple,b=banana'));
    }

    public function testAddPasswordValue(): void
    {

    }

    public function testAdd(): void
    {

    }

    public function testAddString(): void
    {

    }

    public function testGetName(): void
    {

    }

    public function testGetParameters(): void
    {

    }

    public function testGetContext(): void
    {

    }

    public function testCount(): void
    {

    }

    public function testPrepareWithDefaults(): void
    {

    }

    public function testPrepareWithUndefinedValuesAndStrictIsTrue(): void
    {

    }

    public function testPrepareWithUndefinedValuesAndStrictIsFalse(): void
    {

    }

    public function testPrepareWithMissingRequiredValues(): void
    {

    }

    public function testGetApiDocumentationReturnsEmptyArrayWhenNoParametersAreAdded(): void
    {

    }

    public function testGetApiDocumentationReturnsExpectedValuesWhenParametersAreAdded(): void
    {

    }

    public function testGetIterator(): void
    {

    }
}

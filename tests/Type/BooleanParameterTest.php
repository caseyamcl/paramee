<?php

/**
 *  OpenApi-Params Library
 *
 *  @license http://opensource.org/licenses/MIT
 *  @link https://github.com/caseyamcl/openapi-params
 *  @package caseyamcl/openapi-params
 *  @author Casey McLaughlin <caseyamcl@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE.md
 *  file that was distributed with this source code.
 *
 *  ------------------------------------------------------------------
 */

namespace OpenApiParams\Type;

use OpenApiParams\AbstractParameterTestBase;
use OpenApiParams\Model\Parameter;

/**
 * Class BooleanParameterTest
 *
 * @author Casey McLaughlin <caseyamcl@gmail.com>
 */
class BooleanParameterTest extends AbstractParameterTestBase
{
    /**
     * @return array
     */
    protected static function getTwoOrMoreValidValues(): array
    {
        return [true, false];
    }


    /**
     * Return values that are not the correct type, but can be automatically type-cast if that is enabled
     *
     * @return array|mixed[]  Values for type cast check
     */
    protected static function getValuesForTypeCastTest(): array
    {
        return [1, '1', 0, '0'];
    }

    /**
     * @param string $name
     * @return Parameter
     */
    protected function buildInstance(string $name = 'test'): Parameter
    {
        return new BooleanParameter($name);
    }
}

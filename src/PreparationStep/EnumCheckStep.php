<?php
/**
 *  Paramee Library
 *
 *  @license http://opensource.org/licenses/MIT
 *  @link https://github.com/caseyamcl/paramee
 *  @author Casey McLaughlin <caseyamcl@gmail.com> caseyamcl/paramee
 *  @author Casey McLaughlin <caseyamcl@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE.md
 *  file that was distributed with this source code.
 *
 *  ------------------------------------------------------------------
 */

declare(strict_types=1);

namespace Paramee\PreparationStep;

use Paramee\Contract\PreparationStepInterface;
use Paramee\Exception\InvalidValueException;
use Paramee\Model\ParameterValues;

/**
 * Class EnumCheck
 *
 * @author Casey McLaughlin <caseyamcl@gmail.com>
 */
class EnumCheckStep implements PreparationStepInterface
{
    /**
     * @var array
     */
    private $allowedValues;

    /**
     * EnumCheckStep constructor.
     *
     * @param array $allowedValues
     */
    public function __construct(array $allowedValues)
    {
        $this->allowedValues = $allowedValues;
    }

    /**
     * Get API Documentation for this step
     *
     * If this step defines a rule that is important to be included in the API description, then include
     * it here.  e.g. "value must be ..."
     *
     * @return string|null
     */
    public function getApiDocumentation(): ?string
    {
        return null; // enums are always added to the documentation automatically, so this would be redundant
    }

    /**
     * Describe what this step does (will appear in debug log if enabled)
     *
     * @return string
     */
    public function __toString(): string
    {
        return 'check raw typecast value against allowed values: ' . $this->serializeValues();
    }

    /**
     * Prepare a parameter
     *
     * @param mixed $value The current value to be processed
     * @param string $paramName
     * @param ParameterValues $allValues All of the values
     * @return mixed
     */
    public function __invoke($value, string $paramName, ParameterValues $allValues)
    {
        // Non-strict check
        if (in_array($value, $this->allowedValues)) {
            return $value;
        } else {
            throw InvalidValueException::fromMessage($this, $paramName, $value, sprintf(
                'value must be one of: %s',
                $this->serializeValues()
            ));
        }
    }

    /**
     * Serialize values for message
     *
     * @param array|null $values
     * @return string
     */
    private function serializeValues(?array $values = null): string
    {
        foreach ($values ?: $this->allowedValues as $val) {
            switch (true) {
                case is_scalar($val):
                    $out[] = $val;
                    break;
                case is_array($val):
                    $out[] = '[' . $this->serializeValues($val) . ']';
                    break;
                case is_object($val):
                    $out[] = $this->serializeValues((array) $val);
                    break;
            }
        }

        return implode(', ', ($out ?? ['(empty set)']));
    }
}

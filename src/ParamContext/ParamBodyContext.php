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

namespace Paramee\ParamContext;

use Paramee\Contract\ParameterDeserializer;
use Paramee\Model\ParameterValuesContext;
use Psr\Log\LoggerInterface;

/**
 * Class ParamBodyContext
 *
 * @author Casey McLaughlin <caseyamcl@gmail.com>
 */
final class ParamBodyContext extends ParameterValuesContext
{
    /**
     * ParamBodyContext constructor.
     *
     * @param ParameterDeserializer|null $deserializer
     */
    public function __construct(?ParameterDeserializer $deserializer = null, ?LoggerInterface $logger = null)
    {
        parent::__construct('body', $deserializer, $logger);
    }
}

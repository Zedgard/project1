<?php
/**
 * Nexmo Client Library for PHP
 *
 * @copyright Copyright (c) 2016 Nexmo, Inc. (http://nexmo.com)
 * @license   https://github.com/Nexmo/nexmo-php/blob/master/LICENSE.txt MIT License
 */

namespace Nexmo\Client\Exception;

use Nexmo\Entity\Psr7Trait;
use Nexmo\Entity\HasEntityTrait;

class Request extends Exception
{
    use HasEntityTrait;
    use Psr7Trait;
}

<?php
/**
 * Orange Management
 *
 * PHP Version 8.0
 *
 * @package   Modules\Calendar\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Calendar\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Available status enum.
 *
 * @package Modules\Calendar\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
abstract class AvailableStatus extends Enum
{
    public const AVAILABLE = 0;

    public const BUSY = 1;

    public const AWAY = 2;
}

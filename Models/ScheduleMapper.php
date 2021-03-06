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

use Modules\Admin\Models\AccountMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Mapper class.
 *
 * @package Modules\Calendar\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class ScheduleMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    protected static array $columns = [
        'schedule_id'                     => ['name' => 'schedule_id',                     'type' => 'int',      'internal' => 'id'],
        'schedule_uid'                    => ['name' => 'schedule_uid',                    'type' => 'string',   'internal' => 'uid'],
        'schedule_status'                 => ['name' => 'schedule_status',                 'type' => 'int',      'internal' => 'status'],
        'schedule_freq_type'              => ['name' => 'schedule_freq_type',              'type' => 'int',      'internal' => 'freqType'],
        'schedule_freq_interval'          => ['name' => 'schedule_freq_interval',          'type' => 'int',      'internal' => 'freqInterval'],
        'schedule_freq_interval_type'     => ['name' => 'schedule_freq_interval_type',     'type' => 'int',      'internal' => 'intervalType'],
        'schedule_freq_relative_interval' => ['name' => 'schedule_freq_relative_interval', 'type' => 'int',      'internal' => 'relativeInternal'],
        'schedule_freq_recurrence_factor' => ['name' => 'schedule_freq_recurrence_factor', 'type' => 'int',      'internal' => 'recurrenceFactor'],
        'schedule_start'                  => ['name' => 'schedule_start',                  'type' => 'DateTime', 'internal' => 'start'],
        'schedule_duration'               => ['name' => 'schedule_duration',               'type' => 'int',      'internal' => 'duration'],
        'schedule_end'                    => ['name' => 'schedule_end',                    'type' => 'DateTime', 'internal' => 'end'],
        'schedule_created_at'             => ['name' => 'schedule_created_at',             'type' => 'DateTimeImmutable', 'internal' => 'createdAt', 'readonly' => true],
        'schedule_created_by'             => ['name' => 'schedule_created_by',             'type' => 'int',      'internal' => 'createdBy', 'readonly' => true],
    ];

    /**
     * Belongs to.
     *
     * @var array<string, array{mapper:string, external:string}>
     * @since 1.0.0
     */
    protected static array $belongsTo = [
        'createdBy' => [
            'mapper'     => AccountMapper::class,
            'external'   => 'schedule_created_by',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'schedule';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $createdAt = 'schedule_created_at';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'schedule_id';
}

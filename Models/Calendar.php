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

use phpOMS\Stdlib\Base\SmartDateTime;

/**
 * Calendar class.
 *
 * @package Modules\Calendar\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Calendar
{
    /**
     * Calendar ID.
     *
     * @var int
     * @since 1.0.0
     */
    private int $id = 0;

    /**
     * Name.
     *
     * @var string
     * @since 1.0.0
     */
    public string $name = '';

    /**
     * Description.
     *
     * @var string
     * @since 1.0.0
     */
    public string $description = '';

    /**
     * Created at.
     *
     * @var \DateTimeImmutable
     * @since 1.0.0
     */
    public \DateTimeImmutable $createdAt;

    /**
     * Current date of the calendar.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    private \DateTime $date;

    /**
     * Events.
     *
     * @var array<int, \Modules\Calendar\Models\Event>
     * @since 1.0.0
     */
    private $events = [];

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable('now');
        $this->date      = new SmartDateTime('now');
    }

    /**
     * @return int
     *
     * @since 1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param Event $event Calendar event
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function addEvent(Event $event) : int
    {
        $this->events[] = $event;

        \end($this->events);
        $key = \key($this->events);
        \reset($this->events);

        return $key ?? 0;
    }

    /**
     * @return Event[]
     *
     * @since 1.0.0
     */
    public function getEvents() : array
    {
        return $this->events;
    }

    /**
     * @param int $id Event id
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function removeEvent(int $id) : bool
    {
        if (isset($this->events[$id])) {
            unset($this->events[$id]);

            return true;
        }

        return false;
    }

    /**
     * @param int $id Event id
     *
     * @return Event
     *
     * @since 1.0.0
     */
    public function getEvent(int $id) : Event
    {
        return $this->events[$id] ?? new NullEvent();
    }

    /**
     * Get current date
     *
     * @return \DateTime
     *
     * @since 1.0.0
     */
    public function getDate() : \DateTime
    {
        return $this->date;
    }

    /**
     * Set current date
     *
     * @param \DateTime $date Current date
     *
     * @since 1.0.0
     */
    public function setDate(\DateTime $date) : void
    {
        $this->date = $date;
    }

    /**
     * Get event by date
     *
     * @param \DateTime $date Date of the event
     *
     * @return Event[]
     *
     * @since 1.0.0
     */
    public function getEventByDate(\DateTime $date) : array
    {
        $events = [];
        foreach ($this->events as $event) {
            if ($event->createdAt->format('Y-m-d') === $date->format('Y-m-d')) {
                $events[] = $event;
            }
        }

        return $events;
    }

    /**
     * Has event on date
     *
     * @param \DateTime $date Date of the event
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function hasEventOnDate(\DateTime $date) : bool
    {
        foreach ($this->events as $event) {
            if ($event->createdAt->format('Y-m-d') === $date->format('Y-m-d')) {
                return true;
            }
        }

        return false;
    }
}

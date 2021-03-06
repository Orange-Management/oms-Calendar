<?php
/**
 * Orange Management
 *
 * PHP Version 8.0
 *
 * @package   Modules\Calendar
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Calendar\Controller;

use Modules\Calendar\Models\CalendarMapper;
use Modules\Dashboard\Models\DashboardElementInterface;
use phpOMS\Asset\AssetType;
use phpOMS\Contract\RenderableInterface;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Stdlib\Base\SmartDateTime;
use phpOMS\Views\View;

/**
 * Calendar controller class.
 *
 * @package Modules\Calendar
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class BackendController extends Controller implements DashboardElementInterface
{
    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewCalendarDashboard(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);

        /** @var \phpOMS\Model\Html\Head $head */
        $head = $response->get('Content')->getData('head');
        $head->addAsset(AssetType::CSS, '/Modules/Calendar/Theme/Backend/css/styles.css');

        $view->setTemplate('/Modules/Calendar/Theme/Backend/calendar-dashboard');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1001201001, $request, $response));

        /** @var \Modules\Calendar\Models\Calendar $calendar */
        $calendar = CalendarMapper::get(1);
        $calendar->setDate(new SmartDateTime((string) ($request->getData('date') ?? 'now')));
        $view->addData('calendar', $calendar);

        $calendarEventPopup = new \Modules\Calendar\Theme\Backend\Components\Event\BaseView($this->app->l11nManager, $request, $response);
        $view->addData('calendarEventPopup', $calendarEventPopup);

        return $view;
    }

    /**
     * {@inheritdoc}
     */
    public function viewDashboard(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        /** @var \phpOMS\Model\Html\Head $head */
        $head = $response->get('Content')->getData('head');
        $head->addAsset(AssetType::CSS, '/Modules/Calendar/Theme/Backend/css/styles.css');

        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Calendar/Theme/Backend/dashboard-calendar');

        $calendarView = new \Modules\Calendar\Theme\Backend\Components\Calendar\BaseView($this->app->l11nManager, $request, $response);
        $calendarView->setTemplate('/Modules/Calendar/Theme/Backend/Components/Calendar/mini');
        $view->addData('calendar', $calendarView);

        /** @var \Modules\Calendar\Models\Calendar $calendar */
        $calendar = CalendarMapper::get(1);
        $calendar->setDate(new SmartDateTime((string) ($request->getData('date') ?? 'now')));
        $view->addData('cal', $calendar);

        return $view;
    }
}

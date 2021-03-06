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

?>
<div id="calendar-dashboard" class="col-xs-12 col-md-6" draggable="true">
    <div class="portlet">
    <div class="portlet-head"><?= $this->getHtml('Calendar', 'Calendar'); ?></div>
    <?= $this->getData('calendar')->render($this->getData('cal')); ?>
</div>

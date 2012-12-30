<?php
$this->pageTitle = Yii::app()->name . ' - Calendar';
$this->breadcrumbs = array(
    'Calendar',
);
?>
<h1>Calendar</h1>

<?php
$this->widget('application.extensions.fullcalendar.FullcalendarGraphWidget', array(
    'data' => array(
        'title' => 'All Day Event',
        'start' => '2012-10-23',
        'end' => '2012-10-25',
    ),
    'options' => array(
        'editable' => true,
        'selectable' => true,
        'selectHelper' => true,
        'dropable' => true,
        'eventClick' => 'js:function(event, eventElement){ alert("eventClick"); }',
        'dayClick' => 'js:function(event, eventElement){ alert("dayClick"); }',
        'eventResize' => 'js:function(event, eventElement){ alert("eventResize"); }',
        'eventDrop' => 'js:function(event, eventElement){ alert("eventDrop"); }',
        'select' => 'js:function(start, end, allDay){ var title = prompt(\'Event Title:\');
				if (title) {
					this.fullCalendar(\'renderEvent\',
						{
							title: title,
							start: start,
							end: end,
							allDay: allDay
						},
						true // make the event "stick"
					);
				}
				this.fullCalendar(\'unselect\'); }',
    ),
    'htmlOptions' => array(
        'class' => 'cal_theme',
        'style' => 'width:910px;margin: 0 auto;'
    ),
        )
);
?>
<br />
<div class="flash-notice">
    <p>This is a "static" page. You may change the content of this page
        by updating the file <tt><?php echo __FILE__; ?></tt>.</p>
</div>
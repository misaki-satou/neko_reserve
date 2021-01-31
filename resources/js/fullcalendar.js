// resources/js/fullcalendar.js
import { Calendar } from '@fullcalendar/core'
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import momentTimezonePlugin from '@fullcalendar/moment-timezone';
import googleCalendar from '@fullcalendar/google-calendar';

document.addEventListener('DOMContentLoaded', function () {
  const calendarEl = document.getElementById('calendar');

  const calendar = new Calendar(calendarEl, {
    allDaySlot: false,
    plugins: [timeGridPlugin, momentTimezonePlugin, interactionPlugin, googleCalendar],
    timeZone: 'Asia/Tokyo', // momentTimezonePlugin
    defaultView: 'timeGridWeek',

    events: []
  });

  calendar.render();
});
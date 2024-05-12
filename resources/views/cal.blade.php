document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        height: 450,
        initialView: 'listWeek',
        views: {
            listDay: {
                buttonText: 'list day'
            },
            listWeek: {
                buttonText: 'list week'
            },
            listMonth: {
                buttonText: 'list month'
            }
        },
        events: [
            @foreach ($log as $item)
                {
                    title: '{{ $item->activity }} {{ $item->tos }}',
                    start: '{{ $item->created_at }}'
                },
            @endforeach
        ]
    });

    calendar.render();
});

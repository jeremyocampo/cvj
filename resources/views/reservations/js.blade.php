@section('js')
    <script>
        let events = [];

        function calendar() {
            $('#calendar').fullCalendar({
                themeSystem: 'bootstrap4',
                businessHours: false,
                defaultView: 'month',
                editable: true,
                header: {
                    left: 'title',
                    center: 'month',
                    right: 'today prev,next'
                },
                dayClick: function(date) {
                    let now = new Date();
                    now = moment(now).format('YYYY-MM-DD');
                    date = moment(date).format('YYYY-MM-DD');
    
                    if (moment(now).isBefore(date)) {
                        $('#modalDate').val(date);
                        $('#addEvent').modal('show');
                    }
                },
                events: events,
                eventRender: function(event, element) {
                    element.attr('title', event.tip);
                }
            });
        }

        $('#modalSaveEvent').on('click', function() {
            let input = {
                event: $('#modalEvent').val(),
                time: $('#modalTime').val(),
                event_place: $('#modalVenue').find('option:selected').val(),
                event_date: $('#modalDate').val(),
                _token: '{!! csrf_token() !!}'
            };

            $.ajax({
                url: '/reservations',
                type: 'POST',
                data: input,
                success: function(data) {
                    events.push({
                        title: input.event + ': ' + input.event_place + ': ' + input.time,
                        start: input.event_date,
                        editable: false
                    });

                    $('#modalEvent').val('');
                    $('#modalTime').val('');
                    $('#modalDate').val('');

                    $('#calendar').fullCalendar('refetchEvents');

                    $('#addEvent').modal('hide');
                },
                error: function(error) {
                    alert('Event Place and Time is now reserved');
                }
            });
        });

        $(document).ready(function() {
            $.ajax({
                url: '/events?date=2019-11-01',
                type: 'GET',
                success: function(data) {
                    $.each(data, function(key, value) {
                        events.push({
                            id: value.id,
                            title: value.event + ': ' + value.event_place + ': ' + value.time,
                            start: value.event_date,
                            editable: false
                        });
                    });

                    calendar();
                },
                error: function(error) {
                    
                }
            });
        });
    </script>
@stop
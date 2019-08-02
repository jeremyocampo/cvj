<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="_token" content="{{ csrf_token() }}">
        <title>jQuery UI Datepicker - Display month &amp; year menus</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $( function() {
                $( "#datepicker" ).datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                onSelect: function(selected,evnt) {
                    console.log("YESSIR MGA KAIBIGAN");
                    $.ajax({
                    type : 'get',
                    url : '{{URL::to('calendarSearch')}}',
                    data:{'search':selected},
                    success:function(data){
                        console.log(data);
                            document.getElementById("schedule").innerHTML = data;
                        }
                    });
                }
                });
            } );
        </script>
    </head>
    <body>
        <div id="schedule">Yes</div>
        <p>Date: <input type="text" id="datepicker"></p>
        <script type="text/javascript">
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
        </script>
    </body>
</html>
@extends('layout.app')
@section('title','Schedule')
@section('css')
    <link rel="stylesheet" href="{{ url('/') }}/plugins/fullcalendar/main.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/plugins/fullcalendar/style.css">
    <link rel="stylesheet" href="{{ url('/') }}/plugins/fullcalendar-daygrid/main.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/plugins/fullcalendar-timegrid/main.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/plugins/fullcalendar-bootstrap/main.min.css">
    <style>
        .external-event {
            box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
            border-radius: .25rem;
            cursor: move;
            font-weight: 700;
            margin-bottom: 4px;
            padding: 5px 10px;
        }

    </style>
@endsection
@section('content')
    <h2 class="title-header">Schedule</h2>
    <div class="row">
        <div class="col-md-3">
            <div class="sticky-top mb-3">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">Draggable Events</h3>
                    </div>
                    <div class="card-body">
                        <!-- the events -->
                        <div id="external-events">
                            <div class="external-event bg-success" data-color="#17ae5f">Early Pregnancy</div>
                            <div class="external-event bg-warning" data-color="#ffc107">Sonographic Findings</div>
                            <div class="external-event bg-info" data-color="#17a2b8 ">2nd and 3rd Trimester</div>
                            <div class="external-event bg-primary" data-color="#293a80">Meeting</div>
                            <div class="external-event bg-danger" data-color="#dc3545">Urgent Meeting</div>
                            <div class="checkbox">
                                <label for="drop-remove">
                                    <input type="checkbox" id="drop-remove">
                                    remove after drop
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="card mt-3">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">Create Event</h3>
                    </div>
                    <div class="card-body">
                        <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                            <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                            <ul class="fc-color-picker" id="color-chooser">
                                <li><a class="text-primary" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-warning" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-success" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-danger" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
                            </ul>
                        </div>
                        <!-- /btn-group -->
                        <div class="input-group">
                            <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                            <div class="input-group-append">
                                <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                            </div>
                            <!-- /btn-group -->
                        </div>
                        <!-- /input-group -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-body p-3">
                    <!-- THE CALENDAR -->
                    <div id="calendar"></div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
@endsection

@section('js')
    <script src="{{ url('/') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="{{ url('/') }}/js/demo.js"></script>
    <script src="{{ url('/') }}/plugins/moment/moment.min.js"></script>
    <script src="{{ url('/') }}/plugins/fullcalendar/main.min.js"></script>
    <script src="{{ url('/') }}/plugins/fullcalendar-daygrid/main.min.js"></script>
    <script src="{{ url('/') }}/plugins/fullcalendar-timegrid/main.min.js"></script>
    <script src="{{ url('/') }}/plugins/fullcalendar-interaction/main.min.js"></script>
    <script src="{{ url('/') }}/plugins/fullcalendar-bootstrap/main.min.js"></script>
    <script>
        $(document).ready(function(){
            $.ajax({
                url: "{{ route('get.schedule') }}",
                type: "GET",
                success: function (data) {
                    /* initialize the external events
            -----------------------------------------------------------------*/
                    function ini_events(ele) {
                        ele.each(function () {

                            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                            // it doesn't need to have a start or end
                            var eventObject = {
                                title: $.trim($(this).text()) // use the element's text as the event title
                            }

                            // store the Event Object in the DOM element so we can get to it later
                            $(this).data('eventObject', eventObject)

                            // make the event draggable using jQuery UI
                            $(this).draggable({
                                zIndex        : 1070,
                                revert        : true, // will cause the event to go back to its
                                revertDuration: 0  //  original position after the drag
                            })

                        })
                    }

                    ini_events($('#external-events div.external-event'))

                    /* initialize the calendar
                     -----------------------------------------------------------------*/
                    //Date for the calendar events (dummy data)
                    var date = new Date()
                    var d    = date.getDate(),
                        m    = date.getMonth(),
                        y    = date.getFullYear()

                    var Calendar = FullCalendar.Calendar;
                    var Draggable = FullCalendarInteraction.Draggable;

                    var containerEl = document.getElementById('external-events');
                    var checkbox = document.getElementById('drop-remove');
                    var calendarEl = document.getElementById('calendar');

                    // initialize the external events
                    // -----------------------------------------------------------------

                    new Draggable(containerEl, {
                        itemSelector: '.external-event',
                        eventData: function(eventEl) {
                            return {
                                title: eventEl.innerText,
                                backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
                                borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
                                textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
                            };
                        }
                    });

                    var calendar = new Calendar(calendarEl, {
                        plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
                        header    : {
                            left  : 'prev,next today',
                            center: 'title',
                            right : 'dayGridMonth,timeGridWeek,timeGridDay'
                        },
                        'themeSystem': 'bootstrap',
                        //Random default events
                        events    : data,
                        editable  : true,
                        droppable : true, // this allows things to be dropped onto the calendar !!!
                        drop      : function(info) {

                            // is the "remove after drop" checkbox checked?
                            if (checkbox.checked) {
                                // if so, remove the element from the "Draggable Events" list
                                info.draggedEl.parentNode.removeChild(info.draggedEl);
                            }
                        },
                        eventDrop: function(event,dayDelta,minuteDelta,allDay,revertFunc) {
                            addSchedule(event);
                        },
                        eventResize: function(event){
                            addSchedule(event);
                        },
                        eventReceive: function(event, view){
                            addSchedule(event);
                            event.event.remove();
                        },
                        eventClick: function(event){
                            var event = event.event;
                            var c = confirm('Are you sure you want to delete this schedule?');
                            if(c){
                                $.ajax({
                                    url: "{{ url('/schedule/destroy/') }}/"+event.id,
                                    type: 'GET',
                                    success: function (res) {
                                        event.remove();
                                    }
                                })
                            }
                        }
                    });

                    calendar.render();
                    // $('#calendar').fullCalendar()
                    function convertDate(date)
                    {
                        if(date){
                            var tmp_date = date.getFullYear() + '-' + ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '-' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate()));
                            var tmp_time = ((date.getHours() > 9) ? (date.getHours()) : ('0' + (date.getHours()))) + ':' + ((date.getMinutes() > 9) ? (date.getMinutes()) : ('0' + (date.getMinutes()))) + ':' + ((date.getSeconds() > 9) ? (date.getSeconds()) : ('0' + (date.getSeconds())))
                            return tmp_date + " " + tmp_time;
                        }
                        return null;
                    }
                    function addSchedule(event)
                    {
                        var event = event.event;

                        var data = {
                            id: event.id,
                            title: event.title,
                            start: convertDate(event.start),
                            end: convertDate(event.end),
                            color: event.backgroundColor,
                            allDay: event.allDay
                        }
                        $.ajax({
                           url: "{{ route('update.schedule') }}",
                           type: "POST",
                           data: data,
                           success: function (res) {
                                if(res>0){
                                    data.id = res;
                                    calendar.addEvent(data);
                                }
                           },
                            error: function (err) {
                                console.log(err);
                            }
                        });
                    }
                    /* ADDING EVENTS */
                    var currColor = '#3c8dbc' //Red by default
                    //Color chooser button
                    var colorChooser = $('#color-chooser-btn')
                    $('#color-chooser > li > a').click(function (e) {
                        e.preventDefault()
                        //Save color
                        currColor = $(this).css('color')
                        //Add color effect to button
                        $('#add-new-event').css({
                            'background-color': currColor,
                            'border-color'    : currColor
                        })
                    })
                    $('#add-new-event').click(function (e) {
                        e.preventDefault()
                        //Get value and make sure it is not null
                        var val = $('#new-event').val()
                        if (val.length == 0) {
                            return
                        }

                        //Create events
                        var event = $('<div />')
                        event.css({
                            'background-color': currColor,
                            'border-color'    : currColor,
                            'color'           : '#fff'
                        }).addClass('external-event')

                        event.attr('data-color',currColor);


                        event.html(val)
                        $('#external-events').prepend(event)

                        //Add draggable funtionality
                        ini_events(event)

                        //Remove event from text input
                        $('#new-event').val('')
                    })
                }
            })
        });
    </script>
    <script>
        $(function () {


        })
    </script>
@endsection
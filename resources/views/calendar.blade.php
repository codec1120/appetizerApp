<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head> 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
        
    </head>     
    <body>
        <div class="modal-active" tabindex="-1" role="dialog" style="max-height:100px">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Calendar @csrf</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" >
                    <div class="row">
                        <input type="text" class="form-control" id="url" style="display:none" value="{{ url('createEvent') }}">
                        <div class="col col-sm-8">
                            <input type="text" class="form-control" id="event_name" placeholder="Event" aria-label="Event" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col col-sm-4">
                             <input class="date form-control" id="event_start" placeholder="From" aria-label="From" type="text">
                        </div>
                        <div class="col col-sm-4">
                             <input class="date form-control" id="event_end" placeholder="To" aria-label="To" type="text">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col col-sm-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="monday">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Mon
                                </label>
                            </div>
                        </div>
                        <div class="col col-sm-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="tuesday">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Tue
                                </label>
                            </div>
                        </div>
                        <div class="col col-sm-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="wednesday">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Wed
                                </label>
                            </div>
                        </div>
                        <div class="col col-sm-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="thursday">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Thur
                                </label>
                            </div>
                        </div>
                        <div class="col col-sm-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="friday">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Fri
                                </label>
                            </div>
                        </div>
                        <div class="col col-sm-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="saturday">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Sat
                                </label>
                            </div>
                        </div>
                        <div class="col col-sm-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="sunday">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Sun
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                   <div>
                        <table class="table">
                            <tbody>
                            @foreach( $calendar as $event) 
                                    @if ( $event['active'] )
                                        <tr class="table-success">    
                                            <td>{{ date( 'd',strtotime( $event['event_date'])).' '.$event['event_day']}}</td>
                                            <td>{{$event['event_name']}}</td>
                                        </tr>
                                    @else
                                        <tr>    
                                            <td>{{date( 'd',strtotime( $event['event_date'])).' '.$event['event_day']}}</td>
                                            <td>{{$event['event_name']}}</td>
                                        </tr>
                                    @endif
                            @endforeach
                            </tbody>
                        </table>
                   </div>
                <div class="modal-footer">
                    <button type="button" id="saveEvent" class="btn btn-primary">Save changes</button>
                </div>
                </div>
            </div>
        </div>
    </body>
    <footer>
        <script type="text/javascript">
        // Date Picker
        $( document ).ready(function() {
            $('.date').datepicker({  
                format: 'yyyy-mm-dd'
            }); 


            // Event Listener
            $('#saveEvent').click( function () {
                
                if ( $('#event_start').val() != '' && $('#event_end').val() != '' ) {

                    const days = [ 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'],
                        daysKey = [ 'sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];

                    const event_start = new Date( $('#event_start').val() ).getTime(),
                        event_end = new Date( $('#event_end').val() ).getTime();
                        
                    let base_url = $('#url').val();

                    let eventStartCounter = event_start,
                        eventDataHolder = [],
                        selectedDays = [];
                
                    // Get all selected Days
                    for ( let i = 0; i < days.length; i++) {
                        if ( $( `#${ days[i] }` ).prop('checked') ) {
                            selectedDays.push( days[i] );
                        }
                    }


                    while (eventStartCounter < event_end) {
                        const eventStartCounterDay = new Date( eventStartCounter ).getDay()
                       
                        eventDataHolder.push({
                            event_name  : $('#event_name').val(),
                            event_date  : `${new Date( eventStartCounter ).getFullYear()}-${new Date( eventStartCounter ).getMonth()+1}-${new Date( eventStartCounter ).getDate()}`,
                            event_end   : $('#event_end').val(),
                            event_day   : daysKey[eventStartCounterDay],
                            active      : selectedDays.includes( days[eventStartCounterDay] ) ? 1 : 0
                        });

                        // Add day
                        eventStartCounter = addDays( new Date(eventStartCounter), 1);
                    }
                    
                    // Ajax
                    const formData = {
                        events: JSON.stringify( eventDataHolder ),
                    };

                    $.ajax({
                        type: "POST",
                        data: formData,
                        url: `${base_url}`,
                        dataType: "json",
                        success: function( response ){
                            window.location.reload();
                        }
                    });
                }

                // Functions
                function addDays(date, days) {
                    let result = new Date(date);
                        result.setDate(result.getDate() + days);

                    return result.getTime();
                }
               
              
            });
        });
           
        </script> 
    </footer>
</html>
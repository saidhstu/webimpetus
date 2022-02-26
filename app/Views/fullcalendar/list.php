<?php require_once (APPPATH.'Views/fullcalendar/list-title.php'); ?>
<script>

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        themeSystem: 'bootstrap',
        height: 'auto',
        expandRows: true,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        initialView: 'dayGridMonth',
        initialDate: '<?php echo render_date(time(), "", "Y-m-d"); ?>',
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        selectable: true,
        nowIndicator: true,
        dayMaxEvents: true, // allow "more" link when too many events
        events: [
            <?php foreach ($timeslips as $eachSlip) {
                $startDate = strtotime($eachSlip['slip_start_date']);
                $endDate = strtotime($eachSlip['slip_end_date']);
                $splitted = explode(" ", $eachSlip['slip_timer_started']);
                $titleStartDateHour = getTitleHour($eachSlip['slip_timer_started']);
                $titleEndDateHour = getTitleHour($eachSlip['slip_timer_end']);
                echo "{
                    id: '" . $eachSlip['id'] . "',
                    title: '". "{" . render_date($startDate, "", "d-M") . " " . $titleStartDateHour . " - " . render_date($endDate, "", "d-M") . " " . $titleEndDateHour . "} " . $eachSlip['employee_name'] . ": ". $eachSlip['task_name'] ."',
                    start: '" . render_date($startDate, "", "Y-m-d") . "',
                    end: '" . render_date($endDate, "", "Y-m-d") . "',
                    url: '" . base_url('/' . $tableName . '/edit/' . $eachSlip['uuid']) . "',
                },";
            } ?>
        ],
        dateClick: function(dateEventObj) {

            console.log(dateEventObj);

            var date=dateEventObj.date;
            var jsEvent = dateEventObj.jsEvent;
            var s_time='';
            if(dateEventObj.view.type != "dayGridMonth"){
                var date_arr=String(date).split(" ");
                var timestring='';
                for(var i=0; i<date_arr.length; i++){
                    var contains = (date_arr[i].indexOf(":") > -1);
                    if(contains){
                        timestring=date_arr[i];
                        break;
                    }
                }
                var time_arr=timestring.split(":");
                if(time_arr[0]>12){ var h=time_arr[0]-12; s_time=h+":"+time_arr[1]+"pm"; }
                else{ s_time=time_arr[0]+":"+time_arr[1]+"am"; }
            }				

            var cal_left=Number($('#calendar').offset().left);
            var cal_top=Number($('#calendar').offset().top);
            
            var left = jsEvent.pageX - cal_left - (Number($(".new-event").outerHeight())/2);
            var top = jsEvent.pageY - cal_top - Number($(".new-event").outerHeight()) - Number($(".arrow_border").outerHeight());

            if(left<0){
                left=0;
            }else if(left>(Number($('#calendar').outerWidth())-Number($(".new-event").outerWidth()))){
                left=Number($('#calendar').outerWidth())-Number($(".new-event").outerWidth());
            }
            if(top<0){
                top=0;
            }
            $(".new-event").css('left', left);
            $(".new-event").css('top', top);
                    
            
            var converted = days[date.getDay()] + ", " + date.getDate() + " " +months[date.getMonth()];
            var curr_month = Number(date.getMonth())+1;
            var curr_date =	date.getDate()+'/'+	curr_month+'/'+date.getFullYear();
            
            $(".new-event").find('.date').html(converted);
            $("#curr_date").val(curr_date);
            $("#slip_timer_started").val(s_time);
            $("#slip_timer_end").val();
            $("select#task_name").val('');
            $("select#employee_name").val('');
            $("#slip_description").val('');
            $(".new-event").fadeIn("fast");
        }
    });

    calendar.render();

    $(".popup .close-pop").click(function () {
        $(".new-event").fadeOut("fast");
    });
});


var new_event=new Array();


function ValidateForm () {

    if (document.frm_task.Task_ID.value=="") { 
        __alertMessage('Please specify task name');
        //alert('Please Specify Task Name'); 
        document.frm_task.Task_ID.focus();
        return false;
    }
    if (document.frm_task.s_time.value=="") { 
        __alertMessage('Please specify start time');
        //alert('Please Specify Start Time'); 
        document.frm_task.s_time.focus();
        return false;
    }
    if (document.frm_task.e_time.value=="")
    { 
        __alertMessage('Please specify end time');
        //alert('Please Specify End Time'); 
        document.frm_task.e_time.focus();
        return false;
    }
    if (document.frm_task.slip_descr.value=="")
    { 
        __alertMessage('Please specify timeslip description');
        //alert('Please Specify Timeslip Description'); 
        document.frm_task.slip_descr.focus();
        return false;
    }
	save();
}

var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

</script>

<div class="calendar-wrapper">
    <div id='calendar'></div>
    <div class="new-event popup" style="display:none">
        <div class="pointer">
            <div class="arrow"></div>
            <div class="arrow_border"></div>
        </div>
        <i class="close-pop fa fa-times"></i>
        <h5>Date <span class="date"></span></h5>
        <form name="frm_task" class="form-horizontal col-sm-12 col-lg-12"> 
            <input type="hidden" value="" name="curr_date" id="curr_date">
            <div class="form-group">
                Task Name <sup class="required">*</sup>
                <div class="ui-widget">
                    <select name="task_name" id="task_name" class="form-control dashboard-dropdown">
                        <option value="">--Selected--</option>
                        <?php foreach ($tasks as $task) { ?>
                            <option value="<?php echo $task['id'] ?>"><?php echo $task['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                Employee Name <sup class="required">*</sup>
                <div class="ui-select">
                    <select name="employee_name" id="employee_name" class="form-control dashboard-dropdown">
                        <option value="">--Selected--</option>
                        <?php foreach ($employees as $employee) { ?>
                            <option value="<?php echo $employee['id'] ?>"><?php echo $employee['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                Start Time <sup class="required">*</sup>
                <input type="text" class="event-input timepicker form-control" style="margin-left:0px;" name="slip_timer_started" id="slip_timer_started">
                End Time <sup class="required">*</sup>
                <input type="text" class="event-input timepicker form-control" style="margin-left:0px;" name="slip_timer_end" id="slip_timer_end">
            </div>
            <div class="form-group">
                Description <sup class="required">*</sup>
                <textarea name="slip_description" id="slip_description" rows="5" cols="10" class="event-input form-control"></textarea>
            </div>
    
            <button type="button" class="btn btn-primary btn-color margin-right-5 btn-sm" onclick="return ValidateForm();">
                Create
            </button>
        </form>
    </div>
</div>
<script>
    function validateForm()
    {
        alert('validation');
    }
</script>
<?php require_once (APPPATH.'Views/common/footer.php'); ?>
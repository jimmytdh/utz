<script>
    $(document).ready(function(){
        $.fn.editable.defaults.mode = 'inline';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    var pk = "{{ $patient->id }}";
    var patientUrl = "{{ route('update.patient') }}";

    $('#hospital_no').editable({
        url: patientUrl,
        pk: pk,
        type: 'text',
        validate: function(value) {
            if ($.isNumeric(value) == '') return 'Only numbers are allowed';
        }
    });

    $('#dob').editable({
        url: patientUrl,
        pk: pk,
        format: 'yyyy-mm-dd',
        viewformat: 'M dd, yyyy',
        datepicker: {
            weekStart: 1
        },
        success: function(age){
            $('#age').html(age);
        }
    });

    $('#fname, #mname, #lname').editable({
        url: patientUrl,
        pk: pk,
        type: 'text',
        validate: function(value) {
            if($.trim(value) == '') return 'This field is required';
        }
    });
</script>
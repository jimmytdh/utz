<script>
    var admUrl = "{{ route('update.admission') }}";
    var admID = "{{ $adm->id }}";

    $('#date_started, #date_ended').editable({
        url: admUrl,
        pk: admID,
        format: 'hh:mm A',
        viewformat: 'hh:mm A',
        template: 'hh:mm A',

        success: function(res){
            console.log(res);
        }
    });

    $('#date').editable({
        url: admUrl,
        pk: admID,
        format: 'yyyy-mm-dd',
        viewformat: 'M dd, yyyy',
        datepicker: {
            weekStart: 1
        }
    });

    $('#room').editable({
        url: admUrl,
        pk: admID,
        type: 'text',
        validate: function(value) {
            if ($.isNumeric(value) == '') return 'Only numbers are allowed';
        }
    });

    $('#ward, #referring_doctor, #scan_indication, #pmp, #lmp, #menstrual_age').editable({
        url: admUrl,
        pk: admID,
        type: 'text'
    });

    $('#gp_code').editable({
        url: admUrl,
        pk: admID,
        type: 'text',
        success: function(res){
            $('#g').html(res.g);
            $('#p').html(res.p);
        }
    });
</script>
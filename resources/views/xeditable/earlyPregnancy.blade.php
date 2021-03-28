<script>
    var earlyUrl = "{{ route('update.earlyPregnancy') }}";
    var earlyID = "{{ $early->id }}";

    $('#yolk_sac, #subchrionic, #number, #crl, #heart_motion_desc, .earlyEdit').editable({
        url: earlyUrl,
        pk: earlyID,
        type: 'text',
        emptytext: 'N/A'
    });
    $('#remarks, #left_ovary, #right_ovary').editable({
        url: earlyUrl,
        pk: earlyID,
        type: 'textarea',
        emptytext: 'N/A'
    });

    var doctors = [];
    @foreach($doctors as $d)
        var data = {
            value: "{{ $d->id }}",
            text: "Dr. {{ $d->fname }} {{ $d->mname }} {{ $d->lname }}"
        };
        doctors.push(data);
    @endforeach
    $('#ob_doctor').editable({
        url: earlyUrl,
        pk: earlyID,
        source: doctors,
        emptytext: 'N/A'
    });
</script>
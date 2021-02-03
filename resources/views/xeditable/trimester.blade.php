<script>
    var triURL = "{{ route('update.trimester') }}";
    var triID = "{{ $tri->id }}";

    $('.edit').editable({
        url: triURL,
        pk: triID,
        type: 'text',
        emptytext: 'N/A'
    });
    $('.textarea').editable({
        url: triURL,
        pk: triID,
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
        url: triURL,
        pk: triID,
        source: doctors,
        emptytext: 'N/A'
    });
    $('#gender').editable({
        url: triURL,
        pk: triID,
        source: [
            {value: 'g', text: 'Girl'},
            {value: 'b', text: 'Boy'}
        ],
        emptytext: 'N/A'
    });
</script>
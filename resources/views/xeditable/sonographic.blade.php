<script>
    var sonoURL = "{{ route('update.sonographics') }}";
    var sonoID = "{{ $sono->id }}";

    $('.edit').editable({
        url: sonoURL,
        pk: sonoID,
        type: 'text',
        emptytext: 'N/A'
    });
    $('.textarea').editable({
        url: sonoURL,
        pk: sonoID,
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
        url: sonoURL,
        pk: sonoID,
        source: doctors,
        emptytext: 'N/A'
    });
</script>
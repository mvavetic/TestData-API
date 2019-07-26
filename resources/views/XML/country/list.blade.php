<countries>

    @foreach ($countries as $country)

        <country>
            <id>{{ $country->id }}</id>
            <name>{{ $country->name }}</name>
            <code>{{ $country->code }}</code>
        </country>

    @endforeach

</countries>
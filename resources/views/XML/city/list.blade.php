<cities>
    @foreach ($cities as $city)

    <city>
        <id>{{ $city->id }}</id>
        <name>{{ $city->name }}</name>
        <country>
            <name>{{ $city->country->name }}</name>
        </country>
    </city>

    @endforeach
</cities>
<cities>
    @foreach ($cities as $city)

    <city>
        <id>{{ $city->id }}</id>
        <name>{{ $city->name }}</name>
        <country>{{ $city->country->name }}</country>
    </city>

    @endforeach
</cities>
<sports>
    @foreach ($sports as $sport)

    <sport>
        <id>{{ $sport->id }}</id>
        <name>{{ $sport->name }}</name>
    </sport>

    @endforeach
</sports>
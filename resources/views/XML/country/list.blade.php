<countries>
@foreach ($countries as $country)

   <country>
       <id>{{ $country->id }}</id>
       <name>{{ $country->name }}</name>
       <code>{{ $country->code }}</code>
       @if($country->relationLoaded('cities'))
       @foreach($country->cities as $city)
       <cities>
            <city>
                <name>{{ $city->name}}</name>
            </city>
       </cities>
       @endforeach
       @endif
   </country>

@endforeach
</countries>
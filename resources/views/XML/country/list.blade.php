<countries>
@foreach ($countries as $country)

   <country>
       <id>{{ $country->id }}</id>
       <name>{{ $country->name }}</name>
       <code>{{ $country->code }}</code>
       <capital>{{ $country->capitalCity->name }}</capital>
   </country>

@endforeach
</countries>
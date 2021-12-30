
@switch($number)
@case(2)
   nombre est égal à 2
    @break

@case(15)
nombre est égal à 15
    @break

@default
    nombre ni égal à 2 ni à 15.
@endswitch

{{-- @isset($fruits) --}}
    {{-- {{ count($fruits) }} --}}
{{-- @endif --}}

{{-- si besoin inserer code php
    @php
        echo rand(1, 15);
    @endphp
    
    
    --}}

{{-- si fruit on affiche dans le paragraphe sinon --}}

{{-- @forelse($fruits as $fruit) --}}
    {{-- <p>{{ $fruit }}</p> --}}
{{-- @empty --}}
    {{-- Aucun fruit. --}}
{{-- @endforelse --}}
{{--  --}}

{{-- @foreach($fruits as $fruit) --}}
{{-- <p>{{ $fruit }}</p> --}}
{{-- @endforeach --}}


{{-- @unless($number == 5)  --}}
{{-- à moins que le nb soit différent de 5 tu m'affiche  --}}
    {{-- Nombre est différent de 5. --}}
{{-- @endunless --}}

{{-- @for($i = 0; $i <= 5; $i++ ) 
<p>nombre égal à {{ $i }}</p>

@endfor



    {{-- @if ($number <5)
     inferieur à 5
 @elseif ($number == 5)
       egal à 5
@else
     superieur à 5
 @endif --}}







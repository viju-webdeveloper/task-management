@props(['name'])
<input name="{{$name}}" id="{{$name}}" {{$attributes->merge(['class'=>'border p-2 w-full'])}} >
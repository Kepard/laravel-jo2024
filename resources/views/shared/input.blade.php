@php
$label ??= null;
$type ??= 'text';
$class ??= null;
$name ??= '';
$value ??= '';
$placeholder ??= null;
$min ??= null;
$max ??= null;
@endphp

<div @class(["form-group", $class])>
    <label for="{{$name}}">{{$label}}</label>
    <input class="form-control @error($name) is-invalid @enderror" type="{{$type}}" id="{{$name}}" name="{{$name}}" placeholder="{{ $placeholder }}" min="{{$min}}" max="{{$max}}" value="{{old($name,$value)}}">

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
    
</div>
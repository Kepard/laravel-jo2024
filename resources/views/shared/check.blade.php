@php
$label ??= null;
$class ??= null;
$name ??= '';
$value ??= '';
$checked ??= false;
$onclick ??= null;
@endphp

<div @class(["form-check", $class])>
    <input class="form-check-input @error($name) is-invalid @enderror" type="checkbox" id="{{$name}}" name="{{$name}}" value="{{old($name,$value)}}" @if($checked) checked @endif onclick="{{ $onclick }}">
    <label class="form-check-label" for="{{$name}}">{{$label}}</label>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
    
</div>
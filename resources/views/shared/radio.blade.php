@php
$label ??= null;
$name ??= '';
$value ??= '';
$checked ??= false;
@endphp

<div class="form-check">
    <input class="form-check-input" type="radio" id="{{ $name }}_{{ $value }}" name="{{ $name }}" value="{{ $value }}" @if($checked) checked @endif>
    <label class="form-check-label" for="{{ $name }}_{{ $value }}">{{ $label }}</label>
</div>

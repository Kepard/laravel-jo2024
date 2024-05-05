@php
$label ??= null;
$class ??= null;
$name ??= '';
$options ??= null;
$value ??= null;
@endphp

<div class="form-group {{$class}}">
    <label for="{{$name}}">{{$label}}</label>
    <select class="form-select @error($name) is-invalid @enderror" name="{{$name}}" id="{{$name}}">
        <option value=""></option> 
        @foreach($options as $option)
            @php
                $optionValue = is_array($option) ? $option['value'] : $option->id;
                $optionText = is_array($option) ? $option['text'] : $option->name;
            @endphp
            <option value="{{$optionValue}}" @if($optionValue == $value) selected @endif>{{$optionText}}</option>
        @endforeach
    </select>

    @error($name)
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>

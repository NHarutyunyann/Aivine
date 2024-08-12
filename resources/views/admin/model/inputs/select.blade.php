<div class="form-group row pl-3 pr-3 {{ $classes ?? '' }}">
    <label for="{{ $field }}">{{ $label ?? ucfirst(str_replace('_', ' ', $field)) }}</label>
    <select class="form-control @error($field) is-invalid @enderror" id="{{ $field }}" name="{{ $field }}">
        @foreach($options as $option)
            <option value="{{$option['value'] ?? $option['option']}}" {{($option['value'] ?? $option['option']) === old($field, @$entity->$field) ? 'selected' : ''}}>
                {{$option['option']}}
            </option>
        @endforeach
    </select>
    @error($field)<span class="invalid-feedback">{{ $message }}</span>@enderror
</div>

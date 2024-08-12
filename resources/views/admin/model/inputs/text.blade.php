<div class="form-group row pl-3 pr-3 {{ $classes ?? '' }}">
    <label class="col-form-label col-form-label-sm" for="{{ $field }}">{{ $label ?? ucfirst(str_replace('_', ' ', $field)) }}</label>
    <input type="text" name="{{ $field }}"
           {{@$disabled ? 'disabled="true"' : ''}}
           value="{{ old($field, @$entity->$field) }}" class="form-control form-control-sm @error($field) is-invalid @enderror">
    @error($field)<span class="invalid-feedback">{{ $message }}</span>@enderror
</div>

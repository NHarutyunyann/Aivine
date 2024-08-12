<div class="form-group row pl-3 pr-3 {{ $classes ?? '' }}">
   <div class="col-12">
       <label class="col-form-label col-form-label-sm" for="{{ $field }}">{{ $label ?? ucfirst(str_replace('_', ' ', $field)) }}</label>
       <input type="checkbox" name="{{ $field }}"
              value="1" {{ old($field, @$entity->$field) ? 'checked' : '' }} class="form-control form-control-sm @error($field) is-invalid @enderror">
       @error($field)<span class="invalid-feedback">{{ $message }}</span>@enderror
   </div>
</div>

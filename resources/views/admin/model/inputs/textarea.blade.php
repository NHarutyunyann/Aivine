<div class="card card-default collapsed-card main-card">
    <div class="card-header" data-card-widget="collapse">{{ $label ?? ucfirst(str_replace('_', ' ', $field)) }}</div>
    <div class="card-body tinymce-box">
        <div class="input-group-sm">
            <media-uploader
                prop-input-name="tinymce"
                prop-size="full"
                class="tinymce-uploader"
            ></media-uploader>
            <textarea class="form-control @error($field) is-invalid @enderror tinymce" name="{{ $field }}" rows="{{ $rows ?? 20 }}">{{ old($field, @$entity->$field) }}</textarea>
            @error($field)<span class="invalid-feedback">{{ $message }}</span>@enderror
        </div>
    </div>
</div>

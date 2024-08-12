<div class="card card-default main-card">
    <div data-card-widget="collapse">
        <div class="card-header">
            <span>{{ $label ?? ucfirst(str_replace('_', ' ', $field)) }}</span>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <media-uploader
                    prop-input-name="{{ $field }}"
                    prop-size="full"
                    class="@error($field) is-invalid @enderror"
                    :prop-selected-attachments="{{json_encode(\App\Models\Attachment::where('id', old($field, @$entity->$field))->get())}}"
                ></media-uploader>
                @error($field)<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>
</div>

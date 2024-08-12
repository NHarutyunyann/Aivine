

<!-- right column -->
<div class="col-md-3 main-content--small">
    <div class="row">
        <div class="col-12">
            @include('admin.model.actions-section', ['entity' => $entity ?? null])
        </div>
    </div>

    <div class="row">
        <div class="col-12">

            @include('admin.model.inputs.upload-from-media', ['entity' => $entity ?? null, 'field' => 'main_image'])
            
            @include('admin.model.inputs.text', ['entity' => $entity ?? null, 'field' => 'title', 'classes' => 'generate-title'])

        </div>
    </div>
</div>

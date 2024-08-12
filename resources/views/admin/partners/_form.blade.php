<!-- left column -->
<div class="col-md-9 main-content--large">
    <div class="row">
        <div class="col-12 card card-default main-card">
            <div class="card-body">
                @include('admin.model.inputs.text', ['entity' => $entity ?? null, 'field' => 'name'])
            </div>
        </div>
    </div>
</div>

<!-- right column -->
<div class="col-md-3 main-content--small">
    <div class="row">
        <div class="col-12">
            @include('admin.model.actions-section', ['entity' => $entity ?? null])
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @include('admin.model.inputs.upload-from-media', ['entity' => $entity ?? null, 'field' => 'image'])
        </div>
    </div>
</div>

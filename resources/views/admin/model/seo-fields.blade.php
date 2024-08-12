<div class="card card-default collapsed-card main-card seo-box">
    <div class="card-header" data-card-widget="collapse">SEO</div>
    <div class="card-body">
        @include('admin.model.inputs.text', ['entity' => $entity ?? null, 'field' => 'canonical'])

        @include('admin.model.inputs.text', ['entity' => $entity ?? null, 'field' => 'meta_title'])

        @include('admin.model.inputs.textarea', ['entity' => $entity ?? null, 'field' => 'meta_description', 'rows' => 10])
    </div>
</div>

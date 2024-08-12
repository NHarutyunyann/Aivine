<div class="card card-default main-card">
    <div class="card-header" data-card-widget="collapse">
        <span>Actions</span>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <div class="input-group-sm">
                        <select name="status" class="form-control custom-select">
                            @foreach(($statuses ?? \App\Models\AppModel::ALL_STATUSES) as $status)
                                <option value="{{ $status }}" @if(@$entity->status === $status) selected @endif>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-4 text-right">
                <button class="btn btn-sm btn-primary" form="create-form" type="submit">{{ $entity ? 'Update' : 'Create' }}</button>
            </div>
            @if($entity && $entity->publish_url)
                <div class="col-12 text-right">
                    <a class="btn btn-outline" target="_blank" href="{{$entity->publish_url}}">Preview</a>
                </div>
            @endif
        </div>
    </div>
</div>

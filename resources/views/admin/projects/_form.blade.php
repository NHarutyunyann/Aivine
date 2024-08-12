<!-- left column -->
<div class="col-md-9 main-content--large">
    <div class="row">
        <div class="col-12 card card-default main-card">
            <div class="card-body">
                
                

                @include('admin.model.inputs.text', ['entity' => $entity ?? null, 'field' => 'title', 'classes' => 'generate-slug'])
                @include('admin.model.inputs.text', ['entity' => $entity ?? null, 'field' => 'title_hy'])
                @include('admin.model.inputs.text', ['entity' => $entity ?? null, 'field' => 'title_ru'])


                @include('admin.model.inputs.text', ['entity' => $entity ?? null, 'field' => 'slug', 'classes' => 'input-slug'])

                @include('admin.model.inputs.text', ['entity' => $entity ?? null, 'field' => 'search_words', 'classes' => 'input-search_words'])

                @include('admin.model.inputs.text', ['entity' => $entity ?? null, 'field' => 'description', 'classes' => 'input-description'])
                @include('admin.model.inputs.text', ['entity' => $entity ?? null, 'field' => 'description_hy'])
                @include('admin.model.inputs.text', ['entity' => $entity ?? null, 'field' => 'description_ru'])



                @include('admin.model.inputs.text', ['entity' => $entity ?? null, 'field' => 'url', 'classes' => 'input-url'])

                @include('admin.model.inputs.textarea', ['entity' => $entity ?? null, 'field' => 'content'])

                @include('admin.model.inputs.multiple-select', ['entity' => $entity ?? null, 'field' => 'tags'])
                {{-- {{$options}} --}}

                {{-- <form ">
                    <label for="cars">Select</label>
                    <select name="cars" id="cars" multiple style="display: flex">
                        @foreach ($tags as $tag )
                            <option value="{{$tag->name}}">{{$tag->name}}</option>
                        @endforeach
                    </select>
                    <br><br>
                    <input type="submit" value="Submit">
                  </form> --}}
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

    {{-- <div class="row">
        <div class="col-12">
            @include('admin.model.inputs.upload-from-media', [
                'entity' => $entity ?? null,
                'field' => 'main_image',
            ])
        </div>
    </div> --}}
{{-- {{$tags}} --}}
    <div class="row image-row">
        <div class="col-12">
            <div class="card card-default main-card">
                <div data-card-widget="collapse">
                    <div class="card-header">
                        <span>Project Gallery</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <media-uploader
                                prop-input-name="relations[attachments]"
                                :prop-multiple="true"
                                class="@error('attachments') is-invalid @enderror"
                                :prop-selected-attachments="{{json_encode(@$entity->attachments ? $entity->attachments : \App\Models\Attachment::whereIn('id', old('attachments', []))->get())}}"
                            >
                        </media-uploader>
                            @error('attachments')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

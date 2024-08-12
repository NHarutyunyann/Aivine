<?php 
    $tags =  App\Models\Tag::get();
?>
<div class="row d-flex justify-content-center mt-100" style="height:60px">
    <div class="col"> 
        <select id="choices-multiple-remove-button" name='relations[tags][]' placeholder="Select upto tags" multiple>
            @foreach ($tags as $tag)
                <option value="{{$tag->id}}" @if(in_array($tag->id, $entity? $entity->tags()->pluck('id')->toArray(): [] )) selected @endif >{{$tag->name}}</option>
            @endforeach
        </select>
     </div>
</div>


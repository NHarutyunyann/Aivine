@foreach($subCategories as $subCategory)
    <option value={{ $subCategory->id }}>  <?php echo str_repeat("-", $level); ?> {{ $subCategory->name }}</option>
    @if(!$subCategory->subCategories->isEmpty())
        @include('admin.partials.subCategory',['subCategories' => $subCategory->subCategories, 'level' =>++$level])
    @endif
@endforeach


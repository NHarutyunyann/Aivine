@extends('layouts.admin')
@section('title', 'Menus')
@section('content')
    <div class="content-wrapper admin-attribute-edit-content">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-6">
                        <h1>Edit Menu - {{$entity->title}}</h1>
                    </div>
                </div>
            </div>
        </section>
        <div class="content">
           <div class="container-fluid">
               <div class="row">
               <!--<h2> Edit Menu </h2>-->
                    <div class="col-md-6"><div class="title-box mb-3">
                            <div class="form-group">
                                <label for="page_id">Pages</label>
                                <select class="form-control w-auto" name="page_id" id="page_id" required>
                                    <option value=""></option>
                                    @foreach(\App\Models\Page::all() as $page)
                                        <option value="{{ '/' . trim($page->slug, '/') }}" data-locales="{{json_encode($page)}}">{{$page->title}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <form id="frmEdit" class="form-horizontal">
                                    <div class="form-group">
                                        <input type="text" class="form-control item-menu" id="url" name="url" placeholder="Url">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control item-menu" id="name" name="name" placeholder="Title">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control item-menu" id="name" name="name_hy" placeholder="Title_hy">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control item-menu" id="name" name="name_ru" placeholder="Title_ru">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control item-menu" id="icon" name="icon" placeholder="Icon(fa)">
                                    </div>
                                </form>
                                <div>
                                    <button type="button" id="btnAdd" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
                                    <button type="button" id="btnUpdate" style="display: none" class="btn btn-primary"><i class="fa fa-refresh" aria-hidden="true"></i> Update</button>
                                </div>
                            </div>
                        </div>

                       <div class="card card-default collapsed-card main-card">
                           <div class="card-header" data-card-widget="collapse">Add menu</div>
                           <div class="card-body">
                               <form id="saveMenu" action="{{route('menus.update', $entity->id)}}" method="post" class="form-inline">
                                   @csrf
                                   @method('PUT')
                                   <input type="hidden" id="menu_items" name="items" value="{{json_encode($entity->items)}}">
                                   <div class="form-group">
                                       <input type="text" class="form-control" id="title" name="title" required value="{{$entity->title}}" placeholder="Title"  />
                                   </div>
                                   <div class="ml-5 form-group">
                                       <select name="type" class="form-control">
                                           <option {{$entity->type === 'main' ? 'selected' : ''}} value="main">Main</option>
                                           <option {{$entity->type === 'sidebar' ? 'selected' : ''}} value="sidebar">Sidebar</option>
                                           <option {{$entity->type === 'footer' ? 'selected' : ''}} value="footer">Footer</option>
                                       </select>
                                   </div>
                                   <div class="ml-5 form-group">
                                       <label for="active" class="mr-2">Active</label>
                                       <input type="checkbox" @if($entity->active) checked @endif class="form-control" id="active" name="active" value="{{$entity->active}}">
                                   </div>
                                   <div class="ml-5 form-group">
                                       <input type="submit" id="save-menu" class="form-control btn btn-primary" value="Save">
                                   </div>
                               </form>
                           </div>
                       </div>

                       <div class="card card-default collapsed-card main-card">
                           <div class="card-header" data-card-widget="collapse">Menu</div>
                           <div class="card-body">
                               <ul id="myEditor" class="sortableLists list-group">
                               </ul>
                           </div>
                       </div>
                    </div>
               </div>
           </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('/js/menu.js?v=' . config('app.release'))}}"></script>
    <script src="{{asset('/js/jquery-menu-editor.js?v=' . config('app.release'))}}"></script>
@endsection

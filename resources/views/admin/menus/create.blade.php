@extends('layouts.admin')
@section('title', 'Add New Menu')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col">
                    <h1>Add Menu </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="title-box mb-3">
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
                            <form id="saveMenu" action="{{route('menus.store')}}" method="post" class="form-inline">
                                @csrf
                                <input type="hidden" id="menu_items" name="items" value="">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="title" name="title" required placeholder="Title" />
                                </div>
                                <div class="ml-5 form-group">
                                    <select name="type" class="form-control">
                                        <option value="main">Main</option>
                                        <option value="sidebar">Sidebar</option>
                                        <option value="footer">Footer</option>
                                    </select>
                                </div>
                                <div class="ml-5 form-group">
                                    <label for="active" class="mr-2">Active</label>
                                    <input type="checkbox" checked class="form-control" id="active" name="active" value="1">
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
@endsection

@section('scripts')
    <script src="{{asset('/js/jquery-menu-editor.js?v=' . config('app.release'))}}"></script>
    <script src="{{asset('/js/menu.js?v=' . config('app.release'))}}"></script>
@endsection

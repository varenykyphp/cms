@extends('varenykyAdmin::app')

@section('title', __('varenyky::admin.menuItems.create.title'))

@section('content_header')
    <strong>{{ __('varenyky::admin.menuItems.create.title') }}</strong>
@stop

@section('save-btn', route('admin.items.store', $menu_id))
@section('back-btn', route('admin.items.index', $menu_id))

@section('content')

    <form action="{{ route('admin.items.store', $menu_id) }}" method="POST" id="nopulpForm" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card border p-3">
                    <div class="form-group mb-3">
                        <label for="type" class="form-label">{{ __('varenyky::labels.type') }}</label>
                        <select id="type" name="type" class="form-select mb-3" aria-label="Default select example">
                            <option value="cms">cms</option>
                            <option value="link">hardlink</option>
                            @if($categories)
                            <option value="category">category</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="name"
                            class="@if ($errors->has('name')) text-danger @endif">{{ __('varenyky::labels.name') }}</label>
                        <input id="name" type="text" placeholder="{{ __('varenyky::labels.name') }}..."
                            name="name" class="form-control @if ($errors->has('name')) is-invalid @endif"
                            value="{{ old('name') }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="sort_order"
                            class="@if ($errors->has('sort_order')) text-danger @endif">{{ __('varenyky::labels.sort_order') }}</label>
                            <input type="number" step="1" required class="form-control" id="sort_order" name="sort_order" placeholder="{{ __('varenyky::labels.sort_order') }}">
                    </div>
                    <div class="d-none mb-3" id="link_input">
                        <label for="link" class="form-label">{{ __('varenyky::labels.link') }}</label>
                        <input type="text" required class="form-control" id="link" name="link" placeholder="{{ __('varenyky::labels.link') }}">
                    </div>
                    <div class="d-none mb-3" id="page_input">
                        <label for="page" class="form-label">{{ __('varenyky::labels.page') }}</label>
                        <select id="page" name="page" class="form-select mb-3" aria-label="Default select example">
                            @foreach ($pages as $page)
                            <option value="{{$page->id}}">{{$page->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-none mb-3" id="category_input">
                        <label for="category" class="form-label">{{ __('varenyky::labels.category') }}</label>
                        <select id="category" name="category" class="form-select mb-3" aria-label="Default select example">
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="parent" class="form-label">{{ __('varenyky::labels.parent') }}</label>
                        <select name="parent" class="form-select" aria-label="Default select example">
                            <option value="0">{{ __('varenyky::labels.head') }}</option>
                            @foreach ($menuItems as $menuItem)
                                <option value="{{ $menuItem->id }}">{{ $menuItem->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>
        </div>
    </form>
@endsection

@section('js')
<script>
    $('document').ready(function () {
    $("#type").change(function () {
        var data = $(this).val();
        if (data == "cms") {
            $('#link_input').addClass('d-none');
            $('#page_input').removeClass('d-none');
            $('#category_input').addClass('d-none');
            document.getElementById("page").setAttribute("name", "link");
            document.getElementById("link").setAttribute("required", "");
            document.getElementById("category").removeAttribute("name");
        } else if (data == "category") {
            $('#link_input').addClass('d-none');
            $('#page_input').addClass('d-none');
            $('#category_input').removeClass('d-none');
            document.getElementById("category").setAttribute("name", "link");
            document.getElementById("link").removeAttribute("required");
            document.getElementById("page").removeAttribute("name");
        } else {
            $('#link_input').removeClass('d-none');
            $('#page_input').addClass('d-none');
            $('#category_input').addClass('d-none');
            document.getElementById("page").setAttribute("name", "");
            document.getElementById("link").removeAttribute("required");
            document.getElementById("category").removeAttribute("name");
        }
    });
    window.$('#type').trigger('change');
});


</script>
@stop
@extends('varenykyAdmin::app')

@section('title', __('varenyky::admin.pages.edit.title'))

@section('content_header')
    <strong>{{ __('varenyky::admin.pages.edit.title') }}</strong>
@stop

@section('save-btn', route('admin.pages.update', $page))
@section('back-btn', route('admin.pages.index'))

@section('content')

        <form action="{{ route('admin.pages.update', $page) }}" method="POST" id="nopulpForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="card border p-3">
                    <div class="template-blocks"></div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card border p-3">
                        <div class="form-group mb-3">
                            <label for="page_name"
                                class="@if ($errors->has('name')) text-danger @endif">{{ __('varenyky::labels.name') }}</label>
                            <input id="page_name" type="text" placeholder="{{ __('varenyky::labels.name') }}..."
                                name="name" class="form-control @if ($errors->has('name')) is-invalid @endif"
                                value="{{ $page->name }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="template" class="form-label">{{ __('varenyky::labels.template') }}</label>
                            <select name="template" class="form-select mb-3" aria-label="Default select example" data-action="get-blocks" data-href="/admin/pages/get-blocks">
                                <option value="">{{ __('varenyky::labels.choice') }}</option>
                                @foreach ($templates as $template)
                                    @php
                                        $name = str_replace(['templates/', '.php'], ['',''], $template);
                                    @endphp
                                    <option @if($name == $page->template) selected @endif value="{{ $name }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <hr>
                        <div class="form-group mb-3">
                            <label for="seo_title">{{ __('varenyky::labels.seo_title') }}</label>
                            <input id="seo_title" name="seo_title" placeholder="{{ __('varenyky::labels.seo_title') }}..."
                                class="form-control" value="{{ $page->seo_title }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="seo_desc">{{ __('varenyky::labels.seo_description') }}</label>
                            <input id="seo_desc" name="seo_desc"
                                placeholder="{{ __('varenyky::labels.seo_description') }}..." class="form-control"
                                value="{{ $page->seo_desc }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="seo_snip">{{ __('varenyky::labels.seo_snip') }}</label>
                            <input id="seo_snip" name="seo_snip" placeholder="{{ __('varenyky::labels.seo_snip') }}..."
                                class="form-control" value="{{ $page->seo_snip }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="seo_key">{{ __('varenyky::labels.seo_key') }}</label>
                            <input id="seo_key" name="seo_key" placeholder="{{ __('varenyky::labels.seo_key') }}..."
                                class="form-control" value="{{ $page->seo_key }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="parent" class="form-label">{{ __('varenyky::labels.parent') }}</label>
                            <select name="parent" class="form-select mb-3" aria-label="Default select example">
                                <option value="0">{{ __('varenyky::labels.head') }}</option>
                                @foreach ($pages as $xpage)
                                    <option @if($xpage->id == $page->id) selected @endif value="{{ $xpage->id }}">{{ $xpage->name }}</option>
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
        function addField(field) {
            let input = getField(field);
            window.$('.template-blocks').append(
                '<div class="form-group mb-3">' +
                '<label for="tBlock[' + field.slug + ']">' + field.name + '</label>' + input +
                '</div>'
            );
        }

        function getField(field) {
            if (window.$.inArray(field.value, ['', null, undefined]) !== -1) {
                field.value = '';
            }
            switch (field.type) {
                case 'text':
                    return '<input type="text" id="tBlock[' + field.slug + ']" name="tBlock[' + field.slug + ']" class="form-control keyword_checker tblocks" ftype="' + field.type + '" slug="' +
                        field.slug + '" value="' + field.body + '">';
                case 'wysiwyg':
                    return '<textarea id="tBlock[' + field.slug + ']" name="tBlock[' + field.slug + ']" class="tiny tinymce keyword_checker tblocks" ftype="' + field.type + '" slug="' + field.slug + '">' +
                        field.body + '</textarea>';
                case 'image':
                    return '<br><div class="row"><div class="col-3"><img src="' + field.body +
                        '" class="rounded w-100"></div><div class="col-9"><input class="form-control" type="file" id="tBlock[' + field.slug + ']" name="tBlock_' + field.slug + '" ftype="' + field
                        .type + '" slug="' + field.slug + '"></div></div>';
                case 'link':
                    let pages = @json($pages);
                    var selectField = '<select class="form-select" id="tBlock[' + field.slug + ']" name="tBlock[' + field.slug + ']" ftype="' + field.type + '" slug="' + field.slug +
                        '"><option value="">{{ __('labels.choice') }}</option>';
                    for (let i = 0; i < pages.length; i++) {
                        let selected = null;
                        if (parseInt(pages[i].id) === parseInt(field.body)) {
                            selected = 'selected="selected"';
                        }
                        selectField += '<option ' + selected + ' value="' + pages[i].id + '">' + pages[i].name + '</option>';
                    }
                    selectField += '</select>';
                    return selectField;
            }
        }

        window.$('[data-action="get-blocks"]').on('change', function() {
            let template = $(this).val();
            window.$('.removable').remove();
            window.$.ajax({
                url: '/admin/pages/get-blocks',
                method: 'post',
                data: {
                    template: template,
                    pageId: {{ $page->id }},
                    _token: '{{ csrf_token() }}',
                }
            }).done(function(data) {
                window.$.each(data, function(key, field) {
                    addField(field);
                });
                // window.$('.js-example-basic-multiple').select2({
                //     multiple: true,
                //     maximumSelectionLength: 24
                // });

                @php
                    if (in_array(request()->server('REMOTE_ADDR'), ['127.0.0.1'])) {
                        $plugins = '"link lists link table hr wordcount code"';
                    } else {
                        $plugins = "'link lists link table hr wordcount code'";
                    }
                @endphp

                tinymce.init({
                    selector: '.tiny',
                    height: 250,
                    plugins: {!! $plugins !!},
                    toolbar: "undo redo code | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link hr paste wordcount",
                    paste_data_images: true,
                    setup: function(editor) {
                        editor.on("change keyup", function(e) {
                            tinyMCE.triggerSave();
                            editor.save();
                            window.$(editor.getElement()).trigger('change');
                        });
                    }
                });
            });
        }).trigger('change');
    </script>
@stop

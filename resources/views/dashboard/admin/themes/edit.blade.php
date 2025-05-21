@extends('layouts.main-dashboard')

@section('stylecss')
    <style>
        .multi-step ul.progress-steps {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            justify-content: center;
            gap: 1em;
            list-style: none;
        }
        .multi-step ul.progress-steps li {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .multi-step ul.progress-steps li > span{
            position: relative;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 1em;
            border-radius: 50%;
            background-color:#a1acb8;
            z-index: 1;
        }
        .multi-step ul.progress-steps li.active > span {
            color: white;
            background-color: #696cff;
            z-index: 1;
        }

        .multi-step ul.progress-steps li p {
            width: 100px;
        }
        .multi-step ul.progress-steps li:not(:last-child)::before{
            content: '';
            position: absolute;
            left: 40px;
            top: 20px;
            width: 75px;
            height: 2px;
            background-color: #a1acb8;
        }
        .select2{
            max-width: 100%;
        }

        .select2-selection__arrow{
            display: none;
        }
        .select2-container .select2-selection--single{
            height: inherit !important;
        }
        .select2-container--default .select2-selection--single{
            border: 1px solid #d9dee3;
            border-radius: 0.375rem;
        }
        .select2-container .select2-selection--single .select2-selection__rendered{
            padding: 0.4375rem 1.875rem 0.4375rem 0.875rem;
            font-size: 0.9375rem;
            line-height: 1.53;
            color: #697a8d;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='rgba%2867, 89, 113, 0.6%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.875rem center;
            background-size: 17px 12px;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            appearance: none;
        }
        .select2-results__option{
            padding: 6px 0.875rem 6px 0.875rem;
        }
        .select2-search--dropdown {
            padding: 4px 0.875rem;
        }
        .select2-search--dropdown .select2-search__field{
            padding: 0.4375rem 0.875rem;
            font-size: 0.9375rem;
            font-weight: 400;
            line-height: 1.53;
            color: #697a8d;
            background-color: #fff;
            background-clip: padding-box;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 -960 960 960'%3e%3cpath fill='currentColor' stroke='rgba%2867, 89, 113, 0.6%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M380-320q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l224 224q11 11 11 28t-11 28q-11 11-28 11t-28-11L532-372q-30 24-69 38t-83 14Zm0-80q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.875rem center;
            background-size: 20px;
            border: 1px solid #d9dee3;
            border-color: 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            border-radius: 0.375rem;
        }
        .select2-search--dropdown .select2-search__field:focus {
            border: 1px solid #696cff;
            outline: none;
        }
        .select2-container--default .select2-selection--multiple{
            padding: 0.4375rem 1.875rem 0.4375rem 0.875rem;
            font-size: 0.9375rem;
            line-height: 1.53;
            color: #697a8d;
            border: 1px solid #d9dee3;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            appearance: none;
        }
        .select2-container--default.select2-container--focus .select2-selection--multiple, .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover, .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:focus {
            color: #697a8d;
            background-color: #fff;
            border: solid 1px #696cff;
            outline: 0;
            box-shadow: 0 0 0.25rem 0.05rem rgba(105, 108, 255, 0.1);
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice{
            margin: 0 5px 0 0;
        }
        span.select2-search .select2-search--inline{
            display: flex;
        }
        .select2-container--default .select2-search--inline .select2-search__field{
            margin: 0;
        }
        .select2-container .select2-search--inline .select2-search__field{
            margin: 0;
            height: 22.941px;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__clear{
            margin-top: 0
        }
    </style>
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
<!-- Breadcrumb -->
    <h4 class="fw-bold py-3 mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item text-muted fw-light">
                    <a href="/admin/dashboard">Dashboard</a>
                </li>
                <li class="breadcrumb-item text-muted fw-light">
                    <a href="/admin/themes">Themes</a>
                </li>
                <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
        </nav>
    </h4>
<!--/ End Breadcrumb -->

<!-- Hoverable Table rows -->
    <div class="card">
        <div class="card-body">
            <form id="form-theme" action="/admin/themes/{{ $theme->slug }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="card col-12 col-sm-6 mb-3 mb-sm-0">
                                <iframe src="/katalog/{{ $theme->slug }}?to=Prasetyo-Adi" height="500px" width="100%" title="{{ $title }}"></iframe>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="mb-3">
                                    <label for="nama_tag" class="form-label">Nama Tema</label>
                                    <input
                                        name="nama_tema"
                                        type="text"
                                        class="form-control @error('nama_tema') is-invalid @enderror"
                                        placeholder="Nama Tema"
                                        value="{{ old('nama_tema', $theme->nama_tema) }}" 
                                        onkeyup="noSymbol(this)"
                                    />
                                    @error('nama_tema')
                                        <div class="invalid-feedback">
                                            {{ $message }}        
                                        </div>
                                    @enderror
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="blade_file" class="form-label">Upload Template Tema</label>
                                        <input 
                                            name="blade_file"
                                            class="form-control @error('blade_file') is-invalid @enderror"
                                            type="file"
                                            accept=".blade.php"
                                        />
                                        @error('blade_file')
                                            <div class="invalid-feedback">
                                                {{ $message }}        
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input 
                                            name="slug" 
                                            type="text" 
                                            id="slug" 
                                            class="form-control @error('slug') is-invalid @enderror"
                                            {{-- style="cursor: default;" --}}
                                            placeholder="Slug"
                                            value="{{ old('slug', $theme->slug) }}" 
                                            {{-- onfocus="this.blur()"  --}}
                                            
                                        >
                                        @error('slug')
                                            <div class="invalid-feedback">
                                                {{ $message }}        
                                            </div>
                                        @enderror         
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Kategori</label>
                                    <select name="category_id" id="select-category" class="form-select select-search @error('category_id') is-invalid @enderror">
                                        @if ($categories->count())
                                            <option>-- Pilih Kategori --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->nama_category }}</option>
                                        @endforeach
                                        @else
                                            <option>-- Data Tidak Ada --</option>
                                        @endif
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}        
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="tags" class="form-label">Tag</label>
                                    <select 
                                        name="tags[]" 
                                        id="tags"
                                        class="select2 form-control @error('tags') is-invalid @enderror"
                                        multiple="multiple"
                                        placeholder="Select Tags"
                                    >
                                    @if (is_array(old('tags') ?? $oldtags))
                                        @foreach($tags as $id => $value)
                                            <option 
                                                value="{{ $id }}" 
                                                {{ in_array($id, old('tags', $oldtags) ?? []) ? 'selected' : '' }}
                                                >
                                                    {{ $value }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                    
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script type="text/javascript">
    $('#nama-tag').change(function() {
        $('#slug').val($('#nama-tag').val().toLowerCase().replaceAll(' ', '-'));
    });
    window.onload = function () {
        //change selectboxes to selectize mode to be searchable
        $(".select-search").select2({});
        $('.select-search').one('select2:open', function(e) {
            $('input.select2-search__field').prop('placeholder', 'Search..');
        });

        $("#tags").select2({
            // tags: true,
            multiple: true,
            tokenSeparators: [','],
            placeholder: '-- Pilih Tags --',
            allowClear: true,
            ajax: {
                url: "{{ route('get-tags') }}",
                type: "post",
                delay: 250,
                dataType: 'json',
                data: function(params) {
                    return{
                        nama_tag:params.term,
                        "_token":"{{ csrf_token() }}"
                    };
                },

                processResults:function(data) {
                    return{
                        results: $.map(data, function(item) {
                            return {
                                id: item.id,
                                text: item.nama_tag,
                            }
                        })
                    };
                },
            },
        });

        var old = {!! json_encode(["category_id" => old('category_id')]) !!}
        var data = {!! json_encode($theme->category_id) !!}
        // Set Selected data to el Select2
        $('#select-category').val(old.category_id ?? data).trigger("change");
    };

    var select2label;

    $("#form-theme").validate({
        ignore: 'input[type=hidden], .select2-input, .select2-focusser',
        rules: {
            'tags[]': {
                required: true
            }
        },
        messages: {
            'tags[]': {
                required: "Tags wajib diisi",
            }
        },
        errorPlacement: function(label, element) {
            if (element.hasClass('select2')) {
                label.insertAfter(element.next('.select2-container')).addClass('invalid-feedback');
                select2label = label
            } else {
                label.addClass('invalid-feedback');
                label.insertAfter(element);
            }
        },
        highlight: function(element) {
            // $(element).parent().addClass('is-invalid')
            $(element).addClass('is-invalid')
        },
        success: function(label, element) {
            // $(element).parent().removeClass('is-invalid')
            $(element).removeClass('is-invalid')
            label.remove();
        },
    });

    $('.select2').on("change", function(e) {
        $(this).trigger('blur');
        //remove label
        select2label.remove();
    });

    function noSymbol(input) {
        var regex = /[^a-zA-Z0-9 \n\t]/gi;
        input.value = input.value.replace(regex, "");
    }
</script>
@endsection
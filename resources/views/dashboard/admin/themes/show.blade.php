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
<div class="card" style="height: 85%">
        <iframe src="/katalog/{{ $theme->slug }}?to=Prasetyo-Adi" height="100%" width="100%" title="{{ $title }}"></iframe>

</div>
    
@endsection

@section('js')

@endsection
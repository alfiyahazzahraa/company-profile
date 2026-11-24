
@extends('admin.layouts.app')

@section('title', 'Edit Layanan')
@section('header', 'Edit Layanan')

@section('content')

<form
    action="{{ route('admin.services.update', $service) }}"
    method="POST"
    enctype="multipart/form-data"
>
    @csrf
    @method('PUT')

    @include('admin.services.form')

</form>

@endsection

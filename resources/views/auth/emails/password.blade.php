@extends('layouts.emails.base')

@push('styles')
<style>
    .reset-button {
        width: 150px;
        border-radius: 8px;
        position: relative;
        background: rgba(30, 20, 30, 0.7);
        text-align: center;
        margin-bottom: 1.5em;
    }
    .reset-button a {
        width: 100%;
        padding: .85em 0;
        display: inline-block;
    }
    .reset-button a:hover {
        text-decoration: none;
    }
</style>
@endpush

@section('content')
    <p>@trans('passwords.email.description')</p>
    <h3>@trans('passwords.email.click')</h3>
    <div class="reset-button">
        <a href="@route('reset', ['token' => $token])">@trans('passwords.email.reset-button')</a>
    </div>
    <small>@trans('passwords.email.fallback')</small>
    <br>
    <a href="@route('reset', ['token' => $token])">@route('reset', ['token' => $token])</a>
@stop
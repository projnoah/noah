@extends('layouts.emails.base')

@push('styles')
<style>
    .confirm-button {
        width: 150px;
        border-radius: 8px;
        position: relative;
        background: rgba(30, 20, 30, 0.7);
        text-align: center;
        margin-bottom: 1.5em;
    }
    .confirm-button a {
        width: 100%;
        padding: .85em 0;
        display: inline-block;
    }
    .confirm-button a:hover {
        text-decoration: none;
    }
</style>
@endpush

@section('content')
    <p>@trans('emails.auth.registered.subject')</p>
    <h3>@trans('emails.auth.registered.description')</h3>
    <div class="confirm-button">
        <a href="@route('confirm-email', ['token' => $token])">@trans('emails.auth.registered.button')</a>
    </div>
    <small>@trans('emails.fallback')</small>
    <br>
    <a href="@route('confirm-email', ['token' => $token])">@route('confirm-email', ['token' => $token])</a>
@stop
@extends('layouts.layouts')

@section('title', 'Login')

@section('script')
<link rel="stylesheet" type="text/css" href="/css/login.css">
<script type="text/javascript" src="/js/login.js"></script>
<script type="text/javascript" src="/js/submit.js"></script>
@endsection

@section('content')
    <hgroup>
        <h1>OpenStack</h1>
        <h3>By SSS</h3>
    </hgroup>
    <form id="login-form" action="{{ route('access') }}" method="post">
        {{ @csrf_field() }}
        <div class="group">
            <input type="text" name="domain"><span class="highlight"></span><span class="bar"></span>
            <label>Domain</label>
        </div>
        <div class="group">
            <input type="text" name="name"><span class="highlight"></span><span class="bar"></span>
            <label>Username</label>
        </div>
        <div class="group">
            <input type="password" name="pass"><span class="highlight"></span><span class="bar"></span>
            <label>Password</label>
        </div>
        <button type="submit" class="button buttonBlue">Sigin
            <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
        </button>
    </form>
@endsection
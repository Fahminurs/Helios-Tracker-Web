@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-{{ session('type', 'success') }}">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>Welcome, {{ Auth::user()->nama }}</h2>
                    <p>You are logged in as an administrator.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

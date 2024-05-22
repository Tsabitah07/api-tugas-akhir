@extends('layouts.auth')

@section('container')

    <div class="row justify-content-center">
        <div class="col-md-4 m-5">
            <div class="card p-3 border-3">
                <div class="card-body text-center">
                    <h3 class="card-title">Login</h3>

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="post" action="/admin/login">
                        @csrf

                        <div class="form-group text-start mb-2">
                            <label for="email">Email:</label>
                            <input type="text" name="email" id="email" class="form-control">
                        </div>

                        <div class="form-group text-start mb-2">
                            <label for="password">Password:</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>

{{--                        <div class="form-group text-start mb-2 flex">--}}
{{--                            <input type="checkbox" id="remember">--}}
{{--                            <label for="remember" class="form-check-label">Remember me</label>--}}
{{--                        </div>--}}

                        <button type="submit" class="btn btn-primary mt-3 mb-3 px-4">Login</button>
                    </form>

                    <a href="/admin/register">Don't have an account? Register</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showAlert() {
            alert("Login Success!");
        }

        function showError() {
            alert("Login Failed!");
        }
    </script>

@endsection

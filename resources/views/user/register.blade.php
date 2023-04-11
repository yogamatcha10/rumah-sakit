@extends('layoutlogin')
@section('content')
<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            @if($errors->any())
        @foreach($errors->all() as $err)
        <p class="alert alert-danger">{{ $err }}</p>
        @endforeach
        @endif
                            <form class="user" action="{{ route('register.action') }}" method="POST">
                            @csrf
                                <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="name" value="{{ old('name') }}"
                                            placeholder="Masukan nama">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="email" value="{{ old('email') }}"
                                        placeholder="Masukan alamat email">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                           name="password" placeholder="Masukan password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            name="password_confirm" placeholder="Masukan ulang password">
                                    </div>
                                </div>
                                <div class="mb-3">
                <button class="btn btn-primary btn-user btn-block">Register</button>
            </div>
                                <hr>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="/password">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="/login">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>
@endsection
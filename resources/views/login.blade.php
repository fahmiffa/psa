<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php $title = str_replace("_"," ",env('APP_NAME')); @endphp
    <title>{{ $title }}</title>
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/auth.css') }}">

    <style>
        .text-puprle {
            color: #673ab7
        }

        .bg-purple,
        .btn-purple {
            background-color: #673ab7
        }

        .btn-purple {
            color: white;
            background-color: #673ab7
        }

        .btn-purple:hover {
            color: white;
            background-color: #673ab7
        }

        #auth {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.dev/svgjs' width='1440' height='560' preserveAspectRatio='none' viewBox='0 0 1440 560'%3e%3cg mask='url(%26quot%3b%23SvgjsMask1001%26quot%3b)' fill='none'%3e%3crect width='1440' height='560' x='0' y='0' fill='rgba(77%2c 21%2c 96%2c 1)'%3e%3c/rect%3e%3cpath d='M0%2c495.891C91.72%2c491.005%2c157.647%2c412.336%2c242.688%2c377.63C353.065%2c332.584%2c510.999%2c363.44%2c573.417%2c261.871C634.131%2c163.075%2c551.685%2c36.888%2c520.771%2c-74.876C493.652%2c-172.919%2c477.954%2c-280.199%2c404.123%2c-350.175C332.656%2c-417.911%2c227.899%2c-429.739%2c130.575%2c-444.698C43.924%2c-458.016%2c-39.411%2c-439.016%2c-126.78%2c-431.774C-239.4%2c-422.438%2c-363.802%2c-459.904%2c-456.998%2c-395.991C-555.006%2c-328.778%2c-631.995%2c-208.555%2c-625.289%2c-89.903C-618.612%2c28.234%2c-494.017%2c98.337%2c-423.68%2c193.488C-369.673%2c266.548%2c-333.843%2c351.62%2c-259.893%2c404.402C-183.594%2c458.861%2c-93.608%2c500.877%2c0%2c495.891' fill='%23320e3e'%3e%3c/path%3e%3cpath d='M1440 946.435C1511.449 950.999 1576.665 903.124 1629.377 854.6759999999999 1676.946 810.955 1695.847 747.836 1720.882 688.275 1745.121 630.607 1765.276 574.094 1773.384 512.067 1784.096 430.11199999999997 1831.195 330.36400000000003 1775.6680000000001 269.142 1719.763 207.503 1614.682 256.872 1532.166 246.111 1465.604 237.43 1401.927 192.10199999999998 1337.831 212.043 1273.942 231.92000000000002 1246.883 304.659 1197.8029999999999 350.135 1140.905 402.85400000000004 1047.7939999999999 425.966 1026.465 500.543 1005.14 575.107 1046.96 655.892 1092.3809999999999 718.752 1133.551 775.7280000000001 1206.757 792.92 1265.56 831.435 1325.025 870.383 1369.06 941.903 1440 946.435' fill='%23681c82'%3e%3c/path%3e%3c/g%3e%3cdefs%3e%3cmask id='SvgjsMask1001'%3e%3crect width='1440' height='560' fill='white'%3e%3c/rect%3e%3c/mask%3e%3c/defs%3e%3c/svg%3e");
            background-size: cover;
        }
    </style>
</head>

<body>
    <div id="auth">
        <div class="row justify-content-center">
            <div class="col-md-4 col-sm-12">
                <div class="mt-5 mx-5 card card-body shadow-sm">
                    <a href="{{ route('home') }}">
                        <img class="mx-auto d-block" src="{{ asset('logo.png') }}" width="25%">
                    </a>
                    <h2 class="auth-title text-center my-2 text-purple">{{ $title }}</h2>
                    <br>
                    <p class="auth-subtitle mb-3 text-justify">Input data login Anda yang terdaftar di sistem</p>

                    @if (session('error'))
                        <div class="alert alert-danger" id="timeoutAlert" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session('info'))
                        <div class="alert alert-success" id="timeoutAlert" role="alert">
                            {{ session('info') }}
                        </div>
                    @endif

                    <form action="{{ route('sign') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control" value="{{ old('email') }}"
                                name="email" placeholder="Email">                   
                            @error('email')
                                <div class='small text-danger text-left'>{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-right mb-4">
                            <input type="password" name="password" id="pass" class="form-control"
                                placeholder="Password">
                            <div class="form-control-icon" onclick="show()">
                                <i id="con" class="bi bi-eye"></i>
                            </div>
                            <p class="text-end d-block my-2 text-purple"><a href="{{ route('forgot') }}"
                                class="ext-purple">Lupa password</a></p>
                            @error('password')
                                <div class='small text-danger text-left'>{{ $message }}</div>
                            @enderror
                        </div>                        
                        <p>Belum punya akun ?
                            <a href="{{ route('daftar') }}" class="badge bg-purple rounded-pill">Daftar</a>
                        </p>
                        <button class="btn btn-purple rounded-pill btn-block shadow-lg my-3">Log in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @if (session('error'))
        <script>
            var timeoutAlert = document.getElementById('timeoutAlert');
            setTimeout(function() {
                timeoutAlert.style.display = 'none';
            }, 3000);
        </script>
    @endif

    @if (session('info'))
        <script>
            var timeoutAlert = document.getElementById('timeoutAlert');
            setTimeout(function() {
                timeoutAlert.style.display = 'none';
            }, 3000);
        </script>
    @endif

    <script>
        const passwordInput = document.getElementById('pass');
        const icon = document.getElementById('con');

        function show() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            const con = passwordInput.getAttribute('type') === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
            icon.setAttribute("class", con);
        }
    </script>




    @include('sweetalert::alert')
</body>

</html>

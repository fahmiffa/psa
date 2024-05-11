<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php $title = str_replace("_"," ",env('APP_NAME')); @endphp
    <title>{{ $title }}</title>
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon">
    <link rel="shortcut icon"
        href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC"
        type="image/png">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/auth.css') }}">

    <style>
        .text-puprle {
            color: #673ab7
        }

        .bg-purple {
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
            @isset($user)
                <div class="col-md-8 col-sm-12">
                    <div class="mx-5 my-5 card card-body shadow-sm">
                        @if (session('status'))
                            <div class="alert alert-danger" id="timeoutAlert" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @include('pendaftaran/' . $par)
                    </div>
                </div>
            @else
                <div class="col-md-4 col-sm-12">
                    <div class="mt-5 mx-5 card card-body shadow-sm">
                        <a href="{{ route('home') }}">
                            <img class="mx-auto d-block" src="{{ asset('logo.png') }}" width="25%">
                        </a>
                        <h2 class="auth-title text-center my-2 text-purple">{{ $title }}</h2>
                        <br>
                        <p class="auth-subtitle mb-3 text-justify">Silahkan Input Data pendaftaran</p>

                        @if (session('error'))
                            <div class="alert alert-danger" id="timeoutAlert" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('daftar') }}" method="post">
                            @csrf
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="user" class="form-control form-control-xl" value="{{ old('user') }}"
                                    name="user" placeholder="Username">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                                @error('user')
                                    <div class='small text-danger text-left'>{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="email" class="form-control form-control-xl" value="{{ old('email') }}"
                                    name="email" placeholder="Email">
                                <div class="form-control-icon">
                                    <i class="bi bi-envelope"></i>
                                </div>
                                @error('email')
                                    <div class='small text-danger text-left'>{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="number" name="hp" value="{{ old('hp') }}"
                                    class="form-control form-control-xl" placeholder="Nomor HP">
                                <div class="form-control-icon">
                                    <i class="bi bi-phone"></i>
                                </div>
                                @error('hp')
                                    <div class='small text-danger text-left'>{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="password" name="password" class="form-control form-control-xl"
                                    placeholder="Password">
                                <div class="form-control-icon">
                                    <i class="bi bi-shield-lock"></i>
                                </div>
                                @error('password')
                                    <div class='small text-danger text-left'>{{ $message }}</div>
                                @enderror
                            </div>
                            <p>Sudah punya akun ?
                                <a href="{{ route('login') }}" class="badge bg-purple rounded-pill">Login</a>
                            </p>
                            <button class="btn btn-purple btn-block rounded-pill shadow-lg mt-3">Daftar</button>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
        @stack('js')
        @if (session('error'))
            <script>
                var timeoutAlert = document.getElementById('timeoutAlert');
                setTimeout(function() {
                    timeoutAlert.style.display = 'none';
                }, 3000);
            </script>
        @endif

        <script>
            document.getElementById('button-back').addEventListener('click', function(e) {
                document.getElementById('back').submit();
            });
        </script>

        @include('sweetalert::alert')

    </body>

    </html>

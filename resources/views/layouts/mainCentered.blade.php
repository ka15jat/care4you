<!DOCTYPE HTML>
@include('layouts.header')

<style>
    body,
    wrapper {
        min-height: 100vh;
        overflow-x: hidden;
        overflow-y: auto;
    }

    .alert {
        opacity: 1;
        transition: opacity 3s;
    }

    .alertFade {
        opacity: 0;
    }

</style>

<body style='background-color:var(--Bg);'>
    <wrapper class="d-flex flex-column min-vh-100">
        @if (Route::currentRouteName() != 'login' && Route::currentRouteName() != 'register' && Route::currentRouteName() != 'registerCompany')
            @include('layouts.navbar')
        @endif
        @if ($errors->any())
            <div class="alert alert-danger" style="z-index: 20;position:absolute;width:100%;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li
                            style="background-color: transparent !important;list-style-type:none;padding: 0 !important;margin: 0 !important;">
                            {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @isset($error)
            <div class="alert alert-danger" style="z-index: 20;position:absolute;width:100%;">
                <ul style="background-color: transparent !important;">
                    <li
                        style="background-color: transparent !important;list-style-type:none;padding: 0 !important;margin: 0 !important;">
                        {{ $error }}</li>
                </ul>
            </div>
        @endisset

        @if (\Session::has('success'))
            <div class="alert alert-success" style="z-index: 20;position:absolute;width:100%;">
                <li
                    style="background-color: transparent !important;list-style-type:none;padding: 0 !important;margin: 0 !important;">
                    {{ \Session::get('success') }}</li>
            </div>
        @endif
        @if (\Session::has('error'))
            <div class="alert alert-danger" style="z-index: 20;position:absolute;width:100%;">
                <li
                    style="background-color: transparent !important;list-style-type:none;padding: 0 !important;margin: 0 !important;">
                    {{ \Session::get('error') }}</li>
            </div>
        @endif
        <main class="flex-fill d-flex align-items-center">
            <div class="container-fluid text-center">
                <div id="BodyContainer">
                    @yield('Content')
                </div>
            </div>
        </main>
        <footer>
            @include('layouts.footer')
        </footer>
    </wrapper>
    <script>
        setTimeout(() => {
            let alerts = document.querySelectorAll('.alert')
            if (alerts.length > 0) {
                for (let i = 0; i < alerts.length; i++) {
                    alerts[i].classList.add("alertFade");
                    setTimeout(() => {
                        alerts[i].remove()
                    }, 3000);
                }
            }
        }, 3000);
    </script>

</body>

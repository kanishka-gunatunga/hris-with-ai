<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRIS Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font import (Nunito Sans) -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        .nunito-sans {
            font-family: 'Nunito Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-[#F6F6F8] flex items-center justify-center min-h-screen relative overflow-y-visible font-sans">

    <!-- Top Right Decoration -->
    <div class="absolute top-0 right-0 pointer-events-none">
        <svg width="273" height="304" viewBox="0 0 273 304" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M247.181 303.965C298.12 302.104 293.091 230.518 333.043 205.156C364.334 185.292 421.899 203.518 445.778 177.895C469.03 152.945 439.55 117.04 443.98 86.1152C449.169 49.8968 496.502 12.9896 473.942 -18.6796C451.427 -50.2856 391.272 -46.495 346.194 -51.157C312.679 -54.6231 280.445 -37.3595 247.181 -42.131C203.103 -48.4539 169.951 -85.7242 125.316 -82.8413C77.8007 -79.7724 20.7004 -62.0544 3.70367 -26.4053C-14.0032 10.7332 37.1184 46.8376 44.7609 86.1152C50.8866 117.597 20.7523 154.137 43.8788 180.069C67.4176 206.464 124.435 191.957 156.67 211.602C196.239 235.716 197.502 305.781 247.181 303.965Z"
                fill="#FF5A1D" fill-opacity="0.4" />
        </svg>
    </div>

    <!-- Bottom Left Decoration -->
    <div class="absolute bottom-0 left-0 pointer-events-none">
        <svg width="280" height="289" viewBox="0 0 280 289" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M47.1814 0.0346434C98.1196 1.89645 93.0908 73.4825 133.043 98.8445C164.334 118.708 221.899 100.482 245.778 126.105C269.03 151.055 239.55 186.96 243.98 217.885C249.169 254.103 296.502 291.01 273.942 322.68C251.427 354.286 191.272 350.495 146.194 355.157C112.679 358.623 80.4446 341.36 47.1814 346.131C3.10312 352.454 -30.0488 389.724 -74.6842 386.841C-122.199 383.772 -179.3 366.054 -196.296 330.405C-214.003 293.267 -162.882 257.162 -155.239 217.885C-149.113 186.403 -179.248 149.863 -156.121 123.931C-132.582 97.536 -75.5653 112.043 -43.3302 92.398C-3.76141 68.2841 -2.49847 -1.78116 47.1814 0.0346434Z"
                fill="#FF5A1D" fill-opacity="0.4" />
        </svg>
    </div>

    <div class="grid grid-col-1 justify-items-center w-full">
        <!-- Logo Area -->
      <div class="relative center w-48 h-32 top-10  items-center justify-center">
            <!--<h2 class="text-4xl font-bold text-[#FF5A1D]">HRIS</h2>-->
             <img src="{{ asset('assets/images/slt_logo_new.png') }}" class="mb-4">
        </div>

        <!-- Login Card -->
        <div
            class="bg-white nunito-sans px-10 py-6 rounded-lg shadow-[0_8px_30px_rgb(0,0,0,0.04)] max-w-md w-full z-10">
            <div class="text-left mb-8">
                <h1 class="text-[30px] font-semibold mb-4 leading-10 text-left text-[#172635]">Welcome to <br /><span
                        class="font-[800]">HRIS</span></h1>

                @if(Session::has('login_error'))
                    <div class="p-3 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                        role="alert">
                        {{ Session::get('login_error') }}
                    </div>
                @endif
            </div>

            <form method="POST" action="">
                @csrf

                <!-- Username Input -->
                <div class="mb-4">
                    <input type="text" id="user_name" name="user_name" placeholder="Username"
                        class="w-full px-4 py-3 text-[#7C7C7C] text-sm border border-[#B0B0B0] rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition duration-300"
                        required>
                    @if($errors->has("user_name"))
                        <p class="mt-2 text-sm text-red-600">{{ $errors->first('user_name') }}</p>
                    @endif
                </div>

                <div class="mb-2 relative">
                    <input type="password" id="password" name="password" placeholder="Password"
                        class="w-full px-4 py-3 text-[#7C7C7C] text-sm border border-[#B0B0B0] rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition duration-300"
                        required>
                    @if($errors->has("password"))
                        <p class="mt-2 text-sm text-red-600">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <div class="text-left mb-14">
                    <!-- Forgot Password removed as requested -->
                </div>

                <button type="submit"
                    class="w-full bg-[#FF5A1D] text-white font-semibold py-3 rounded-lg hover:bg-orange-600 transition duration-300">
                    LOGIN
                </button>
            </form>

            <div class="mt-14 text-center text-xs text-[#7C7C7C]">
                <p>Copyright © {{ date('Y') }} HRIS. All Rights Reserved.</p>
            </div>
        </div>
    </div>

</body>

</html>
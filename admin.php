<?php

?>
<html>
    <head>
        <title>Mary Alston Hotel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="stylesheet" href="alston.css"> -->
        <script src="https://kit.fontawesome.com/dbed6b6114.js" crossorigin="anonymous"></script>
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- <link rel = "icon" href = "images/logo.png" type = "image/png"> -->
    </head>

    <body class="flex justify-center items-center">
        <form class = "flex flex-col items-center gap-5 p-6 border-2 border-black text-lg">
            <div class="text-3xl font-semibold w-full text-center">ADMIN </div>
            <div class="flex flex-col gap-3 w-full">
                <div class="flex gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                    <input type = "text" id = "username" placeholder="Username" class="border-2 border-black px-2">
                </div>
                <div class="flex gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                    </svg>
                    <input type = "text" id = "password" placeholder="Password" class="border-2 border-black px-2">
                </div>
            </div>

            <input type = "submit" value="LOGIN" class="border-2 border-black p-2 w-full cursor-pointer">
        </form>
        <script src="alston_script.js"></script>
    </body>
</html>
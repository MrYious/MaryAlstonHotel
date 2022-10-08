<?php
	// session_start();
	// if(!isset($_SESSION['username']) && !isset($_SESSION['password'])){
	// 	header('location:alston_main.html');
	// }
?>
<html>
    <head>
        <title> Admin Login</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="js/jquery-3.6.1.min.js"></script>
        <link rel="icon" href="images/favicon.png" type = "image/png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        },
                    }
                }
            }
        </script>
    </head>

    <body>
        <main class="flex justify-center items-center w-full min-h-screen bg-[url('/images/gallery.jpg')] bg-cover">
            <form action="" method="POST" class="flex flex-col items-center gap-5 p-6 border-2 border-slate-100 text-lg bg-slate-100 drop-shadow-2xl shadow-2xl shadow-black rounded-lg">
                <div class="text-3xl font-semibold text-center ">Administrator </div>
                <div class="flex justify-center items-center flex-col gap-3 w-full">
                    <!-- ERROR MESSAGE -->
                    <!-- <div class="text-xs bg-red-400 py-1 px-3 rounded-full text-center">Incorrect username or password</div> -->
                    <div class="flex justify-center items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 " viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                        <input type="text" name="username" id="username" placeholder="Username" class="border-[1px] border-black p-2 text-sm focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none rounded" maxlength="15" size="25" required autocomplete="username">
                    </div>
                    <div class="flex justify-center items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                        </svg>
                        <input type="password" name="password" id="password" placeholder="Password" class="border-[1px] border-black p-2 text-sm focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none rounded" maxlength="15" size="25" required>
                    </div>
                </div>
                <input type="submit" value="LOGIN" class="p-2 w-full cursor-pointer bg-green-700 shadow-md shadow-black text-white font-semibold tracking-widest  hover:bg-green-900">
            </form>
        </main>
    </body>
</html>
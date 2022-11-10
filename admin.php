<?php
	session_start();
	include 'api/checkExpired.php';
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
            <form id="adminLogin" action="api/validateLogin.php" method="POST" class="flex flex-col items-center gap-3 p-6 border-2 border-slate-100 text-lg bg-slate-100 drop-shadow-2xl shadow-2xl shadow-black rounded-lg">
                <div class="text-2xl lg:text-3xl font-semibold text-center ">Administrator </div>
                <!-- ERROR MESSAGE -->
                <?php
                    if (isset($_SESSION["errorMsg"])) {
                        echo '<div class="text-sm bg-red-400 py-1 px-3 rounded-full text-center">' . $_SESSION["errorMsg"] . '</div>';
                    }
                ?>
                <div class="flex justify-center items-center flex-col w-64 lg:w-72 text-sm lg:text-base">
                    <div class="form-floating mb-3 w-full">
                        <input id="username" type="text" name="username" class="form-control
                            block
                            w-full
                            px-3
                            py-1.5
                            font-normal
                            text-gray-700
                            bg-white bg-clip-padding
                            border border-solid border-gray-300
                            rounded
                            transition
                            ease-in-out
                            m-0
                            focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="floatingInput" placeholder="Username" required maxlength="15" minlength="3"
                        >
                        <label for="floatingInput" class="text-gray-700">Username</label>
                    </div>
                    <div class="form-floating mb-3 w-full">
                        <input id="password" type="password" name="password" class="form-control
                            block
                            w-full
                            px-3
                            py-1.5
                            font-normal
                            text-gray-700
                            bg-white bg-clip-padding
                            border border-solid border-gray-300
                            rounded
                            transition
                            ease-in-out
                            m-0
                            focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="floatingPassword" placeholder="Password" required maxlength="15" minlength="5"
                        >
                        <label for="floatingPassword" class="text-gray-700">Password</label>
                    </div>
                </div>
                <input id="submitBtn" type="submit" value="LOGIN" class="p-2 w-full cursor-pointer bg-green-700 shadow-md shadow-black text-white font-semibold tracking-widest  hover:bg-green-900">
            </form>
        </main>
        <script>
            $(document).ready(function(){
                $('#username').focus();
                $('#password').val('');
            });
        </script>
    </body>
</html>
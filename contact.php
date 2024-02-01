<?php
	session_start();
?>
<html>
    <head>
        <title> Contact Us </title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="/js/jquery-3.6.1.min.js"></script>
        <link rel="icon" href="/images/favicon.png" type = "image/png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css"
        />
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
        <div class="flex justify-center items-center min-h-screen bg-gray-200">
            <div class="flex flex-col w-[90%] lg:w-[75%]  lg:w-[50%] bg-gray-300 shadow-gray-500 shadow-sm drop-shadow-xl">
                <div class="flex flex-col p-7 gap-5">
                    <div class="flex flex-col gap-1">
                        <div class="text-2xl font-bold">Contact Us Form</div>
                        <div class="italic text-sm">Send us a message</div>
                    </div>
                    <form id="sendMessage" class="flex flex-col gap-2">
                        <label class="flex flex-col gap-1 w-full">
                            <div class="font-semibold">
                                Name <span class="text-red-600 font-bold">*</span>
                            </div>
                            <input type="text" name="name" id="name" required class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black">
                        </label>
                        <label class="flex flex-col gap-1 w-full">
                            <div class="font-semibold">
                                Email <span class="text-red-600 font-bold">*</span>
                            </div>
                            <input type="email" name="email" id="email" required class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black">
                        </label>
                        <label class="flex flex-col gap-1 w-full">
                            <div class="font-semibold">
                                Message <span class="text-red-600 font-bold">*</span>
                            </div>
                            <textarea rows="6" name="message" id="message" required class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black resize-none" ></textarea>
                        </label>
                        <button type="submit" class="w-full text-white rounded font-bold py-2 bg-green-800 hover:bg-green-900 shadow-sm shadow-black mt-3">SEND MESSAGE</button>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
        <script>
            // EVENT HANDLER
            $("#sendMessage").submit(function(e) {
                e.preventDefault();
                var name = $('#name').val();
                var email = $('#email').val();
                var message = $('#message').val();
                $('#name').val('');
                $('#email').val('');
                $('#message').val('');
                $.post("/api/newMessage.php",{
                    name: name,
                    email: email,
                    message: message,
                }).done(function(data, status) {
                    alert('Message is submitted successfully')
                }).fail(function(response) {
                })
            });
        </script>
    </body>
</html>
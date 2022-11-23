<?php
	session_start();
	include dirname(__DIR__).'/api/authSession.php';
	include dirname(__DIR__).'/api/checkExpired.php';
?>
<html>
    <head>
        <title> Settings </title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="../js/jquery-3.6.1.min.js"></script>
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
        <!-- Mobile Nav Button -->
        <span class="fixed text-white text-4xl top-5 left-4 cursor-pointer  z-[2]" onclick="openSidebar()" >
            <div class="p-1 bg-gray-900 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                </svg>
            </div>
        </span>

        <div class="flex min-h-screen">
            <!-- NAV -->
            <div class="bg-gray-200 lg:w-[300px] shrink-0">
                <div class="sidebar fixed top-0 bottom-0 left-0 p-2 w-[300px] z-[2] overflow-y-auto text-center bg-gray-800">
                    <div class="text-gray-100 text-xl">
                        <div class="p-2.5 mt-1 flex justify-between items-center">
                            <h1 class="font-bold text-gray-200 text-[20px] ml-3">MARY ALSTON HOTEL</h1>
                            <i class="bi bi-x-lg cursor-pointer lg:hidden" onclick="openSidebar()"></i>
                        </div>
                        <div class="my-2 bg-gray-600 h-[1px]"></div>
                    </div>
                    <a href="/admin/dashboard.php" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                        <i class="bi bi-columns"></i>
                        <span class="text-[15px] ml-4 text-gray-200 font-bold">Dashboard</span>
                    </a>
                    <a href="/admin/calendar.php" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                        <i class="bi bi-calendar-week"></i>
                        <span class="text-[15px] ml-4 text-gray-200 font-bold">Official Calendar</span>
                    </a>
                    <a href="/admin/today.php" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                        <i class="bi bi-hourglass"></i>
                        <span class="text-[15px] ml-4 text-gray-200 font-bold">Manage Today</span>
                    </a>
                    <a href="/admin/reschedule.php" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                        <i class="bi bi-arrow-repeat"></i>
                        <span class="text-[15px] ml-4 text-gray-200 font-bold">Reschedule</span>
                    </a>
                    <a href="/admin/reservations.php" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                        <i class="bi bi-calendar-plus"></i>
                        <span class="text-[15px] ml-4 text-gray-200 font-bold">Pending Reservations</span>
                    </a>
                    <div onclick="dropdown1()" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                        <i class="bi bi-clock-history"></i>
                        <div class="flex justify-between w-full items-center">
                            <span class="text-[15px] ml-4 text-gray-200 font-bold">History</span>
                            <span class="text-sm rotate-180" id="arrow1">
                                <i class="bi bi-chevron-down"></i>
                            </span>
                        </div>
                    </div>
                    <div class="text-left text-sm mt-2 w-4/5 mx-auto text-gray-200 font-bold" id="submenu1">
                        <a href="/admin/completed.php"  class="block cursor-pointer p-2 hover:bg-blue-600 rounded-md mt-1">
                            Completed
                        </a>
                        <a href="/admin/expired.php"  class="block cursor-pointer p-2 hover:bg-blue-600 rounded-md mt-1">
                            Expired
                        </a>
                        <a href="/admin/declined.php"  class="block cursor-pointer p-2 hover:bg-blue-600 rounded-md mt-1">
                            Declined
                        </a>
                    </div>
                    <div class="my-4 bg-gray-600 h-[1px]"></div>
                    <div onclick="dropdown2()" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                        <i class="bi bi-bar-chart"></i>
                        <div class="flex justify-between w-full items-center">
                            <span class="text-[15px] ml-4 text-gray-200 font-bold">Reports</span>
                            <span class="text-sm rotate-180" id="arrow2">
                                <i class="bi bi-chevron-down"></i>
                            </span>
                        </div>
                    </div>
                    <div class="text-left text-sm mt-2 w-4/5 mx-auto text-gray-200 font-bold" id="submenu2">
                        <a href="/admin/reports/monthly.php"  class="block cursor-pointer p-2 hover:bg-blue-600 rounded-md mt-1">
                            Monthly
                        </a>
                        <a href="/admin/reports/yearly.php"  class="block cursor-pointer p-2 hover:bg-blue-600 rounded-md mt-1">
                            Yearly
                        </a>
                    </div>
                    <a href="/admin/settings.php" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                        <i class="bi bi-gear"></i>
                        <span class="text-[15px] ml-4 text-gray-200 font-bold">Settings</span>
                    </a>
                    <a href="/api/logout.php" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span class="text-[15px] ml-4 text-gray-200 font-bold">Logout</span>
                    </a>
                </div>
            </div>
            <!-- CONTENT -->
            <div class="w-full">
                <section class="flex py-7 px-20 lg:px-7 bg-gray-300">
                    Admin / Settings
                </section>
                <section class="flex flex-col p-7 justify-start items-start bg-gray-200 h-full">
                    <div class="flex flex-col w-[90%] md:w-[70%] lg:w-[50%] gap-5 p-8">
                        <div class="flex flex-col gap-1">
                            <div class=" text-3xl">Change Admin</div>
                            <div class=" text-sm">Modify administrator's login credentials</div>
                            <!-- ERROR MESSAGE -->
                            <?php
                                if (isset($_SESSION["errorMsg"])) {
                                    echo '<div class="mt-2 bg-red-200 p-2 text-red-600 rounded">Failed: '. $_SESSION["errorMsg"] .'</div>';
                                }
                            ?>
                        </div>
                        <form action="/api/updateAdmin.php" method="POST" autocomplete="off"  class="flex-col flex gap-2">
                            <input required type="password" autocomplete="off" name="oldPassword" placeholder="Current Password" class="p-2 mb-5 outline-none border-[1px] border-black" >
                            <input required type="text" minlength="4" name="newUsername" placeholder="New Username" class="p-2 outline-none border-[1px] border-black" >
                            <input required type="password" minlength="5" maxlength="15" name="newPassword" placeholder="New Password" class="p-2 outline-none border-[1px] border-black" >
                            <input required type="password" minlength="5" maxlength="15" name="confirmNewPassword" placeholder="Confirm New Password" class="p-2 outline-none border-[1px] border-black" >
                            <button type="submit" class="w-full text-white rounded font-bold py-2 bg-green-800 hover:bg-green-900 shadow-sm shadow-black mt-3">SAVE CHANGES</button>
                        </form>
                        <div class="flex flex-col gap-1">
                            <div class=" text-3xl">Update Payment Channels</div>
                            <div class=" text-sm">Modify the official payment channels to be seen by the guests</div>
                        </div>
                        <form autocomplete="off"  class="flex gap-5">
                            <div class="flex flex-col gap-2">
                                <div>Payment Channel 1</div>
                                <input type="text" id="type1" placeholder="Type" class="p-2 outline-none border-[1px] border-black" >
                                <input type="text" id="name1" placeholder="Name" class="p-2 outline-none border-[1px] border-black" >
                                <input type="text" id="number1" placeholder="Number" class="p-2 outline-none border-[1px] border-black" >
                            </div>
                            <div class="flex flex-col gap-2">
                                <div>Payment Channel 2</div>
                                <input type="text" id="type2" placeholder="Type" class="p-2 outline-none border-[1px] border-black" >
                                <input type="text" id="name2" placeholder="Name" class="p-2 outline-none border-[1px] border-black" >
                                <input type="text" id="number2" placeholder="Number" class="p-2 outline-none border-[1px] border-black" >
                            </div>
                            <div class="flex flex-col gap-2">
                                <div>Payment Channel 3</div>
                                <input type="text" id="type3" placeholder="Type" class="p-2 outline-none border-[1px] border-black" >
                                <input type="text" id="name3" placeholder="Name" class="p-2 outline-none border-[1px] border-black" >
                                <input type="text" id="number3" placeholder="Number" class="p-2 outline-none border-[1px] border-black" >
                            </div>
                        </form>
                        <button id="updatePaymentChannels" type="submit" class="w-full text-white rounded font-bold py-2 bg-green-800 hover:bg-green-900 shadow-sm shadow-black mt-3">SAVE CHANGES</button>
                    </div>
                </section>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
        <script type="text/javascript">
            function dropdown1() {
                document.querySelector("#submenu1").classList.toggle("hidden");
                document.querySelector("#arrow1").classList.toggle("rotate-0");
            }
            function dropdown2() {
                document.querySelector("#submenu2").classList.toggle("hidden");
                document.querySelector("#arrow2").classList.toggle("rotate-0");
            }
            dropdown1();
            dropdown2();

            function openSidebar() {
                document.querySelector(".sidebar").classList.toggle("hidden");
            }
        </script>
        <script>
            $(document).ready(function () {
            var channel1 = {name: '', number: '', type: ''}
            var channel2 = {name: '', number: '', type: ''}
            var channel3 = {name: '', number: '', type: ''}

            $.post("/api/getPaymentChannels.php")
            .done(function(data, status) {
                var channels = data.channels[0];
                channel1 = JSON.parse(channels.channel1);
                channel2 = JSON.parse(channels.channel2);
                channel3 = JSON.parse(channels.channel3);

                $('#type1').val(channel1.type);
                $('#type2').val(channel2.type);
                $('#type3').val(channel3.type);

                $('#name1').val(channel1.name);
                $('#name2').val(channel2.name);
                $('#name3').val(channel3.name);

                $('#number1').val(channel1.number);
                $('#number2').val(channel2.number);
                $('#number3').val(channel3.number);
            }).fail(function() {

            })

            $( "#updatePaymentChannels" ).click(function(e) {
                e.preventDefault();
                channel1 = {
                    name: $('#name1').val(),
                    number: $('#number1').val(),
                    type: $('#type1').val(),
                }
                channel2 = {
                    name: $('#name2').val(),
                    number: $('#number2').val(),
                    type: $('#type2').val(),
                }
                channel3 = {
                    name: $('#name3').val(),
                    number: $('#number3').val(),
                    type: $('#type3').val(),
                }
                // console.log(channel1, channel2, channel3);
                $.post("/api/updatePaymentChannels.php",{
                    channel1: JSON.stringify(channel1),
                    channel2: JSON.stringify(channel2),
                    channel3: JSON.stringify(channel3),
                }).done(function(data, status) {
                    alert('Updated Successfully')
                }).fail(function() {
                    alert('Update was unsuccessful.')
                })
            });
        });
        </script>
    </body>
</html>
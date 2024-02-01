<?php
	session_start();
	include dirname(__DIR__).'/api/authSession.php';
	include dirname(__DIR__).'/api/checkExpired.php';

    if ( $_SESSION["role"] !== 'master' && ( !isset($_SESSION["permissions"]) || $_SESSION["permissions"]->manageBlacklist !== 'true')) {
		header('location:/');
    }
?>
<html>
    <head>
        <title> Blacklist </title>
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
    <body class=" bg-gray-200">
        <!-- Mobile Nav Button -->
        <span class="fixed text-white text-4xl top-5 left-4 cursor-pointer z-[2]" onclick="openSidebar()" >
            <div class="p-1 bg-gray-900 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                </svg>
            </div>
        </span>

        <div class="flex">
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
                    <div class="p-2.5 mt-3 flex items-center rounded-md text-white">
                        <i class="bi bi-person-circle text-3xl"></i>
                        <div class="flex flex-col items-start gap-1">
                            <?php
                                if ($_SESSION["role"] === 'master') {
                                    echo '<span class="text-[15px] ml-4 text-gray-200 font-bold">'. $_SESSION["username"] .'</span>';
                                } else if(isset($_SESSION["username"])){
                                    echo '<span class="text-[15px] ml-4 text-gray-200 font-bold">'. $_SESSION["name"] .'</span>';
                                }
                            ?>
                            <span class="text-[15px] ml-4 text-gray-200 font-bold">Administrator</span>
                        </div>
                    </div>
                    <a href="/admin/dashboard.php" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                        <i class="bi bi-columns"></i>
                        <span class="text-[15px] ml-4 text-gray-200 font-bold">Dashboard</span>
                    </a>
                    <a href="/admin/calendar.php" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                        <i class="bi bi-calendar-week"></i>
                        <span class="text-[15px] ml-4 text-gray-200 font-bold">Official Calendar</span>
                    </a>
                    <?php
                        if ( $_SESSION["role"] === 'master' || ( isset($_SESSION["permissions"]) && $_SESSION["permissions"]->manageCurrent === 'true')) {
                            echo '
                                <a href="/admin/today.php" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                                    <i class="bi bi-hourglass"></i>
                                    <span class="text-[15px] ml-4 text-gray-200 font-bold">Manage Today</span>
                                </a>
                            ';
                        }
                    ?>
                    <?php
                        if ( $_SESSION["role"] === 'master' || ( isset($_SESSION["permissions"]) && $_SESSION["permissions"]->rescheduling === 'true')) {
                            echo '
                                <a href="/admin/reschedule.php" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                                    <i class="bi bi-arrow-repeat"></i>
                                    <span class="text-[15px] ml-4 text-gray-200 font-bold">Reschedule</span>
                                </a>
                            ';
                        }
                    ?>
                    <?php
                        if ( $_SESSION["role"] === 'master' || ( isset($_SESSION["permissions"]) && $_SESSION["permissions"]->managePending === 'true')) {
                            echo '
                                <a href="/admin/reservations.php" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                                    <i class="bi bi-calendar-plus"></i>
                                    <span class="text-[15px] ml-4 text-gray-200 font-bold">Pending Reservations</span>
                                </a>
                            ';
                        }
                    ?>
                    <?php
                        if ( $_SESSION["role"] === 'master' || ( isset($_SESSION["permissions"]) && $_SESSION["permissions"]->managePayments === 'true')) {
                            echo '
                                <a href="/admin/payments.php" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                                    <i class="bi bi-calendar-week"></i>
                                    <span class="text-[15px] ml-4 text-gray-200 font-bold">Manage Payments</span>
                                </a>
                            ';
                        }
                    ?>
                    <?php
                        if ( $_SESSION["role"] === 'master' || ( isset($_SESSION["permissions"])
                            && ( $_SESSION["permissions"]->viewCompleted === 'true'
                            || $_SESSION["permissions"]->viewExpired === 'true'
                            || $_SESSION["permissions"]->viewDeclined === 'true' ))
                        ) {
                            echo '
                                <div onclick="dropdown1()" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                                    <i class="bi bi-clock-history"></i>
                                    <div class="flex justify-between w-full items-center">
                                        <span class="text-[15px] ml-4 text-gray-200 font-bold">History</span>
                                        <span class="text-sm rotate-180" id="arrow1">
                                            <i class="bi bi-chevron-down"></i>
                                        </span>
                                    </div>
                                </div>
                            ';
                        }
                    ?>
                    <div class="text-left text-sm mt-2 w-4/5 mx-auto text-gray-200 font-bold" id="submenu1">
                        <?php
                            if ( $_SESSION["role"] === 'master' || ( isset($_SESSION["permissions"]) && $_SESSION["permissions"]->viewCompleted === 'true')) {
                                echo '
                                    <a href="/admin/completed.php"  class="block cursor-pointer p-2 hover:bg-blue-600 rounded-md mt-1">
                                        Completed
                                    </a>
                                ';
                            }
                        ?>
                        <?php
                            if ( $_SESSION["role"] === 'master' || ( isset($_SESSION["permissions"]) && $_SESSION["permissions"]->viewExpired === 'true')) {
                                echo '
                                    <a href="/admin/expired.php"  class="block cursor-pointer p-2 hover:bg-blue-600 rounded-md mt-1">
                                        Expired
                                    </a>
                                ';
                            }
                        ?>
                        <?php
                            if ( $_SESSION["role"] === 'master' || ( isset($_SESSION["permissions"]) && $_SESSION["permissions"]->viewDeclined === 'true')) {
                                echo '
                                    <a href="/admin/declined.php"  class="block cursor-pointer p-2 hover:bg-blue-600 rounded-md mt-1">
                                        Declined
                                    </a>
                                ';
                            }
                        ?>
                    </div>
                    <div class="my-4 bg-gray-600 h-[1px]"></div>
                    <?php
                        if ( $_SESSION["role"] === 'master' || ( isset($_SESSION["permissions"]) && $_SESSION["permissions"]->viewReports === 'true')) {
                            echo '
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
                            ';
                        }
                    ?>
                    <?php
                        if ( $_SESSION["role"] === 'master' || ( isset($_SESSION["permissions"]) && $_SESSION["permissions"]->manageMessages === 'true')) {
                            echo '
                                <a href="/admin/messages.php" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                                    <i class="bi bi-envelope"></i>
                                    <span class="text-[15px] ml-4 text-gray-200 font-bold">Messages</span>
                                </a>
                            ';
                        }
                    ?>
                    <?php
                        if (isset($_SESSION["role"]) && $_SESSION["role"] === 'master') {
                            echo '
                                <a href="/admin/accounts.php" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                                    <i class="bi bi-people"></i>
                                    <span class="text-[15px] ml-4 text-gray-200 font-bold">Administrator Accounts</span>
                                </a>
                            ';
                        }
                    ?>
                    <?php
                        if ( $_SESSION["role"] === 'master' || ( isset($_SESSION["permissions"]) && $_SESSION["permissions"]->manageDiscounts === 'true')) {
                            echo '
                                <a href="/admin/discounts.php" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                                    <i class="bi bi-tag"></i>
                                    <span class="text-[15px] ml-4 text-gray-200 font-bold">Manage Discounts</span>
                                </a>
                            ';
                        }
                    ?>
                    <?php
                        if ($_SESSION["role"] === 'master' || (isset($_SESSION["permissions"]) && $_SESSION["permissions"]->manageBlacklist === 'true')) {
                            echo '
                                <a href="/admin/blacklist.php" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                                    <i class="bi bi-person-x"></i>
                                    <span class="text-[15px] ml-4 text-gray-200 font-bold">Manage Blacklist</span>
                                </a>
                            ';
                        }
                    ?>
                    <?php
                        if (isset($_SESSION["role"]) && $_SESSION["role"] === 'master') {
                            echo '
                                <a href="/admin/settings.php" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                                    <i class="bi bi-gear"></i>
                                    <span class="text-[15px] ml-4 text-gray-200 font-bold">Settings</span>
                                </a>
                            ';
                        }
                    ?>
                    <a href="/api/logout.php" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span class="text-[15px] ml-4 text-gray-200 font-bold">Logout</span>
                    </a>
                </div>
            </div>
            <!-- CONTENT -->
            <div class="w-full">
                <section class="flex py-7 px-20 lg:px-7 bg-gray-300">
                    Admin / Manage Blacklist
                </section>
                <section class="flex flex-col gap-3 p-7 ">
                    <form id="newEmail" class="flex gap-2 items-center">
                        <input type="email" id="email" required placeholder="Enter new email" class="p-2 outline-none border-[1px] border-gray-700 text-sm" >
                        <button  class="flex items-center outline-none w-fit gap-1 py-1 px-2 border border-blue-700 bg-blue-100 hover:bg-blue-300 text-blue-700 rounded">
                            <i class="bi bi-plus-lg cursor-pointer text-lg "></i>
                            <p>Add new email</p>
                        </button>
                    </form>
                    <div>List of blacklisted emails</div>
                    <div id="blacklist" class="flex flex-col gap-1">
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

            var blacklist = [
                // {
                //     id: 1,
                //     index: 1,
                //     email: 'sample1@gmail.com',
                //     date: new Date().toLocaleDateString(),
                // },
                // {
                //     id: 2,
                //     index: 2,
                //     email: 'sample2@gmail.com',
                //     date: new Date().toLocaleDateString(),
                // },
                // {
                //     id: 3,
                //     index: 3,
                //     email: 'sample3@gmail.com',
                //     date: new Date().toLocaleDateString(),
                // },
            ]

            $("#newEmail").submit(function(e) {
                e.preventDefault();
                var email = $('#email').val();
                $('#email').val('');
                // console.log(email);
                $.post("/api/newBlacklistEmail.php",{
                    email: email,
                }).done(function(data, status) {
                    // console.log(data);
                    if(data.isExisting){
                        alert('Email is already blacklisted')
                    }else {
                        fetchList()
                    }
                }).fail(function(response) {
                    // console.log(response);
                })
            })

            function removeEmail(id) {
                $.post("/api/deleteBlacklistEmail.php",{
                    id: id,
                }).done(function(data, status) {
                    fetchList()
                }).fail(function(response) {
                    // console.log(response);
                })
            }

            function fetchList() {
                $('#blacklist').empty()

                $.post("/api/getBlacklistEmail.php")
                .done(function(data, status) {
                    blacklist = data.list
                    if(blacklist.length === 0){
                        $('#blacklist').append(`
                            <div class="italic">No records</div>
                        `)
                    } else {
                        blacklist.forEach((item, i) => {
                            blacklist[i].index = i;
                            $('#blacklist').append(`
                                <div class="flex gap-2 items-center justify-between border border-gray-500 rounded p-2 lg:w-[50%]">
                                    <div class="flex gap-2 shrink-none">
                                        <div>${item.index + 1}.</div>
                                        <div>${item.email}</div>
                                    </div>
                                    <i onclick="removeEmail(${item.id})" class="bi bi-trash text-xl cursor-pointer text-red-600"></i>
                                </div>
                            `)
                        });
                    }
                }).fail(function(response) {
                    // console.log(response);
                })

            }

            fetchList();
        </script>
    </body>
</html>
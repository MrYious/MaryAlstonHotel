<?php
	session_start();
	include dirname(__DIR__).'/api/authSession.php';
	include dirname(__DIR__).'/api/checkExpired.php';

    if ($_SESSION["role"] !== 'master') {
		header('location:/');
    }
?>
<html>
    <head>
        <title> Administrator Accounts </title>
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
            <!-- MODAL -->
            <div id="modal" class=" flex justify-center items-center z-50 w-full h-screen fixed ">
                <div class="w-full h-screen bg-gray-200 opacity-60"></div>
                <form id="modalCreate" class="w-[90%] md:w-[50%] flex flex-col bg-gray-50 absolute drop-shadow-xl">
                </form>
                <form id="modalPermission" class="w-[90%] md:w-[50%] flex flex-col bg-gray-50 absolute drop-shadow-xl">
                </form>
                <form id="modalCredential" class="w-[90%] md:w-[50%] flex flex-col bg-gray-50 absolute drop-shadow-xl">
                </form>
            </div>
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
                    Admin / Administrator Accounts
                </section>
                <section class="flex flex-col gap-3 p-7 ">
                    <button onclick="createNewAccount()" class="flex items-center outline-none w-fit gap-1 py-1 px-2 border border-blue-700 bg-blue-100 hover:bg-blue-300 text-blue-700 rounded">
                        <i class="bi bi-plus-lg cursor-pointer text-lg "></i>
                        <p>Add new account</p>
                    </button>
                    <div>List of Administrator Accounts</div>
                    <div id="accounts" class="flex flex-col gap-1">
                    </div>
                </section>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
        <script type="text/javascript">
            $("#modal").hide();
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
            var accounts = [
                {
                    id: 1,
                    username: 'Mark',
                    role: 'sample1@gmail.com',
                    permissions: {
                        manageCurrent: true,
                        managePending: true,
                        rescheduling: true,
                        viewCompleted: true,
                        viewExpired: true,
                        viewDeclined: true,
                        viewReports: true,
                        managePayments: true,
                        manageMessages: true,
                        manageDiscounts: true,
                        manageBlacklist: true,
                    }
                },
            ]
            var selectedAccount;

            function createNewAccount() {
                $('#modalCreate').append(`
                    <div class="p-5 flex justify-between">
                        <span class="font-bold text-lg">Create new administrator account</span>
                        <span onclick="closeModal()" class="cursor-pointer">❌</span>
                    </div>
                    <div class="flex flex-col gap-3 p-5 h-[370px] overflow-auto">
                        <div class="flex flex-col gap-1 w-full">
                            <div class="font-semibold">
                                Username <span class="text-red-600 font-bold">*</span>
                            </div>
                            <input type="text" minlength="3" maxlength="15" id="username" required class="p-2 outline-none border-[1px] border-gray-700 text-sm" >
                        </div>
                        <div class="flex flex-col gap-1 w-full">
                            <div class="font-semibold">
                                Full Name <span class="text-red-600 font-bold">*</span>
                            </div>
                            <input type="text" maxlength="75" id="name" required class="p-2 outline-none border-[1px] border-gray-700 text-sm" >
                        </div>
                        <div class="flex flex-col lg:flex-row gap-5">
                            <div class="flex flex-col gap-1 w-full">
                                <div class="font-semibold">
                                    Password <span class="text-red-600 font-bold">*</span>
                                </div>
                                <input type="password" minlength="5" maxlength="15" id="password1" required class="p-2 outline-none border-[1px] border-gray-700 text-sm" >
                            </div>
                            <div class="flex flex-col gap-1 w-full">
                                <div class="font-semibold">
                                    Confirm Password <span class="text-red-600 font-bold">*</span>
                                </div>
                                <input type="password" minlength="5" maxlength="15" id="password2" required class="p-2 outline-none border-[1px] border-gray-700 text-sm" >
                            </div>
                        </div>
                        <div class="flex flex-col gap-2 w-full">
                            <div class="font-semibold">
                                Permissions <span class="text-red-600 font-bold">*</span>
                            </div>
                            <div class="flex flex-col lg:flex-row gap-1 lg:gap-3">
                                <div class="flex flex-col gap-1 w-full lg:w-1/2">
                                    <div>
                                        <input type="checkbox" id="manageCurrent" name="manageCurrent" value="true">
                                        <label for="manageCurrent"> Manage Present Reservations</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="managePending" name="managePending" value="true">
                                        <label for="managePending"> Manage Pending Reservations</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="rescheduling" name="rescheduling" value="true">
                                        <label for="rescheduling"> Reschedule Reservations</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="viewCompleted" name="viewCompleted" value="true">
                                        <label for="viewCompleted"> View Completed Reservations</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="viewExpired" name="viewExpired" value="true">
                                        <label for="viewExpired"> View Expired Reservations</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="viewDeclined" name="viewDeclined" value="true">
                                        <label for="viewDeclined"> View Declined Reservations</label>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-1 w-full lg:w-1/2">
                                    <div>
                                        <input type="checkbox" id="viewReports" name="viewReports" value="true">
                                        <label for="viewReports"> View and Generate Reports</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="managePayments" name="managePayments" value="true">
                                        <label for="managePayments"> Manage Payments</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="manageMessages" name="manageMessages" value="true">
                                        <label for="manageMessages"> Manage Messages</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="manageDiscounts" name="manageDiscounts" value="true">
                                        <label for="manageDiscounts"> Manage Discounts</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="manageBlacklist" name="manageBlacklist" value="true">
                                        <label for="manageBlacklist"> Manage Blacklist</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-5 flex justify-end gap-3">
                        <span onclick="closeModal()" class="cursor-pointer py-2 px-4 rounded font-semibold bg-red-500 text-red-100 hover:bg-red-700">CLOSE</span>
                        <button type="submit" class="cursor-pointer py-2 px-4 rounded font-semibold bg-green-500 text-green-100 hover:bg-green-700">CREATE</button>
                    </div>
                `);
                $("#modal").show();
            }

            function handleOpenChangeCredential(id) {
                selectedAccount = accounts.find(item => {return item.id == id})
                $('#modalCredential').append(`
                    <div class="p-5 flex justify-between">
                        <span class="font-bold text-lg">Change account credentials</span>
                        <span onclick="closeModal()" class="cursor-pointer">❌</span>
                    </div>
                    <div class="flex flex-col gap-3 p-5 h-[300px] overflow-auto">
                        <div class="flex flex-col gap-1 w-full">
                            <div class="font-semibold">
                                Username <span class="text-red-600 font-bold">*</span>
                            </div>
                            <input type="text" minlength="3" maxlength="15" id="username" value="${selectedAccount.username}" required class="p-2 outline-none border-[1px] border-gray-700 text-sm" >
                        </div>
                        <div class="flex flex-col gap-1 w-full">
                            <div class="font-semibold">
                                Full Name <span class="text-red-600 font-bold">*</span>
                            </div>
                            <input type="text" maxlength="75" id="name" value="${selectedAccount.name}" required class="p-2 outline-none border-[1px] border-gray-700 text-sm" >
                        </div>
                        <div class="flex flex-col lg:flex-row gap-5">
                            <div class="flex flex-col gap-1 w-full">
                                <div class="font-semibold">
                                    New Password <span class="text-red-600 font-bold">*</span>
                                </div>
                                <input type="password" minlength="5" maxlength="15" id="password1" required class="p-2 outline-none border-[1px] border-gray-700 text-sm" >
                            </div>
                            <div class="flex flex-col gap-1 w-full">
                                <div class="font-semibold">
                                    Confirm New Password <span class="text-red-600 font-bold">*</span>
                                </div>
                                <input type="password" minlength="5" maxlength="15" id="password2" required class="p-2 outline-none border-[1px] border-gray-700 text-sm" >
                            </div>
                        </div>
                    </div>
                    <div class="p-5 flex justify-end gap-3">
                        <span onclick="closeModal()" class="cursor-pointer py-2 px-4 rounded font-semibold bg-red-500 text-red-100 hover:bg-red-700">CLOSE</span>
                        <button type="submit" class="cursor-pointer py-2 px-4 rounded font-semibold bg-green-500 text-green-100 hover:bg-green-700">SAVE CHANGES</button>
                    </div>
                `);
                $("#modal").show();
            }

            function handleOpenModifyPermission(id) {
                selectedAccount = accounts.find(item => {return item.id == id})
                $('#modalPermission').append(`
                    <div class="p-5 flex justify-between">
                        <span class="font-bold text-lg">Modify account permissions</span>
                        <span onclick="closeModal()" class="cursor-pointer">❌</span>
                    </div>
                    <div class="flex flex-col gap-3 p-5 h-[300px] overflow-auto">
                        <div class="flex flex-col gap-2 w-full">
                            <div class="font-semibold">
                                Permissions <span class="text-red-600 font-bold">*</span>
                            </div>
                            <div class="flex flex-col lg:flex-row gap-1 lg:gap-3">
                                <div class="flex flex-col gap-1 w-full lg:w-1/2">
                                    <div>
                                        <input type="checkbox" id="manageCurrent" name="manageCurrent" value="true" ${selectedAccount.permissions.manageCurrent === 'true' ? 'checked' : ''}>
                                        <label for="manageCurrent"> Manage Present Reservations</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="managePending" name="managePending" value="true" ${selectedAccount.permissions.managePending === 'true' ? 'checked' : ''}>
                                        <label for="managePending"> Manage Pending Reservations</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="rescheduling" name="rescheduling" value="true" ${selectedAccount.permissions.rescheduling === 'true' ? 'checked' : ''}>
                                        <label for="rescheduling"> Reschedule Reservations</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="viewCompleted" name="viewCompleted" value="true" ${selectedAccount.permissions.viewCompleted === 'true' ? 'checked' : ''}>
                                        <label for="viewCompleted"> View Completed Reservations</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="viewExpired" name="viewExpired" value="true" ${selectedAccount.permissions.viewExpired === 'true' ? 'checked' : ''}>
                                        <label for="viewExpired"> View Expired Reservations</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="viewDeclined" name="viewDeclined" value="true" ${selectedAccount.permissions.viewDeclined === 'true' ? 'checked' : ''}>
                                        <label for="viewDeclined"> View Declined Reservations</label>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-1 w-full lg:w-1/2">
                                    <div>
                                        <input type="checkbox" id="viewReports" name="viewReports" value="true" ${selectedAccount.permissions.viewReports === 'true' ? 'checked' : ''}>
                                        <label for="viewReports"> View and Generate Reports</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="managePayments" name="managePayments" value="true" ${selectedAccount.permissions.managePayments === 'true' ? 'checked' : ''}>
                                        <label for="managePayments"> Manage Payments</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="manageMessages" name="manageMessages" value="true" ${selectedAccount.permissions.manageMessages === 'true' ? 'checked' : ''}>
                                        <label for="manageMessages"> Manage Messages</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="manageDiscounts" name="manageDiscounts" value="true" ${selectedAccount.permissions.manageDiscounts === 'true' ? 'checked' : ''}>
                                        <label for="manageDiscounts"> Manage Discounts</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="manageBlacklist" name="manageBlacklist" value="true" ${selectedAccount.permissions.manageBlacklist === 'true' ? 'checked' : ''}>
                                        <label for="manageBlacklist"> Manage Blacklist</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-5 flex justify-end gap-3">
                        <span onclick="closeModal()" class="cursor-pointer py-2 px-4 rounded font-semibold bg-red-500 text-red-100 hover:bg-red-700">CLOSE</span>
                        <button type="submit" class="cursor-pointer py-2 px-4 rounded font-semibold bg-green-500 text-green-100 hover:bg-green-700">SAVE CHANGES</button>
                    </div>
                `);
                $("#modal").show();
            }

            $("#modalCreate").submit(function(e) {
                e.preventDefault();
                $("#modal").hide();
                var username = $('#username').val();
                var name = $('#name').val();
                var password1 = $('#password1').val();
                var password2 = $('#password2').val();
                var permissions = {
                    manageCurrent: $('#manageCurrent').is(':checked'),
                    managePending: $('#managePending').is(':checked'),
                    rescheduling: $('#rescheduling').is(':checked'),
                    viewCompleted: $('#viewCompleted').is(':checked'),
                    viewExpired: $('#viewExpired').is(':checked'),
                    viewDeclined: $('#viewDeclined').is(':checked'),
                    viewReports: $('#viewReports').is(':checked'),
                    managePayments: $('#managePayments').is(':checked'),
                    manageMessages: $('#manageMessages').is(':checked'),
                    manageDiscounts: $('#manageDiscounts').is(':checked'),
                    manageBlacklist: $('#manageBlacklist').is(':checked'),
                }
                // console.log(username);
                // console.log(password1);
                // console.log(password2);
                // console.log(permissions);
                $.post("/api/newAdminAccount.php",{
                    name: name,
                    username: username,
                    password1: password1,
                    password2: password2,
                    permissions: permissions,
                }).done(function(data, status) {
                    alert(data.message)
                    if (data.isSuccess) {
                        fetchList()
                    }
                    closeModal();
                }).fail(function(response) {
                    // console.log(response);
                })
            })

            $("#modalCredential").submit(function(e) {
                e.preventDefault();
                $("#modal").hide();
                var name = $('#name').val();
                var username = $('#username').val();
                var password1 = $('#password1').val();
                var password2 = $('#password2').val();
                $.post("/api/updateAdminAccount.php",{
                    old: selectedAccount,
                    name: name,
                    username: username,
                    password1: password1,
                    password2: password2,
                }).done(function(data, status) {
                    alert(data.message)
                    if (data.isSuccess) {
                        fetchList()
                    }
                    closeModal();
                }).fail(function(response) {
                    // console.log(response);
                })
            })

            $("#modalPermission").submit(function(e) {
                e.preventDefault();
                $("#modal").hide();
                var permissions = {
                    manageCurrent: $('#manageCurrent').is(':checked'),
                    managePending: $('#managePending').is(':checked'),
                    rescheduling: $('#rescheduling').is(':checked'),
                    viewCompleted: $('#viewCompleted').is(':checked'),
                    viewExpired: $('#viewExpired').is(':checked'),
                    viewDeclined: $('#viewDeclined').is(':checked'),
                    viewReports: $('#viewReports').is(':checked'),
                    managePayments: $('#managePayments').is(':checked'),
                    manageMessages: $('#manageMessages').is(':checked'),
                    manageDiscounts: $('#manageDiscounts').is(':checked'),
                    manageBlacklist: $('#manageBlacklist').is(':checked'),
                }
                // console.log(permissions);
                $.post("/api/updateAdminPermission.php",{
                    old: selectedAccount,
                    permissions: permissions,
                }).done(function(data, status) {
                    alert(data.message)
                    fetchList()
                    closeModal();
                }).fail(function(response) {
                    // console.log(response);
                })
            })

            function closeModal() {
                $("#modal").hide();
                $("#modalCreate").empty();
                $("#modalCredential").empty();
                $("#modalPermission").empty();
                selectedAccount = {};
            };

            function handleDelete(id) {
                $.post("/api/deleteAccount.php",{
                    id: id,
                }).done(function(data, status) {
                    fetchList()
                }).fail(function(response) {
                    // console.log(response);
                })
            }

            function fetchList() {
                $('#accounts').empty()
                $.post("/api/getAdminAccounts.php")
                .done(function(data, status) {
                    accounts = data.list.map((item, i) => {
                        return {...item, permissions: JSON.parse(item.permissions)}
                    })
                    if(accounts.length === 0){
                        $('#accounts').append(`
                            <div class="italic">No records</div>
                        `)
                    } else {
                        accounts.forEach((item, i) => {
                            // console.log(item.permissions);
                            $('#accounts').append(`
                                <div class="flex flex-col lg:flex-row justify-between border rounded border-gray-600 p-4 gap-4 lg:gap-7">
                                    <div class="flex gap-2 w-full items-center justify-center">
                                        <div class="w-[40%] shrink-0">
                                            ${item.name}
                                        </div>
                                        <div class="w-full flex justify-between text-lg ">
                                            ${item.permissions.manageCurrent === 'true' ? '<i class="bi bi-check-square"></i>' : '<i class="bi bi-square"></i>'}
                                            ${item.permissions.managePending === 'true' ? '<i class="bi bi-check-square"></i>' : '<i class="bi bi-square"></i>'}
                                            ${item.permissions.rescheduling === 'true' ? '<i class="bi bi-check-square"></i>' : '<i class="bi bi-square"></i>'}
                                            ${item.permissions.viewCompleted === 'true' ? '<i class="bi bi-check-square"></i>' : '<i class="bi bi-square"></i>'}
                                            ${item.permissions.viewExpired === 'true' ? '<i class="bi bi-check-square"></i>' : '<i class="bi bi-square"></i>'}
                                            ${item.permissions.viewDeclined === 'true' ? '<i class="bi bi-check-square"></i>' : '<i class="bi bi-square"></i>'}
                                            ${item.permissions.viewReports === 'true' ? '<i class="bi bi-check-square"></i>' : '<i class="bi bi-square"></i>'}
                                            ${item.permissions.managePayments === 'true' ? '<i class="bi bi-check-square"></i>' : '<i class="bi bi-square"></i>'}
                                            ${item.permissions.manageMessages === 'true' ? '<i class="bi bi-check-square"></i>' : '<i class="bi bi-square"></i>'}
                                            ${item.permissions.manageDiscounts === 'true' ? '<i class="bi bi-check-square"></i>' : '<i class="bi bi-square"></i>'}
                                            ${item.permissions.manageBlacklist === 'true' ? '<i class="bi bi-check-square"></i>' : '<i class="bi bi-square"></i>'}
                                        </div>
                                    </div>
                                    <div class="flex gap-2 w-fit shrink-0">
                                        <button onclick="handleOpenChangeCredential(${item.id})" class="flex items-center gap-1 p-1 border border-green-700 bg-green-100 hover:bg-green-300 text-green-700 rounded">
                                            <i class="bi bi-shield-lock cursor-pointer text-lg "></i>
                                            <span>Change Credentials</span>
                                        </button>
                                        <button onclick="handleOpenModifyPermission(${item.id})" class="flex items-center gap-1 p-1 border border-green-700 bg-green-100 hover:bg-green-300 text-green-700 rounded">
                                            <i class="bi bi-gear cursor-pointer text-lg "></i>
                                            <span>Modify Permissions</span>
                                        </button>
                                        <button onclick="handleDelete(${item.id})" class="flex items-center gap-1 p-1 border border-red-700 bg-red-100 hover:bg-red-300 text-red-700 rounded">
                                            <i class="bi bi-trash cursor-pointer text-lg "></i>
                                            <span>Delete</span>
                                        </button>
                                    </div>
                                </div>
                            `)
                        });
                    }
                }).fail(function(response) {
                    // console.log(response);
                })

            }

            fetchList();
            closeModal()
        </script>
    </body>
</html>
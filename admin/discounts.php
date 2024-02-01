<?php
	session_start();
	include dirname(__DIR__).'/api/authSession.php';
	include dirname(__DIR__).'/api/checkExpired.php';

    if ( $_SESSION["role"] !== 'master' && ( !isset($_SESSION["permissions"]) || $_SESSION["permissions"]->manageDiscounts !== 'true')) {
		header('location:/');
    }
?>
<html>
    <head>
        <title> Discounts </title>
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
                <form id="modalEdit" class="w-[90%] md:w-[50%] flex flex-col bg-gray-50 absolute drop-shadow-xl">
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
                    Admin / Manage Discounts
                </section>
                <section class="flex flex-col gap-3 p-7 ">
                    <div class="flex flex-col gap-2">
                        <div class="font-semibold">Persons with Disabilities (PWD) Discount</div>
                        <div class="px-5">
                            <input type="checkbox" id="cbxPWD" name="cbxPWD" value="true">
                            <label for="cbxPWD"> Enable Discount </label>
                        </div>
                        <div class="flex flex-col gap-2 w-full lg:w-1/2 px-5">
                            <div class="font-medium">Discount Value (%)</div>
                            <form id="formPwdDiscount" class="flex items-center gap-2">
                                <input type="number" name="pwdDiscount" id="pwdDiscount" max="100" min="0" value="0" required class="text-sm w-1/2 lg:text-base browser-default px-1 py-1 border-[1px] focus:border-blue-800 outline-none rounded border-black">
                                <button type="submit" class="flex w-fit items-center py-1 px-5 border border-green-700 bg-green-100 hover:bg-green-300 text-green-700 rounded">
                                    Update
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="font-semibold">Senior Citizen Discount</div>
                        <div class="px-5">
                            <input type="checkbox" id="cbxSenior" name="cbxSenior" value="true">
                            <label for="cbxSenior"> Enable Discount </label>
                        </div>
                        <div class="flex flex-col gap-2 w-full lg:w-1/2 px-5">
                            <div class="font-medium">Discount Value (%)</div>
                            <form id="formSeniorDiscount" class="flex items-center gap-2">
                                <input type="number" name="seniorDiscount" id="seniorDiscount" max="100" min="0" value="0" required class="text-sm w-1/2 lg:text-base browser-default px-1 py-1 border-[1px] focus:border-blue-800 outline-none rounded border-black">
                                <button type="submit" class="flex w-fit items-center py-1 px-5 border border-green-700 bg-green-100 hover:bg-green-300 text-green-700 rounded">
                                    Update
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="font-semibold">Voucher Codes Discount</div>
                        <div class="px-5">
                            <input type="checkbox" id="cbxVoucher" name="cbxVoucher" value="true">
                            <label for="cbxVoucher"> Enable Discount </label>
                        </div>
                        <div class="flex flex-col gap-2 px-5">
                            <button id="addNewVoucher" onclick="createNewVoucher()" class="flex items-center outline-none w-fit gap-1 py-1 px-2 border border-blue-700 bg-blue-100 hover:bg-blue-300 text-blue-700 rounded">
                                <i class="bi bi-plus-lg cursor-pointer text-lg "></i>
                                <p>Add new voucher</p>
                            </button>
                            <div class="font-semibold">List of Voucher Codes</div>
                            <div class="px-5 text-xs">Enabled | Voucher Name | Voucher Code | Discount Amount | Discount Type </div>
                            <div id="vouchers" class="flex gap-1 flex-col px-5">
                                <!-- vouchers -->
                                <!-- <div class="flex items-center gap-5 border border-gray-500 py-1 px-2 rounded">
                                    <div class="flex gap-5 w-fit shrink-0">
                                        <input type="checkbox" id="cbx" name="cbx" value="true">
                                        <div>Christmas Voucher</div>
                                        <div> | </div>
                                        <div>BXSYDC1</div>
                                        <div> | </div>
                                        <div>5 %</div>
                                        <div> | </div>
                                        <div>Amount Percentage</div>
                                    </div>
                                    <div class="w-full flex justify-end gap-2">
                                        <button onclick="handleEdit()" class="flex items-center gap-1 p-1 border border-green-700 bg-green-100 hover:bg-green-300 text-green-700 rounded">
                                            <i class="bi bi-pencil cursor-pointer  "></i>
                                            <span class="text-sm">Edit</span>
                                        </button>
                                        <button onclick="handleDelete()" class="flex items-center gap-1 p-1 border border-red-700 bg-red-100 hover:bg-red-300 text-red-700 rounded">
                                            <i class="bi bi-trash cursor-pointer  "></i>
                                            <span class="text-sm">Delete</span>
                                        </button>
                                    </div>
                                </div> -->
                            </div>
                        </div>
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
            var codes = [
                // {
                //     isEnabled: true,
                //     name: 'Christmas Voucher',
                //     code: 'BXSYDC1',
                //     type: 'percent',
                //     value: 5,
                // },
                // {
                //     isEnabled: true,
                //     name: 'Halloween Voucher',
                //     code: 'WXGYBZ3',
                //     type: 'fixed',
                //     value: 1000,
                // }
            ]
            var selectedCode;
            var isPWD;
            var isSenior;
            var isVoucher;
            var vouchers;

            $('#cbxPWD').change(function () {
                var cbxPWD = $('#cbxPWD').is(':checked');
                isPWD = cbxPWD;
                // console.log(cbxPWD);
                $.post("/api/updateDiscountSettings.php", {
                    type: 'pwd',
                    enabled: cbxPWD,
                })
            });
            $('#cbxSenior').change(function () {
                var cbxSenior = $('#cbxSenior').is(':checked');
                isSenior = cbxSenior;
                // console.log(cbxSenior);
                $.post("/api/updateDiscountSettings.php", {
                    type: 'seniorCitizen',
                    enabled: cbxSenior,
                })
            });
            $('#cbxVoucher').change(function () {
                var cbxVoucher = $('#cbxVoucher').is(':checked');
                isVoucher = cbxVoucher;
                // console.log(cbxVoucher);
                $.post("/api/updateDiscountSettings.php", {
                    type: 'voucher',
                    enabled: cbxVoucher,
                })
            });

            function createNewVoucher() {
                $('#modalCreate').append(`
                    <div class="p-5 flex justify-between">
                        <span class="font-bold text-lg">Create new voucher</span>
                        <span onclick="closeModal()" class="cursor-pointer">❌</span>
                    </div>
                    <div class="flex flex-col gap-3 p-5 h-[300px] overflow-auto">
                        <div class="flex flex-col gap-1 w-full">
                            <div class="font-semibold">
                                Voucher Name <span class="text-red-600 font-bold">*</span>
                            </div>
                            <input type="text" id="name" required class="p-2 outline-none border-[1px] border-gray-700 text-sm" >
                        </div>
                        <div class="flex flex-col gap-1 w-full">
                            <div class="font-semibold">
                                Voucher Code <span class="text-red-600 font-bold">*</span>
                            </div>
                            <input type="text" id="code" minlength="5" maxlength="12" required class="p-2 outline-none border-[1px] border-gray-700 text-sm" >
                        </div>
                        <div class="flex flex-col lg:flex-row gap-5">
                            <div class="flex flex-col gap-1 w-full">
                                <div class="font-semibold">
                                    Discount Type <span class="text-red-600 font-bold">*</span>
                                </div>
                                <select name="type" id="type" required class="p-2 outline-none border-[1px] border-gray-700 lg:text-base ">
                                    <option disabled selected value="default">Select option</option>
                                    <option value="percent">Percentage</option>
                                    <option value="fixed">Fixed Amount</option>
                                </select>
                            </div>
                            <div class="flex flex-col gap-1 w-full">
                                <div class="font-semibold">
                                    Discount Amount <span class="text-red-600 font-bold">*</span>
                                </div>
                                <input type="number" id="amount" disabled required class="p-2 outline-none border-[1px] border-gray-700 text-sm" >
                            </div>
                        </div>
                    </div>
                    <div class="p-5 flex justify-end gap-3">
                        <span onclick="closeModal()" class="cursor-pointer py-2 px-4 rounded font-semibold bg-red-500 text-red-100 hover:bg-red-700">CLOSE</span>
                        <button type="submit" class="cursor-pointer py-2 px-4 rounded font-semibold bg-green-500 text-green-100 hover:bg-green-700">CREATE</button>
                    </div>
                `);
                $('#type').on('change', function() {
                    const val = this.value;
                    // console.log(val);
                    $('#amount').attr('disabled', false);
                    $("#amount").removeAttr("min")
                    $("#amount").removeAttr('max')
                    if(val === 'percent'){
                        $('#amount').attr({
                            "max" : 100,
                            "min" : 1
                        })
                    }else if(val === 'fixed'){
                        $('#amount').attr({
                            "min" : 1
                        })
                    }
                });
                $("#modal").show();
            }

            function handleEdit(id) {
                selectedCode = codes.find(item => {return item.index == id})
                $('#modalEdit').append(`
                    <div class="p-5 flex justify-between">
                        <span class="font-bold text-lg">Edit voucher details</span>
                        <span onclick="closeModal()" class="cursor-pointer">❌</span>
                    </div>
                    <div class="flex flex-col gap-3 p-5 h-[300px] overflow-auto">
                        <div>
                            <input type="checkbox" id="isEnabled" name="isEnabled" value="true">
                            <label for="isEnabled"> Enable Voucher </label>
                        </div>
                        <div class="flex flex-col gap-1 w-full">
                            <div class="font-semibold">
                                Voucher Name <span class="text-red-600 font-bold">*</span>
                            </div>
                            <input type="text" id="name" required class="p-2 outline-none border-[1px] border-gray-700 text-sm" >
                        </div>
                        <div class="flex flex-col gap-1 w-full">
                            <div class="font-semibold">
                                Voucher Code <span class="text-red-600 font-bold">*</span>
                            </div>
                            <input type="text" id="code" minlength="5" maxlength="12" required class="p-2 outline-none border-[1px] border-gray-700 text-sm" >
                        </div>
                        <div class="flex flex-col lg:flex-row gap-5">
                            <div class="flex flex-col gap-1 w-full">
                                <div class="font-semibold">
                                    Discount Type <span class="text-red-600 font-bold">*</span>
                                </div>
                                <select name="type" id="type" required class="p-2 outline-none border-[1px] border-gray-700 lg:text-base ">
                                    <option value="percent">Percentage</option>
                                    <option value="fixed">Fixed Amount</option>
                                </select>
                            </div>
                            <div class="flex flex-col gap-1 w-full">
                                <div class="font-semibold">
                                    Discount Amount <span class="text-red-600 font-bold">*</span>
                                </div>
                                <input type="number" id="amount" required class="p-2 outline-none border-[1px] border-gray-700 text-sm" >
                            </div>
                        </div>
                    </div>
                    <div class="p-5 flex justify-end gap-3">
                        <span onclick="closeModal()" class="cursor-pointer py-2 px-4 rounded font-semibold bg-red-500 text-red-100 hover:bg-red-700">CLOSE</span>
                        <button type="submit" class="cursor-pointer py-2 px-4 rounded font-semibold bg-green-500 text-green-100 hover:bg-green-700">UPDATE</button>
                    </div>
                `);
                $('#isEnabled').attr('checked', selectedCode.isEnabled === 'true' ? true : false);
                $('#name').val(selectedCode.name),
                $('#code').val(selectedCode.code),
                $('#type').val(selectedCode.type),
                $('#amount').val(selectedCode.value),
                $('#type').on('change', function() {
                    const val = this.value;
                    // console.log(val);
                    $('#amount').attr('disabled', false);
                    $("#amount").removeAttr("min")
                    $("#amount").removeAttr('max')
                    if(val === 'percent'){
                        $('#amount').attr({
                            "max" : 100,
                            "min" : 1
                        })
                    }else if(val === 'fixed'){
                        $('#amount').attr({
                            "min" : 1
                        })
                    }
                });
                $("#modal").show();
            }

            $("#modalCreate").submit(function(e) {
                e.preventDefault();
                $("#modal").hide();
                var voucher = {
                    isEnabled: true,
                    name: $('#name').val(),
                    code: $('#code').val(),
                    type: $('#type').val(),
                    value: $('#amount').val(),
                }
                console.table(voucher);
                codes.push(voucher);
                $.post("/api/updateDiscount.php", {
                    type: 'voucher',
                    codes: codes
                }).done(function(data, status) {
                    closeModal()
                    fetchList()
                })
            })

            $("#modalEdit").submit(function(e) {
                e.preventDefault();
                $("#modal").hide();
                var voucher = {
                    isEnabled: $('#isEnabled').is(':checked'),
                    name: $('#name').val(),
                    code: $('#code').val(),
                    type: $('#type').val(),
                    value: $('#amount').val(),
                }
                console.table(voucher);
                codes[selectedCode.index] = voucher;
                $.post("/api/updateDiscount.php", {
                    type: 'voucher',
                    codes: codes
                }).done(function(data, status) {
                    closeModal()
                    fetchList()
                })
            })

            $("#formPwdDiscount").submit(function(e) {
                e.preventDefault();
                var value =  $('#pwdDiscount').val()
                // console.log(value);
                $.post("/api/updateDiscount.php", {
                    type: 'pwd',
                    codes: parseInt(value),
                }).done(function(data, status) {
                    fetchList()
                })
            })

            $("#formSeniorDiscount").submit(function(e) {
                e.preventDefault();
                var value =  $('#seniorDiscount').val()
                // console.log(value);
                $.post("/api/updateDiscount.php", {
                    type: 'seniorCitizen',
                    codes: parseInt(value),
                }).done(function(data, status) {
                    fetchList()
                })
            })

            function handleDelete(id) {
                var newCodes = codes.filter(item => { return !(item.index == id)})
                // console.log(newCodes);
                $.post("/api/updateDiscount.php", {
                    type: 'voucher',
                    codes: newCodes
                }).done(function(data, status) {
                    fetchList()
                })
            }

            function closeModal() {
                $("#modal").hide();
                $("#modalCreate").empty();
                $("#modalEdit").empty();
                selectedCode = {};
            };

            function fetchList() {
                $('#vouchers').empty()

                $.post("/api/getDiscounts.php")
                .done(function(data, status) {
                    vouchers = data.list
                    // console.log(vouchers);

                    isPWD = vouchers.find((x) => x.type === "pwd").enabled;
                    isSenior = vouchers.find((x) => x.type === "seniorCitizen").enabled;
                    isVoucher = vouchers.find((x) => x.type === "voucher").enabled;

                    $('#pwdDiscount').val(parseInt(JSON.parse(vouchers.find((x) => x.type === "pwd").codes)))
                    $('#seniorDiscount').val(parseInt(JSON.parse(vouchers.find((x) => x.type === "seniorCitizen").codes)))

                    $('#cbxPWD').prop('checked', isPWD === 'true' ? true : false );
                    $('#cbxSenior').prop('checked', isSenior === 'true' ? true : false );
                    $('#cbxVoucher').prop('checked', isVoucher === 'true' ? true : false );

                    // console.log(isPWD, isSenior, isVoucher);

                    codes = JSON.parse(vouchers.find((x) => x.type === "voucher").codes);
                    // console.log(codes);

                    if(codes.length === 0){
                        $('#vouchers').append(`
                            <div class="italic">No records</div>
                        `)
                    } else {
                        codes
                        .forEach((item, i) => {
                            item.index = i;
                            $('#vouchers').append(`
                                <div class="flex items-center justify-between flex-wrap gap-5 border border-gray-500 py-1 px-2 rounded">
                                    ${
                                        item.isEnabled === 'true'
                                        ?
                                            '<i class="bi bi-check-square text-green-600 "></i>'
                                        :
                                            '<i class="bi bi-x-square text-red-600 "></i>'
                                    }
                                    <div>${item.name}</div>
                                    <div> | </div>
                                    <div>${item.code}</div>
                                    <div> | </div>
                                    <div>${item.value} ${item.type === 'percent' ? '%' : 'PHP' }</div>
                                    <div> | </div>
                                    <div>${item.type === 'fixed' ? 'FIXED' : 'PERCENT' }</div>
                                    <div class="flex justify-end gap-2">
                                        <button onclick="handleEdit(${item.index})" class="flex items-center gap-1 p-1 border border-green-700 bg-green-100 hover:bg-green-300 text-green-700 rounded">
                                            <i class="bi bi-pencil cursor-pointer  "></i>
                                            <span class="text-sm">Edit</span>
                                        </button>
                                        <button onclick="handleDelete(${item.index})" class="flex items-center gap-1 p-1 border border-red-700 bg-red-100 hover:bg-red-300 text-red-700 rounded">
                                            <i class="bi bi-trash cursor-pointer  "></i>
                                            <span class="text-sm">Delete</span>
                                        </button>
                                    </div>
                                </div>
                            `)
                        });
                        // console.log(codes);
                    }
                }).fail(function(response) {
                    // console.log(response);
                })

            }

            fetchList();
        </script>
    </body>
</html>
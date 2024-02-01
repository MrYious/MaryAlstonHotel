<?php
	session_start();
	include dirname(__DIR__).'/api/authSession.php';
	include dirname(__DIR__).'/api/checkExpired.php';

    if ( $_SESSION["role"] !== 'master' && ( !isset($_SESSION["permissions"]) || $_SESSION["permissions"]->managePayments !== 'true')) {
		header('location:/');
    }
?>
<html>
    <head>
        <title> Manage Payments </title>
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
                <form id="modalAccept" class="w-[90%] md:w-[50%] flex flex-col bg-gray-50 absolute drop-shadow-xl">
                </form>
                <form id="modalImage" class="w-[90%] md:w-[50%] flex flex-col bg-gray-50 absolute drop-shadow-xl">
                </form>
                <form id="modalReservation" class="w-[90%] md:w-[50%] flex flex-col bg-gray-50 absolute drop-shadow-xl">
                </form>
                <form id="modalDelete" class="w-[90%] md:w-[50%] flex flex-col bg-gray-50 absolute drop-shadow-xl">
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
                    Admin / Manage Payments
                </section>
                <section class="flex flex-col gap-3 p-7 ">
                    <div class="w-full flex items-center justify-end gap-2">
                        <div class="shrink-0">Filter Results</div>
                        <select name="filter" id="filter" class="inline w-fit outline-none px-2 border-[1px] focus:border-blue-800 rounded border-black text-sm lg:text-base ">
                            <option value="all">All</option>
                            <option value="accepted">Accepted</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                    <div class="flex justify-between">
                        <div>List of Payments</div>
                        <div class="flex gap-2">
                            <div>
                                <b id="accepted">0</b>
                                Accepted
                            </div>
                            <div>
                                <b id="pending">0</b>
                                Pending
                            </div>
                            <div>
                                <b id="total">0</b>
                                Total
                            </div>
                        </div>
                    </div>
                    <div id="payments" class="flex flex-col gap-1">
                        <!-- <div class="flex flex-col-reverse lg:flex-row border rounded border-gray-600 p-4 gap-2 lg:gap-7">
                            <div class="flex flex-col gap-2 w-full lg:w-[40%] justify-between">
                                <div><b>Transaction Number:</b> ${item.name} </div>
                                <div><b>Name:</b> ${item.email} </div>
                                <div><b>Email:</b> ${item.createdAt}</div>
                                <div><b>Note:</b> ${item.createdAt}</div>
                                <div class="pt-2 flex gap-2 w-full">
                                    <button onclick="handleAccept(1)" class="flex items-center gap-2 p-1 border border-green-700 bg-green-100 hover:bg-green-300 text-green-700 rounded">
                                        <i class="bi bi-check-lg cursor-pointer text-lg "></i>
                                        <span>Accept</span>
                                    </button>
                                    <button onclick="handleViewImage(1)" class="flex items-center gap-2 py-1 px-2 border border-green-700 bg-green-100 hover:bg-green-300 text-green-700 rounded">
                                        <i class="bi bi-card-image cursor-pointer text-lg "></i>
                                        <span>View Image Proof</span>
                                    </button>
                                    <button onclick="handleDelete(1)" class="flex items-center gap-2 p-1 border border-red-700 bg-red-100 hover:bg-red-300 text-red-700 rounded">
                                        <i class="bi bi-trash cursor-pointer text-lg "></i>
                                        <span>Delete</span>
                                    </button>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 w-full lg:w-[60%] ">
                                <div><b>Reference Number or Transaction Code:</b> ${item.createdAt}</div>
                                <div><b>Payment Via:</b> ${item.name} </div>
                                <div><b>Amount Paid:</b> ${item.email} </div>
                                <div><b>Payment Date:</b> ${item.createdAt}</div>
                                <div class="pt-2 flex gap-2 w-full items-center">
                                    <button onclick="handleViewReservation(1)" class="flex items-center gap-2 p-1 border border-blue-700 bg-blue-100 hover:bg-blue-300 text-blue-700 rounded">
                                        <i class="bi bi-eye cursor-pointer text-lg "></i>
                                        <span>View Reservation Details</span>
                                    </button>
                                    <div>
                                        Reservation Not Found
                                    </div>
                                </div>
                            </div>
                        </div> -->
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
            var payments = [
                {
                    id: 1,
                    transCode: '',
                    name: '',
                    email: '',
                    note: '',
                    channel: '',
                    amount: '',
                    referenceNum: '',
                    date: '',
                    status: '',
                    channelInfo: '',
                    reservation: {}
                },
            ]
            var selectedPayment = {};
            var filter = 'all';
            var channels;

            const roomDetails = [
                {
                    id: 0,
                    name: 'Pahiyas',
                    type: 'Executive Suite',
                    capacity: 2,
                    bed: '(1) Double Bed',
                    cost: 2500,
                    img: 'gallery/pahiyas4.jpg',
                    adults: 2,
                    children: 1,
                    perPerson: 1000
                },
                {
                    id: 1,
                    name: 'Harana',
                    type: 'Junior  Suite',
                    capacity: 2,
                    bed: '(2) Single Beds',
                    cost: 1800,
                    img: 'gallery/harana3.jpg',
                    adults: 2,
                    children: 1,
                    perPerson: 600
                },
                {
                    id: 2,
                    name: 'Imbayah',
                    type: 'Junior  Suite',
                    capacity: 2,
                    bed: '(2) Single Beds',
                    cost: 1800,
                    img: 'gallery/imbayah2.jpg',
                    adults: 2,
                    children: 1,
                    perPerson: 600
                },
                {
                    id: 3,
                    name: 'Pagdayao',
                    type: 'Dormitory',
                    capacity: 5,
                    bed: '(4) Single Beds',
                    cost: 2800,
                    img: 'gallery/pagdayao2.jpg',
                    adults: 5,
                    children: 4,
                    perPerson: 500
                },
                {
                    id: 4,
                    name: 'Moriones ',
                    type: 'Dormitory',
                    capacity: 5,
                    bed: '(4) Single Beds',
                    cost: 2800,
                    img: 'gallery/moriones2.jpg',
                    adults: 5,
                    children: 4,
                    perPerson: 500
                },
            ]

            function handleAccept(id) {
                selectedPayment = payments.find(item => {return item.id == id})
                if(selectedPayment.reservation){
                    $('#modalAccept').append(`
                        <div class="p-5 flex justify-between">
                            <span class="font-bold text-lg">Accept Payment</span>
                            <span onclick="closeModal()" class="cursor-pointer">❌</span>
                        </div>
                        <div class="flex flex-col gap-3 p-5 h-[70px] overflow-auto">
                            <div>Are you sure you want to accept the payment ?</div>
                        </div>
                        <div class="p-5 flex justify-end gap-3">
                            <span onclick="closeModal()" class="cursor-pointer py-2 px-4 rounded font-semibold bg-red-500 text-red-100 hover:bg-red-700">CLOSE</span>
                            <button type="submit" class="cursor-pointer py-2 px-4 rounded font-semibold bg-green-500 text-green-100 hover:bg-green-700">SUBMIT</button>
                        </div>
                    `);
                } else {
                    $('#modalAccept').append(`
                        <div class="p-5 flex justify-between">
                            <span class="font-bold text-lg">Accept Payment</span>
                            <span onclick="closeModal()" class="cursor-pointer">❌</span>
                        </div>
                        <div class="flex flex-col gap-3 p-5 h-[200px] overflow-auto">
                            <div>Are you sure you want to accept the payment ?</div>
                            <b>❌ INVALID TRANSACTION CODE! </b>
                            <div>Transaction code didn't match to any existing reservations and the payment will not proceed automatically.</div>
                            <div>By proceeding, you have to manually add payment to the appropriate reservation.</div>
                        </div>
                        <div class="p-5 flex justify-end gap-3">
                            <span onclick="closeModal()" class="cursor-pointer py-2 px-4 rounded font-semibold bg-red-500 text-red-100 hover:bg-red-700">CLOSE</span>
                            <button type="submit" class="cursor-pointer py-2 px-4 rounded font-semibold bg-green-500 text-green-100 hover:bg-green-700">SUBMIT</button>
                        </div>
                    `);
                }
                $("#modal").show();
            }

            function handleViewImage(id) {
                selectedPayment = payments.find(item => {return item.id == id})
                $('#modalImage').append(`
                    <div class="p-5 flex justify-between">
                        <span class="font-bold text-lg">View Proof of Payment</span>
                        <span onclick="closeModal()" class="cursor-pointer">❌</span>
                    </div>
                    <div class="flex flex-col gap-3 p-5 h-[400px] overflow-auto">
                        <div id="holder" class="flex items-center justify-center w-full px-2 py-2 border-[1px] rounded border-black ">
                            ${ selectedPayment.image ? `<img id="imgPreview" class="w-fit h-full" src="${selectedPayment.image}" alt="pic" />` : 'Select an image to preview'}
                        </div>
                    </div>
                    <div class="p-5 flex justify-end gap-3">
                        <span onclick="closeModal()" class="cursor-pointer py-2 px-4 rounded font-semibold bg-red-500 text-red-100 hover:bg-red-700">CLOSE</span>
                    </div>
                `);
                $("#modal").show();
            }

            function handleViewReservation(id) {
                selectedPayment = payments.find(item => {return item.id == id})
                $('#modalReservation').append(`
                    <div class="p-5 flex justify-between">
                        <span class="font-bold text-lg">Reservation Details</span>
                        <span onclick="closeModal()" class="cursor-pointer">❌</span>
                    </div>
                    <div class="flex flex-col gap-3 p-5 h-[360px] overflow-auto">
                        <div><b>Transaction Code:</b> ${selectedPayment.reservation.transactionCode}</div>
                        <div><b>Status:</b> ${selectedPayment.reservation.bookingStatus}</div>
                        <div><b>Room:</b> ${roomDetails[selectedPayment.reservation.roomCode].name + ' | ' + roomDetails[selectedPayment.reservation.roomCode].type + ' | P' + new Intl.NumberFormat().format(roomDetails[selectedPayment.reservation.roomCode].cost) + '.00'}</div>
                        <div><b>Check-In Date:</b> ${selectedPayment.reservation.inDate}</div>
                        <div><b>Check-Out Date:</b> ${selectedPayment.reservation.outDate}</div>
                        <div><b>No. of Guests:</b> ${selectedPayment.reservation.guests}</div>
                        <div><b>No. of Nights:</b> ${selectedPayment.reservation.guests}</div>
                        <div><b>Total Cost:</b> ${selectedPayment.reservation.isDiscounted === 'true'? new Intl.NumberFormat().format(Math.round(parseInt(selectedPayment.reservation.costDiscounted))) + '.00' : selectedPayment.reservation.costTotal}</div>
                        <div><b>Amount Paid:</b> ${selectedPayment.reservation.amountPaid ? selectedPayment.reservation.amountPaid : '0.00'}</div>
                    </div>
                    <div class="p-5 flex justify-end gap-3">
                        <span onclick="closeModal()" class="cursor-pointer py-2 px-4 rounded font-semibold bg-red-500 text-red-100 hover:bg-red-700">CLOSE</span>
                    </div>
                `);
                $("#modal").show();
            }

            function handleDelete(id) {
                selectedPayment = payments.find(item => {return item.id == id})
                if (selectedPayment.status === 'Pending') {
                    $('#modalDelete').append(`
                        <div class="p-5 flex justify-between">
                            <span class="font-bold text-lg">Delete Payment</span>
                            <span onclick="closeModal()" class="cursor-pointer">❌</span>
                        </div>
                        <div class="flex flex-col gap-3 p-5 h-[320px] overflow-auto">
                            <div>Are you sure you want to remove this payment record ? </div>
                            <div>
                                <input type="checkbox" id="isSend" name="isSend" value="true">
                                <label for="isSend"> Send reply via email</label>
                            </div>
                            <div class="flex flex-col gap-1 w-full">
                                <div class="font-semibold">
                                    Message
                                </div>
                                <textarea rows="6" name="message" id="message" disabled required class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black resize-none" ></textarea>
                            </div>
                        </div>
                        <div class="p-5 flex justify-end gap-3">
                            <span onclick="closeModal()" class="cursor-pointer py-2 px-4 rounded font-semibold bg-red-500 text-red-100 hover:bg-red-700">CLOSE</span>
                            <button type="submit" class="cursor-pointer py-2 px-4 rounded font-semibold bg-green-500 text-green-100 hover:bg-green-700">OK</button>
                        </div>
                    `);
                    $("#modal").show();
                    $('#isSend').change(function () {
                        var isSend = $('#isSend').is(':checked');
                        if(isSend){
                            $('#message').removeAttr('disabled');
                        }else{
                            $('#message').attr('disabled', 'disabled');
                        }
                        $('#message').val('');
                        // console.log(isSend);
                    });
                } else {
                    $.post("/api/deletePaymentInstant.php",{
                        id: id,
                    }).done(function(data, status) {
                        closeModal()
                        alert('Payment Deleted')
                        fetchList()
                    }).fail(function(response) {
                        // console.log(response);
                    })
                }
            }

            $("#modalAccept").submit(function(e) {
                e.preventDefault();
                $("#modal").hide();
                var paid = selectedPayment.reservation && selectedPayment.reservation.amountPaid  ? parseInt(selectedPayment.reservation.amountPaid.replaceAll(',', '')) + parseInt(selectedPayment.amount) : 0 + parseInt(selectedPayment.amount) ;
                $.post("/api/updatePaymentAutomatic.php",{
                    id: selectedPayment.id,
                    hasReservation: selectedPayment.reservation ? 'true' : 'false',
                    resID: selectedPayment.reservation?.id,
                    paid: new Intl.NumberFormat().format(paid) + '.00',
                    email: selectedPayment.email,
                    name: selectedPayment.name,
                }).done(function(data, status) {
                    closeModal()
                    alert('Action Success')
                    fetchList()
                }).fail(function(response) {
                    closeModal()
                })
            })

            $("#modalDelete").submit(function(e) {
                e.preventDefault();
                $("#modal").hide();
                $.post("/api/deletePayment.php",{
                    id: selectedPayment.id,
                    isSend: $('#isSend').is(':checked'),
                    email: selectedPayment.email,
                    name: selectedPayment.name,
                    message:  $('#message').val()
                }).done(function(data, status) {
                    closeModal()
                    alert('Payment Deleted')
                    fetchList()
                }).fail(function(response) {
                    // console.log(response);
                })
            })

            $('#filter').on('change', function() {
                const val = this.value;
                filter = val;
                fetchList()
            });

            function closeModal() {
                $("#modal").hide();
                $("#modalAccept").empty();
                $("#modalImage").empty();
                $("#modalReservation").empty();
                $("#modalDelete").empty();
                selectedPayment = {};
            };

            function fetchList() {
                $('#payments').empty()
                $.post("/api/getPayments.php")
                    .done(function(data, status) {
                        payments = data.list
                        // console.log(payments);
                        // console.log(data.codes);
                        // console.log(data.reservations);
                        if(payments.length === 0){
                            $('#payments').append(`
                                <div class="italic">No records</div>
                            `)
                            $("#total").text(0);
                            $("#accepted").text(0);
                            $("#pending").text(0);
                        } else {
                            var acceptedPayments = payments.filter((payment) => {
                                return payment.status !== 'Pending'
                            })
                            var pendingPayments = payments.filter((payment) => {
                                return payment.status === 'Pending'
                            })

                            $("#total").text(payments.length);
                            $("#accepted").text(acceptedPayments.length);
                            $("#pending").text(pendingPayments.length);
                            // console.log(channels);
                            var channel1 = JSON.parse(channels.channel1);
                            var channel2 = JSON.parse(channels.channel2);
                            var channel3 = JSON.parse(channels.channel3);
                            // console.table(channel1);
                            // console.table(channel2);
                            // console.table(channel3);

                            payments = payments.filter((item) => {
                                if(filter === 'all'){
                                    return true
                                } else if(filter === 'accepted'){
                                    return item.status !== 'Pending'
                                } else if(filter === 'pending'){
                                    return item.status === 'Pending'
                                }
                            });

                            payments.forEach((item, i) => {
                                payments[i].channelInfo = item.channel === '1' ? channel1.type + ' | ' + channel1.name + ' | ' + channel1.number : item.channel === '2' ? channel2.type + ' | ' + channel2.name + ' | ' + channel2.number : channel3.type + ' | ' + channel3.name + ' | ' + channel3.number ;
                                payments[i].reservation = data.reservations.find((res) => res.transactionCode === payments[i].transCode );
                                $('#payments').append(`
                                    <div class="flex flex-col lg:flex-row border rounded border-gray-600 p-4 gap-2 lg:gap-7">
                                        <div class="flex flex-col gap-2 w-full lg:w-[40%] justify-between">
                                            <div><b>Transaction Number:</b> ${item.transCode} </div>
                                            <div><b>Name:</b> ${item.name} </div>
                                            <div><b>Email:</b> ${item.email}</div>
                                            <div><b>Note:</b> ${item.note}</div>
                                            <div class="pt-2 flex gap-2 w-full">
                                                ${
                                                    item.status === 'Pending' ? `
                                                        <button onclick="handleAccept(${item.id})" class="flex items-center gap-2 p-1 border border-green-700 bg-green-100 hover:bg-green-300 text-green-700 rounded">
                                                            <i class="bi bi-check-lg cursor-pointer text-lg "></i>
                                                            <span>Accept</span>
                                                        </button>`
                                                    : ` <div class="flex items-center gap-2 p-1 text-green-700">
                                                            <span>Accepted</span>
                                                        </div>`
                                                }
                                                <button onclick="handleViewImage(${item.id})" class="flex items-center gap-2 py-1 px-2 border border-green-700 bg-green-100 hover:bg-green-300 text-green-700 rounded">
                                                    <i class="bi bi-card-image cursor-pointer text-lg "></i>
                                                    <span>View Image Proof</span>
                                                </button>
                                                <button onclick="handleDelete(${item.id})" class="flex items-center gap-2 p-1 border border-red-700 bg-red-100 hover:bg-red-300 text-red-700 rounded">
                                                    <i class="bi bi-trash cursor-pointer text-lg "></i>
                                                    <span>Delete</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-2 w-full lg:w-[60%] ">
                                            <div><b>Reference Number or Transaction Code:</b> ${item.referenceNum}</div>
                                            <div><b>Payment Via:</b> ${item.channelInfo} </div>
                                            <div><b>Amount Paid:</b> ${new Intl.NumberFormat().format(item.amount) + '.00'} </div>
                                            <div><b>Payment Date:</b> ${item.date}</div>
                                            <div class="pt-2 flex gap-2 w-full items-center">
                                                ${item.reservation ? `<button onclick="handleViewReservation(${item.id})" class="flex items-center gap-2 p-1 border border-blue-700 bg-blue-100 hover:bg-blue-300 text-blue-700 rounded">
                                                        <i class="bi bi-eye cursor-pointer text-lg "></i>
                                                        <span>View Reservation Details</span>
                                                    </button>` : ' ❌'
                                                }
                                                <div class="p-1">
                                                    ${item.reservation ? 'Reservation Found' : 'Reservation Not Found'}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `)
                            });
                            // console.log(payments);
                        }
                    }).fail(function(response) {
                        // console.log(response);
                    })
            }

            $.post("/api/getPaymentChannels.php")
            .done(function(data, status) {
                channels = data.channels[0];
                fetchList();
            })
        </script>
    </body>
</html>
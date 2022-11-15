<?php
	session_start();
	include dirname(__DIR__).'/api/authSession.php';
	include dirname(__DIR__).'/api/checkExpired.php';
?>
<html>
    <head>
        <title> Official Calendar </title>
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

        <!-- FULL CALENDAR -->
        <script src="https://cdn.jsdelivr.net/combine/npm/fullcalendar@5.11.3,npm/fullcalendar@5.11.3/locales-all.min.js,npm/fullcalendar@5.11.3/locales-all.min.js,npm/fullcalendar@5.11.3/main.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/combine/npm/fullcalendar@5.11.3/main.min.css,npm/fullcalendar@5.11.3/main.min.css">
    </head>
    <body>
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
                        <a href="/admin/reports/weekly.php"  class="block cursor-pointer p-2 hover:bg-blue-600 rounded-md mt-1">
                            Weekly
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
                    Admin / Official Calendar
                </section>
                <section class="flex flex-col p-2 justify-center items-center bg-gray-200">
                    <div class=" w-full md:w-[55%] flex gap-5 p-2 items-center bg-gray-300">
                        <div class="font-medium text-base lg:text-lg shrink-0">The Room: </div>
                        <select name="room" id="room" class="inline outline-none w-full p-2 border-[1px] focus:border-blue-800 rounded border-black text-sm lg:text-base ">
                            <option value="ES_Pahiyas">Pahiyas - Executive Suite</option>
                            <option value="JS_Harana">Harana  - Junior Suite</option>
                            <option value="JS_Imbayah">Imbayah  - Junior Suite</option>
                            <option value="DM_Pagdayao">Pagdayao - Dormitory</option>
                            <option value="DM_Moriones">Moriones - Dormitory</option>
                        </select>
                    </div>
                    <div class="border-2 border-black w-full md:w-[55%]"></div>
                    <div class=" w-full md:w-[55%] ">
                        <div id='calendar' class="select-none"></div>
                    </div>
                    <div class=" w-full md:w-[55%] flex flex-wrap justify-around gap-2 lg:gap-7 bg-gray-300 py-3">
                        <div class="flex gap-2 items-center">
                            <div class="border-[1px] border-orange-400 bg-orange-400 w-3 h-3 rounded-full"></div>
                            <div class="text-xs lg:text-sm">Pending </div>
                        </div>
                        <div class="flex gap-2 items-center">
                            <div class="border-[1px] border-green-600 bg-green-600 w-3 h-3 rounded-full"></div>
                            <div class="text-xs lg:text-sm">Confirmed </div>
                        </div>
                        <div class="flex gap-2 items-center">
                            <div class="border-[1px] border-blue-500 bg-blue-500 w-3 h-3 rounded-full"></div>
                            <div class="text-xs lg:text-sm">Rescheduled </div>
                        </div>
                    </div>
                </section>
                <!-- DETAILS -->
                <section class="flex flex-col p-7 bg-gray-200 gap-2">
                    <!-- 1 -->
                    <div class=" flex  justify-start items-center">
                        <div class="border-2 border-black w-1/12"></div>
                        <div class="text-lg lg:text-2xl font-semibold w-fit shrink-0 px-4">
                            Booking Information
                        </div>
                        <div class="border-2 border-black w-full"></div>
                    </div>
                    <!-- 1 -->
                    <div class="flex flex-col lg:flex-row gap-4">
                        <div class="flex gap-4 w-full lg:w-1/2">
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-bold text-base lg:text-lg">Check-in Date</div>
                                <div id="inDate" class="text-sm lg:text-base  py-2 w-full ">
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-bold text-base lg:text-lg">Check-out Date</div>
                                <div id="outDate" class="text-sm lg:text-base  py-2 w-full ">
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-4  w-full lg:w-1/2">
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-bold text-base lg:text-lg">Check-in Time</div>
                                <div id="inTime" class="text-sm lg:text-base  py-2 w-full ">
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-bold text-base lg:text-lg">No. of Night(s)</div>
                                <div id="nights" class="text-sm lg:text-base  py-2 w-full ">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 1 -->
                    <div class="flex flex-col lg:flex-row gap-4">
                        <div class="flex gap-4 w-full lg:w-1/2">
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-bold text-base lg:text-lg">No. of Children</div>
                                <div id="children" class="text-sm lg:text-base  py-2 w-full ">
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-bold text-base lg:text-lg">No. of Adult(s)</div>
                                <div id="adults" class="text-sm lg:text-base  py-2 w-full ">
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-4  w-full lg:w-1/2">
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-bold text-base lg:text-lg">Total no. of Guest(s)</div>
                                <div id="guests" class="text-sm lg:text-base  py-2 w-full ">
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-bold text-base lg:text-lg">Date Booked</div>
                                <div id="dateBooked" class="text-sm lg:text-base  py-2 w-full ">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 2 -->
                    <div class=" flex  justify-start items-center">
                        <div class="border-2 border-black w-1/12"></div>
                        <div class="text-lg lg:text-2xl font-semibold w-fit shrink-0 px-4">
                            Room Information
                        </div>
                        <div class="border-2 border-black w-full"></div>
                    </div>
                    <!-- 2 -->
                    <div class="flex flex-col lg:flex-row gap-4">
                        <div class="flex gap-4 w-full lg:w-1/2">
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-bold text-base lg:text-lg">Room Name</div>
                                <div id="roomName" class="text-sm lg:text-base  py-2 w-full ">
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-bold text-base lg:text-lg">Room Type</div>
                                <div id="roomType" class="text-sm lg:text-base  py-2 w-full ">
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-4  w-full lg:w-1/2">
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-bold text-base lg:text-lg">Capacity</div>
                                <div id="roomCapacity" class="text-sm lg:text-base  py-2 w-full ">
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-bold text-base lg:text-lg">Cost</div>
                                <div id="roomCost" class="text-sm lg:text-base  py-2 w-full ">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 3 -->
                    <div class=" flex  justify-start items-center">
                        <div class="border-2 border-black w-1/12"></div>
                        <div class="text-lg lg:text-2xl font-semibold w-fit shrink-0 px-4">
                            Guest Information
                        </div>
                        <div class="border-2 border-black w-full"></div>
                    </div>
                    <!-- 3 -->
                    <div class="flex flex-col lg:flex-row gap-4">
                        <div class="flex gap-4 w-full lg:w-1/2">
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-bold text-base lg:text-lg">First Name</div>
                                <div id="firstName" class="text-sm lg:text-base  py-2 w-full "></div>
                            </div>
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-bold text-base lg:text-lg">Last Name</div>
                                <div id="lastName" class="text-sm lg:text-base  py-2 w-full "></div>
                            </div>
                        </div>
                        <div class="flex gap-4  w-full lg:w-1/2">
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-bold text-base lg:text-lg">Email Address</div>
                                <div id="email" class="text-sm lg:text-base  py-2 w-full "></div>
                            </div>
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-bold text-base lg:text-lg">Contact Number</div>
                                <div id="mobileNo" class="text-sm lg:text-base  py-2 w-full "></div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col lg:flex-row gap-4">
                        <div class="flex gap-4 w-full lg:w-1/2">
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-bold text-base lg:text-lg">Birth Date</div>
                                <div id="birthDate" class="text-sm lg:text-base  py-2 w-full "></div>
                            </div>
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-bold text-base lg:text-lg">From TUA</div>
                                <div id="fromTua" class="text-sm lg:text-base  py-2 w-full "></div>
                            </div>
                        </div>
                        <div class="flex gap-4 w-full lg:w-1/2">
                            <div class="flex flex-col gap-2 w-full">
                                <div class="font-bold text-base lg:text-lg">Special Request</div>
                                <div id="specialRequests" class="text-sm lg:text-base  py-2 w-full ">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 4 -->
                    <div class=" flex  justify-start items-center">
                        <div class="border-2 border-black w-1/12"></div>
                        <div class="text-lg lg:text-2xl font-semibold w-fit shrink-0 px-4">
                            Transaction Information
                        </div>
                        <div class="border-2 border-black w-full"></div>
                    </div>
                    <!-- 4 -->
                    <div class="flex flex-col lg:flex-row gap-4">
                        <div class="flex gap-4  w-full lg:w-1/2">
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-bold text-base lg:text-lg">Transaction Number:</div>
                                <div id="transCode" class="text-sm lg:text-base  py-2 w-full ">
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-bold text-base lg:text-lg">Status</div>
                                <div id="status" class="text-sm lg:text-base  py-2 w-full ">
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-4 w-full lg:w-1/2">
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-bold text-base lg:text-lg">Required Down Payment</div>
                                <div id="downPayment" class="text-sm lg:text-base  py-2 w-full ">
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-bold text-base lg:text-lg">Total Amount</div>
                                <div id="totalAmount" class="text-sm lg:text-base  py-2 w-full ">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 4 -->
                    <div class="flex flex-col lg:flex-row gap-4">
                        <div class="flex gap-4  w-full lg:w-1/2">
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-bold text-base lg:text-lg">Amount Paid:</div>
                                <div id="amountPaid" class="text-sm lg:text-base  py-2 w-full ">
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-bold text-base lg:text-lg">Remaining Balance</div>
                                <div id="balance" class="text-sm lg:text-base  py-2 w-full ">
                                </div>
                            </div>
                        </div>
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
        <script >
            // STATES
            var allReservations;

            // CONSTANTS
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
                    name: 'Pagdayao ',
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

            // CALENDAR
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                selectable: true,
                unselectAuto: false,
                selectOverlap: false,
                eventDisplay: 'background',
                events: [
                    {
                        id: '0',
                        groupId: 'Invalid',
                        start: '2020-10-08',
                        end: formatDate(new Date()),
                        backgroundColor: '#241d1c', //black
                    },
                ],
                selectOverlap: function(event) {

                    // console.log('OVERLAP Event ', event)
                    // console.log('OVERLAP Date ', event.start)
                    // console.log('OVERLAP Event ID ', event.id)
                    // console.log('OVERLAP Event Group ID ', event.groupId)

                    console.log('OVERLAP Event ID ', event.id);
                    const selectedReservation = allReservations.find((reservation)=> {return reservation.booking.id === event.id} )
                    console.log('Selected Reservation | Event : ', selectedReservation);
                    // console.log('Selected Reservation bookDate | Event : ', selectedReservation.booking.createdAt);
                    // console.log('Selected Reservation bookDate | Event : ', formatDate(new Date(selectedReservation.booking.createdAt)));

                    $('#inDate').text(selectedReservation.booking.inDate);
                    $('#outDate').text(selectedReservation.booking.outDate);
                    $('#inTime').text(selectedReservation.booking.inTime ? new Date(selectedReservation.booking.inTime).toLocaleTimeString() : 'Not Yet');
                    $('#nights').text(selectedReservation.booking.nights);
                    $('#dateBooked').text(formatDate(new Date(selectedReservation.booking.createdAt)));
                    $('#adults').text(selectedReservation.booking.adult);
                    $('#children').text(selectedReservation.booking.children);
                    $('#guests').text(selectedReservation.booking.guests);

                    $('#roomName').text(roomDetails[selectedReservation.booking.roomCode].name);
                    $('#roomType').text(roomDetails[selectedReservation.booking.roomCode].type);
                    $('#roomCapacity').text(roomDetails[selectedReservation.booking.roomCode].capacity);
                    $("#roomCost").text(new Intl.NumberFormat().format(roomDetails[selectedReservation.booking.roomCode].cost) + '.00');

                    $('#firstName').text(selectedReservation.guest.firstname);
                    $('#lastName').text(selectedReservation.guest.lastname);
                    $('#email').text(selectedReservation.guest.email);
                    $('#mobileNo').text(selectedReservation.guest.mobileNo);
                    $('#birthDate').text(selectedReservation.guest.birthdate);
                    $('#fromTua').text(selectedReservation.guest.fromTua);
                    $('#specialRequests').text(selectedReservation.booking.specialRequests);

                    $('#transCode').text(selectedReservation.booking.transactionCode);
                    $('#status').text(selectedReservation.booking.bookingStatus);
                    const down = parseInt(selectedReservation.booking.costTotal.replaceAll(',', '')) / 2;
                    $("#downPayment").text(new Intl.NumberFormat().format(down) + '.00');
                    $('#totalAmount').text(selectedReservation.booking.costTotal);
                    const balance = selectedReservation.booking.amountPaid ? parseInt(selectedReservation.booking.costTotal.replaceAll(',', '')) - parseInt(selectedReservation.booking.amountPaid.replaceAll(',', '')) : parseInt(selectedReservation.booking.costTotal.replaceAll(',', ''));
                    $('#amountPaid').text(selectedReservation.booking.amountPaid ? selectedReservation.booking.amountPaid : '0.00');
                    $('#balance').text(new Intl.NumberFormat().format(balance > 0 ? balance : 0) + '.00');

                    return true;
                },
            });

            calendar.render();

            // FUNCTIONS
            function formatDate(date) {
                return [
                    date.getFullYear(),
                    padTo2Digits(date.getMonth() + 1),
                    padTo2Digits(date.getDate()),
                ].join('-');
            }

            function padTo2Digits(num) {
                return num.toString().padStart(2, '0');
            }

            const resetEvents = () => {
                const allEvents = calendar.getEvents()
                // console.log('All Events: ', allEvents);
                allEvents.forEach((event, i) => {
                    // console.log('Event ' + i + ': ', event.groupId)
                    event.remove();
                });
                calendar.unselect()

                $('#inDate').text('');
                $('#outDate').text('');
                $('#inTime').text('');
                $('#nights').text('');
                $('#dateBooked').text('');
                $('#adults').text('');
                $('#children').text('');
                $('#guests').text('');

                $('#roomName').text('');
                $('#roomType').text('');
                $('#roomCapacity').text('');
                $('#roomCost').text('');

                $('#firstName').text('');
                $('#lastName').text('');
                $('#email').text('');
                $('#mobileNo').text('');
                $('#birthDate').text('');
                $('#fromTua').text('');
                $('#specialRequests').text('');

                $('#transCode').text('');
                $('#status').text('');
                $('#downPayment').text('');
                $('#totalAmount').text('');
                $('#amountPaid').text('');
                $('#balance').text('');
            }

            // EVENT HANDLERS
            $('#room').on('change', function() {
                // alert( this.value );
                const val = this.value;
                var roomDetail;
                switch(val){
                    case 'ES_Pahiyas':
                        roomDetail = roomDetails[0]
                        break;
                    case 'JS_Harana':
                        roomDetail = roomDetails[1]
                        break;
                    case 'JS_Imbayah':
                        roomDetail = roomDetails[2]
                        break;
                    case 'DM_Pagdayao':
                        roomDetail = roomDetails[3]
                        break;
                    case 'DM_Moriones':
                        roomDetail = roomDetails[4]
                        break;
                }
                // console.table(roomDetail);
                updateAllReservations(roomDetail.id)
            });

            // DATA FETCH
            function updateAllReservations(num) {
                // console.log('Room Code', num);
                $.post("/api/getAllReservationsPerRoom.php", {
                    roomCode: num
                }).done(function(data, status) {
                    // console.log('Retrieval Success')
                    // console.log('Status', status)
                    console.log('ALL RESERVATIONS', data)
                    var reservations = data.bookings.map((booking) => {return {booking, guest: data.guests.find((guest) => { return booking.guest_id === guest.id })}});
                    console.log('MERGED RESERVATIONS', reservations);
                    allReservations = reservations

                    resetEvents();

                    allReservations.forEach( (reservation, i) =>{
                        // console.log('Reservation ' + i + ': ', reservation);
                        calendar.addEvent({
                            id: reservation.booking.id,
                            groupId: reservation.booking.bookingStatus,
                            start: reservation.booking.inDate,
                            end: reservation.booking.outDate,
                            backgroundColor: reservation.booking.bookingStatus === 'Pending' ? 'orange' :  reservation.booking.bookingStatus === 'Confirmed' ? 'green' : 'blue' ,
                            classNames: 'cursor-pointer',
                        });
                    });

                }).fail(function() {
                    alert( "Retrieval Error" );
                    console.log('Retrieval Error')
                })
            }

            // CALL IT FIRST TIME
            updateAllReservations(0)
        </script>
    </body>
</html>
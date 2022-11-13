<?php
	session_start();
	include dirname(__DIR__).'/api/authSession.php';
	include dirname(__DIR__).'/api/checkExpired.php';
?>
<html>
    <head>
        <title> Dashboard </title>
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
                    Admin / Dashboard
                </section>
                <section class="flex flex-col lg:flex-row gap-5 p-7 ">
                    <div class="flex flex-col gap-5 w-full lg:w-2/3">
                        <div class="flex gap-5">
                            <div class="flex flex-col w-[50%] bg-gray-100 shadow-sm shadow-black border-b-8 p-4 border-blue-900 gap-2">
                                <div > Ongoing Reservations for Today</div>
                                <div id="1" class="text-7xl">20</div>
                                <div id="2" class="text-xs italic text-right">October 10, 2022</div>
                            </div>
                            <div class="flex flex-col w-[50%] bg-gray-100 shadow-sm shadow-black border-b-8 p-4 border-green-900 gap-2">
                                <div >Total Confirmed Reservations</div>
                                <div id="3" class="text-7xl">20</div>
                                <div id="4" class="text-xs italic text-right">Month of October</div>
                            </div>
                        </div>
                        <div class="flex gap-5">
                            <div class="flex flex-col w-[50%] bg-gray-100 shadow-sm shadow-black border-b-8 p-4 border-orange-900 gap-2">
                                <div >New Pending Reservations</div>
                                <div id="5" class="text-7xl">20</div>
                                <div id="6" class="text-xs italic text-right">October 10, 2022</div>
                            </div>
                            <div class="flex flex-col w-[50%] bg-gray-100 shadow-sm shadow-black border-b-8 p-4 border-purple-900 gap-2">
                                <div >Total Pending Reservations</div>
                                <div id="7" class="text-7xl">20</div>
                                <div id="8" class="text-xs italic text-right">Overall</div>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-5 w-full lg:w-1/3 bg-red-400">
                        <div class="flex flex-col justify-between w-full bg-gray-100 shadow-sm shadow-black border-b-8 p-4 border-purple-900 gap-2">
                            <div >Total Completed Reservations</div>
                            <div id="9" class="text-6xl"></div>
                            <div >Total Sales</div>
                            <div id="10" class="text-4xl"></div>
                            <div >Most Booked Room</div>
                            <div id="11" class="text-3xl"></div>
                            <div id="12" class="text-xs italic text-right">Month of September</div>
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
        <script>

            var stats = {
                today: 0,
                confirmedM: 0,
                newPendingToday: 0,
                totalPending: 0,
                totalCompletedM: 0,
                totalSalesML: 0,
                mostBookedRoom: '',

                dateToday: 0,
                currentMonth: 0,
                previousMonth: 0,
            }

            // DATA FETCH
            function loadData() {
                const monthNames = [
                    "January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"
                ];
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

                let date = new Date();

                stats.dateToday = monthNames[date.getMonth()] + ' ' + date.getDate() + ', ' + date.getFullYear();
                stats.currentMonth = monthNames[date.getMonth()];
                stats.previousMonth = monthNames[date.getMonth()-1 ? date.getMonth()-1 : 11];

                $.post("/api/getAll.php")
                .done(function(data, status) {
                    // console.log('ALL RESERVATIONS', data)
                    var allReservations = data.bookings.map((booking) => {return {booking, guest: data.guests.find((guest) => { return booking.guest_id === guest.id })}});
                    console.log('ALL RESERVATIONS', allReservations);

                    // CHANGE THESE
                    const dateToday = formatDate(new Date());
                    const dateToday1 = '2022-11-17';

                    const todayReservations = allReservations.filter( (reservation, i) =>{
                        return reservation.booking.inDate <= dateToday1 && dateToday1 <= reservation.booking.outDate && (reservation.booking.bookingStatus === 'Confirmed' || reservation.booking.bookingStatus === 'Rescheduled' );
                    });
                    console.log('TODAY RESERVATIONS', todayReservations);
                    stats.today = todayReservations.length;

                    const thisMonthConfirmedReservations = allReservations.filter( (reservation, i) =>{
                        // console.log(new Date(reservation.booking.inDate).getMonth(), new Date().getMonth())
                        return (reservation.booking.bookingStatus === 'Confirmed' || reservation.booking.bookingStatus === 'Rescheduled' ) && new Date(reservation.booking.inDate).getMonth() === new Date().getMonth();
                    });
                    console.log('CONFIRMED THIS MONTH RESERVATIONS', thisMonthConfirmedReservations);
                    stats.confirmedM = thisMonthConfirmedReservations.length;

                    const thisDayPendingReservations = allReservations.filter( (reservation, i) =>{
                        return reservation.booking.bookingStatus === 'Pending' && new Date(reservation.booking.createdAt).toLocaleDateString() === new Date().toLocaleDateString();
                    });
                    console.log('NEW PENDING TODAY RESERVATIONS', thisDayPendingReservations);
                    stats.newPendingToday = thisDayPendingReservations.length;

                    const allPendingReservations = allReservations.filter( (reservation, i) =>{
                        return reservation.booking.bookingStatus === 'Pending';
                    });
                    console.log('ALL PENDING RESERVATIONS', allPendingReservations);
                    stats.totalPending = allPendingReservations.length;

                    const allCompletedReservations = allReservations.filter( (reservation, i) =>{
                        // console.log(new Date(reservation.booking.outDate).getMonth(), new Date().getMonth()-1 ? new Date().getMonth() - 1 : 11)
                        return reservation.booking.bookingStatus === 'Completed' && new Date(reservation.booking.inDate).getMonth() === (new Date().getMonth()-1 ? new Date().getMonth()-1 : 11);
                    });
                    console.log('ALL COMPLETED RESERVATIONS', allCompletedReservations);
                    stats.totalCompletedM = allCompletedReservations.length;

                    var totalSales = 0;
                    allCompletedReservations.forEach(reservation => {
                        totalSales += parseInt(reservation.booking.costTotal.replaceAll(',', ''));
                    });
                    console.log('TOTAL SALES', totalSales);
                    stats.totalSalesML = totalSales;

                    var countRooms = [0,0,0,0,0]
                    allCompletedReservations.forEach(reservation => {
                        countRooms[parseInt(reservation.booking.roomCode)]++
                    });
                    var highestCount = Math.max(...countRooms)
                    console.log('MOST BOOKED ROOM', countRooms, highestCount);

                    countRooms.forEach((num,i) => {
                        if(highestCount === num && highestCount !== 0)
                            stats.mostBookedRoom += stats.mostBookedRoom ? ', ' + roomDetails[i].name : roomDetails[i].name;
                    });

                    console.log('STATS: ', stats);

                    $('#1').text(stats.today);
                    $('#2').text(stats.dateToday);

                    $('#3').text(stats.confirmedM);
                    $('#4').text('Month of ' + stats.currentMonth);

                    $('#5').text(stats.newPendingToday);
                    $('#6').text(stats.dateToday);

                    $('#7').text(stats.totalPending);
                    $('#8').text('Overall');

                    $('#9').text(stats.totalCompletedM);
                    $('#10').text('P '+ new Intl.NumberFormat().format(stats.totalSalesML) + '.00');
                    $('#11').text(stats.mostBookedRoom ? stats.mostBookedRoom : 'N/A' );
                    $('#12').text('Month of ' + stats.previousMonth);

                }).fail(function() {
                    alert( "Retrieval Error" );
                    console.log('Retrieval Error')
                })
                // const stats = {
                //     today: 0,
                //     confirmedM: 0,
                //     newPendingToday: 0,
                //     totalPending: 0,
                //     totalCompletedM: 0,
                //     totalSalesML: 0,
                //     mostBookedRoom: 'Pahiyas',

                //     dateToday: 0,
                //     currentMonth: 0,
                //     previousMonth: 0,
                // }
            }

            // CALL IT FIRST TIME
            loadData();

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
        </script>
    </body>
</html>
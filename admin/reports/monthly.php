<?php
	session_start();
    $dir = dirname(__DIR__);
	include trim($dir,'\admin').'/api/authSession.php';
	include trim($dir,'\admin').'/api/checkExpired.php';
?>
<html>
    <head>
        <title> Monthly Sales Reports </title>
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
        <!-- HTML 2 PDF -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" integrity="sha512-YcsIPGdhPK4P/uRW6/sruonlYj+Q7UHWeKfTAkBW+g83NKM+jMJFJ4iAPfSnVp7BKD4dKMHmVSvICUbE/V1sSw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                    Admin / Monthly Sales Report
                </section>
                <section>
                    <div class="flex justify-around items-center">
                        <img src="/logo.jpg" alt="logo" width="100px" height="100px">
                        <div class="text-center">
                            <div class="font-bold">TRINITY UNIVERSITY OF ASIA</div>
                            <div class="font-bold">MARY ALSTON HALL</div>
                            <div>Room Reservation</div>
                        </div>
                        <img src="/logo.jpg" alt="logo" width="100px" height="100px">
                    </div>
                </section>
                <section class="flex flex-col p-7 bg-gray-200 gap-10">
                    <div class="text-lg">Generate and View the Monthly Sales Report</div>
                    <div class="flex flex-col items-start gap-5">
                        <div class="flex flex-col gap-2 w-60">
                            <div class="font-bold text-lg">
                                Select a year
                            </div>
                            <select id="year" required class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black">
                                <option selected disabled>Select an option</option>
                            </select>
                        </div>
                        <div class="flex flex-col gap-2 w-60">
                            <div class="font-bold text-lg">
                                Select a month
                            </div>
                            <select id="month" required class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black">
                                <option selected disabled>Select an option</option>
                                <option value="0">January</option>
                                <option value="1">February</option>
                                <option value="2">March</option>
                                <option value="3">April</option>
                                <option value="4">May</option>
                                <option value="5">June</option>
                                <option value="6">July</option>
                                <option value="7">August</option>
                                <option value="8">September</option>
                                <option value="9">October</option>
                                <option value="10">November</option>
                                <option value="11">December</option>
                            </select>
                        </div>
                        <div class="flex flex-col gap-2">
                            <div class="font-bold text-lg">
                                Results
                            </div>
                            <div class="w-full">
                                <div class="flex gap-1">
                                    <div class="w-48">
                                        Month:
                                    </div>
                                    <b id="date">
                                       <!-- November 2022 -->
                                    </b>
                                </div>
                                <div class="flex gap-1">
                                    <div class="w-48">
                                        Number of records:
                                    </div>
                                    <b id="records">
                                       <!-- 20 -->
                                    </b>
                                </div>
                                <div class="flex gap-1">
                                    <div class="w-48">
                                        Total Sales:
                                    </div>
                                    <b id="sales">
                                        <!-- 10,900.00 -->
                                    </b>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <button id="handleGenerate" class="font-bold text-lg bg-green-400 hover:bg-green-600 rounded py-2 px-5 shadow-sm shadow-black">
                                GENERATE AND DOWNLOAD A COPY
                            </button>
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
            var allReservations;
            var selectedReservations;
            var year, month;

            // CONSTANTS
            var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            var years = [];

            // EVENT HANDLER
            $('#year').on('change', function() {
                year = this.value;
                handleChange();
            });
            $('#month').on('change', function() {
                month = this.value;
                handleChange();
            });

            function handleChange() {
                $("#date").text('');
                $("#records").text('');
                $("#sales").text('');
                selectedReservations = [];

                if(year && month){
                    $("#date").text(months[month] + ' ' + year);

                    selectedReservations = allReservations.filter( (reservation, i) =>{
                        let thisDate = new Date(reservation.booking.inDate);
                        console.log(thisDate.getFullYear(), year, thisDate.getMonth(), month);
                        return thisDate.getFullYear() === parseInt(year) && thisDate.getMonth() === parseInt(month) && reservation.booking.bookingStatus === 'Completed';
                    });
                    console.log('SelectedReservations', selectedReservations);

                    $("#records").text(selectedReservations.length);
                    var totalSales = 0;
                    selectedReservations.forEach(reservation => {
                        let sale = parseInt(reservation.booking.amountPaid.replaceAll(',', ''));
                        totalSales += sale;
                    });
                    console.log('Total Sales', totalSales);

                    $("#sales").text('P ' + new Intl.NumberFormat().format(totalSales) + '.00');
                }
            }

            $('#handleGenerate').click(function (e) {
                e.preventDefault();
                if(!year || !month){
                    alert('Select a year and a month first')
                }else if(!selectedReservations || selectedReservations.length === 0){
                    alert('There are no records')
                }else{
                    alert('Processing...')
                    var element = `
                        <div class="flex justify-around items-center">
                            <img src="/logo.jpg" alt="logo" width="100px" height="100px">
                            <div class="text-center">
                                <div>TRINITY UNIVERSITY OF ASIA</div>
                                <div>MARY ALSTON HALL</div>
                                <div>Room Reservation</div>
                            </div>
                            <img src="/logo.jpg" alt="logo" width="100px" height="100px">
                        </div>
                    `;
                    var opt = {
                        margin:       1,
                        filename:     'Monthly Report - '+ months[month] + ' ' + year + '.pdf',
                        image:        { type: 'jpeg', quality: 0.98 },
                        html2canvas:  { scale: 2 },
                        jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
                    };
                    html2pdf().set(opt).from(element).save();
                }
            })

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

            // DATA FETCH
            function loadData() {

                $.post("/api/getAll.php")
                .done(function(data, status) {
                    // console.log('ALL RESERVATIONS', data)
                    allReservations = data.bookings.map((booking) => {return {booking, guest: data.guests.find((guest) => { return booking.guest_id === guest.id })}});
                    console.log('ALL RESERVATIONS', allReservations);

                    var startYear = 2020;
                    var currentYear = new Date().getFullYear();
                    let years = []
                    while ( startYear <= currentYear ) {
                        years.push(startYear++);
                    }
                    years.sort(function(a, b) {
                        return b - a;
                    });

                    console.log(startYear, currentYear, years);

                    years.forEach(year => {
                        $('#year').append($('<option>').val(year).text(year))
                    });
                }).fail(function() {
                    alert( "Retrieval Error" );
                    console.log('Retrieval Error')
                })

            }

            // CALL IT FIRST TIME
            loadData();

        </script>
    </body>
</html>
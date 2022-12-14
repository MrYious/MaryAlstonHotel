<?php
	include 'api/checkExpired.php';
?>
<html>
    <head>
        <title> Mary Alston Hotel </title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="js/jquery-3.6.1.min.js"></script>
        <link rel="icon" href="images/favicon.png" type = "image/png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
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
        <link rel="stylesheet" href="https://unpkg.com/materialize-stepper@3.1.0/dist/css/mstepper.min.css">
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="reservation.css">

        <!-- FULL CALENDAR -->
        <script src="https://cdn.jsdelivr.net/combine/npm/fullcalendar@5.11.3,npm/fullcalendar@5.11.3/locales-all.min.js,npm/fullcalendar@5.11.3/locales-all.min.js,npm/fullcalendar@5.11.3/main.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/combine/npm/fullcalendar@5.11.3/main.min.css,npm/fullcalendar@5.11.3/main.min.css">

        <!-- HTML 2 PDF -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" integrity="sha512-YcsIPGdhPK4P/uRW6/sruonlYj+Q7UHWeKfTAkBW+g83NKM+jMJFJ4iAPfSnVp7BKD4dKMHmVSvICUbE/V1sSw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <style>
            [type="checkbox"].reset-checkbox,
            [type="checkbox"].reset-checkbox:checked,
            [type="checkbox"].reset-checkbox:not(checked) {
            opacity: 1;
            position: relative;
            }

            [type="checkbox"].reset-checkbox+span::before,
            [type="checkbox"].reset-checkbox+span::after,
            [type="checkbox"].reset-checkbox:checked+span::before,
            [type="checkbox"].reset-checkbox:checked+span::after {
            display: none;
            }

            [type="checkbox"].reset-checkbox+span:not(.lever) {
            padding-left: 10px;
            }
        </style>
    </head>
    <body>
        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="exampleModalCenteredScrollable" tabindex="-1" aria-labelledby="exampleModalCenteredScrollable" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable relative w-auto pointer-events-none">
                <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                    <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalCenteredScrollableLabel">
                    Modal title
                    </h5>
                    <button type="button"
                    class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                    data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body relative p-4">
                    <p>This is some placeholder content to show a vertically centered modal. We've added some extra copy here to show how vertically centering the modal works when combined with scrollable modals. We also use some repeated line breaks to quickly extend the height of the content, thereby triggering the scrolling. When content becomes longer than the predefined max-height of modal, content will be cropped and scrollable within the modal.</p>
                <br><br><br><br><br><br><br><br><br><br>
                <p>Just like that.</p>
                </div>
                <div
                    class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                    <button type="button"
                    class="inline-block px-6 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out"
                    data-bs-dismiss="modal">
                    Close
                    </button>
                    <button type="button"
                    class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out ml-1">
                    Save changes
                    </button>
                </div>
                </div>
            </div>
        </div>
        <!-- TITLE BAR -->
        <div class="flex justify-between items-center bg-slate-600 h-[8vh] text-white">
            <a href="/" class="text-2xl font-semibold px-5">
                Mary Alston Hotel - Reservation
            </a>
        </div>
        <!-- STEPPER -->
        <section class="p-5 bg-slate-100">
            <ul class="stepper linear ">
                <!-- 1 -->
                <li class="step active">
                    <!-- title -->
                    <div class="step-title waves-effect text-xl" >Booking Information </div>
                    <!-- content -->
                    <div class="step-content flex flex-col ">
                        <input type="text" class="id hidden" value="1">
                        <div class="flex flex-col md:flex-row gap-6 h-fit">
                            <!-- COLUMN 1 -->
                            <div class="flex flex-col w-full md:w-[25%] gap-4 p-3">
                                <div class="flex flex-col gap-2">
                                    <div class="font-medium text-base lg:text-lg">Please select a room:</div>
                                    <select name="room" id="room" class="inline w-full px-2 border-[1px] focus:border-blue-800 rounded border-black text-sm lg:text-base ">
                                        <option value="ES_Pahiyas">Pahiyas - Executive Suite</option>
                                        <option value="JS_Harana">Harana  - Junior Suite</option>
                                        <option value="JS_Imbayah">Imbayah  - Junior Suite</option>
                                        <option value="DM_Pagdayao">Pagdayao - Dormitory</option>
                                        <option value="DM_Moriones">Moriones - Dormitory</option>
                                    </select>
                                </div>
                                <div class="flex flex-col w-full rounded-xl border-[1px] border-black">
                                    <img src="gallery/pahiyas4.jpg" id='roomImg' alt="room image" class="w-full rounded-t-xl">
                                    <div class="flex flex-col justify-start items-start gap-2 p-4">
                                        <div><b>Room Name:</b> <span id='roomName'>Pahiyas </span></div>
                                        <div><b>Room Type:</b> <span id='roomType'>Executive Suite</span></div>
                                        <div><b>Max Capacity:</b> <span id='roomCapacity'> 2</span> Persons</div>
                                        <div><b>Bedroom:</b> <span id='roomBed'>(1) Double Bed </span></div>
                                        <div class="text-right w-full"><b id='roomCost' class="text-3xl">2,500.00</b> / Per Night</div>
                                    </div>
                                </div>
                            </div>
                            <!-- COLUMN 2 -->
                            <div class="flex flex-col w-full md:w-[40%] gap-5 p-3">
                                <!-- CALENDAR -->
                                <div class="p-2 w-full ">
                                    <div id='calendar' class="select-none"></div>
                                </div>
                                <div class="flex flex-wrap justify-around px-4 gap-2 lg:gap-5">
                                    <div class="flex gap-2 items-center">
                                        <div class="border-[1px] border-black w-3 h-3 rounded-full"></div>
                                        <div class="text-xs lg:text-sm">Available Date</div>
                                    </div>
                                    <div class="flex gap-2 items-center">
                                        <div class="border-[1px] border-red-400 bg-red-400 w-3 h-3 rounded-full"></div>
                                        <div class="text-xs lg:text-sm">Unavailable Date</div>
                                    </div>
                                    <div class="flex gap-2 items-center">
                                        <div class="border-[1px] border-gray-600 bg-gray-600 w-3 h-3 rounded-full"></div>
                                        <div class="text-xs lg:text-sm">Invalid Date</div>
                                    </div>
                                    <div class="flex gap-2 items-center">
                                        <div class="border-[1px] border-blue-500 bg-blue-500 w-3 h-3 rounded-full"></div>
                                        <div class="text-xs lg:text-sm">Check-in Date</div>
                                    </div>
                                    <div class="flex gap-2 items-center">
                                        <div class="border-[1px] border-blue-500 bg-blue-500 w-3 h-3 rounded-full"></div>
                                        <div class="text-xs lg:text-sm">Check-out Date</div>
                                    </div>
                                    <div class="flex gap-2 items-center">
                                        <div class="border-[1px] border-blue-500 bg-blue-500 w-3 h-3 rounded-full"></div>
                                        <div class="text-xs lg:text-sm">Period of Stay</div>
                                    </div>
                                </div>
                            </div>
                            <!-- COLUMN 3 -->
                            <div class="flex flex-col w-full md:w-[35%] gap-4 p-3">
                                <div class="text-sm">
                                    Check-in Time starts at <b>2 PM</b> and Check-out Time is <b>12 PM</b>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <div class="flex w-full gap-6 ">
                                        <!-- 1 -->
                                        <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                            <div class="font-medium text-base lg:text-lg">Check-in Date:</div>
                                            <input type="date" name="inDate" id="inDate" required readonly  class="text-sm lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black">
                                        </div>
                                        <!-- 2 -->
                                        <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                            <div class="font-medium text-base lg:text-lg">Check-out Date:</div>
                                            <input type="date" name="outDate" id="outDate" required readonly class="text-sm lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black">
                                        </div>
                                    </div>
                                    <div class="flex w-full gap-6">
                                        <!-- 3 -->
                                        <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                            <div class="font-medium text-base lg:text-lg">No. of Adults*</div>
                                            <input type="number" name="noAdults" id="noAdults" value="1" min="1" max="2" class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black">
                                        </div>
                                        <!-- 4 -->
                                        <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                            <div class="font-medium text-base lg:text-lg">No. of Children*</div>
                                            <input type="number" name="noChildren" id="noChildren" value="0" min="0" max="1" class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black">
                                        </div>
                                    </div>
                                    <div class="flex w-full gap-6">
                                        <!-- 5 -->
                                        <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                            <div class="font-medium text-base lg:text-lg">No. of Night(s):</div>
                                            <div class="text-sm lg:text-base browser-default px-2 py-2 w-full "> <b  id="nights">0</b> night(s)</div>
                                        </div>
                                        <!-- 6 -->
                                        <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                            <div class="font-medium text-base lg:text-lg">No. of Guest(s):</div>
                                            <div class="text-sm lg:text-base browser-default px-2 py-2 w-full "> <b  id="guests">1</b> guest(s)</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col border-[1px] border-black p-3 gap-2 rounded-xl">
                                    <b class="text-lg ">Total Breakdown</b>
                                    <div>
                                        <span id="tb_roomName">Pahiyas</span>
                                         -
                                        <span id="tb_roomType">Executive Suite</span>
                                    </div>
                                    <div class="flex flex-col gap-2 px-3">
                                        <div class="flex justify-between">
                                            <b>First Night </b>
                                            <b id="tb_roomCost">0.00</b>
                                        </div>
                                        <div class="flex justify-between pl-7">
                                            <div id="tb_sub1">2,500 x 0 night</div>
                                        </div>
                                        <div class="flex justify-between">
                                            <b>Succeeding night(s) </b>
                                            <b id="tb_roomOtherCosts">0.00</b>
                                        </div>
                                        <div class="flex justify-between pl-7">
                                            <div  id="tb_sub2">1,000 x 1 guest(s) x 0 night(s)</div>
                                        </div>
                                        <div class="border-2 border-black w-full h-1"></div>
                                    </div>
                                    <div class="text-right w-full p-3"><b id="tb_total" class="text-3xl">0.00</b> PHP</div>
                                </div>
                            </div>
                        </div>
                        <div class="step-actions">
                            <!-- Here goes your actions buttons -->
                            <button class="waves-effect waves-dark btn next-step">CONTINUE</button>
                        </div>
                    </div>
                </li>
                <!-- 2 -->
                <li class="step">
                    <div class="step-title waves-effect text-xl"> Guest Information</div>
                    <div class="step-content flex flex-col">
                        <input type="text" class="id hidden" value="2">
                        <div class="flex flex-col lg:flex-row h-fit gap-4 lg:gap-10">
                            <!-- 1 -->
                            <div class="flex flex-col h-fit gap-4 lg:w-1/2 w-full">
                                <div class="flex gap-4">
                                    <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                        <div class="font-medium text-base lg:text-lg">First Name*</div>
                                        <input type="text" name="fname" id="fname" required class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black">
                                    </div>
                                    <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                        <div class="font-medium text-base lg:text-lg">Last Name*</div>
                                        <input type="text" name="lname" id="lname" required class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black">
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                        <div class="font-medium text-base lg:text-lg">Email Address*</div>
                                        <input type="email" name="email" id="email" placeholder="youremail@provider.com" required class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black">
                                    </div>
                                    <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                        <div class="font-medium text-base lg:text-lg">Contact Number*</div>
                                        <input type="number" name="mobileNo" id="mobileNo" maxlength="11" placeholder="09XXXXXXXXX" required class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black">
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                        <div class="font-medium text-base lg:text-lg">Birth Date*</div>
                                        <input type="date" name="birthDate" id="birthDate" required class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black">
                                    </div>
                                    <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                        <div class="font-medium text-base lg:text-lg">From TUA*</div>
                                        <div class="flex gap-2 p-2" id="fromTua">
                                            <p>
                                                <label>
                                                <input class="with-gap" name="fromTua" type="radio" value="Yes"/>
                                                <span>Yes</span>
                                                </label>
                                            </p>
                                            <p>
                                                <label>
                                                <input class="with-gap" name="fromTua" type="radio" value="No"/>
                                                <span>No</span>
                                                </label>
                                            </p>
                                        </div>
                                        <!-- <input type="radio" name="birthDate" id="birthDate" required class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black"> -->
                                    </div>
                                </div>
                            </div>
                            <!-- 2 -->
                            <div class="flex lg:w-1/2 w-full ">
                                <div class="flex flex-col gap-2 w-full lg:w-2/3">
                                    <div class="flex gap-1">
                                        <div class="font-medium text-lg lg:text-2xl">Special Request</div>
                                        <div class="text-xs">(optional)</div>
                                    </div>
                                    <div class="font-medium text-xs lg:text-sm">(Subject to availability)</div>
                                    <textarea name="specialRequest" id="specialRequest" maxlength="500" class="w-full h-32 lg:h-full text-sm lg:text-base browser-default bg-white px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black resize-none"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="step-actions">
                            <!-- Here goes your actions buttons -->
                            <button class="waves-effect waves-dark btn next-step">CONTINUE</button>
                            <button class="waves-effect waves-dark btn-flat previous-step">BACK</button>
                        </div>
                    </div>
                </li>
                <!-- 3 -->
                <li class="step">
                    <div class="step-title waves-effect text-xl">Review & Confirm Reservation </div>
                    <div class="step-content flex flex-col">
                        <input type="text" class="id hidden" value="3">
                        <div class="flex flex-col lg:flex-row h-fit gap-4 lg:gap-10 ">
                            <!-- 1ST COLUMN -->
                            <div class="flex flex-col h-fit gap-4 lg:w-3/4 w-full ">
                                <!-- ROW 1 -->
                                <div class=" flex  justify-start items-center">
                                    <div class="border-2 border-black w-1/12"></div>
                                    <div class="text-lg lg:text-2xl font-semibold w-fit shrink-0 px-4">
                                        Booking Information
                                    </div>
                                    <div class="border-2 border-black w-full"></div>
                                </div>
                                <div class="flex flex-col lg:flex-row gap-4">
                                    <div class="flex gap-4  w-full lg:w-1/2">
                                        <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                            <div class="font-medium text-base lg:text-lg">Room Name</div>
                                            <div id="bi_roomName" class="text-sm lg:text-base  py-2 w-full font-bold truncate"></div>
                                        </div>
                                        <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                            <div class="font-medium text-base lg:text-lg">No. of Guest(s)</div>
                                            <div id="bi_guests" class="text-sm lg:text-base  py-2 w-full font-bold truncate"></div>
                                        </div>
                                    </div>
                                    <div class="flex gap-4 w-full lg:w-1/2">
                                        <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                            <div class="font-medium text-base lg:text-lg">Check-in Date</div>
                                            <div id="bi_inDate" class="text-sm lg:text-base  py-2 w-full font-bold truncate"></div>
                                        </div>
                                        <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                            <div class="font-medium text-base lg:text-lg">Check-out Date</div>
                                            <div id="bi_outDate" class="text-sm lg:text-base  py-2 w-full font-bold truncate"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ROW 2 -->
                                <div class=" flex  justify-start items-center">
                                    <div class="border-2 border-black w-1/12"></div>
                                    <div class="text-lg lg:text-2xl font-semibold w-fit shrink-0 px-4">
                                        Guess Information
                                    </div>
                                    <div class="border-2 border-black w-full"></div>
                                </div>
                                <div class="flex flex-col lg:flex-row gap-4">
                                    <div class="flex gap-4 w-full lg:w-1/2">
                                        <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                            <div class="font-medium text-base lg:text-lg">First Name</div>
                                            <div id="gi_fname" class="text-sm lg:text-base  py-2 w-full font-bold truncate"></div>
                                        </div>
                                        <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                            <div class="font-medium text-base lg:text-lg">Last Name</div>
                                            <div id="gi_lname" class="text-sm lg:text-base  py-2 w-full font-bold truncate"></div>
                                        </div>
                                    </div>
                                    <div class="flex gap-4 w-full lg:w-1/2">
                                        <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                            <div class="font-medium text-base lg:text-lg">Email Address</div>
                                            <div id="gi_email" class="text-sm lg:text-base  py-2 w-full font-bold truncate"></div>
                                        </div>
                                        <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                            <div class="font-medium text-base lg:text-lg">Contact Number</div>
                                            <div id="gi_mobileNo" class="text-sm lg:text-base  py-2 w-full font-bold truncate"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col lg:flex-row gap-4">
                                    <div class="flex flex-col gap-2 w-full lg:w-1/2 ">
                                        <div class="font-medium text-base lg:text-lg">Special Request</div>
                                        <div id="gi_specialRequests" class="text-sm lg:text-base  py-2 w-full font-bold "></div>
                                    </div>
                                    <div class="flex gap-4 w-full lg:w-1/2 shrink-0 lg:pl-2">
                                        <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                            <div class="font-medium text-base lg:text-lg">Birth Date</div>
                                            <div id="gi_birthDate" class="text-sm lg:text-base  py-2 w-full font-bold truncate"></div>
                                        </div>
                                        <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                            <div class="font-medium text-base lg:text-lg">From TUA</div>
                                            <div id="gi_fromTua" class="text-sm lg:text-base  py-2 w-full font-bold truncate"></div>
                                        </div>
                                    </div>
                                </div>
                                <label class="text-black flex items-center">
                                    <input type="checkbox" class="filled-in reset-checkbox" />
                                    <span>
                                        I have read and agreed to the
                                        <span id="privacy" class="font-bold hover:underline cursor-pointer">Privacy Policies</span>
                                        and
                                        <span id="terms" class="font-bold hover:underline cursor-pointer">Terms and Conditions</span>
                                        ?
                                    </span>
                                </label>
                            </div>
                            <!-- 2ND COLUMN -->
                            <div class="flex lg:w-1/4 w-full ">
                                <div class="flex flex-col gap-4 w-full">
                                    <div class=" flex  justify-start items-center">
                                        <div class="border-2 border-black w-full"></div>
                                        <div class="text-lg lg:text-2xl font-semibold w-fit shrink-0 px-4">
                                            TOTAL AMOUNT
                                        </div>
                                        <div class="border-2 border-black w-full"></div>
                                    </div>
                                    <div class="flex flex-col border-[1px] border-black p-3 gap-2 rounded-xl">
                                        <b class="text-lg ">Total Breakdown</b>
                                        <div>
                                            <span id="ta_roomName">Pahiyas</span>
                                            -
                                            <span id="ta_roomType">Executive Suite</span>
                                        </div>
                                        <div class="flex flex-col gap-2 px-3">
                                            <div class="flex justify-between">
                                                <b>First Night </b>
                                                <b id="ta_roomCost">0.00</b>
                                            </div>
                                            <div class="flex justify-between pl-7">
                                                <div id="ta_sub1">2,500 x 0 night</div>
                                            </div>
                                            <div class="flex justify-between">
                                                <b>Succeeding night(s) </b>
                                                <b id="ta_roomOtherCosts">0.00</b>
                                            </div>
                                            <div class="flex justify-between pl-7">
                                                <div  id="ta_sub2">1,000 x 1 guest(s) x 0 night(s)</div>
                                            </div>
                                            <div class="border-2 border-black w-full h-1"></div>
                                        </div>
                                        <div class="text-right w-full p-3"><b id="ta_total" class="text-3xl">0.00</b> PHP</div>
                                    </div>
                                    <div class="text-sm">
                                        <b>Note:</b> You have to pay at least <b>50%</b> of the total amount as down payment for the reservation to be official.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="step-actions">
                            <!-- Here goes your actions buttons -->
                            <button id="submitBtn" class="waves-effect waves-dark btn">SUBMIT</button>
                            <button class="waves-effect waves-dark btn-flat previous-step">BACK</button>
                        </div>
                    </div>
                </li>
                <!-- 4 -->
                <li class="step">
                    <div class="step-title waves-effect text-xl">Final Note</div>
                    <div class="step-content flex flex-col">
                        <input type="text" class="id hidden" value="4">
                        <div class="flex flex-col lg:flex-row h-fit gap-4 lg:gap-10 ">
                            <!-- 1ST COLUMN -->
                            <div class="flex flex-col h-fit gap-4 lg:w-3/4 w-full ">
                                <!-- ROW 1 -->
                                <div class=" flex  justify-start items-center">
                                    <div class="border-2 border-black w-1/12"></div>
                                    <div class="text-lg lg:text-2xl font-semibold w-fit shrink-0 px-4">
                                        Important Notice
                                    </div>
                                    <div class="border-2 border-black w-full"></div>
                                </div>
                                <div class="flex flex-col lg:flex-row gap-4">
                                    <div class="flex flex-col gap-2 w-full ">
                                        <div class="text-sm lg:text-base  py-2 w-full">
                                            You have 48 hrs (2 days) to pay atleast 50% of the total amount of the booking as down payment to the reservation.
                                            Failure to pay within alloted time allows the system to automatically remove your reservation from the official list.
                                        </div>
                                        <div class="text-sm lg:text-base  py-2 w-full  ">
                                            The down payment must be paid via the provided official payment channels below. You shall receive an email in a few minutes containing the booking and payment information.
                                            The guest must reply to the email attaching a valid proof of payment such as official receipts and other similar valid proofs.
                                        </div>
                                        <div class="text-sm lg:text-base  py-2 w-full  ">
                                            For important concerns and issues, you can reach us via the following email: <b>maryalstonhall@gmail.com. </b> Also, save your transaction number for future reference.
                                        </div>
                                        <div class="text-sm lg:text-base  py-2 w-full  ">
                                            The standard check-in time starts at <b>2 PM</b>, and the guests should already check-out before <b>12 PM</b> in the last day.
                                        </div>
                                    </div>
                                </div>
                                <!-- ROW 2 -->
                                <div class=" flex  justify-start items-center">
                                    <div class="border-2 border-black w-1/12"></div>
                                    <div class="text-lg lg:text-2xl font-semibold w-fit shrink-0 px-4">
                                        Official Payment Channels
                                    </div>
                                    <div class="border-2 border-black w-full"></div>
                                </div>
                                <div class="flex flex-col lg:flex-row gap-4">
                                    <div class="flex flex-wrap lg:justify-around w-full gap-8">
                                        <div class="flex flex-col gap-2 w-[46%] lg:w-[30%]">
                                            <div id="type1" class="font-bold text-base lg:text-lg">GCASH</div>
                                            <div id="name1" class="text-sm lg:text-base py-1 w-full truncate">Name: Juan dela Cruz</div>
                                            <div id="number1" class="text-sm lg:text-base py-1 w-full  truncate">Number: 09366845621</div>
                                        </div>
                                        <div class="flex flex-col gap-2 w-[46%] lg:w-[30%]">
                                            <div id="type2" class="font-bold text-base lg:text-lg">BANK ACCOUNT</div>
                                            <div id="name2" class="text-sm lg:text-base py-1 w-full  truncate">Name: Juan dela Cruz</div>
                                            <div id="number2" class="text-sm lg:text-base py-1 w-full  truncate">Number: 09366845621</div>
                                        </div>
                                        <div class="flex flex-col gap-2 w-[46%] lg:w-[30%]">
                                            <div id="type3" class="font-bold text-base lg:text-lg">BANK ACCOUNT</div>
                                            <div id="name3" class="text-sm lg:text-base py-1 w-full  truncate">Name: Juan dela Cruz</div>
                                            <div id="number3" class="text-sm lg:text-base py-1 w-full  truncate">Number: 09366845621</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 2ND COLUMN -->
                            <div id="myColumn" class="flex lg:w-1/4 w-full ">
                                <div class="flex flex-col gap-3 w-full">
                                    <div class=" flex  justify-start items-center">
                                        <div class="border-2 border-black w-full"></div>
                                        <div class="text-lg lg:text-2xl font-semibold w-fit shrink-0 px-4">
                                            TOTAL AMOUNT
                                        </div>
                                        <div class="border-2 border-black w-full"></div>
                                    </div>
                                    <div class="text-sm lg:text-base py-2 w-full  ">
                                        <b>Transaction #:</b> <span id="transCode"></span>
                                    </div>
                                    <div class="flex flex-col border-[1px] border-black p-3 gap-2 rounded-xl">
                                    <b class="text-lg ">Total Breakdown</b>
                                        <div>
                                            <span id="tc_roomName">Pahiyas</span>
                                            -
                                            <span id="tc_roomType">Executive Suite</span>
                                        </div>
                                        <div class="flex flex-col gap-2 px-3">
                                            <div class="flex justify-between">
                                                <b>First Night </b>
                                                <b id="tc_roomCost">0.00</b>
                                            </div>
                                            <div class="flex justify-between pl-7">
                                                <div id="tc_sub1">2,500 x 0 night</div>
                                            </div>
                                            <div class="flex justify-between">
                                                <b>Succeeding night(s) </b>
                                                <b id="tc_roomOtherCosts">0.00</b>
                                            </div>
                                            <div class="flex justify-between pl-7">
                                                <div  id="tc_sub2">1,000 x 1 guest(s) x 0 night(s)</div>
                                            </div>
                                            <div class="border-2 border-black w-full h-1"></div>
                                        </div>
                                        <div class="text-right w-full p-3"><b id="tc_total" class="text-3xl">0.00</b> PHP</div>
                                    </div>
                                    <div class="flex justify-center items-center border-[1px] border-black p-3 gap-1 rounded-xl">
                                        <b class="text-md shrink-0">Down Payment</b>
                                        <div class="text-right w-full "><b id='tc_downpayment' class="text-lg">1,250.00</b> PHP</div>
                                    </div>
                                    <button id="generatePDF" class="bg-green-400 p-3 rounded-xl hover:bg-green-500 shadow-sm shadow-black">
                                        Generate a copy in PDF
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="step-actions">
                            <!-- Here goes your actions buttons -->
                            <button id="finishBtn" class="waves-effect waves-dark btn ">FINISH</button>
                        </div>
                    </div>
                </li>
            </ul>
        </section>
        <script src="https://unpkg.com/materialize-stepper@3.1.0/dist/js/mstepper.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                // STATES
                var allReservations;
                var formData = {
                    roomDetail: {
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
                };

                var channel1 = {name: '', number: '', type: ''}
                var channel2 = {name: '', number: '', type: ''}
                var channel3 = {name: '', number: '', type: ''}

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

                        if (event.groupId === 'Invalid' || event.groupId === 'Unavailable'){
                            return false;
                        }else{
                            return true;
                        }
                    },
                    selectAllow: function (selectInfo) {
                        const tempEvent = calendar.getEventById('TEMPORARY');
                        if(tempEvent){
                            tempEvent.remove();
                        }
                        return true;
                    },
                    select: handleSelectDate,
                });

                calendar.render();

                // STEPPER
                var stepper = document.querySelector('.stepper');
                var stepperInstance = new MStepper(stepper, {
                    firstActive: 2,
                    validationFunction: validationFunction,
                    stepTitleNavigation: false,
                })

                // FUNCTIONS
                function handleSelectDate (selectionInfo ) {
                    // WILL NOT PROCEED WHEN SELECT ALLOW IS FALSE

                    // WILL NOT PROCEED WHEN AN OVERLAPPING EVENT IS HIT AND FALSE

                    $('#inDate').val(selectionInfo.startStr);
                    $('#outDate').val(selectionInfo.endStr);

                    let start = new Date(selectionInfo.startStr);
                    let end = new Date(selectionInfo.endStr);

                    let difference = start.getTime() - end.getTime();

                    let TotalNights = Math.abs(Math.ceil(difference / (1000 * 3600 * 24)));
                    $('#nights').text(TotalNights);

                    updateTotal();

                    // DATE EVENT
                    calendar.addEvent({
                        id: 'TEMPORARY',
                        groupId: 'TEMPORARY',
                        start: selectionInfo.startStr,
                        end: selectionInfo.endStr,
                        backgroundColor: 'blue',
                    });
                }

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

                function validationFunction(stepperForm, activeStepContent) {
                    const StepID = activeStepContent.querySelector('.id').value;

                    if(StepID == 1){
                        const strD = $('#inDate').val();
                        const endD = $('#outDate').val();

                        if( !strD || !endD ){
                            alert('Please select a date.')
                            return false;
                        }

                        if( ($('#guests').text()) > formData.roomDetail.capacity ){
                            alert('The max allowed capacity is only ' + formData.roomDetail.capacity + ' !')
                            return false;
                        }

                        $('.active').removeClass('wrong');

                        formData.inDate = $('#inDate').val();
                        formData.outDate = $('#outDate').val();
                        formData.guests = {
                            adults: $('#noAdults').val(),
                            children: $('#noChildren').val(),
                            total: $('#guests').text(),
                        }
                        formData.nights = $('#nights').text();
                        formData.costs = {
                            firstNight: $('#tb_roomCost').text(),
                            otherNights: $('#tb_roomOtherCosts').text(),
                            total: $('#tb_total').text(),
                        }

                        console.table('FormData |', formData)

                        return true;

                    } else if(StepID == 2){
                        if( !(activeStepContent.querySelector('#fname').checkValidity()) || !(activeStepContent.querySelector('#lname').checkValidity()) ){
                            alert('Enter your name')
                            return false;
                        }

                        if( !activeStepContent.querySelector('#email').checkValidity() ){
                            alert('Enter your valid email')
                            return false;
                        }

                        if( !activeStepContent.querySelector('#mobileNo').checkValidity() ){
                            alert('Enter your valid mobile number')
                            return false;
                        }else if(!(activeStepContent.querySelector('#mobileNo').value.length === 11)){
                            alert('The mobile number should be 11 characters long')
                            return false;
                        }

                        if( !activeStepContent.querySelector('#birthDate').checkValidity() ){
                            alert('Enter your birth date')
                            return false;
                        }

                        if( !$('input[name="fromTua"]:checked').val() ){
                            alert('Please state if your from TUA or not')
                            return false;
                        }

                        formData.guestInfo = {
                            firstName: $('#fname').val(),
                            lastName: $('#lname').val(),
                            email: $('#email').val(),
                            mobileNo: $('#mobileNo').val(),
                            birthDate: $('#birthDate').val(),
                            fromTua: $('input[name="fromTua"]:checked').val(),
                            specialRequests: $('#specialRequest').val(),
                        }

                        console.table('FormData |', formData)

                        updateStep3()

                        return true;
                    } else if(StepID == 3){
                        return true;
                    } else if(StepID == 4){
                        return true;
                    }
                }

                const updateTotal = () => {
                    var guests = $("#guests").text();
                    var nights = $("#nights").text();

                    $("#tb_roomName").text(formData.roomDetail.name)
                    $("#tb_roomType").text(formData.roomDetail.type)

                    var cost = nights > 0 ? formData.roomDetail.cost : 0;
                    var AddCost = nights > 0 ? (formData.roomDetail.perPerson * guests) * (nights -1) : 0;
                    var totalCost = cost + AddCost;
                    if(nights > 0){
                        $("#tb_roomCost").text(new Intl.NumberFormat().format(cost) + '.00')
                        $("#tb_sub1").text(new Intl.NumberFormat().format(formData.roomDetail.cost) + ' x 1 night')
                        $("#tb_roomOtherCosts").text(new Intl.NumberFormat().format(AddCost) + '.00')
                        $("#tb_sub2").text(new Intl.NumberFormat().format(formData.roomDetail.perPerson) + ' x ' + guests + ' guest(s) x '+ (nights - 1) + ' night(s)');
                    }else{
                        $("#tb_roomCost").text('0.00')
                        $("#tb_sub1").text(new Intl.NumberFormat().format(formData.roomDetail.cost) + ' x 0 night')
                        $("#tb_roomOtherCosts").text('0.00');
                        $("#tb_sub2").text(new Intl.NumberFormat().format(formData.roomDetail.perPerson) + ' x ' + guests + ' guest(s) x 0 night(s)');
                    }
                    $("#tb_total").text(new Intl.NumberFormat().format(totalCost) + '.00')
                }

                const updateStep3 = () => {
                    $("#bi_roomName").text(formData.roomDetail.name + ' - ' + formData.roomDetail.type);
                    $("#bi_guests").text(formData.guests.total);
                    $("#bi_inDate").text(formData.inDate);
                    $("#bi_outDate").text(formData.outDate);
                    $("#gi_fname").text(formData.guestInfo.firstName);
                    $("#gi_lname").text(formData.guestInfo.lastName);
                    $("#gi_email").text(formData.guestInfo.email);
                    $("#gi_mobileNo").text(formData.guestInfo.mobileNo);
                    $("#gi_specialRequests").text(formData.guestInfo.specialRequests);
                    $("#gi_birthDate").text(formData.guestInfo.birthDate);
                    $("#gi_fromTua").text(formData.guestInfo.fromTua);

                    $("#ta_roomName").text(formData.roomDetail.name);
                    $("#ta_roomType").text(formData.roomDetail.type);
                    $("#ta_roomCost").text(formData.costs.firstNight);
                    $("#ta_roomOtherCosts").text(formData.costs.otherNights);
                    $("#ta_total").text(formData.costs.total);

                    if(formData.nights > 0){
                        $("#ta_sub1").text(new Intl.NumberFormat().format(formData.roomDetail.cost) + ' x 1 night')
                        $("#ta_sub2").text(new Intl.NumberFormat().format(formData.roomDetail.perPerson) + ' x ' + formData.guests.total + ' guest(s) x '+ (formData.nights - 1) + ' night(s)');
                    }else{
                        $("#ta_sub1").text(new Intl.NumberFormat().format(formData.roomDetail.cost) + ' x 0 night')
                        $("#ta_sub2").text(new Intl.NumberFormat().format(formData.roomDetail.perPerson) + ' x ' + formData.guests.total + ' guest(s) x 0 night(s)');
                    }

                    $("#tc_roomName").text(formData.roomDetail.name);
                    $("#tc_roomType").text(formData.roomDetail.type);
                    $("#tc_roomCost").text(formData.costs.firstNight);
                    $("#tc_roomOtherCosts").text(formData.costs.otherNights);
                    $("#tc_total").text(formData.costs.total);

                    if(formData.nights > 0){
                        $("#tc_sub1").text(new Intl.NumberFormat().format(formData.roomDetail.cost) + ' x 1 night')
                        $("#tc_sub2").text(new Intl.NumberFormat().format(formData.roomDetail.perPerson) + ' x ' + formData.guests.total + ' guest(s) x '+ (formData.nights - 1) + ' night(s)');
                    }else{
                        $("#tc_sub1").text(new Intl.NumberFormat().format(formData.roomDetail.cost) + ' x 0 night')
                        $("#tc_sub2").text(new Intl.NumberFormat().format(formData.roomDetail.perPerson) + ' x ' + formData.guests.total + ' guest(s) x 0 night(s)');
                    }
                    const down = parseInt(formData.costs.total.replaceAll(',', '')) / 2;
                    $("#tc_downpayment").text(new Intl.NumberFormat().format(down) + '.00');
                }

                const resetEvents = () => {
                    const allEvents = calendar.getEvents()
                    allEvents.forEach((event, i) => {
                        if(event.groupId === 'Unavailable' || event.groupId === 'TEMPORARY'){
                            event.remove();
                        }
                    });
                    calendar.unselect()
                    $('#inDate').val('');
                    $('#outDate').val('');
                    $('#nights').text('0');
                    updateTotal();
                }

                // EVENT HANDLERS
                $( "#submitBtn" ).click(function(e) {
                    e.preventDefault();

                    let text = "Are you sure you want to submit this reservation?";

                    if (confirm(text) == true) {
                        $.post("/api/newBooking.php",{
                            formData: formData,
                            channel1,
                            channel2,
                            channel3
                        }).done(function(data, status) {
                            alert('Submission Success')
                            stepperInstance.nextStep();
                            formData.transCode = data.transactionCode;
                            $("#transCode").text(data.transactionCode)
                        }).fail(function() {
                            alert('Submission Success')
                            stepperInstance.nextStep();
                        })
                    }
                });

                $( "#finishBtn" ).click(function(e) {
                    e.preventDefault();
                    window.location.replace("/");
                });

                $( "#privacy" ).click(function() {
                    alert('privacy');
                });

                $( "#terms" ).click(function() {
                    alert('terms');
                });

                $("#generatePDF").click(function(e) {
                    e.preventDefault();
                    const date = new Date();
                    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                    let month = months[date.getMonth()];
                    var down = parseInt(formData.costs.total.replaceAll(',', '')) / 2;
                    down = new Intl.NumberFormat().format(down) + '.00';
                    var element = `
                        <div class="flex justify-center items-center">
                            <div class="text-center">
                                <div class="font-bold">TRINITY UNIVERSITY OF ASIA</div>
                                <div class="font-bold">MARY ALSTON HALL</div>
                                <div>Room Reservation</div>
                            </div>
                        </div>
                        <p><span style="font-size:14px">&nbsp;<br />
                        <p><span style="font-size:14px">Date:&nbsp;<strong>${month} ${date.getDate()}, ${date.getFullYear()}</strong></span></p>

                        <p><span style="font-size:14px">Transaction Number:&nbsp;<strong>${formData.transCode}</strong></span></p>

                        <p><span style="font-size:14px">&nbsp;<br />
                        Good Day,&nbsp;<strong>${formData.guestInfo.firstName}&nbsp;</strong>!<br />
                        <br />
                        Thank you for booking with us today! This email contains information about your reservation and how to make it official by paying the required down payment.&nbsp;</span></p>
                        <br />
                        <p><span style="font-size:14px">You now have&nbsp;<strong>48 hrs (2 days)&nbsp;</strong>to pay atleast&nbsp;<strong>${down + ', a '}</strong><strong>50%&nbsp;</strong>of the total amount of the booking as down payment to the reservation. Failure to pay within alloted time allows the system to automatically remove your reservation from the official list.</span></p>
                        <br />
                        <p><span style="font-size:14px">The down payment must be paid via the provided official payment channels below.&nbsp;<strong>You must reply to our email by attaching a valid proof of payment such as official receipts inorder to acknowledge your payment and for us to offically confirm your reservation.</strong><br />
                        <br />
                        Thank you for booking with us, we hope to hear from you again.</span></p>

                        <p><span style="font-size:14px"><strong>Note:&nbsp;&nbsp;</strong>The standard check-in time starts at&nbsp;&nbsp;<strong>2 PM&nbsp;</strong>, and the guests should already check-out before&nbsp;&nbsp;<strong>12 PM&nbsp;</strong>&nbsp;in the last day.</span></p>

                        <hr />

                        <p>&nbsp;</p>
                        <h3><span style="font-size:14px"><strong>Our Official Payment Channels:</strong></span></h3>

                        <table style="width: 571.422px;" border="0">
                            <tbody>
                                <tr>
                                    <td style="text-align: center; width: 75px;">&nbsp;</td>
                                    <td style="width: 136px;">
                                        <p style="text-align: center;"><span style="font-size: 12px;"><strong>${channel1.type}</strong></span></p>
                                    </td>
                                    <td style="width: 92px;">
                                        <p style="text-align: center;">&nbsp;</p>
                                    </td>
                                    <td style="width: 174px;">
                                        <p style="text-align: center;"><span style="font-size: 12px;"><strong>${channel2.type}</strong></span></p>
                                    </td>
                                    <td style="width: 95px;">&nbsp;</td>
                                    <td style="width: 283.422px;">
                                        <p style="text-align: center;"><span style="font-size: 12px;"><strong>${channel3.type}</strong></span></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 75px;">
                                        <p style="text-align: center;"><span style="font-size: 12px;"><strong>Name</strong></span></p>
                                    </td>
                                    <td style="width: 136px;">
                                        <p style="text-align: center;"><span style="font-size: 12px;">${channel1.name}</span></p>
                                    </td>
                                    <td style="width: 92px;">
                                        <p style="text-align: center;"><span style="font-size: 12px;"><strong>Name</strong></span></p>
                                    </td>
                                    <td style="width: 174px;">
                                        <p style="text-align: center;"><span style="font-size: 12px;">${channel2.name}</span></p>
                                    </td>
                                    <td style="width: 95px;">
                                        <p style="text-align: center;"><span style="font-size: 12px;"><strong>Name</strong></span></p>
                                    </td>
                                    <td style="width: 283.422px;">
                                        <p style="text-align: center;"><span style="font-size: 12px;">${channel3.name}</span></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 75px;">
                                        <p style="text-align: center;"><span style="font-size: 12px;"><strong>Number</strong></span></p>
                                    </td>
                                    <td style="width: 136px;">
                                        <p style="text-align: center;"><span style="font-size: 12px;">${channel1.number}</span></p>
                                    </td>
                                    <td style="width: 92px;">
                                        <p style="text-align: center;"><span style="font-size: 12px;"><strong>Number</strong></span></p>
                                    </td>
                                    <td style="width: 174px;">
                                        <p style="text-align: center;"><span style="font-size: 12px;">${channel2.number}</span></p>
                                    </td>
                                    <td style="width: 95px;">
                                        <p style="text-align: center;"><span style="font-size: 12px;"><strong>Number</strong></span></p>
                                    </td>
                                    <td style="width: 283.422px;">
                                        <p style="text-align: center;"><span style="font-size: 12px;">${channel3.number}</span></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <p>&nbsp;</p>

                        <h3><span style="font-size:14px"><strong>Guest Information:</strong></span></h3>

                        <table border="0" style="width:329px">
                            <tbody>
                                <tr>
                                    <td style="width:138px">
                                    <p><span style="font-size:12px"><strong>Full Name</strong></span></p>
                                    </td>
                                    <td style="width:175px">
                                    <p style="text-align:center"><span style="font-size:12px">${formData.guestInfo.lastName}, ${formData.guestInfo.firstName}&nbsp;</span></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:138px">
                                    <p><span style="font-size:12px"><strong>Email</strong></span></p>
                                    </td>
                                    <td style="width:175px">
                                    <p style="text-align:center"><span style="font-size:12px">${formData.guestInfo.email}</span></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:138px">
                                    <p><span style="font-size:12px"><strong>Contact Number</strong></span></p>
                                    </td>
                                    <td style="width:175px">
                                    <p style="text-align:center"><span style="font-size:12px">${formData.guestInfo.mobileNo}</span></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:138px">
                                    <p><span style="font-size:12px"><strong>Birth Date</strong></span></p>
                                    </td>
                                    <td style="width:175px">
                                    <p style="text-align:center"><span style="font-size:12px">${formData.guestInfo.birthDate}</span></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:138px">
                                    <p><span style="font-size:12px"><strong>From TUA</strong></span></p>
                                    </td>
                                    <td style="width:175px">
                                    <p style="text-align:center"><span style="font-size:12px">${formData.guestInfo.fromTua}</span></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:138px">
                                    <p><span style="font-size:12px"><strong>Special Requests</strong></span></p>
                                    </td>
                                    <td style="width:175px">
                                    <p style="text-align:center"><span style="font-size:12px">${formData.guestInfo.specialRequests}</span></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <p>&nbsp;</p>

                        <h3><span style="font-size:14px"><strong>Booking Information:</strong></span></h3>

                        <table border="0" style="width:359px">
                            <tbody>
                                <tr>
                                    <td style="width:160px">
                                    <p><span style="font-size:12px"><strong>Room Name</strong></span></p>
                                    </td>
                                    <td style="width:181px">
                                    <p style="text-align:center"><span style="font-size:12px">${formData.roomDetail.name + ' - ' + formData.roomDetail.type}&nbsp;</span></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:160px">
                                    <p><span style="font-size:12px"><strong>Check-in Date</strong></span></p>
                                    </td>
                                    <td style="width:181px">
                                    <p style="text-align:center"><span style="font-size:12px">${formData.inDate}</span></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:160px">
                                    <p><span style="font-size:12px"><strong>Check-out Date</strong></span></p>
                                    </td>
                                    <td style="width:181px">
                                    <p style="text-align:center"><span style="font-size:12px">${formData.outDate}</span></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:160px">
                                    <p><span style="font-size:12px"><strong>Number of nights</strong></span></p>
                                    </td>
                                    <td style="width:181px">
                                    <p style="text-align:center"><span style="font-size:12px">${formData.nights}</span></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:160px">
                                    <p><span style="font-size:12px"><strong>Number of&nbsp;guests</strong></span></p>
                                    </td>
                                    <td style="width:181px">
                                    <p style="text-align:center"><span style="font-size:12px">${formData.guests.total}</span></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:160px">
                                    <p><span style="font-size:12px"><strong>Total Cost</strong></span></p>
                                    </td>
                                    <td style="width:181px">
                                    <p style="text-align:center"><span style="font-size:12px">&nbsp;${formData.costs.total}</span></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:160px">
                                    <p><span style="font-size:12px"><strong>Required Down Payment</strong></span></p>
                                    </td>
                                    <td style="width:181px">
                                    <p style="text-align:center"><span style="font-size:12px">&nbsp;${down}</span></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    `;
                    var opt = {
                        margin:       1,
                        filename:     'Reservation.pdf',
                        image:        { type: 'jpeg', quality: 0.98 },
                        html2canvas:  { scale: 2 },
                        jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
                    };
                    html2pdf().set(opt).from(element).save();
                });

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
                    formData.roomDetail = roomDetail;
                    updateAllReservations(roomDetail.id)

                    $('#roomName').text(roomDetail.name)
                    $('#roomType').text(roomDetail.type)
                    $('#roomCapacity').text(roomDetail.capacity)
                    $('#roomBed').text(roomDetail.bed)
                    $('#roomCost').text(new Intl.NumberFormat().format(roomDetail.cost) + '.00')
                    $("#roomImg").attr("src",roomDetail.img);
                    $("#noAdults").attr("max",roomDetail.adults);
                    $("#noChildren").attr("max",roomDetail.children);

                    updateTotal();
                });

                $('#noAdults').on('change', function() {
                    var adults = $("#noAdults").val();
                    var children = $("#noChildren").val();
                    var sum = parseInt(adults) + parseInt(children);
                    $("#guests").text(sum);

                    updateTotal();
                });

                $('#noChildren').on('change', function() {
                    var adults = $("#noAdults").val();
                    var children = $("#noChildren").val();
                    var sum = parseInt(adults) + parseInt(children);
                    $("#guests").text(sum);

                    updateTotal();
                });


                // DATA FETCH
                function updateAllReservations(num) {
                    $.post("/api/getAllReservationsPerRoom.php", {
                        roomCode: num
                    }).done(function(data, status) {
                        var reservations = data.bookings.map((booking) => {return {booking, guest: data.guests.find((guest) => { return booking.guest_id === guest.id })}});
                        allReservations = reservations

                        resetEvents();

                        allReservations.forEach( (reservation, i) =>{
                            calendar.addEvent({
                                id: reservation.booking.id,
                                groupId: 'Unavailable',
                                start: reservation.booking.inDate,
                                end: reservation.booking.outDate,
                                backgroundColor: 'red',
                            });
                        });

                    }).fail(function() {
                        alert( "Retrieval Error" );
                    })

                    $.post("/api/getPaymentChannels.php")
                    .done(function(data, status) {
                        var channels = data.channels[0];
                        channel1 = JSON.parse(channels.channel1);
                        channel2 = JSON.parse(channels.channel2);
                        channel3 = JSON.parse(channels.channel3);

                        $('#type1').text(channel1.type);
                        $('#type2').text(channel2.type);
                        $('#type3').text(channel3.type);

                        $('#name1').text('Name: ' + channel1.name);
                        $('#name2').text('Name: ' + channel2.name);
                        $('#name3').text('Name: ' + channel3.name);

                        $('#number1').text('Number: ' + channel1.number);
                        $('#number2').text('Number: ' + channel2.number);
                        $('#number3').text('Number: ' + channel3.number);
                    }).fail(function() {

                    })
                }

                // CALL IT FIRST TIME
                updateAllReservations(0)
            });
        </script>
    </body>
</html>
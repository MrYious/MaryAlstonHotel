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
        <div id="modalPrivacy" class=" flex justify-center items-center z-50 w-full h-screen fixed ">
            <div class="w-full h-screen bg-gray-200 opacity-60"></div>
            <div class="w-[90%] md:w-[50%] flex flex-col bg-gray-50 absolute drop-shadow-xl">
                <div class="p-5 flex justify-between">
                    <span class="font-bold text-2xl">Privacy Policy</span>
                    <span class="closePrivacy cursor-pointer">❌</span>
                </div>
                <div class="flex flex-col gap-4 p-5 h-[400px] overflow-auto text-justify">
                    <div class="font-semibold">Mary Alston Hotel's Privacy Policy</div>
                    <div>
                        MARY ALSTON HOTEL is dedicated to protecting your personal information. You have the right
                        to have your personal data protected as a hotel guest or visitor to our website. Personal Data is
                        information that identifies you personally, either alone or in combination with other information
                        we have (e.g. your name, contact number, e-mail address, among others). We are committed to
                        complying with the Philippines' Data Privacy Act of 2012 ("DPA"), its Implementing Rules and
                        Regulations ("IRR"), and other relevant government regulations and issuances to ensure that
                        your right to privacy is protected in the course of our transactions and when we process your
                        Personal Data.
                    </div>
                    <div>
                        It is necessary that you read and comprehend this Privacy Notice, which explains how and why
                        we collect your personal data, what we do with it, how long we keep it, who we share it with, and
                        how it is protected.
                    </div>
                    <div class="font-semibold">Consent</div>
                    <div>
                        By using our website or giving us with your Personal Data, you are granting us permission to
                        collect, use, and process your Personal Data, and you have agreed to the rules and practices
                        mentioned in this Privacy Notice.
                    </div>
                    <div>
                        If you do not agree to the collection, use, and processing of your Personal Data, please do not
                        use our website and/or contact us if you have any privacy concerns.
                    </div>
                    <div>
                        This Privacy Notice is subject to change at any time. Please review this Privacy Notice on a
                        regularly to keep yourself informed of any changes in the processing of your Personal Data.
                    </div>
                    <div class="font-semibold">Contact Details</div>
                    <div>
                        In compliance with the Data Privacy Act of 2012, the hotel serves as the Personal Information
                        Controller. This means that the hotel is in charge of establishing how and why it gathers and
                        processes your personal data.
                    </div>
                    <div class="font-semibold">Purposes for Collection and Processing of your Personal Data</div>
                    <div>
                        We process your Personal Data for at least one of the following legal reasons:
                    </div>
                    <ul class="flex flex-col gap-1">
                        <li>
                            • Processing of your Personal Data is required to carry out the contract between you and Mary Alston Hotel.
                        </li>
                        <li>
                            • Processing is based on your permission.
                        </li>
                    </ul>
                    <div class="font-semibold">Other Purposes</div>
                    <div>
                        Your personal information will be used only for the purposes for which it was acquired or for
                        other purposes that are compatible with the original. If your personal data is used for any other
                        reason, Mary Alston Hotel will notify you and inform you of the legal basis for the processing, or
                        the hotel will request your consent. In any circumstances, your personal data is treated in
                        compliance with the following principles and the Data Privacy Act of 2012:
                        Your personal data will be collected based on any of the following:
                    </div>
                    <ul class="flex flex-col gap-1">
                        <li>
                            • Handle any complaints, mishaps, illnesses, accidents, or emergencies that may arise during
                            your stay at the hotel.
                        </li>
                        <li>
                            • To contact you or any other appropriate contact in the event of an emergency
                        </li>
                        <li>
                            • Identifying, investigating, and preventing fraud and other criminal actions. Personal data may
                            be shared with third parties for these reasons, such as law enforcement authorities and external
                            consultants.
                        </li>
                        <li>
                            • To improve visitor experience by using information from your evaluations and ratings
                        </li>
                    </ul>
                    <div class="font-semibold">Personal Data We Collect and Collection Methods</div>
                    <div>
                        Personal Data are components of data that identify you as an identifiable individual. The
                        Personal Data that we gather and process are outlined in full below:
                    </div>
                    <ul class="flex flex-col gap-1">
                        <li>
                            • Personal information (name, last name, date of birth, etc.)
                        </li>
                        <li>
                            • Contact information (home address, telephone number, email address, etc.)
                        </li>
                        <li>
                            • Information about your stay (room preferences, arrival and departure dates, name)
                        </li>
                        <li>
                            • Financial information, such as your payment method and transaction details
                        </li>
                        <li>
                            • Special requests and preferences for your stay in order to accommodate specific conditions
                        </li>
                        <li>
                            • Information gathered from hotel and customer security equipment such as CCTV
                        </li>
                        <li>
                            • Information about your level of satisfaction with our products and services, as well as your
                            overall experience during your stay
                        </li>
                    </ul>
                    <div>
                        When you use our site, we automatically collect information, some of which may be personal data.
                    </div>
                    <div class="font-semibold">Retention</div>
                    <div>
                        The Mary Alston Hotel keeps personal information of its various stakeholders in both computer
                        and paper-based records. It takes all reasonable precautions to protect your personal
                        information from misuse, loss, unauthorized access, disclosure, or transfer.
                    </div>
                    <div>
                        We will keep your personal data for as long as it is necessary to fulfill the purposes described in
                        this Privacy Notice and as long as it is necessary to fulfill our contractual and legal obligations,
                        unless required or permitted by law for a longer retention period, or the user requests, opposes,
                        or withdraws his or her consent. Several things affect our retention periods:
                    </div>
                    <ul class="flex flex-col gap-1">
                        <li>
                            • The period during which we have a continuous interaction with you and provide you
                            with our services
                        </li>
                        <li>
                            • If you have a partially completed reservation
                        </li>
                        <li>
                            • If there is a legal requirement that we must uphold (for example, some laws require
                            us to keep your transaction records for a certain period before deleting them)
                        </li>
                        <li>
                            • If we have legitimate business needs, such as managing our relationship with you
                            and our operations.
                        </li>
                        <li>
                            • Maintenance intervals determined by legal and regulatory requirements or directions
                        </li>
                    </ul>
                    <div>
                        Only authorized Mary Alston Hotel personnel have access to this personal information, which
                        will remain with the University Hotel for as long as it deems appropriate, after which physical
                        records will be shredded and digital files will be permanently deleted, with the exception of those
                        that will be kept perpetually as necessary in the course of its operation.
                    </div>
                    <div class="font-semibold">Updating/Amendment of our Privacy Notice</div>
                    <div>
                        We reserve the right to update our Privacy Notice from time to time in order to comply with new
                        and current legislation affecting the DPA, as well as any modifications or improvements we
                        make to protect your personal information.
                        Unless otherwise required by law, any updates or alterations will have no effect on how we treat
                        previously collected personal data unless you consent.
                    </div>
                </div>
                <div class="p-5 flex justify-end">
                    <span class="closePrivacy cursor-pointer py-2 px-4 rounded font-semibold bg-red-500 text-red-100 hover:bg-red-700">CLOSE</span>
                </div>
            </div>
        </div>
        <div id="modalTerms" class=" flex justify-center items-center z-50 w-full h-screen fixed ">
            <div class="w-full h-screen bg-gray-200 opacity-60"></div>
            <div class="w-[90%] md:w-[50%] flex flex-col bg-gray-50 absolute drop-shadow-xl">
                <div class="p-5 flex justify-between">
                    <span class="font-bold text-2xl">Terms and Conditions</span>
                    <span class="closeTerms cursor-pointer">❌</span>
                </div>
                <div class="flex flex-col gap-4 p-5 h-[400px] overflow-auto">
                    <div class="font-semibold">RESERVATION POLICY:</div>
                    <div class="font-semibold">Modification Policy:</div>
                    <div>Reschedule is allowed but contact the admin first to let you know if the rescheduled date is available.</div>
                    <div class="font-semibold">Cancellation Policy:</div>
                    <div>Cancellation is not allowed; non-refundable.</div>
                    <div class="font-semibold">No Show Policy:</div>
                    <div>Failure to arrive at the hotel will be treated as Expired and no refund will be given.</div>
                    <div class="font-semibold">Check-In/ Check-Out Time:</div>
                    <div>Check-in time is at 2pm and check-out time is at 12nn of the following day.</div>
                    <div class="font-semibold">Policy for prepaid bookings:</div>
                    <div>
                        In the event that the person who made the reservation is not present upon check-in, guest should
                        submit an authorization letter and a copy of government-issued ID signed by the person who booked
                        the hotel. Failure to submit the required documents, hotel has the right to refuse or deny the stay.
                    </div>
                </div>
                <div class="p-5 flex justify-end">
                    <span class="closeTerms cursor-pointer py-2 px-4 rounded font-semibold bg-red-500 text-red-100 hover:bg-red-700">CLOSE</span>
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
                                        <div class="text-xs lg:text-sm">Reserved Date</div>
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
                                            <div class="font-medium text-base lg:text-lg">No. of Guests*</div>
                                            <input type="number" name="guests" id="guests" value="0" min="1" max="2" class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black">
                                        </div>
                                        <!-- 4 -->
                                        <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                            <div class="font-medium text-base lg:text-lg">No. of Night(s):</div>
                                            <div class="text-sm lg:text-base browser-default px-2 py-2 w-full "> <b  id="nights">0</b> night(s)</div>
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
                    <div class="step-content flex flex-col gap-4">
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
                                    </div>
                                </div>
                            </div>
                            <!-- 2 -->
                            <div class="flex flex-col lg:w-1/2 w-full gap-4">
                                <div class="flex flex-col gap-2 w-full lg:w-2/3">
                                    <div class="font-medium text-base lg:text-lg">Discount</div>
                                    <select name="discountType" id="discountType" class="inline w-full px-2 border-[1px] focus:border-blue-800 rounded border-black text-sm lg:text-base ">
                                        <option selected value="default">None</option>
                                    </select>
                                </div>
                                <!-- Use Voucher Code Function -->
                                <div id="discRow1" class="flex gap-4">
                                    <!-- <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                        <div class="font-medium text-base lg:text-lg">Voucher Code*</div>
                                        <div class="flex items-center gap-2">
                                            <input type="text" name="discNumber" id="discNumber" class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black">
                                            <button onclick="useVoucherCode()" class="flex w-fit items-center py-2 px-5 border border-green-700 bg-green-100 hover:bg-green-300 text-green-700 rounded">
                                                Use
                                            </button>
                                        </div>
                                    </div> -->
                                    <!-- <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                        <div class="font-medium text-base lg:text-lg">Senior Citizen ID Number*</div>
                                        <input type="text" name="discNumber" id="discNumber" required class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black">
                                    </div>
                                    <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                        <div class="font-medium text-base lg:text-lg">Senior Citizen ID Name*</div>
                                        <input type="text" name="discName" id="discName" required class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black">
                                    </div> -->
                                </div>
                                <div id="discRow2" class="flex gap-4">
                                    <!-- <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                        <div class="font-medium text-base lg:text-lg">Voucher Result</div>
                                        <div class="text-sm w-full lg:text-base px-2 py-2 text-red-700">❌ Invalid Voucher Code</div>
                                        <div class="text-sm w-full lg:text-base px-2 py-2 text-red-700">✅ Christmas Voucher applied</div>
                                        <div class="text-sm w-full lg:text-base px-2 py-2 text-red-700">5 % Discount</div>
                                    </div> -->
                                    <!-- <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                        <div class="font-medium text-base lg:text-lg">PWD ID Number*</div>
                                        <input type="text" name="discNumber" id="discNumber" required class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black">
                                    </div>
                                    <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                        <div class="font-medium text-base lg:text-lg">PWD ID Name*</div>
                                        <input type="text" name="discName" id="discName" required class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black">
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col lg:flex-row h-fit gap-4 lg:gap-10 ">
                            <!-- 2 -->
                            <div class="flex flex-col gap-2 lg:w-1/2 w-full ">
                                <div class="flex gap-1">
                                    <div class="font-medium text-lg lg:text-2xl">Special Request</div>
                                    <div class="text-xs">(optional)</div>
                                </div>
                                <div class="font-medium text-xs lg:text-sm">(Subject to availability)</div>
                                <textarea name="specialRequest" id="specialRequest" rows="3" maxlength="500" class="w-full lg:h-full text-sm lg:text-base browser-default bg-white px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black resize-none"></textarea>
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
                        <div class="flex flex-col lg:flex-row h-fit gap-10 ">
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
                                    <div class="flex gap-4 w-full lg:w-1/2 ">
                                        <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                            <div class="font-medium text-base lg:text-lg">Birth Date</div>
                                            <div id="gi_birthDate" class="text-sm lg:text-base  py-2 w-full font-bold truncate"></div>
                                        </div>
                                        <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                            <div class="font-medium text-base lg:text-lg">From TUA</div>
                                            <div id="gi_fromTua" class="text-sm lg:text-base  py-2 w-full font-bold truncate"></div>
                                        </div>
                                    </div>
                                    <div id="step3discount" class="flex gap-4 w-full lg:w-1/2">
                                        <!-- <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                            <div class="font-medium text-base lg:text-lg">Birth Date</div>
                                            <div id="gi_birthDate" class="text-sm lg:text-base  py-2 w-full font-bold truncate"></div>
                                        </div>
                                        <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                            <div class="font-medium text-base lg:text-lg">From TUA</div>
                                            <div id="gi_fromTua" class="text-sm lg:text-base  py-2 w-full font-bold truncate"></div>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="flex flex-col gap-2 w-full ">
                                    <div class="font-medium text-base lg:text-lg">Special Request</div>
                                    <div id="gi_specialRequests" class="text-sm lg:text-base  py-2 w-full font-bold "></div>
                                </div>
                                <label class="text-black flex items-center">
                                    <input id="privacyTerms" type="checkbox" class="filled-in reset-checkbox" />
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
                                                <div id="ta_sub2">1,000 x 1 guest(s) x 0 night(s)</div>
                                            </div>
                                            <div class="border-2 border-black w-full h-1"></div>
                                        </div>
                                        <div class="text-right w-full p-3"><b id="ta_total" class="text-3xl">0.00</b> PHP</div>
                                        <div id="infoDiscount" class="flex flex-col gap-2 px-3">
                                            <!-- <div class="flex justify-between">
                                                <b>Senior Discount </b>
                                                <b>- 1,000.00</b>
                                            </div>
                                            <div class="flex justify-between pl-7">
                                                <div>1,000 x 1 guest(s) x 0 night(s)</div>
                                            </div>
                                            <div class="border-2 border-black w-full h-1"></div>
                                            <div class="text-right w-full p-3"><b class="text-3xl">0.00</b> PHP</div> -->
                                        </div>
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
                                            The down payment must be paid via the provided official payment channels below. You shall receive an email in a few minutes containing your booking and payment information.
                                            The email will contain a link to the form where you must submit your proof of payment, it must be filled up in order for your payment to be acknowledged by the management and for your reservation to be official.
                                            You must provide the necessary information in the provided form as proof of your payment.
                                        </div>
                                        <div class="text-sm lg:text-base  py-2 w-full  ">
                                            For important concerns and issues, you can reach us via the following email: <b>maryalstonhall@gmail.com. </b> Always keep your transaction number for future concerns.
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
                                        <div id="info4Discount" class="flex flex-col gap-2 px-3">
                                            <!-- <div class="flex justify-between">
                                                <b>Senior Discount </b>
                                                <b>- 1,000.00</b>
                                            </div>
                                            <div class="flex justify-between pl-7">
                                                <div>1,000 x 1 guest(s) x 0 night(s)</div>
                                            </div>
                                            <div class="border-2 border-black w-full h-1"></div>
                                            <div class="text-right w-full p-3"><b class="text-3xl">0.00</b> PHP</div> -->
                                        </div>
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
        <script>
            $("#modalPrivacy").hide();
            $("#modalTerms").hide();
        </script>
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
                var codes = []
                var selectedCode;
                var isPWD;
                var isSenior;
                var isVoucher;

                var pwdVal;
                var seniorVal;
                var imageFile;

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
                        img: 'previewImages/pahiyas.jpg',
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
                        img: 'previewImages/harana.jpg',
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
                        img: 'previewImages/imbayah.jpg',
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
                        img: 'previewImages/pagdayao.jpg',
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
                        img: 'previewImages/moriones.jpg',
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
                    firstActive: 0,
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
                        const guests = parseInt($('#guests').val());

                        if( !strD || !endD ){
                            alert('Please select a date.')
                            return false;
                        }
                        console.log(guests);
                        if( !guests ){
                            alert('Please enter the number of guests.')
                            return false;
                        }

                        $('.active').removeClass('wrong');

                        formData.inDate = $('#inDate').val();
                        formData.outDate = $('#outDate').val();
                        formData.guests = $('#guests').val(),
                        formData.nights = $('#nights').text();
                        formData.costs = {
                            firstNight: $('#tb_roomCost').text(),
                            otherNights: $('#tb_roomOtherCosts').text(),
                            total: $('#tb_total').text(),
                        }

                        console.log(formData);

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

                        if ($('#discountType').val() !== 'default') {
                            if ($('#discountType').val() === 'pwd' || $('#discountType').val() === 'senior') {
                                var number = $('#discNumber').val();
                                var name = $('#discName').val();

                                var image = $('#image').prop('files');
                                if (number !== '' && name !== '' && image.length > 0 ) {
                                    var discountValue = $('#discountType').val() === 'pwd' ? pwdVal : seniorVal
                                    var discountAmount = parseInt(formData.costs.total.replaceAll(',', '')) * ( parseInt(discountValue) / 100 )
                                    var costDiscounted = formData.costs.total.replaceAll(',', '') - discountAmount;

                                    formData.discount = {
                                        isDiscounted: 'true',
                                        image: imageFile,
                                        costDiscounted: costDiscounted,
                                        discountDetails: {
                                            type: $('#discountType').val(),
                                            discountValue: discountValue,
                                            discountAmount: discountAmount,
                                            name: name,
                                            number: number,
                                        }
                                    }
                                } else {
                                    formData.discount = {
                                        isDiscounted: 'false',
                                        image: '',
                                        costDiscounted: 0,
                                        discountDetails: {
                                            none: 'none'
                                        }
                                    }
                                }
                            } else {
                                var inputCode = $("#discCode").val();
                                if (inputCode) {
                                    selectedCode = codes.find((code) => (code.isEnabled === 'true' && code.code === inputCode))
                                    console.log(selectedCode);

                                    if (!selectedCode) {
                                        formData.discount = {
                                            isDiscounted: 'false',
                                            image: '',
                                            costDiscounted: 0,
                                            discountDetails: {
                                                none: 'none'
                                            }
                                        }
                                    } else {
                                        var voucherType = selectedCode.type;
                                        var discountValue = selectedCode.value;
                                        var discountAmount = voucherType === 'fixed' ? discountValue : parseInt(formData.costs.total.replaceAll(',', '')) * ( parseInt(discountValue) / 100 )
                                        var costDiscounted = formData.costs.total.replaceAll(',', '') - discountAmount;

                                        formData.discount = {
                                            isDiscounted: 'true',
                                            image: imageFile,
                                            costDiscounted: costDiscounted,
                                            discountDetails: {
                                                type: $('#discountType').val(),
                                                voucherType: voucherType,
                                                discountValue: discountValue,
                                                discountAmount: discountAmount,
                                                code: selectedCode,
                                            }
                                        }
                                    }
                                }
                            }

                        } else {
                            formData.discount = {
                                isDiscounted: 'false',
                                image: '',
                                costDiscounted: 0,
                                discountDetails: {
                                    none: 'none'
                                }
                            }
                        }

                        console.log(formData);

                        updateStep3()

                        return true;
                    } else if(StepID == 3){
                        return true;
                    } else if(StepID == 4){
                        return true;
                    }
                }

                const updateTotal = () => {
                    var guests = $("#guests").val();
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
                    $('#step3discount').empty();
                    $('#infoDiscount').empty();
                    $('#info4Discount').empty();

                    $("#bi_roomName").text(formData.roomDetail.name + ' - ' + formData.roomDetail.type);
                    $("#bi_guests").text(formData.guests);
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
                        $("#ta_sub2").text(new Intl.NumberFormat().format(formData.roomDetail.perPerson) + ' x ' + formData.guests + ' guest(s) x '+ (formData.nights - 1) + ' night(s)');
                    }else{
                        $("#ta_sub1").text(new Intl.NumberFormat().format(formData.roomDetail.cost) + ' x 0 night')
                        $("#ta_sub2").text(new Intl.NumberFormat().format(formData.roomDetail.perPerson) + ' x ' + formData.guests + ' guest(s) x 0 night(s)');
                    }

                    $("#tc_roomName").text(formData.roomDetail.name);
                    $("#tc_roomType").text(formData.roomDetail.type);
                    $("#tc_roomCost").text(formData.costs.firstNight);
                    $("#tc_roomOtherCosts").text(formData.costs.otherNights);
                    $("#tc_total").text(formData.costs.total);

                    if(formData.discount.isDiscounted === 'true'){

                        if (formData.discount.discountDetails.type === 'senior' || formData.discount.discountDetails.type === 'pwd') {
                            $('#step3discount').append(`
                                <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                    <div class="font-medium text-base lg:text-lg"> ID Number</div>
                                    <div class="text-sm lg:text-base  py-2 w-full font-bold truncate">${formData.discount.discountDetails.number}</div>
                                </div>
                                <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                    <div class="font-medium text-base lg:text-lg"> ID Name</div>
                                    <div class="text-sm lg:text-base  py-2 w-full font-bold truncate">${formData.discount.discountDetails.name}</div>
                                </div>
                            `)
                            $('#infoDiscount').append(`
                                <div class="border-2 border-black w-full h-1"></div>
                                <div class="flex justify-between">
                                    <b>${formData.discount.discountDetails.type === 'pwd' ? 'PWD' :  'Senior' } Discount </b>
                                    <b>- ${new Intl.NumberFormat().format(formData.discount.discountDetails.discountAmount) + '.00'}</b>
                                </div>
                                <div class="flex justify-between pl-7">
                                    <div>${formData.costs.total} x ${formData.discount.discountDetails.discountValue}% discount </div>
                                </div>
                                <div class="border-2 border-black w-full h-1"></div>
                                <div class="text-right w-full p-3"><b class="text-3xl">${new Intl.NumberFormat().format(formData.discount.costDiscounted) + '.00'}</b> PHP</div>
                            `)
                            $('#info4Discount').append(`
                                <div class="border-2 border-black w-full h-1"></div>
                                <div class="flex justify-between">
                                    <b>${formData.discount.discountDetails.type === 'pwd' ? 'PWD' :  'Senior' } Discount </b>
                                    <b>- ${new Intl.NumberFormat().format(formData.discount.discountDetails.discountAmount) + '.00'}</b>
                                </div>
                                <div class="flex justify-between pl-7">
                                    <div>${formData.costs.total} x ${formData.discount.discountDetails.discountValue}% discount </div>
                                </div>
                                <div class="border-2 border-black w-full h-1"></div>
                                <div class="text-right w-full p-3"><b class="text-3xl">${new Intl.NumberFormat().format(formData.discount.costDiscounted) + '.00'}</b> PHP</div>
                            `)
                        } else {
                            $('#step3discount').append(`
                                <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                    <div class="font-medium text-base lg:text-lg"> Voucher Name </div>
                                    <div class="text-sm lg:text-base  py-2 w-full font-bold truncate">${formData.discount.discountDetails.code.name}</div>
                                </div>
                                <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                    <div class="font-medium text-base lg:text-lg"> Voucher Discount </div>
                                    <div class="text-sm lg:text-base  py-2 w-full font-bold truncate">${formData.discount.discountDetails.code.type === 'fixed' ? formData.discount.discountDetails.code.value + ' PHP' : formData.discount.discountDetails.code.value + '%'}</div>
                                </div>
                            `)
                            $('#infoDiscount').append(`
                                <div class="border-2 border-black w-full h-1"></div>
                                <div class="flex justify-between">
                                    <b>Voucher Discount </b>
                                    <b>- ${new Intl.NumberFormat().format(formData.discount.discountDetails.discountAmount) + '.00'}</b>
                                </div>
                                <div class="flex justify-between pl-7">
                                    ${
                                        formData.discount.discountDetails.voucherType === 'fixed' ? `
                                            <div>${new Intl.NumberFormat().format(formData.discount.discountDetails.discountValue) + '.00'} off </div>
                                        ` : `
                                            <div>${formData.costs.total} x ${formData.discount.discountDetails.discountValue}% discount </div>
                                        `
                                    }
                                </div>
                                <div class="border-2 border-black w-full h-1"></div>
                                <div class="text-right w-full p-3"><b class="text-3xl">${new Intl.NumberFormat().format(formData.discount.costDiscounted) + '.00'}</b> PHP</div>
                            `)
                            $('#info4Discount').append(`
                                <div class="border-2 border-black w-full h-1"></div>
                                <div class="flex justify-between">
                                    <b>Voucher Discount </b>
                                    <b>- ${new Intl.NumberFormat().format(formData.discount.discountDetails.discountAmount) + '.00'}</b>
                                </div>
                                <div class="flex justify-between pl-7">
                                    ${
                                        formData.discount.discountDetails.voucherType === 'fixed' ? `
                                            <div>${new Intl.NumberFormat().format(formData.discount.discountDetails.discountValue) + '.00'} off </div>
                                        ` : `
                                            <div>${formData.costs.total} x ${formData.discount.discountDetails.discountValue}% discount </div>
                                        `
                                    }
                                </div>
                                <div class="border-2 border-black w-full h-1"></div>
                                <div class="text-right w-full p-3"><b class="text-3xl">${new Intl.NumberFormat().format(formData.discount.costDiscounted) + '.00'}</b> PHP</div>
                            `)
                        }

                    }

                    if(formData.nights > 0){
                        $("#tc_sub1").text(new Intl.NumberFormat().format(formData.roomDetail.cost) + ' x 1 night')
                        $("#tc_sub2").text(new Intl.NumberFormat().format(formData.roomDetail.perPerson) + ' x ' + formData.guests + ' guest(s) x '+ (formData.nights - 1) + ' night(s)');
                    }else{
                        $("#tc_sub1").text(new Intl.NumberFormat().format(formData.roomDetail.cost) + ' x 0 night')
                        $("#tc_sub2").text(new Intl.NumberFormat().format(formData.roomDetail.perPerson) + ' x ' + formData.guests + ' guest(s) x 0 night(s)');
                    }

                    var val = formData.discount.isDiscounted === 'true' ? parseInt(formData.discount.costDiscounted) : parseInt(formData.costs.total.replaceAll(',', ''))
                    var down = Math.round(val / 2);
                    down = new Intl.NumberFormat().format(down) + '.00';
                    $("#tc_downpayment").text(down);
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
                $('#guests').on('input', function() {
                    if($('#guests').val() > formData.roomDetail.capacity){
                        $('#guests').val(formData.roomDetail.capacity)
                    }
                });

                $('#birthDate').on('input', function() {
                    var today = new Date().getFullYear();
                    var bDate = new Date($('#birthDate').val()).getFullYear();
                    if(today <= bDate){
                        $('#birthDate').val('')
                    }
                });

// TODO, SAVE DATA TO DB, LOAD DISCOUNT ON INFOS

                $( "#submitBtn" ).click(function(e) {
                    e.preventDefault();

                    let text = "Are you sure you want to submit this reservation?";

                    if ($('#privacyTerms').is(":checked")){
                        if (confirm(text) == true) {
                            $('#submitBtn').prop('disabled', true);
                            $.post("/api/newBooking.php",{
                                formData: formData,
                                channel1,
                                channel2,
                                channel3
                            }).done(function(data, status) {
                                console.log(data);
                                console.log(data.isExisting);
                                if(data.isExisting){
                                    alert('You are blacklisted from the hotel. You are not allowed to book reservations.')
                                } else {
                                    alert('Submission Success')
                                    stepperInstance.nextStep();
                                    formData.transCode = data.transactionCode;
                                    $("#transCode").text(data.transactionCode)
                                }
                            }).fail(function() {
                                alert('Submission Failed')
                                stepperInstance.nextStep();
                                $('#submitBtn').prop('disabled', false);
                            })
                        }
                    } else{
                        alert('To proceed, you must agree to our Privacy Policy and Terms and Conditions!')
                    }
                });

                $( "#finishBtn" ).click(function(e) {
                    e.preventDefault();
                    window.location.replace("/");
                });

                $( "#privacy" ).click(function() {
                    $("#modalPrivacy").show();
                });

                $( ".closePrivacy" ).click(function() {
                    $("#modalPrivacy").hide();
                });

                $( "#terms" ).click(function() {
                    $("#modalTerms").show();
                });

                $( ".closeTerms" ).click(function() {
                    $("#modalTerms").hide();
                });

                $("#generatePDF").click(function(e) {
                    e.preventDefault();
                    const date = new Date();
                    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                    let month = months[date.getMonth()];
                    var val = formData.discount.isDiscounted === 'true' ? parseInt(formData.discount.costDiscounted) : parseInt(formData.costs.total.replaceAll(',', ''))
                    var down = Math.round(val / 2);
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
                                    <p><span style="font-size:12px"><strong>Number of Nights</strong></span></p>
                                    </td>
                                    <td style="width:181px">
                                    <p style="text-align:center"><span style="font-size:12px">${formData.nights}</span></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:160px">
                                    <p><span style="font-size:12px"><strong>Number of Guests</strong></span></p>
                                    </td>
                                    <td style="width:181px">
                                    <p style="text-align:center"><span style="font-size:12px">${formData.guests}</span></p>
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
                                ${
                                    formData.discount.isDiscounted === 'true'
                                    ?
                                        `<tr>
                                            <td style="width:160px">
                                            <p><span style="font-size:12px"><strong>Discounted Total Cost</strong></span></p>
                                            </td>
                                            <td style="width:181px">
                                            <p style="text-align:center"><span style="font-size:12px">&nbsp;${new Intl.NumberFormat().format(formData.discount.costDiscounted) + '.00' }</span></p>
                                            </td>
                                        </tr>`
                                    :
                                        ''
                                }
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
                    $('#discountType').empty();
                    $('#discountType').append('<option selected value="default">None</option>');
                    updateAllReservations(roomDetail.id)

                    $('#roomName').text(roomDetail.name)
                    $('#roomType').text(roomDetail.type)
                    $('#roomCapacity').text(roomDetail.capacity)
                    $('#roomBed').text(roomDetail.bed)
                    $('#roomCost').text(new Intl.NumberFormat().format(roomDetail.cost) + '.00')
                    $("#roomImg").attr("src",roomDetail.img);
                    $("#guests").attr("max", roomDetail.capacity);

                    updateTotal();
                });

                $('#discountType').on('change', function() {
                    // alert( this.value );
                    // console.log(formData);
                    const val = this.value;
                    $("#discRow1").empty();
                    $("#discRow2").empty();
                    if( val === 'senior'){
                        $('#discRow1').append(`
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-medium text-base lg:text-lg">Senior Citizen ID Number*</div>
                                <input required type="text" name="discNumber" id="discNumber" class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black">
                            </div>
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-medium text-base lg:text-lg">Senior Citizen ID Name*</div>
                                <input required type="text" name="discName" id="discName" class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black">
                            </div>
                        `);
                        $('#discRow2').append(`
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-medium text-base lg:text-lg">Senior Citizen ID Image*</div>
                                <input type="file" name="image" id="image" accept="image/png, image/jpeg" required class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black"/>
                            </div>
                        `);
                        $('#image').change(function(){
                            const file = this.files[0];
                            // console.log(file);
                            if (file) {
                                let reader = new FileReader();
                                reader.onload = function(event){
                                    // console.log(event.target.result);
                                    imageFile = event.target.result;
                                }
                                reader.readAsDataURL(file);
                            }
                        });
                        $('#discName').change(function(e){
                            var val = $(this).val();
                            if (/\d/.test(val)) {
                                $('#discName').val('')
                            }
                        });
                    } else if( val === 'pwd'){
                        $('#discRow1').append(`
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-medium text-base lg:text-lg">PWD ID Number*</div>
                                <input required type="text" name="discNumber" id="discNumber" class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black">
                            </div>
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-medium text-base lg:text-lg">PWD ID Name*</div>
                                <input required type="text" name="discName" id="discName" class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black">
                            </div>
                        `);
                        $('#discRow2').append(`
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-medium text-base lg:text-lg">PWD ID Image*</div>
                                <input type="file" name="image" id="image" accept="image/png, image/jpeg" required class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black"/>
                            </div>
                        `);
                        $('#image').change(function(){
                            const file = this.files[0];
                            // console.log(file);
                            if (file) {
                                let reader = new FileReader();
                                reader.onload = function(event){
                                    // console.log(event.target.result);
                                    imageFile = event.target.result;
                                }
                                reader.readAsDataURL(file);
                            }
                        });
                        $('#discName').change(function(e){
                            var val = $(this).val();
                            if (/\d/.test(val)) {
                                $('#discName').val('')
                            }
                        });
                    } else if( val === 'voucher'){
                        $('#discRow1').append(`
                            <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                <div class="font-medium text-base lg:text-lg">Voucher Code</div>
                                <div class="flex items-center gap-2">
                                    <input required type="text" name="discCode" id="discCode" class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black">
                                    <div id='checkVoucherCode' class="flex w-fit items-center cursor-pointer py-2 px-5 border border-green-700 bg-green-100 hover:bg-green-300 text-green-700 rounded">
                                        Check
                                    </div>
                                </div>
                            </div>
                        `);
                        $('#checkVoucherCode').on('click', function() {
                            $("#discRow2").empty();
                            var inputCode = $("#discCode").val();
                            if (inputCode) {
                                selectedCode = codes.find((code) => (code.isEnabled === 'true' && code.code === inputCode))
                                console.log(selectedCode);

                                if (!selectedCode) {
                                    $('#discRow2').append(`
                                        <div class="flex flex-col gap-2 w-full lg:w-1/2">
                                            <div class="font-medium text-base lg:text-lg">Voucher Result</div>
                                            <div class="text-sm w-full lg:text-base px-2 py-2 text-red-700">❌ Invalid Voucher Code</div>
                                        </div>
                                    `);
                                } else {
                                    $('#discRow2').append(`
                                        <div class="flex flex-col gap-2 w-full">
                                            <div class="font-medium text-base lg:text-lg">Voucher Result</div>
                                            <div class="w-full text-base lg:text-lg px-2 py-2">✅ ${selectedCode.name} - ${selectedCode.value + ' ' + (selectedCode.type === 'fixed' ? ' PHP' : '%') } Discount</div>
                                        </div>
                                    `);
                                }
                            }
                        });
                    }
                });

                $('#guests').on('change', function() {
                    updateTotal();
                });

                // DATA FETCH
                function updateAllReservations(num) {
                    $.post("/api/getAllReservationsPerRoom.php", {
                        roomCode: num
                    }).done(function(data, status) {
                        var reservations = data.bookings.map((booking) => {return {booking, guest: data.guests.find((guest) => { return booking.guest_id === guest.id })}});
                        allReservations = reservations

                        // console.log(allReservations);
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
                        $.post("/api/getDiscounts.php")
                        .done(function(data, status) {
                            var list = data.list
                            console.log(list);

                            isPWD = list.find((x) => x.type === "pwd").enabled;
                            isSenior = list.find((x) => x.type === "seniorCitizen").enabled;
                            isVoucher = list.find((x) => x.type === "voucher").enabled;

                            pwdVal = parseInt(JSON.parse(list.find((x) => x.type === "pwd").codes))
                            seniorVal = parseInt(JSON.parse(list.find((x) => x.type === "seniorCitizen").codes))

                            // $('#discountType').append('');

                            if(isPWD === 'true'){
                                $('#discountType').append($('<option>').val('pwd').text('Persons-With-Disability (PWD) Discount | ' + pwdVal + '%'));
                            }

                            if(isSenior === 'true'){
                                $('#discountType').append($('<option>').val('senior').text('Senior Citizen Discount | ' + seniorVal + '%'));
                            }

                            if(isVoucher === 'true'){
                                $('#discountType').append($('<option>').val('voucher').text('Voucher Code Discount'));
                            }

                            // console.log(isPWD, isSenior, isVoucher);

                            codes = JSON.parse(list.find((x) => x.type === "voucher").codes);
                            console.log('Codes ', codes);
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
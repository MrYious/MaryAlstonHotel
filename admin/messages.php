<?php
	session_start();
	include dirname(__DIR__).'/api/authSession.php';
	include dirname(__DIR__).'/api/checkExpired.php';

    if ( $_SESSION["role"] !== 'master' && ( !isset($_SESSION["permissions"]) || $_SESSION["permissions"]->manageMessages !== 'true')) {
		header('location:/');
    }
?>
<html>
    <head>
        <title> Messages </title>
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
            <div id="modalRespond" class=" flex justify-center items-center z-50 w-full h-screen fixed ">
                <div class="w-full h-screen bg-gray-200 opacity-60"></div>
                <form id="modalContent" class="w-[90%] md:w-[50%] flex flex-col bg-gray-50 absolute drop-shadow-xl">
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
                    Admin / Messages
                </section>
                <section class="flex flex-col gap-3 p-7 ">
                    <div class="w-full flex items-center justify-end gap-2">
                        <div class="shrink-0">Filter Results</div>
                        <select name="filter" id="filter" class="inline w-fit outline-none px-2 border-[1px] focus:border-blue-800 rounded border-black text-sm lg:text-base ">
                            <option value="all">All</option>
                            <option value="answered">Answered</option>
                            <option value="unanswered">Unanswered</option>
                        </select>
                    </div>
                    <div class="flex justify-between">
                        <div>List of Messages</div>
                        <div class="flex gap-2">
                            <div>
                                <b id="answered">0</b>
                                Answered
                            </div>
                            <div>
                                <b id="unanswered">0</b>
                                Unanswered
                            </div>
                            <div>
                                <b id="total">0</b>
                                Total messages
                            </div>
                        </div>
                    </div>
                    <div id="messages" class="flex flex-col gap-1">
                    </div>
                </section>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
        <script type="text/javascript">
            $("#modalRespond").hide();
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
            var messages = [
                // {
                //     id: 1,
                //     name: 'Mark Edison Rosario',
                //     email: 'sample1@gmail.com',
                //     message: 'sample1@gmail.com',
                //     date: new Date().toLocaleDateString(),
                // },
                // {
                //     id: 2,
                //     name: 'Mark Edison Rosario',
                //     email: 'sample1@gmail.com',
                //     message: 'sample1@gmail.com',
                //     date: new Date().toLocaleDateString(),
                // },
                // {
                //     id: 3,
                //     name: 'Mark Edison Rosario',
                //     email: 'sample1@gmail.com',
                //     message: 'sample1@gmail.com',
                //     date: new Date().toLocaleDateString(),
                // },
            ]
            var selectedMessage = {};
            var filter = 'all';

            function handleRespond(id) {
                selectedMessage = messages.find(item => {return item.id == id})
                $('#modalContent').append(`
                    <div class="p-5 flex justify-between">
                        <span class="font-bold text-lg">Respond to the message</span>
                        <span onclick="closeRespond()" class="cursor-pointer">❌</span>
                    </div>
                    <div class="flex flex-col gap-3 p-5 h-[400px] overflow-auto">
                        <div><b>Name:</b> ${selectedMessage.name} </div>
                        <div><b>Email:</b> ${selectedMessage.email} </div>
                        <div class="flex flex-col gap-2">
                            <b>Message:</b>
                            <div class="text-sm italic text-justify ">
                                ${selectedMessage.message}
                            </div>
                        </div>
                        <div class="flex flex-col gap-1 w-full">
                            <div class="font-semibold">
                                Response <span class="text-red-600 font-bold">*</span>
                            </div>
                            <textarea rows="6" name="response" id="response" required class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black resize-none" ></textarea>
                        </div>
                    </div>
                    <div class="p-5 flex justify-end gap-3">
                        <span onclick="closeRespond()" class="cursor-pointer py-2 px-4 rounded font-semibold bg-red-500 text-red-100 hover:bg-red-700">CLOSE</span>
                        <button type="submit" class="cursor-pointer py-2 px-4 rounded font-semibold bg-green-500 text-green-100 hover:bg-green-700">SUBMIT</button>
                    </div>
                `);
                $("#modalRespond").show();
            }

            $("#modalContent").submit(function(e) {
                e.preventDefault();
                $("#modalRespond").hide();
                var response = $('#response').val();
                $.post("/api/updateMessage.php",{
                    id: selectedMessage.id,
                    date: selectedMessage.createdAt,
                    name: selectedMessage.name,
                    email: selectedMessage.email,
                    message: selectedMessage.message,
                    response: response,
                }).done(function(data, status) {
                    // console.log(data);
                    closeRespond()
                    alert('Action Success')
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

            function closeRespond() {
                $("#modalRespond").hide();
                $("#modalContent").empty();
                selectedMessage = {};
            };

            function handleDelete(id) {
                $.post("/api/deleteMessage.php",{
                    id: id,
                }).done(function(data, status) {
                    fetchList()
                }).fail(function(response) {
                    // console.log(response);
                })
            }

            function fetchList() {
                $('#messages').empty()

                $.post("/api/getMessages.php")
                .done(function(data, status) {
                    messages = data.list
                    // console.log(messages);
                    if(messages.length === 0){
                        $('#messages').append(`
                            <div class="italic">No records</div>
                        `)
                        $("#total").text(0);
                        $("#answered").text(0);
                        $("#unanswered").text(0);
                    } else {
                        var answeredMessages = messages.filter((message) => {
                            return message.response
                        })
                        var unansweredMessages = messages.filter((message) => {
                            return !message.response
                        })

                        $("#total").text(messages.length);
                        $("#answered").text(answeredMessages.length);
                        $("#unanswered").text(unansweredMessages.length);

                        messages
                        .filter((item) => {
                            if(filter === 'all'){
                                return true
                            } else if(filter === 'answered'){
                                return item.response
                            } else if(filter === 'unanswered'){
                                return !item.response
                            }
                        })
                        .forEach((item, i) => {
                            $('#messages').append(`
                                <div class="flex flex-col-reverse lg:flex-row border rounded border-gray-600 p-4 gap-2 lg:gap-7">
                                    <div class="flex flex-col gap-2 w-full lg:w-[35%] justify-between">
                                        <div><b>Name:</b> ${item.name} </div>
                                        <div><b>Email:</b> ${item.email} </div>
                                        <div><b>Date:</b> ${item.createdAt}</div>
                                        <div class="pt-2 flex gap-2 w-full">
                                            ${!item.response ? `
                                                <button id="newEmailBtn" onclick="handleRespond(${item.id})" class="flex items-center gap-1 p-1 border border-green-700 bg-green-100 hover:bg-green-300 text-green-700 rounded">
                                                    <i class="bi bi-reply cursor-pointer text-lg "></i>
                                                    <span>Respond</span>
                                                </button>
                                            ` : ''}
                                            <button id="newEmailBtn" onclick="handleDelete(${item.id})" class="flex items-center gap-1 p-1 border border-red-700 bg-red-100 hover:bg-red-300 text-red-700 rounded">
                                                <i class="bi bi-trash cursor-pointer text-lg "></i>
                                                <span>Delete</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-2 w-full lg:w-[65%]">
                                        <b>Message:</b>
                                        <div class="text-sm italic text-justify ">
                                            ${item.message}
                                        </div>
                                        ${
                                            item.response ? `
                                            <b>Your response:</b>
                                            <div class="text-sm italic text-justify ">
                                                ${item.response}
                                            </div>` : ''
                                        }
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
        </script>
    </body>
</html>
<?php
	session_start();
?>
<html>
    <head>
        <title> Proof of Payment Form </title>
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
    </head>
    <body>
        <div class="flex justify-center items-center min-h-screen bg-gray-200 p-10">
            <div class="flex flex-col w-[90%] lg:w-[75%] lg:w-[50%] bg-gray-300 shadow-gray-500 shadow-sm  drop-shadow-xl">
                <div class="flex flex-col p-7 gap-5">
                    <div class="flex flex-col gap-1">
                        <div class="text-2xl font-bold">Proof of Payment Form</div>
                        <div class="italic text-sm">Fill up the required fields to confirm your payment to your reservation</div>
                    </div>
                    <form id="form" method="post" enctype="multipart/form-data" class="flex flex-col gap-2">
                        <div class="flex flex-col gap-1 w-full">
                            <div class="font-semibold">
                                Transaction Number <span class="text-red-600 font-bold">*</span>
                            </div>
                            <div class="italic text-xs">Check the transaction number we sent to your email during the submission of the reservation form </div>
                            <input type="text" name="transCode" id="transCode" required class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black"/>
                        </div>
                        <div class="flex flex-col gap-1 w-full">
                            <div class="font-semibold">
                                Name of Sender or Account Holder <span class="text-red-600 font-bold">*</span>
                            </div>
                            <input type="text" name="name" id="name" required class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black"/>
                        </div>
                        <div class="flex flex-col gap-1 w-full">
                            <div class="font-semibold">
                                Email Address <span class="text-red-600 font-bold">*</span>
                            </div>
                            <div class="italic text-xs">Use the same email address in your reservation </div>
                            <input type="email" name="email" id="email" required class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black"/>
                        </div>
                        <div class="flex flex-col gap-1 w-full">
                            <div class="font-semibold">
                                Note / Remarks
                            </div>
                            <input type="text" name="note" id="note" class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black"/>
                        </div>
                        <div class="flex gap-2 w-full items-center">
                            <div class="border border-gray-800 w-1/2 h-[1px]"></div>
                            <div class="font-bold text-lg shrink-0">
                                Payment Details
                            </div>
                            <div class="border border-gray-800 w-1/2 h-[1px]"></div>
                        </div>
                        <div class="flex flex-col gap-1 w-full">
                            <div class="font-semibold">
                                Payment Via <span class="text-red-600 font-bold">*</span>
                            </div>
                            <select id="channel" required class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black">
                                <option selected disabled>Select an option</option>
                            </select>
                        </div>
                        <div class="flex flex-col gap-1 w-full">
                            <div class="font-semibold">
                                Amount of Payment <span class="text-red-600 font-bold">*</span>
                            </div>
                            <div class="italic text-xs">Enter the exact amount of your payment </div>
                            <input type="number" min="1" name="amount" id="amount" required class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black"/>
                        </div>
                        <div class="flex flex-col gap-1 w-full">
                            <div class="font-semibold">
                                Reference Number or Transaction Code <span class="text-red-600 font-bold">*</span>
                            </div>
                            <input type="text" name="refNum" id="refNum" required class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black"/>
                        </div>
                        <div class="flex flex-col gap-1 w-full">
                            <div class="font-semibold">
                                Payment Date <span class="text-red-600 font-bold">*</span>
                            </div>
                            <div class="italic text-xs">Select the options </div>
                            <input type="date" name="date" id="date" required class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black"/>
                        </div>
                        <div class="flex flex-col gap-1 w-full">
                            <div class="font-semibold">
                                Proof of Payment <span class="text-red-600 font-bold">*</span>
                            </div>
                            <input type="file" name="image" id="image" accept="image/png, image/gif, image/jpeg" required class="text-sm w-full lg:text-base browser-default px-2 py-2 border-[1px] focus:border-blue-800 outline-none rounded border-black"/>
                            <div id="holder" class="flex items-center justify-center w-full px-2 py-2 border-[1px] rounded border-black ">
                                Select an image to preview
                            </div>
                        </div>
                        <button type="submit" class="w-full text-white rounded font-bold py-2 bg-green-800 hover:bg-green-900 shadow-sm shadow-black mt-3">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
        <script>
            var imageFile;
            $.post("/api/getPaymentChannels.php")
            .done(function(data, status) {
                var channels = data.channels[0];
                channel1 = JSON.parse(channels.channel1);
                channel2 = JSON.parse(channels.channel2);
                channel3 = JSON.parse(channels.channel3);

                if(channel1.type !== '' && channel1.name !== '' && channel1.number !== ''){
                    $('#channel').append($('<option>').val(1).text(channel1.type + ' | ' + channel1.name + ' | ' + channel1.number))
                }

                if(channel2.type !== '' && channel2.name !== '' && channel2.number !== ''){
                    $('#channel').append($('<option>').val(2).text(channel2.type + ' | ' + channel2.name + ' | ' + channel2.number))
                }

                if(channel3.type !== '' && channel3.name !== '' && channel3.number !== ''){
                    $('#channel').append($('<option>').val(3).text(channel3.type + ' | ' + channel3.name + ' | ' + channel3.number))
                }

            }).fail(function() {

            })

            $('#date').on('input', function() {
                var today = new Date();
                var date = new Date($('#date').val());
                if(today < date){
                    $('#date').val('')
                }
            });

            $("#form").submit(function(e) {
                e.preventDefault();
                var transCode = $('#transCode').val();
                var name = $('#name').val();
                var email = $('#email').val();
                var note = $('#note').val();
                var channel = $('#channel').val();
                var amount = $('#amount').val();
                var refNum = $('#refNum').val();
                var date = $('#date').val();
                var image = $('#image').prop('files')[0];
                if (!channel) {
                    alert('Select the payment channel where the payment was sent.')
                }else{
                    var data = {
                        transCode: transCode,
                        name: name,
                        email: email,
                        note: note,
                        channel: channel,
                        amount: amount,
                        refNum: refNum,
                        date: date,
                        image: imageFile,
                    };
                    console.log(data);
                    $.post("/api/newPayment.php",{
                        transCode: transCode,
                        name: name,
                        email: email,
                        note: note,
                        channel: channel,
                        amount: amount,
                        refNum: refNum,
                        date: date,
                        image: imageFile,
                    }).done(function(data, status) {
                        $('#form').trigger("reset");
                        $('#holder').empty();
                        $('#holder').text('Select an image to preview');
                        alert("Proof of Payment Sent Successfully")
                    }).fail(function(response) {
                        $('#form').trigger("reset");
                        alert("Proof of Payment Failed to Send")
                    })
                }
            })

            $('#image').change(function(){
                const file = this.files[0];
                // console.log(file);
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event){
                        // console.log(event.target.result);
                        imageFile = event.target.result;
                        $('#holder').empty();
                        $('#holder').append(`<img id="imgPreview" class="w-fit h-full" src="#" alt="pic" />`);
                        $('#imgPreview').attr('src', event.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });

        </script>
    </body>
</html>
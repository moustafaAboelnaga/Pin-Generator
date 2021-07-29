<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Pin Generator</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


        <style>
            * {
                box-sizing: border-box;
            }
            body {
                background: #10101b;
                height: 100vh;
            }


            .half-width {
                height: 580px;
                background: #222436;
                padding: 30px;
                text-align: center;
                border-radius: 4px;
            }
            .generate-btn {
                margin-top: 140px;
                width: 180px;
                height: 180px;
                padding: 20px;
                border-radius: 50%;
                border: 8px solid #39458c;
                background-color: #495bc3;
                color: #ffffff;
                font-weight: bold;
                font-size: 20px;
                text-align: center;
                transition: 0s 0.1s;
            }
            .generate-btn:focus {
                outline: none;
                box-shadow: none;
            }
            .generate-btn:active {
                background: #e0b612;
                border-color: rgb(255 255 255 / 15%);
                transform: scale(1.01);
                transition: 0s;
            }

            input[type="text"] {
                background-color: #3d4153;
                padding: 10px 0px;
                color: #ffffff;
                width: 80%;
                margin: 0 auto;
                border: 2px solid #858299;
                height: 50px;
                padding: 10px;
                text-align: center;
            }
            input[type="text"]:focus {
                background-color: #2f3241;
                color: #fff;
                font-size: 20px;
                box-shadow: none;
            }
            .pin-generator .form-control:disabled,
            .input-section .form-control:disabled {
                background-color: #2f3241;
                border-color: #565b76;
            }
            .pin-generator .form-control.active {
                font-size: 20px;
                color: #fff;
            }


        </style>
    </head>
    <body>

    <div class="container">

        <div class="row">
            <div class="col-md-6">
                <div class="pin-generator half-width">
                    <input class="form-control" type="text" placeholder="Pin Generator" />
                    <button class="generate-btn">Generate Pin</button>
                </div>
            </div>
        </div>
    </div>

    </body>
    <script src="https://code.jquery.com/git/jquery-git.min.js"></script>
<script>
    const generatorInput = document.querySelector(".pin-generator > .form-control");
    const generateBtn = document.querySelector(".pin-generator > .generate-btn");
    const userInput = document.querySelector(".input-section > .form-control");

    generateBtn.addEventListener("click", pinGenerator);

    // Random 4digit pin generate
    function pinGenerator() {

        $.ajax({
            url: '{!! route('getCode') !!}',
            type:"GET",
            success:function(response){
                generatedPin = response.code;
            },
        });
        generatorInput.value = generatedPin;
        generatorInput.disabled = true;
        generatorInput.classList.add("active");
        userInput.focus();
        userInput.value = "";
    }

</script>
</html>

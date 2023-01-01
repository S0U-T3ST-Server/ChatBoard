<?php

define("CHAT", "chatdata.txt");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $text = $_POST['contents'] . "\n";
    file_put_contents(CHAT, $text, FILE_APPEND);
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatBoard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .wrap {
            width: 600px;
            margin: 0 auto;
            padding: 20px 0 100px 0;
            background-color: #f1f1f1;
            min-height: 100vh;
        }

        li {
            position: relative;
            padding: 10px 20px;
            margin: 0 10px 10px 10px;
            background-color: #fff;
            border-radius: 5px;
        }

        span {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 10px;
            font-size: 12px;
            color: black;
        }

        form {
            position: fixed;
            top: 10%;
            left: 5vh;
        }

        #textbox {
            font-size: 16px;
            width: 100%;
            border: none;
            outline: none;
            padding-bottom: 8px;
            box-sizing: border-box;
        }

        .text_underline {
            position: relative;
            border-top: 1px solid #c2c2c2;
        }

        .text_underline::before,
        .text_underline::after {
            position: absolute;
            bottom: 0px;
            width: 0px;
            height: 1px;
            content: '';
            background-color: #3be5ae;
            transition: all 0.5s;
            -webkit-transition: all 0.5s;
        }

        .text_underline::before {
            left: 50%;
        }

        .text_underline::after {
            right: 50%;
        }

        #textbox:focus+.text_underline::before,
        #textbox:focus+.text_underline::after {
            width: 50%;
        }
    </style>
</head>

<body>
    <div class="wrap">
        <ul>
            <li>SampleText <span>&commat;Admin</span></li>
        </ul>
    </div>

    <form action="index.php" method="post">
        <input type="text" name="contents" id="textbox" placeholder="内容を入力する" autocomplete="off">
        <div class="text_underline"></div>
        <button type="submit" class="">送信</button>
        <!-- <input type="text" name="id"> -->
    </form>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

    <script>
        $(function () {
            $.ajax({
                url: 'chatdata.txt',
            })
                .done(function (text) {
                    text.split('\n').forEach(function (chat) {
                        const user_id = "William";
                        if (chat) {
                            const li = `<li>${chat}<span>&commat;${user_id}</span></li>`;
                            $('ul').append(li);
                        }
                    });
                })
                .fail(function () {
                    console.log('ajax_error');
                });
        });
    </script>
</body>

</html>
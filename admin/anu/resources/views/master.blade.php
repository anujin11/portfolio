@extends('layout.master')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax and jQuery</title>
    <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" 
        crossorigin="anonymous" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp">
    <script src="https://kit.fontawesome.com/6d4d46a57e.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="header">
        <div class="col-md-4">
            <h1>Онлайн номын худалдаа</h1>
        </div>
        <div class="pull-right">
            <ul>
                <li class="dropdown" id="book">
                    <h3>Ном &#x25BE;</h3>
                    <ul class="dropdown-menu" id="bookMenu">
                        <li>Байгалийн ухаан</li>
                        <li>Уран зохиол</li>
                        <li>Хууль эрхзүй</li>
                    </ul>
                </li>
                <li class="dropdown" id="account">
                    <h3>Данс &#x25BE;</h3>
                    <ul class="dropdown-menu" id="accountMenu">
                        <li>Данс шалгах</li>
                        <li>Захиалгын статус</li>
                        <li>Нэвтрэх</li>
                    </ul>
                </li>
                <li class="dropdown" id="help">
                    <h3>Тусламж &#x25BE;</h3>
                    <ul class="dropdown-menu" id="helpMenu">
                        <li>Түгээмэл асуулт</li>
                        <li>Буцаалтын бодлого</li>
                        <li>Хүргэлт</li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="cart"><i class="fa-solid fa-cart-shopping"></i><p id="count">0</p></div>
    </div>
    <div class="container">
        <div id="root"></div>
        <div class="sidebar">
            <div class="head"><p>Миний сагс</p></div>
            <div id="cartItem">Сагс хоосон байна.</div>
            <div class="foot">
                <h3>Нийт</h3>
                <h2 id="total">₮ 0.00</h2>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" 
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" 
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script src="lab11.js"></script>
</body>
</html>

<?php
require __DIR__.'/lib/db.inc.php';

?>
<!DOCTYPE HTMl>
<html onload="getTableLimited()">
<head>
    <title>Home</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="./static/css/common.css" />
    <link rel="stylesheet" href="./static/css/jquery.pagination.css" />
    <script type="text/javascript" src="./static/js/jquery.min.js"></script>
    <script type="text/javascript" src="./functions.js"></script>
    <script type="text/javascript" src="./static/js/jquery.pagination.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <style>
        table {
            border-collapse: collapse;
            margin-top: 200px;
            margin-left: 500px;
        }
        table th{
            border: 1px solid black;
            width: 80px;
            height: 40px;
            text-align: center;
            background-color: cornsilk;
        }

        table td{

            border: 1px solid black;
            width: 80px;
            height: 40px;
            text-align: center;

        }

    </style>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><span class="sr-only"></span>Demo Shopping Site</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="./main.php">Home <span class="sr-only"></span></a>
            </li>

        </ul>
    </div>
</nav>
<input type="button" onclick="getTableLimited()" value="show table">
<div>
    <table>
        <thead>
        <tr>
            <th>email</th>
            <th>items</th>
            <th>sumprice</th>
            <th>paymentstate</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<script>
    function getTableLimited() {
        let username = '';
        if (document.cookie.length > 0) {
            c_start = document.cookie.indexOf("y_email=");
            console.log(c_start);
            if (c_start != -1) {
                c_start = c_start + 8;
                c_end = document.cookie.indexOf(";", c_start);
                if (c_end == -1) {
                    c_end = document.cookie.length;
                    username =  unescape(document.cookie.substring(c_start, c_end));
                }
            }
        }
        let datas = [

        ];
        $.ajax({
            type: "post",
            url: "/lib/getLimitedTable.php",
            data: {email: username},
            dataType: "json",
            success: function(msg) {
//                let data = JSON.parse(msg);
                console.log(msg);
                //创建行，有几个人就创建几行
                datas = msg;
                let tbody =document.querySelector('tbody')
                for(let i = 0 ; i < datas.length ; i++){
                    //创建行
                    let tr = document.createElement('tr');
                    tbody.appendChild(tr);
                    //创建单元格
                    console.log(datas[i]);
//                    console.log(JSON.parse(datas[i]));
                    let ob = JSON.parse(datas[i]);
                    console.log(ob["items"]);
                    console.log(ob);
                    let count = 0;
                    for (let k in ob ){
                        if (k == "items") {
                            let td = document.createElement("td");
                            td.innerText = JSON.stringify(ob[k]);
                            tr.appendChild(td);
                        }else {
                            let td = document.createElement("td");
                            td.innerText = ob[k];
                            tr.appendChild(td);
                        }
                        count++;
                    }
                }
            },
            error: function(msg) {
                console.log(msg);
            }
        })

    }
</script>
</body>
</html>
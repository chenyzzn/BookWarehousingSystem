<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            transition: all 0.3s ease;
        }
        body {
            font-family: 'Share Tech', sans-serif;
            font-size: 68px;
            color: white;
            display: flex;
            jsutify-content: center;
            align-items: center;
            margin: 0;
            width: 100vw;
            height: 100vh;
            text-shadow: 8px 8px 10px #0000008c;
            background-color: #343a40;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='28' height='49' viewBox='0 0 28 49'%3E%3Cg fill-rule='evenodd'%3E%3Cg id='hexagons' fill='%239C92AC' fill-opacity='0.25' fill-rule='nonzero'%3E%3Cpath d='M13.99 9.25l13 7.5v15l-13 7.5L1 31.75v-15l12.99-7.5zM3 17.9v12.7l10.99 6.34 11-6.35V17.9l-11-6.34L3 17.9zM0 15l12.98-7.5V0h-2v6.35L0 12.69v2.3zm0 18.5L12.98 41v8h-2v-6.85L0 35.81v-2.3zM15 0v7.5L27.99 15H28v-2.31h-.01L17 6.35V0h-2zm0 49v-8l12.99-7.5H28v2.31h-.01L17 42.15V49h-2z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"), linear-gradient(to right top, #343a40, #2b2c31, #211f22, #151314, #000000);
        }
        h1{
            color:red;
            position:relative;
            font-size:6vw;
            text-shadow:1vw 1vw 3vw rgb(230, 116, 10);
        }
        h2{
            display: inline;
            margin-left: 3vw;
            font-size: 4vw;
            color: rgb(93, 218, 180);
            text-shadow: 0.6vw 0.6vw 1vw rgb(4, 4, 70);
            -webkit-text-stroke: 1px black;
        }
        input{
            color: rgb(121, 202, 245);
            position:relative;
            top:-0.7vw;
            width: 20vw;
            height: 3vw;
        }
        input[type='submit']{
            align-items: center;
            background-image: linear-gradient(144deg,#AF40FF, #5B42F3 50%,#00DDEB);
            border: 0;
            border-radius: 8px;
            box-shadow: rgba(151, 65, 252, 0.2) 0 15px 30px -5px;
            box-sizing: border-box;
            color: #FFFFFF;
            display: flex;
            font-family: Phantomsans, sans-serif;
            font-size: 2vw;
            justify-content: center;
            line-height: 0.8vw;
            width: 15vw;
            height: 3vw;
            text-decoration: none;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            white-space: nowrap;
            cursor: pointer;
            font-weight:bold;
            top: 2vw;
            left: 20vw;
        }
        input[type='submit']:hover{
            width: 20vw;
            left: 17.5vw;
        }
    </style>
</head>
<body>
    <h1>申請帳號</h1>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <form name="form" method="post" action="register_finish.php">
    <h2>UserName：</h2><input type="text" name="name" /> <br>
    <h2>PhoneNumber:</h2><input type="text" name="phone"/><br>
    <h2>Password：</h2><input type="password" name="pw" /> <br>
    <h2>Enter password again：</h2><input type="password" name="pw2" /> <br>
    <h2>Email：</h2><input type="text" name="email" /> <br>
    <input type="submit" name="button" value="確定" />
    </form>
</body>
</html>

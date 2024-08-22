<?php
header('content-type:text/css; charset:UTF-8;');
?>
body {
    background-color:#EEEAE9;
}
h1 {
    color:Black;
    font-family: "Georgia", Times, serif;
    font-weight: bold;
    font-size:40px;
}
h2 {
    color:SlateGrey;
    font-family: "Georgia", Times, serif;
    font-weight: bold;
    font-size:27px;
}
p {
    color:LightSlateGrey;
    font-family:"Lucida Console", "Courier New", monospace;
    font-size:15px;
    text-align:center;
}

/* login鍵和搜尋欄 */
.topnav a {
  float: center;
  display: block;
  color: black;
  text-align: center;
  padding: 15px 10px;
  text-decoration: none;
  font-size: 20px;
  margin-top: 80px;
}

.topnav a.active {
  background-color: #708090;
  color: white;
}

#books {
  font-family: "Georgia", Times, serif;
  border-collapse: collapse;
  width: 100%;
}

#books td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#books tr:nth-child(even){background-color: #f2f2f2;}

#books tr:hover {background-color: #ddd;}

#books th {
  padding-top: 12px;
  padding-bottom: 12px;
  padding: 10px;
  text-align: center;
  background-color: #4682b4;
  color: white;
}

.topnav v {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 15px 20px;
  text-decoration: none;
  font-size: 20px;
  margin-top: 80px;
  margin-left: 180px;
}

.topnav v.active {
  background-color: #708090;
  color: white;
}
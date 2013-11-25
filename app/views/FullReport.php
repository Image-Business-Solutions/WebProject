<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        @import url(//fonts.googleapis.com/css?family=Lato:300,400,700);

        body {
            margin:0;
            font-family:'Lato', sans-serif;
            text-align:center;
            color: #999;
        }

        .welcome {
           width: 300px;
           height: 300px;
           position: absolute;         
           top: 50%; 
           margin-top: -150px;
        }

        a, a:visited {
            color:#FF5949;
            text-decoration:none;
        }

        a:hover {
            text-decoration:underline;
        }

        ul li {
            display:inline;
            margin:0 1.2em;
        }

        p {
            margin:2em 0;
            color:#555;
        }

        #placeInfo {
            width: 600px;
            border-style: solid;
            table-layout: fixed;
        }
        .tdpt {
            padding-right: 10px;
            text-align: right;
            width: 60px;
        }
        .tdpi {
            word-wrap: break-word;
            border-bottom: dashed;
        }
        #productsInfo {
            padding-left: 25px;
            margin-top: 50px;
            width: 600px;
            border-collapse: collapse;
        }
        .tdpri {
            padding-left: 5px;
            text-align: left;
            width: 65%;
            border-bottom: solid;
            border-width: 1px;
        }
        .tdpri2 {
            border-style: solid;
            border-width: 2px;
        }
        .tdpri3 {
            border-style: solid;
            border-width: 2px;
            background-color: grey;
        }        
    </style>
</head>
<body>
    <table id="placeInfo">
        <tr> <td class="tdpt"> Регион: </td> <td class="tdpi"> LALA</td> </tr>
        <tr> <td class="tdpt"> Град: </td> <td class="tdpi"> LALA</td> </tr>
        <tr> <td class="tdpt"> Магазин: </td> <td class="tdpi"> LALA</td> </tr>
        <tr> <td class="tdpt"> Адрес: </td> <td class="tdpi"> LALA</td> </tr>
    </table>
    <table id="productsInfo">
        <tr>
            <td style="width: 65%;">  </td>
            <th colspan='6'  style="border-style: solid;"> Magazin tip: </th>
        </tr>

        <tr>
            <td>  </td>
            <th colspan='2' style="border-style: solid;"> A </th>
            <th colspan='2' style="border-style: solid;"> B </th>
            <th colspan='2' style="border-style: solid;"> C </th>
        </tr>
    </table>
    <table id="productsInfo">
        <tr>
            <td> Pastet...................... </td>
            <th colspan='2' style="border-left:solid; border-top:solid;"> 8 </th>
            <th colspan='2' style="border-top:solid;"> 17 </th>
            <th colspan='2' style="border-top:solid;"> 22 </th>
        </tr>

        <tr>
            <td class="tdpri"> Компас Апетит 180г. </td>
            <td class="tdpri2">20</td>
            <td class="tdpri3">1</td>
            <td class="tdpri2"> 1</td>
            <td class="tdpri3"> 1</td>
            <td class="tdpri2"> 1</td>
            <td class="tdpri3"> 1</td>
        </tr>

    </table>

    <table id="productsInfo">
        <tr>
            <td> Pastet...................... </td>
            <th colspan='2' style="border-left:solid; border-top:solid;"> 8 </th>
            <th colspan='2' style="border-top:solid;"> 17 </th>
            <th colspan='2' style="border-top:solid;"> 22 </th>
        </tr>

        <tr>
            <td class="tdpri"> Компас Апетит 180г. </td>
            <td class="tdpri2">20</td>
            <td class="tdpri3">1</td>
            <td class="tdpri2"> 1</td>
            <td class="tdpri3"> 1</td>
            <td class="tdpri2"> 1</td>
            <td class="tdpri3"> 1</td>
        </tr>
       
    </table>

        <table>
         
        </table>

        

</body>
</html>

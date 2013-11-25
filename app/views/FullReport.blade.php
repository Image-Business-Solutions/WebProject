<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$title}}</title>
    <style>
        @import url(//fonts.googleapis.com/css?family=Lato:300,400,700);

        body {
            margin-bottom: 50px;
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
            margin-top: 20px;
            margin-left: 5%;
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
            width: 90%;
            margin-left: 5%;
            margin-right: 5%;
            border-color: grey;
            border-collapse: collapse;
        }
        .tdpri {
            padding-left: 5px;
            text-align: left;
            width: 45%;
            border-bottom: solid;
            border-width: 1px;
        }
        .tdpri2 {
            border-style: solid;
            border-width: 2px;
        }
        .tdpri3 {
            color: white;
            border-color: grey;
            border-style: solid;
            border-width: 2px;
            background-color: grey;
        }
        .sct {
            border-style: solid;
            border-width: 1px;
            text-align: center;
        }
        #tdcat {
            border-bottom: solid;
            border-width: 1px;
            text-align: center;

        }        
    </style>
</head>
<body>
    <table id="placeInfo">
        <tr> <td class="tdpt"> Регион: </td> <td class="tdpi"> </td> </tr>
        <tr> <td class="tdpt"> Град: </td> <td class="tdpi"> {{$place->city}}</td> </tr>
        <tr> <td class="tdpt"> Магазин: </td> <td class="tdpi"> {{$place->name}}</td> </tr>
        <tr> <td class="tdpt"> Адрес: </td> <td class="tdpi"> {{$place->address}}</td> </tr>
    </table>



   

    @foreach($content as $view)
    {{ $view }}
    @endforeach
    <table id='productsInfo'>
            <tr>
                <td id='tdcat'></td>
                <th colspan='2' > </th>
                <th colspan='2' > </th>
                <th colspan='2' > </th>
            </tr>
            <tr>
                <td colspan='2' class="tdpri"> Общо:</td>
                <td class="tdpri2"> 1</td>
                <td class="tdpri3"> 1</td>
                <td class="tdpri2"> 1</td>
                <td class="tdpri3"> 1</td>
                <td class="tdpri2"> 1</td>
                <td class="tdpri3"> 1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
            </tr>
    </table>

</body>
</html>

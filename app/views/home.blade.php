    <table id="productsInfo">
    	<tr>
            <td style="width: 45%;" rowspan='2'>  </td>
            <th colspan='6'  style="border-style: solid;"> Магазин тип: </th>
            <td rowspan='2' class="sct"> SKU >= </br> листваните </td>
            <td rowspan='2' class="sct"> Липса на </br> цена </td> 
            <td rowspan='2' class="sct"> Липса на</br> продук </td>
            <td rowspan='2' class="sct"> </br> % от Рафта </td> 
            <td rowspan='2' class="sct"> вторично </br> излагане </td>
        </tr>

        <tr>
            <th colspan='2' style="border-style: solid;"> C </th>
            <th colspan='2' style="border-style: solid;"> B </th>
            <th colspan='2' style="border-style: solid;"> A </th>
        </tr>

        <tr>
            <td id='tdcat'> {{$categoryInfoArr['name']}}: </td>
            <th colspan='2' style="border-left:solid; border-top:solid;"> {{$categoryInfoArr['C']}} </th>
            <th colspan='2' style="border-top:solid;"> {{$categoryInfoArr['B']}} </th>
            <th colspan='2' style="border-top:solid;"> {{$categoryInfoArr['A']}} </th>
	        <td></td>
	        <td></td>  
            <td></td>                 
            <td> {{$categoryInfoArr['percents']}}</td>          
        </tr>


        {{$i=0}}
        @foreach($products as $product)

		    <tr>
	            <td class="tdpri"> {{$product->name}} </td>
	            <td class="tdpri2">{{$product->points}}</td>
	            <td class="tdpri3"></td>
	            <td class="tdpri2"></td>
	            <td class="tdpri3"></td>
	            <td class="tdpri2"></td>
	            <td class="tdpri3"> <?php echo $productsInfoArr[$product->id]['countPoints'];?> </td>
	            @if($i == 0)
	            <td> {{$categoryInfoArr['SKUpoints']}}</td>
				@elseif($i == 1)
	            <td> {{$categoryInfoArr['SKUcount']}}</td>
                @elseif($i > 1)
                <td> </td>
				@endif

	            <td><?php echo $productsInfoArr[$product->id]['missingPrice'];?></td>
	            <td style="text-align: center;"> <?php echo $productsInfoArr[$product->id]['missing'];?> </td>
                
                @if($i == 0)
                <td> {{$categoryInfoArr['percentPoint']}}</td>
                @else
                 <td> </td>
                @endif
                
                <td><?php echo $productsInfoArr[$product->id]['secondPoint'];?></td>
	        </tr>
                    {{$i++}}
		@endforeach


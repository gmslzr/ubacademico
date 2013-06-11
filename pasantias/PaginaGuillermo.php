
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<style type="text/css">
  html { height: 100% }
  body { height: 100%; margin: 0px; padding: 0px }
  #map_canvas { height: 100% }
</style>
<script type="text/javascript"
    src="https://maps.google.com/maps/api/js?sensor=false">
</script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
	var map;
    var markers = [];
  function initialize() {
		var latlng = new google.maps.LatLng(10.246944,-67.596111);
		var myOptions = {
			zoom: 10,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
  }
  // Add a marker to the map and push to the array.
      function addMarker(location) {
        marker = new google.maps.Marker({
          position: location,
          map: map
        });
        markers.push(marker);
      }
	 
  // Sets the map on all markers in the array.
      function setAllMap(map) {
        for (var i = 0; i < markers.length; i++) {
          markers[i].setMap(map);
        }
      }

      // Removes the overlays from the map, but keeps them in the array.
      function clearOverlays() {
        setAllMap(null);
      }

      // Shows any overlays currently in the array.
      function showOverlays() {
        setAllMap(map);
      }

      // Deletes all markers in the array by removing references to them.
      function deleteOverlays() {
        clearOverlays();
        markers = [];
      }
  
  
  function lookup(){
	var countryList = document.getElementById("country");
	var provinceList = document.getElementById("region");
	var cityList = document.getElementById("city");
	
	var strCountry = countryList.options[countryList.selectedIndex].text
	var strProvince = provinceList.options[provinceList.selectedIndex].text
	if(cityList.value)
		var strCity = cityList.options[cityList.selectedIndex].text
	
	if(cityList.value){
		var address = strCity + ', ' + strProvince +', '+ strCountry;
	}
	else{
		var address = strProvince +', '+ strCountry;
	}
	
	var gc = new google.maps.Geocoder();
	gc.geocode({'address' : address}, function(results, status){
		if (status == google.maps.GeocoderStatus.OK) {
			$("#lat").html(results[0].geometry.location.lat());
			$("#long").html(results[0].geometry.location.lng());
			clearOverlays();
			map.setCenter(results[0].geometry.location);
			addMarker(results[0].geometry.location);
		}else
		{
			address = strProvince +', '+ strCountry;
			gc.geocode({'address' : address}, function(results, status){
			if (status == google.maps.GeocoderStatus.OK) {
				$("#lat").html(results[0].geometry.location.lat());
				$("#long").html(results[0].geometry.location.lng());
				clearOverlays();
				map.setCenter(results[0].geometry.location);
				addMarker(results[0].geometry.location);
			}else
			{
				address = strCountry;
				gc.geocode({'address' : address}, function(results, status){
				$("#lat").html(results[0].geometry.location.lat());
				$("#long").html(results[0].geometry.location.lng());
				clearOverlays();
				map.setCenter(results[0].geometry.location);
				addMarker(results[0].geometry.location);
			});
		}
	});
  }
  });
}
</script>
<script>
	function NASort(a, b) {
		alert('here');
    return (a.innerHTML > b.innerHTML);
};

    $(document).ready(function(){
        $("select#city").attr("disabled","disabled");
		$("select#region").attr("disabled","disabled");
		
        $("select#country").change(function(){
			
			$("select#region").attr("disabled","disabled");
			$("select#region").html("<option>loading...</option>");
		
			var id = $("select#country option:selected").attr('value');
			$.post("geoselect.php", {id_country:id}, function(data){
                $("select#region").removeAttr("disabled");
                $("select#region").html(data);
			});
		});
			
		$("select#region").change(function(){
			
            $("select#city").attr("disabled","disabled");
            $("select#city").html("<option>loading...</option>");
				var id = $("select#region option:selected").attr('value');
				if($("select#region").html!="<option>loading...</option>"){
					$.post("geoselect.php", {id_state:id}, function(data){
						$("select#city").removeAttr("disabled");
						$("select#city").html(data);
					});
				}
        });
        
    });
	$("select#city").change(function(){ $('select#city option').sort(NASort).appendTo('select#city'); });
</script>
</script>
</head>
<body onload="initialize()">
	<div id="map_canvas" style="height:400px;width:600px"></div>
	<form id="select_form">
    Selec:<br />
		<select id="country">
			<option value="0">choose...</option><option value="1">Afghanistan</option><option value="2">Albania</option><option value="3">Algeria</option><option value="4">American Samoa</option><option value="5">Andorra</option><option value="6">Angola</option><option value="7">Anguilla</option><option value="8">Antarctica</option><option value="9">Antigua and Barbuda</option><option value="10">Argentina</option><option value="11">Armenia</option><option value="12">Aruba</option><option value="13">Australia</option><option value="14">Austria</option><option value="15">Azerbaijan</option><option value="16">Bahamas</option><option value="17">Bahrain</option><option value="18">Bangladesh</option><option value="19">Barbados</option><option value="20">Belarus</option><option value="21">Belgium</option><option value="22">Belize</option><option value="23">Benin</option><option value="24">Bermuda</option><option value="25">Bhutan</option><option value="26">Bolivia</option><option value="27">Bosnia and Herzegovina</option><option value="28">Botswana</option><option value="29">Bouvet Island</option><option value="30">Brazil</option><option value="31">British Indian Ocean</option><option value="32">Brunei</option><option value="33">Bulgaria</option><option value="34">Burkina Faso</option><option value="35">Burundi</option><option value="36">Cambodia</option><option value="37">Cameroon</option><option value="38">Canada</option><option value="39">Cape Verde</option><option value="40">Cayman Islands</option><option value="41">Central African Rep.</option><option value="42">Chad</option><option value="43">Chile</option><option value="44">China</option><option value="45">Christmas Island</option><option value="46">Cocos (Keeling) Is.</option><option value="47">Colombia</option><option value="48">Comoros</option><option value="49">Congo, Dem. Rep</option><option value="50">Congo, Republic</option><option value="51">Cook Islands</option><option value="52">Costa Rica</option><option value="53">Cote d'Ivoire</option><option value="54">Croatia</option><option value="55">Cuba</option><option value="56">Cura?ao</option><option value="57">Cyprus</option><option value="58">Czech Republic</option><option value="59">Denmark</option><option value="60">Djibouti</option><option value="61">Dominica</option><option value="62">Dominican Republic</option><option value="63">East Timor</option><option value="64">Ecuador</option><option value="65">Egypt</option><option value="66">El Salvador</option><option value="67">Equatorial Guinea</option><option value="68">Eritrea</option><option value="69">Estonia</option><option value="70">Ethiopia</option><option value="71">Falkland Islands</option><option value="72">Faroe Islands</option><option value="73">Fiji</option><option value="74">Finland</option><option value="75">France</option><option value="76">French Antarctic</option><option value="77">French Guiana</option><option value="78">French Polynesia</option><option value="79">Gabon</option><option value="80">Gambia</option><option value="81">Georgia</option><option value="82">Germany</option><option value="83">Ghana</option><option value="84">Gibraltar</option><option value="85">Greece</option><option value="86">Greenland</option><option value="87">Grenada</option><option value="88">Guadeloupe</option><option value="89">Guam</option><option value="90">Guatemala</option><option value="91">Guernsey</option><option value="92">Guinea</option><option value="93">Guinea-Bissau</option><option value="94">Guyana</option><option value="95">Haiti</option><option value="96">Heard and McDonald Is</option><option value="97">Holy See (Vatican City)</option><option value="98">Honduras</option><option value="99">Hong Kong</option><option value="100">Hungary</option><option value="101">Iceland</option><option value="102">India</option><option value="103">Indonesia</option><option value="104">Iran</option><option value="105">Iraq</option><option value="106">Ireland</option><option value="107">Isle of Man</option><option value="108">Israel</option><option value="109">Italy</option><option value="110">Jamaica</option><option value="111">Japan</option><option value="112">Jersey</option><option value="113">Jordan</option><option value="114">Kazakhstan</option><option value="115">Kenya</option><option value="116">Kiribati</option><option value="117">Korea, North</option><option value="118">Korea, South</option><option value="119">Kuwait</option><option value="120">Kyrgyzstan</option><option value="121">Laos</option><option value="122">Latvia</option><option value="123">Lebanon</option><option value="124">Lesotho</option><option value="125">Liberia</option><option value="126">Libya</option><option value="127">Liechtenstein</option><option value="128">Lithuania</option><option value="129">Luxembourg</option><option value="130">Macau</option><option value="131">Macedonia (FYR)</option><option value="132">Madagascar</option><option value="133">Malawi</option><option value="134">Malaysia</option><option value="135">Maldives</option><option value="136">Mali</option><option value="137">Malta</option><option value="138">Marshall Islands</option><option value="139">Martinique</option><option value="140">Mauritania</option><option value="141">Mauritius</option><option value="142">Mayotte</option><option value="143">Mexico</option><option value="144">Micronesia</option><option value="145">Moldova</option><option value="146">Monaco</option><option value="147">Mongolia</option><option value="148">Montenegro</option><option value="149">Montserrat</option><option value="150">Morocco</option><option value="151">Mozambique</option><option value="152">Myanmar</option><option value="153">Namibia</option><option value="154">Nauru</option><option value="155">Nepal</option><option value="156">Netherlands</option><option value="157">Netherlands Antilles</option><option value="158">New Caledonia</option><option value="159">New Zealand</option><option value="160">Nicaragua</option><option value="161">Niger</option><option value="162">Nigeria</option><option value="163">Niue</option><option value="164">Norfolk Island</option><option value="165">Northern Mariana Is.</option><option value="166">Norway</option><option value="167">Oman</option><option value="168">Pakistan</option><option value="169">Palau</option><option value="170">Palestine</option><option value="171">Panama</option><option value="172">Papua New Guinea</option><option value="173">Paraguay</option><option value="174">Peru</option><option value="175">Philippines</option><option value="176">Pitcairn Islands</option><option value="177">Poland</option><option value="178">Portugal</option><option value="179">Puerto Rico</option><option value="180">Qatar</option><option value="181">Reunion</option><option value="182">Romania</option><option value="183">Russia</option><option value="184">Rwanda</option><option value="185">Saint Helena</option><option value="186">Saint Lucia</option><option value="187">Samoa</option><option value="188">San Marino</option><option value="189">Sao Tome and Principe</option><option value="190">Saudi Arabia</option><option value="191">Senegal</option><option value="192">Serbia</option><option value="193">Seychelles</option><option value="194">Sierra Leone</option><option value="195">Singapore</option><option value="196">Sint Maarten</option><option value="197">Slovakia</option><option value="198">Slovenia</option><option value="199">Solomon Islands</option><option value="200">Somalia</option><option value="201">South Africa</option><option value="202">South Georgia Island</option><option value="203">South Sudan</option><option value="204">Spain</option><option value="205">Sri Lanka</option><option value="206">St Kitts and Nevis</option><option value="207">St Pierre and Miquelon</option><option value="208">St Vincent Grenadines</option><option value="209">Sudan</option><option value="210">Suriname</option><option value="211">Svalbard and Jan Mayen</option><option value="212">Swaziland</option><option value="213">Sweden</option><option value="214">Switzerland</option><option value="215">Syria</option><option value="216">Taiwan</option><option value="217">Tajikistan</option><option value="218">Tanzania</option><option value="219">Thailand</option><option value="220">Togo</option><option value="221">Tokelau</option><option value="222">Tonga</option><option value="223">Trinidad and Tobago</option><option value="224">Tunisia</option><option value="225">Turkey</option><option value="226">Turkmenistan</option><option value="227">Turks and Caicos Is.</option><option value="228">Tuvalu</option><option value="229">Uganda</option><option value="230">Ukraine</option><option value="231">United Arab Emirates</option><option value="232">United Kingdom</option><option value="233">United States</option><option value="234">Uruguay</option><option value="235">US Minor Outlying Is</option><option value="236">Uzbekistan</option><option value="237">Vanuatu</option><option value="238">Venezuela</option><option value="239">Vietnam</option><option value="240">Virgin Islands (British)</option><option value="241">Virgin Islands (US)</option><option value="242">Wallis and Futuna</option><option value="243">Western Sahara</option><option value="244">Yemen</option><option value="245">Zambia</option><option value="246">Zimbabwe</option>            </select>
        <br /><br />
        Select Region:<br />
        <select id="region">
             <option value="0">select...</option>
        </select>
		<br /><br />
        Select City:<br />
        <select id="city" onchange="lookup();">
             <option value="0">select...</option>
        </select>
        <br /><br />
     </form>
	 Lat:<p id="lat"></p>
	 Long:<p id="long"></p>
</body>
</html>
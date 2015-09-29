	<?php 
	$eat= "Food delivery.
	You pay only for check and for the delivery 15$ and you get all you need without any problems.";
	$airport = "Transfer from airport.
	Picking up in Kharkov airport and transport to your Kharkov apartment for rent or seeing off. You will be assisted by interpreter from Apartment-Kharkov and experienced taxi driver. Price $35. Price for late pickup is 45 USD.";
	$railway = "Transfer from railway.
	Picking you up in Kharkov railway/ bus station and transport to your Kharkov apartment or seeing you off. You will be assisted by interpreter from Apartment-Kharkov and experienced taxi driver. $30";
	$interpreter = 'Interpreter
	A professional interpreter would assist you during your meetings, help shopping, take you around Kharkov, etc. $14 per hour...';
	$car = 'Car rental
	Upon request';
	$p_driver = 'Personal driver
	An experienced driver with a car assisting you around Kharkov (upon request).
	If you’d like to order this service please fill in the form. Our manager will contact you in 24 hours.';
	$buy_phone ='Buy cheap phone with Ukrainian sim card
	Only for 57$ you have all that you need to speak with everyone in Ukraine and abroad.';
	$tour = 'Tour around Kharkov
	Our guide will show you the best places of our city and give you all historical information about Kharkov. 
	The price is 13$ per hour';
	?>


<div class="forma">
 <div class="frm">
    <form id="flat_order" action="order.php" method="post">
    <div class="field"><p>Name <span>*</span></p><input name="name" id="name" type="text"></div>
    <div class="field"><p>E-Mail <span>*</span></p><input name="mail" id="mail" type="text"></div>
    <div class="field"><p>Telephone</p><input name="telephone" type="text"></div>
    <div class="field"><p>Arrival date: <span>*</span></p><input type="text" name="arrival" id="arrival" class="calendar"></div>
	<div class="field"><p>Departure date: <span>*</span></p><input type="text" name="departure" id="departure" class="calendar"></div>
   <div class="bt_price"><a href="#" class="red_button" id="add_serv">Additional services</a></div>
	
	<div id="ico_form">
	<div class="srv">
	<div class="ic_srv"><img src="images/icon_service/food-delivery.png" title="<?php echo $eat; ?>" alt=""></div>
	<div class="choice1"><div class="check"><input type="checkbox" name="choice[]" value="eat"></div>	
	</div>

	</div>
	
	<div class="srv">
	<div class="ic_srv"><img src="images/icon_service/train-car.png" title="<?php echo $railway ;?>" alt=""></div>
	<div class="choice1"><div class="check"><input type="checkbox" name="choice[]" value="railway"></div>	
	</div>

	</div>
	
	<div class="srv">
	<div class="ic_srv"><img src="images/icon_service/airplain-car.png" title="<?php echo $airport; ?>" alt=""></div>
	<div class="choice1"><div class="check"><input type="checkbox" name="choice[]" value="airport"></div>	
	</div>
	</div>
	
	<div class="srv">
	<div class="ic_srv"><img src="images/icon_service/translator.png" title="<?php echo $interpreter ;?>" alt=""></div>
	<div class="choice1"><div class="check"><input type="checkbox" name="choice[]" value="interpreter"></div>	
	</div>
	</div>
	
	<div class="srv">
	<div class="ic_srv"><img src="images/icon_service/car.png" title="<?php echo $car;?>" alt=""></div>
	<div class="choice1"><div class="check"><input type="checkbox" name="choice[]" value="car"></div>	
	</div>
	</div>
	
	<div class="srv">
	<div class="ic_srv"><img src="images/icon_service/car-driver.png" title="<?php echo $p_driver;?>" alt=""></div>
	<div class="choice1"><div class="check"><input type="checkbox" name="choice[]" value="p_driver"></div>	
	</div>
	</div>
	
	<div class="srv">
	<div class="ic_srv"><img src="images/icon_service/mobile.png" title="<?php echo $buy_phone;?>" alt=""></div>
	<div class="choice1"><div class="check"><input type="checkbox" name="choice[]" value="buy_phone"></div>	
	</div>
	</div>
	
	<div class="srv">
	<div class="ic_srv"><img src="images/icon_service/guide.png" title="<?php echo $tour;?>" alt=""></div>
	<div class="choice1"><div class="check"><input type="checkbox" name="choice[]" value="tour"></div>	
	</div>
	</div>
	<div class="com"><div class="bt_price"><input type="button" class="red_button" id="add_order" name="add_order" value="Add to order"></div></div>
	</div>
	<div class="com">
    <div class="field"><p>Comments:</p><textarea name="text"></textarea></div>
    <div class="field"><p>CAPCHA <span>*</span></p>
    <img src="kcaptcha/index.php?'.session_name().'='.session_id().'">
    <input type="text" name="keystring" class="kapcha" id="keystring">
    </div>
	<div class="field"><input type="hidden" name="apart" value="<?php echo $apart; ?>"></div>
	
    <div class="field">
        <input type="submit" name="send_order" class="red_button" value="Send request" onClick="return validate();">
    </div>
	</div>
	

	
	
	
	
</form>
</div>
</div>
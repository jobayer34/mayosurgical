<?php
$path = $_SERVER['DOCUMENT_ROOT']."/mayo/path.php";
require_once($path);
include('header.php');
?>
<section class="row slider_bg">
	<img src="images/slider-1.jpg" alt="image"/>
</section>
<section class="row">
	<div class="container">
		<div class="about_bg">
			<h1>Give your clients the freedom to get the surgery they need</h1>
			<img src="images/images58746598.jpg" alt="image"/>
			<!--<h2>Mauris in erat justo. Nullam ac urna</h2>-->
			<p><strong>Mayo Surgical</strong> knows the pain, suffering and expense individuals can experience after an accident of any kind. What makes it even worse is that these individuals need surgery immediately but cannot find a physician who will take the case for fear the bills will be paid after an extensive wait if they are paid at all. There are other patients waiting in the wings that have insurance and the bills will be paid within 60 days or so.Mayo Surgical provides a unique healthcare solution through medical lien funding and billing services, an advanced solution that offers healthcare providers a low risk.</p>
			<a href="#" class="read_more">read more</a>
		</div>	
	</div>
</section>
<section class="row">
	<div class="container services_box">
		<ul>
			<li>
				<div class="services_box_1">
					<h1>Attorney's</h1>
					<span class="services_icon_1">
						<h3>icon</h3>
					</span>
					<p>As an accident injury attorney how many clients have wanted you to settle their cases quickly... </p>
					<a href="#" class="services_read_more">read more</a>
				</div>
			</li>
			<li>
				<div class="services_box_2">
					<h1>Medical Professionals</h1>
					<span class="services_icon_2">
						<h3>icon</h3>
					</span>
					<p>The oath you have taken to help those who need medical care means a great deal to you.. . </p>
					<a href="#" class="services_read_more">read more</a>
				</div>
			</li>
			<li>
				<div class="services_box_3">
					<h1>Medical Funders</h1>
					<span class="services_icon_3">
						<h3>icon</h3>
					</span>
					<p>Mayo Surgical makes it easy for you to approve our claims.  We are experienced in this area...</p>
					<a href="#" class="services_read_more">read more</a>
				</div>
			</li>
		</ul>
	</div>
</section>
<section class="row">
	<div class="container">
		<div class="section_center">
			<div class="video_bg">
				<h1>Learn more about Mayo Surgical</h1>
				<img src="images/video.png" alt="image"/>
			</div>
			
		</div>	
		<aside class="quote_form">
			<span class="image_icon">H1</span>
			<h1>HOW TO GET MORE INFORMATION</h1>
			<form>
				<input type="text" name="" id="" placeholder="First Name"/>
				<input type="text" name="" id="" placeholder="Last Name"/>
				<input type="email" name="" id="" placeholder="Email Address"/>
				<input type="text" name="" id="" placeholder="Phone Number"/>
				<textarea placeholder="Additional Information"></textarea>
				<input type="submit" name="" id="" value="Submit"/>
			</form>
		</aside>
	</div>
</section>
<?php
require($get_footer);
?>

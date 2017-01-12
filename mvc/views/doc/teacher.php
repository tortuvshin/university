<!doctype html>  
<!--[if IE 6 ]><html lang="en-us" class="ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="en-us" class="ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="en-us" class="ie8"> <![endif]-->
<!--[if (gt IE 7)|!(IE)]><!-->
<html ><!--<![endif]-->
<head>
	<meta charset="utf-8">
	
	 <title>Оюутны бүртгэлийн систем</title>
  
  <meta name="description" content="iNisys оюутны бүртгэлийн систем!">
  <meta name="author" content="Tagtaa Development Team">
  <meta name="copyright" content="Tagtaa Development Team">

  <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url('assets/documentation/css/documenter_style.css'); ?>" media="all">
  <link rel="stylesheet" href="<?php echo base_url('assets/documentation/js/google-code-prettify/prettify.css'); ?>" media="screen">
  <link href="<?php echo base_url('assets/bootstrap/bootstrap.min.css'); ?>" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url('assets/documentation/css/custom.css'); ?>" media="screen">
  
  <script src="<?php echo base_url('assets/documentation/js/google-code-prettify/prettify.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/webcamjs/webcam.js'); ?>"></script>
  <script src="<?php echo base_url('assets/documentation/js/jquery.js'); ?>"></script>
  <script src="<?php echo base_url('assets/documentation/js/jquery.scrollTo.js'); ?>"></script>
  <script src="<?php echo base_url('assets/documentation/js/jquery.easing.js'); ?>"></script>
  <script src="<?php echo base_url('assets/documentation/js/font.js'); ?>"></script>
  <script>document.createElement('section');var duration='450',easing='easeOutExpo';</script>
  <script src="<?php echo base_url('assets/documentation/js/script.js'); ?>"></script>
  
	<style>
		html{background-color:#F3F3F3;color:#585858;}
		::-moz-selection{background:#111111;color:#F1F1F1;}
		::selection{background:#111111;color:#F1F1F1;}
		#documenter_sidebar #documenter_logo{background-image:url(assets/images/image_16.png);}
		a{color:#111111;}
		.btn {
			border-radius:3px;
		}
		.btn-primary {
			  background-image: -moz-linear-gradient(top, #585858, #3B3B3B);
			  background-image: -ms-linear-gradient(top, #585858, #3B3B3B);
			  background-image: -webkit-gradient(linear, 0 0, 0 585858%, from(#333333), to(#3B3B3B));
			  background-image: -webkit-linear-gradient(top, #585858, #3B3B3B);
			  background-image: -o-linear-gradient(top, #585858, #3B3B3B);
			  background-image: linear-gradient(top, #585858, #3B3B3B);
			  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#585858', endColorstr='#3B3B3B', GradientType=0);
			  border-color: #3B3B3B #3B3B3B #bfbfbf;
			  color:#F9F9F9;
		}
		.btn-primary:hover,
		.btn-primary:active,
		.btn-primary.active,
		.btn-primary.disabled,
		.btn-primary[disabled] {
		  border-color: #585858 #585858 #bfbfbf;
		  background-color: #3B3B3B;
		}
		hr{border-top:1px solid #E5E5E5;border-bottom:1px solid #F9F9F9;}
		#documenter_sidebar, #documenter_sidebar ul a{background-color:#333333;color:#F1F1F1;http://static.revaxarts-themes.com/noise.gif}
		#documenter_sidebar ul a{-webkit-text-shadow:1px 1px 0px #444444;-moz-text-shadow:1px 1px 0px #444444;text-shadow:1px 1px 0px #444444;}
		#documenter_sidebar ul{border-top:1px solid #222222;}
		#documenter_sidebar ul a{border-top:1px solid #444444;border-bottom:1px solid #222222;color:#F1F1F1;}
		#documenter_sidebar ul a:hover{background:#111111;color:#F1F1F1;border-top:1px solid #111111;}
		#documenter_sidebar ul a.current{background:#111111;color:#F1F1F1;border-top:1px solid #111111;}
		#documenter_copyright{display:block !important;visibility:visible !important;}
	.style1 {color: #FF0000}
    </style>
	
</head>
<body class="documenter-project-documenter-v20">
	<div id="documenter_sidebar">
		<a href="#documenter_cover" id="documenter_logo"></a>
		<ul id="documenter_nav">
			<li><a class="current" href="#documenter_cover">Эхлэх</a></li>	
			<li><a href="#teacher" title="Багшийн функц">Багшийн функц</a></li>
			<li><a href="#oyutan" title="Оюутны мэдээлэл">Оюутны мэдээлэл </a></li>
			<li><a href="#Bagsh" title=" Багшийн мэдээлэл">Багшийн мэдээлэл </a></li>
			<li><a href="#hichel" title="Хичээлийн мэдээлэл">Хичээлийн мэдээлэл </a></li>
			<li><a href="#shalgalt" title="Шалгалтын хуваарь ">Шалгалтын хуваарь </a></li>
			<li><a href="#odun" title="Оюутны дүн">Оюутны дүн</a></li>
			<li><a href="#hicheel_huwiar" title="Хичээлийн хуваарь">Хичээлийн хуваарь</a></li>
			<li><a href="#Bagshipts" title="Багшийн ирц">Багшийн ирц</a></li>
			<li><a href="#oyutanipts" title="Оюутны болон шалгалтын ирц">Оюутны болон шалгалтын ирц</a></li>
			<li><a href="#bulegdewsh" title="Оюутан бүлэг дэвшүүлэх">Оюутан бүлэг дэвшүүлэх</a></li>
			<li><a href="#medegdel" title="Мэдэгдэл">Мэдэгдэл</a></li>
			<li><a href="#burtgel" title="Бүртгэлийн мэдээлэл">Бүртгэлийн мэдээлэл</a></li>
			<li><a href="#pss" title="Нууц үг солих">Нууц үг солих</a></li>
			<li><a href="#hel" title="Хэл солих">Хэл солих</a></li>
			<li><a href="#medegdeltoh" title="Мэдэгдлийн анхааруулга">Мэдэгдлийн анхааруулга</a></li>
		</ul>

		<div id="documenter_copyright">
		
			<a href="http://folder.mn">Copyright Tagtaa solution 2016</a> <br>
		</div>
	</div>
	<div id="documenter_content">
		<section id="documenter_cover">
			<h1>Оюутны бүртгэлийн систем<br></h1>
		
			
			<hr>
			<p>Оюутны бүртгэлийн систем танилцуулгын дэлгэрэнгүй</p>
		</section>
	

		<section id="teacher">
			<div class="page-header"><h3>Багшийн функц</h3><hr class="notop"></div>
<pre class="prettyprint lang-plain linenums">
 Багшийн удирдлагын самбар дээр багш ба оюутны тоо, хичээлийн тоо, бүртгэлийн мэдээлэл, мэдэгдэлийн самбар ба календарь байна
 Оюутны жагсаалт харах
 Багшийн жагсаалт харах
 Хичээлийн жагсаалт харах
 Шалгалтын хуваарь харах
 Оюутны дүн нэмэх, жагсаах, харах, хэвлэх,pdf татах, pdf мэйл илгээх
 Хичээлийн хуваарь харах
 Багш өөрийн ирцээ харах
 Оюутны болон шалгалтын ирц бүртгэх харах.
 Оюутан бүлэг дэвшүүлэх
 Мэдэгдлийн жагсаах ба тухай мэдэгдлийн дэлгэрэнгүй харах
 Бүртгэлийн мэдээлэл харах.
 Нууц үг солих.
 Хэл солих.
 Мэдэгдлийн анхааруулга.
</pre>
  <p>
    <center>
      <h4> Багшийн удирлагын самбар</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/teacher/teacher_view.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
  
  <br>    
		</section>
		<section id="oyutan">
			<div class="page-header"><h3> Оюутны мэдээлэл харах</h3><hr class="notop"></div>
		
        		Оюутны мэдээлэл харах. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Багшийн эрхээр нэвтрэх
Оюутан цэсийг сонгох  
Курс хэсэгээс аль курсын оюутны мэдээлэл харахыг сонгоно
Дараа нь мэдээлэл харах оюутны харгалзах харах үйлдэл сонгоно 
</pre>
			  <p><img src="<?php echo base_url('assets/documentation/images/teacher/1.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
 <p><img src="<?php echo base_url('assets/documentation/images/teacher/a1.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
             
		</section>
		<section id="Bagsh">
			<div class="page-header"><h3> Багшийн мэдээлэл харах</h3><hr class="notop"></div>
			Багшийн мэдээлэл харах. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Багшийн эрхээр нэвтрэх
Багш цэсийг сонгох  
Дараа нь мэдээлэл харах багшийн харгалзах харах үйлдэл сонгоно
</pre>
			  <p><img src="<?php echo base_url('assets/documentation/images/teacher/2.png'); ?>" width="1000" style="padding: 0px 20px;"></p>

		</section>
		<section id="hichel">
			<div class="page-header"><h3>Сургалт явуулах хичээлийн мэдээлэл харах</h3><hr class="notop"></div>
				Сургалт явуулах хичээлийн мэдээлэл харах. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Багшийн эрхээр нэвтрэх
Хичээл цэсийг сонгох  
Курс хэсэгээс аль курсын мэдээлэл харахыг сонгоно
</pre>
				<p>
					<img src="<?php echo base_url('assets/documentation/images/teacher/3.png'); ?>" width="1000" style="padding: 0px 20px;"/>
				</p>
			
		</section>
		<section id="shalgalt">
			<div class="page-header"><h3>Шалгалтын хуваарь харах</h3><hr class="notop"></div>
			Шалгалтын хуваарь харах. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Багшийн эрхээр нэвтрэх
Шалгалтын хуваарь цэсийг сонгох  
Курс хэсэгээс аль курсын оюутны дүнгийн мэдээлэл харахыг сонгоно
Дараа нь дүнгийн мэдээлэл харах оюутны харгалзах харах үйлдэл сонгоно
</pre>
			  <p><img src="<?php echo base_url('assets/documentation/images/teacher/4.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
		</section>
		<section id="odun">
			<div class="page-header"><h3> Оюутны дүн нэмэх, жагсаах, харах, хэвлэх,pdf татах, pdf мэйл илгээх</h3><hr class="notop"></div>
			<h4>1. Оюутны дүн харах</h4>
        		Оюутны дүн харах. Дараах алхмуудыг дагна уу : 
<pre class="prettyprint">
Багшийн эрхээр нэвтрэх
Дүн цэсийг сонгох  
Курс хэсэгээс аль курсын мэдээлэл харахыг сонгон
</pre>
              <p><img src="<?php echo base_url('assets/documentation/images/teacher/5.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
               <p><img src="<?php echo base_url('assets/documentation/images/teacher/5_1.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
               <h4>2. Оюутны дүн нэмэх</h4>
        		 Оюутны дүн нэмэх. Дараах алхмуудыг дагна уу : 
<pre class="prettyprint">
Багшийн эрхээр нэвтрэх
Дүн цэсийг сонгох  
Дүн нэмэх товч дарна
Дүн оруулах ангыг сонгож дүн товч дарна
Харгалзах оюутны дүнг оруулж дүн нэмэх товч дарна
</pre>
              <p><img src="<?php echo base_url('assets/documentation/images/teacher/5_2.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
               <p><img src="<?php echo base_url('assets/documentation/images/teacher/5_3.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
                <p><img src="<?php echo base_url('assets/documentation/images/teacher/5_4.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
		</section>
		<section id="hicheel_huwiar">
			<div class="page-header"><h3>Сургалт явуулах хичээлийн хуваарь харах</h3><hr class="notop"></div>
			Сургалт явуулах хичээлийн хуваарь харах. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Багшийн эрхээр нэвтрэх
Хичээлийн хуваарь цэсийг сонгох  
Хичээлийн хуваарь харах анги сонгох 
</pre>
			  <p><img src="<?php echo base_url('assets/documentation/images/teacher/6.png'); ?>" width="1000" style="padding: 0px 20px;"></p>

		</section>
		<section id="Bagshipts">
			<div class="page-header"><h3>Багш өөрийн ирцээ харах</h3><hr class="notop"></div>
			Багш өөрийн ирцээ харах. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Багшийн эрхээр нэвтрэх
Ирц -> Багшийн ирц цэсийг сонгох   
</pre>
			  <p><img src="<?php echo base_url('assets/documentation/images/teacher/8.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
		</section>
		<section id="oyutanipts">
			<div class="page-header"><h3>Оюутны болон шалгалтын ирц бүртгэх харах</h3><hr class="notop"></div>
		
        		Оюутны ирц нэмэх. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Багшийн эрхээр нэвтрэх
Ирц -> Оюутны ирц цэсийг сонгох 
Оюутны ирц нэмэх товч дарна
Оюутны ирц оруулах анги өдөр сонгож ирц товч дарна
Харгалзах Оюутны ирц бүртгэнэ 
</pre>
				<p><img src="<?php echo base_url('assets/documentation/images/teacher/7_3.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
			  <p><img src="<?php echo base_url('assets/documentation/images/teacher/7.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
			  	<h4>1. Оюутны ирц харах</h4>
        		Оюутны ирц харах. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Багшийн эрхээр нэвтрэх
Ирц -> Оюутны ирц цэсийг сонгох 
Курс хэсэгээс аль курсын оюутны мэдээлэл харахыг сонгон
Ирцын мэдээлэл харах оюутанд харгалзах харах үйлдэл сонгоно 
</pre>		

			  <p><img src="<?php echo base_url('assets/documentation/images/teacher/7_1.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
			  <p><img src="<?php echo base_url('assets/documentation/images/teacher/7_2.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
			  <h4>2. Шалгалтын ирц нэмэх</h4>
        		Шалгалтын ирц нэмэх. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Багшийн эрхээр нэвтрэх
Ирц -> Шалгалтын ирц цэсийг сонгох 
Шалгалтын ирц нэмэх товч дарна
Шалгалтын ирц оруулах анги өдөр сонгож ирц товч дарна
Харгалзах Оюутны ирц бүртгэнэ 
</pre>
	<p><img src="<?php echo base_url('assets/documentation/images/teacher/9_1.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
			  <p><img src="<?php echo base_url('assets/documentation/images/teacher/10.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
			    <h4>2. Шалгалтын ирц харах</h4>
        		Дүнгийн зэрэг нэмэх. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Багшийн эрхээр нэвтрэх
Ирц -> Шалгалтын ирц цэсийг сонгох 
Ямар хичээлийн шалгалтын мэдээлэл харахыг сонгож ирц харах товч дарна
</pre>

			  <p><img src="<?php echo base_url('assets/documentation/images/teacher/9.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
		</section>
		<section id="bulegdewsh">
			<div class="page-header"><h3>Оюутан бүлэг дэвшүүлэх</h3><hr class="notop"></div>
			Оюутан бүлэг дэвшүүлэх. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Багшийн эрхээр нэвтрэх
Анги дэвшилт цэсийг сонгох 
Анги дэвшихэд хамгийн бага байх дүнг оруулнж анги дэвшилтийн дүнгийн тохируулга товч дарна
Анги дэвших нөхцөл хангагдсан бол тухайн оюутаныг сонгож дараагын ангируу дэвшүүлэх товч дарна
</pre>
			  <p><img src="<?php echo base_url('assets/documentation/images/teacher/11.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
			  <p><img src="<?php echo base_url('assets/documentation/images/teacher/12.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
              
              
		</section>
		<section id="medegdel">
			<div class="page-header"><h3>Мэдэгдлийн жагсаах ба тухай мэдэгдлийн дэлгэрэнгүй харах</h3><hr class="notop"></div>
			Мэдэгдэл харах. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Оюутаны эрхээр нэвтрэх
Мэдэгдэл цэсийг сонгох  
Тухайн мэдэгдэлийн дэлгэрэнгүйг харах бол харах үйлдэлийг сонгоно
</pre>
			  <p><img src="<?php echo base_url('assets/documentation/images/teacher/13.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
			  <p><img src="<?php echo base_url('assets/documentation/images/teacher/14.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
		</section>
		<section id="burtgel">
			<div class="page-header"><h3>Бүртгэлийн мэдээлэл харах</h3><hr class="notop"></div>
				Бүртгэлийн мэдээлэл харах. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Оюутаны эрхээр нэвтрэх
Дээд хэсэгт байрлах хэрэглэгчийн нэрэн дээр дарна
Хэрэглэгчийн мэдээлэл товч дарна
</pre>
			  <p><img src="<?php echo base_url('assets/documentation/images/teacher/15.png'); ?>" width="1000" style="padding: 0px 20px;"></p>

          
		</section>
		<section id="pss">
			<div class="page-header"><h3>Нууц үг солих</h3><hr class="notop"></div>
					Нууц үг солих. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Оюутаны эрхээр нэвтрэх
Дээд хэсэгт байрлах хэрэглэгчийн нэрэн дээр дарна
Хуучин нууц үг оруулсны дараа Шинэ нууц үг оруулж нууц үг товч дарна
</pre>
			  <p><img src="<?php echo base_url('assets/documentation/images/teacher/16.png'); ?>" width="1000" style="padding: 0px 20px;"></p>

            
              	
		</section>
		<section id="hel">
			<div class="page-header"><h3>Хэл солих</h3><hr class="notop"></div>
			Хэл солих. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Оюутаны эрхээр нэвтрэх
Дээд хэсэгт байрлах хэлний сонголт зураг дээр дарна
Өөрчлөх хэлээ сонгоно
</pre>
			  <p><img src="<?php echo base_url('assets/documentation/images/teacher/17.png'); ?>" width="1000" style="padding: 0px 20px;"></p>

              
              
		</section>
		<section id="medegdeltoh">
			<div class="page-header"><h3>Мэдэгдлийн анхааруулга</h3><hr class="notop"></div>
			Мэдэгдэлийн анхааруулга. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Оюутаны эрхээр нэвтрэх
Дээд хэсэгт байрлах мэдэгдэл зураг дээр дарна
</pre>
			  <p><img src="<?php echo base_url('assets/documentation/images/teacher/18.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
			
		</section>
		

	</div>
</body>
</html>
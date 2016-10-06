<!doctype html>  
<!--[if IE 6 ]><html lang="en-us" class="ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="en-us" class="ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="en-us" class=  "ie8"> <![endif]-->
<!--[if (gt IE 7)|!(IE)]><!-->
<html ><!--<![endif]-->
<head>
  <meta charset="utf-8">
  
  <title>Оюутны бүртгэлийн систем</title>
  
  <meta name="description" content="iNisys оюутны бүртгэлийн систем!">
  <meta name="author" content="Tagtaa Development Team">
  <meta name="copyright" content="Tagtaa Development Team">
  
  <link rel="stylesheet" href="<?php echo base_url('assets/documentation/css/documenter_style.css'); ?>" media="all">
  <link rel="stylesheet" href="<?php echo base_url('assets/documentation/js/google-code-prettify/prettify.css'); ?>" media="screen">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
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
    #documenter_sidebar #documenter_logo{
      background-image:url(<?php echo base_url('assets/documentation/images/image_16.png'); ?>);
    }

    a{color:#111111;}
    .btn {
      border-radius:3px;
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
    #documenter_sidebar, #documenter_sidebar ul a{

      font-family: 'Roboto', sans-serif !important  ;
      background-color:#333333;color:#F1F1F1;
    }
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
      <li><a href="#admin" title="Admin">Администраторийн функц</a></li>
      <li><a href="#teacher" title="Teacher">Багшийн функц</a></li>
      <li><a href="#student" title="Student">Оюутаны функц</a></li>
      <li><a href="#accountant" title="Accountant"> Нягтлан бодогчийн функц</a></li>
      <li><a href="#oyutan" title="Oyutan">Оюутан тохируулах</a></li>
      <li><a href="#Dun_haragch" title="Dun haragch">Дүн харагч тохируулах</a></li>
      <li><a href="#Bagsh" title="Bagsh">Багш тохируулах</a></li>
      <li><a href="#Hereglegch" title="Hereglegch">Хэрэглэгч тохируулах</a></li>
      <li><a href="#Angi" title="Angi">Анги тохируулах</a></li>
      <li><a href="#Bvleg" title="Bvleg">Бүлэг тохируулах</a></li>
      <li><a href="#Hicheel" title="Hicheel">Хичээл тохируулах</a></li>
      <li><a href="#Dungiin_zereg" title="Dungiin zereg">Дүнгийн зэрэг тохируулах</a></li>
      <li><a href="#Shalgalt" title="Shalgalt">Шалгалт тохируулах</a></li>
      <li><a href="#Dun" title="Dun">Дүн тохируулах</a></li>
       <li><a href="#Hicheeliin_huwaari" title="Hicheeliin huwaari">Хичээлийн хуваарь тохируулах</a></li>
      <li><a href="#Irts" title="Irts">Ирц тохируулах</a></li>
      <li><a href="#Tolboriin_medeelel" title="Tolboriin medeelel">Төлбөрийн мэдээлэл тохируулах</a></li>
      <li><a href="#Bvleg_dewshilt" title="Bvleg dewshilt">Бүлэг дэвшилт тохируулах</a></li>
      <li><a href="#Mail_zurwas" title="Mail zurwas">Мэйл / Зурвас тохируулах</a></li>
      <li><a href="#Medegdel" title="Medegdel">Мэдэгдэл тохируулах</a></li>
      <li><a href="#Tailan" title="Tailan">Тайлан</a></li>
      <li><a href="#import" title="import">Импорт</a></li>
      <li><a href="#backup" title="backup">Backup</a></li>
      <li><a href="#nuuts_ug" title="nuuts ug">Нууц үг сэргээх</a></li>
      <li><a href="#System_admin" title="System admin">Системийн Администратор тохируулах</a></li>
      <li><a href="#Tohirgoo" title="Tohirgoo">Тохиргоо</a></li>
      <li><a href="#export" title="export">Нөөцөлж авах</a></li>
    </ul>

    <div id="documenter_copyright">
    
      <a href="http://folder.mn">v1.2</a> <br>
      Copyright Tagtaa solution 2016<br>
    </div>
  </div>
  <div id="documenter_content">
    <section id="documenter_cover">
      <h1>Inisys Оюутны бүртгэлийн систем v.1.2<br></h1>
    
      
      <hr>
      <ul>
      <li>Хөгжүүлэгч: Тагтаа солюшн ХХК  ( <a href="http://folder.mn">folder.mn</a> )</li>
      <li>Тусламж: <a href="http://support@folder.mn/">Онлайн тусламж ( support@folder.mn)</a></li>
      </ul>
      <p>Inisys Оюутны бүртгэлийн систем v.1.2 танилцуулгын дэлгэрэнгүй</p>
    </section>
  
    <section id="admin">
      <div class="page-header"><h3>Администраторийн функц</h3><hr class="notop"></div>
<pre class="prettyprint lang-plain linenums">
Админы удирлагын самбар дээр хэрэглэгч тоологч,тухайн өдөрийн ирц, төлбөрийн график,хэрэглэгчийн мэдээлэл, мэдээлэл гэсэн хэрэглүүрүүд байна.
Багшийн жагсаалт, нэмэх, засах, устгах, харах, PDF ба ID card хэвлэх, PDF-ийг мэйлээр илгээх
Ангийн жагсаалт, нэмэх, засах ба устгах
Бүлэгийн жагсаалт, нэмэх, засах ба устгах
Оюутаны жагсаалт, нэмэх, засах, устгах, харах, PDF ба ID card хэвлэх, PDF-ийг мэйлээр илгээх
Дүн харагчийн жагсаалт, нэмэх, засах, устгах, харах, PDF хэвлэх, PDF-ийг мэйлээр илгээх
Хэрэглэгч (Нягтлан бодогч)жагсаалт, нэмэх, засах, устгах, харах, PDF ба ID card хэвлэх, PDF-ийг мэйлээр илгээх
Хичээлийн жагсаалт, нэмэх, засах ба устгах
Дүнгийн зэрэгийн жагсаалт, нэмэх, засах ба устгах
Шалгалтийн жагсаалт, нэмэх, засах ба устгах
Шалгалтийн хуваарын жагсаалт, нэмэх, засах ба устгах
Дүнгийн жагсаалт, нэмэх, засах ба устгах
Хичээлийн хуваарын жагсаалт, нэмэх, засах ба устгах
Оюутны ирц нэмэх ба үзэх
Багшийн ирц нэмэх ба үзэх
Шалгалтын ирц нэмэх ба үзэх 
Төлбөрийн төрөлийн жагсаалт харах, нэмэх, засах, устгах
Нэхэмжлэлийн жагсаалт харах, нэмэх, засах, устгах
Оюутан бүлэг дэвшүүлэх
Майл/зурвас загварын жагсаалт харах, нэмэх, засах,утгах
Майл/зурвас илгээх
Мэдэгдэлийн жагсаалт харах, нэмэх, устгах, PDF хэвлэх ба PDF мэйл илгээх
Тайлангийн жагсаалт үзэх ба татаж авах.
Тохиргоо засах.
Бүртгэлийн мэдээлэл харах.
Нууц үг сэргээх.
Хэл солих.
Мэдэгдэлийн анхааруулга.
</pre>

  <p>
    <center>
      <h4> Администраторийн удирлагын самбар</h4> 
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/admin/view.png'); ?>" width="1000" style="padding: 0px 20px;"></p>

  <p>
    <center>
      <h4> Багш үүсгэх </h4> 
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/admin/dada.png'); ?>" width="1000" style="padding: 0px 20px;"></p>

  <p>
    <center>
      <h4> Багшийн жагсаалт</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/admin/bagsh.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
  
  <p>
    <center>
      <h4> Багшийн мэдээлэл засварлах</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/admin/rere.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
  
  <p>
    <center>
      <h4> Анги үүсгэх</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/admin/admin_create_class.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
  
  <p>
    <center>
      <h4> Ангийн жагсаалт</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/admin/admin_view_class_list.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
  
  <p>
    <center>
      <h4> Ангийн мэдээлэл засварлах</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/admin/admin_edit_class.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
  
  <p>
    <center>
      <h4> Оюутан үүсгэх</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/admin/admin_create_student.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
  
  <p>
    <center>
      <h4> Оюутаны жагсаалт</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/admin/admin_view_student_list.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
  
  <p>
    <center>
      <h4> Оюутаны мэдээлэл засварлах</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/admin/admin_edit_student.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
  
  <p>
    <center>
      <h4> Оюутаны бүртгэлийн мэдээлэл харах</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/admin/admin_view_student_profile.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
  
  <p>
    <center>
      <h4> Дүн харагч үүсгэх</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/admin/admin_create_parents.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
  
  <p>
    <center>
      <h4> Дүн харагчийн жагсаалт</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/admin/admin_view_parents_list.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
  
  <p>
    <center>
      <h4> Дүн харагчийн мэдээлэл засварлах</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/admin/admin_edit_parents.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
  
  <p>
    <center>
      <h4> Дүн харагчийн бүртгэлийн мэдээлэл харах</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/admin/admin_view_parents_profile.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
  
  <p>
    <center>
      <h4> Хичээл үүсгэх</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/admin/admin_create_subject.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
  
  <p>
    <center>
      <h4> Хичээлийн жагсаалт</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/admin/admin_view_subject_list.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
  
  <p>
    <center>
      <h4> Хичээлийн мэдээлэл засварлах </h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/admin/admin_edit_subject.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
  
  <p>
    <center>
      <h4> Мэдэгдэл үүсгэх </h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/admin/admin_create_notice.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
  
  <p>
    <center>
      <h4> Мэдэгдэлийн жагсаалт</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/admin/admin_view_notice_list.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
  
  <p>
    <center>
      <h4> Мэдэгдэлийн мэдээлэл засварлах</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/admin/admin_edit_notice.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
  
  <p>
    <center>
      <h4> Тохиргоо өөрчлөх</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/admin/admin_change_setting.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
  
  <p>
    <center>
      <h4> Нууц үг солих</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/admin/admin_change_password.png'); ?>" width="1000" style="padding: 0px 20px;"></p>


    </section>

    <section id="teacher">
      <div class="page-header"><h3>Багшийн функц</h3><hr class="notop"></div>
<pre class="prettyprint lang-plain linenums">
 Багшийн удирлагын самбар дээр багш ба оюутны тоо, хичээлийн тоо, бүртгэлийн мэдээлэл, мэдэгдэлийн самбар ба календарь байна
 Оюутаны жагсаалт харах
 Багшийн жагсаалт харах
 Хичээлийн жагсаалт харах
 Шалгалтын хуваарь харах
 Оюутаны дүн нэмэх, жагсаах, үзэх, хэвлэх,pdf татах, pdf мэйл илгээх
 Хичээлийн хуваарь харах
 Багш өөрийн ирцээ харах
 Оюутаны болон шалгалтын ирц бүртгэх харах.
 Оюутан бүлэг дэвшүүлэх
 Мэдэгдэлийн жагсаах ба тухай мэдэгдэлийн дэлгэрэнгүй харах
 Бүртгэлийн мэдээлэл харах.
 Нууц үг солих.
 Хэл солих.
 Мэдэгдэлийн анхааруулга.
</pre>
  <p>
    <center>
      <h4> Багшийн удирлагын самбар</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/teacher/teacher_view.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
  <br>
  
  <p>
    <center>
      <h4> Багш дүн нэмэх</h4>
    </center>
    <pre class="prettyprint lang-plain">
 Багшийн эрхээр нэвтрэх
 Дүн цэс сонгоно
 Дүн нэмэх товч дарна
 Харгалзах сонголтийг сонгож дүн товч дарна
 Оюутнуудын дүнг оруулж дүн нэмэх тоюч дарна

</pre>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/teacher/teacher_dun.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
   <p><img src="<?php echo base_url('assets/documentation/images/teacher/teacher_dun2.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
  
  <br>

  <p>
    <center>
      <h4> Багшийн бүртгэлийн мэдээлэл</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/teacher/teacher_profile2.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
    </section>

      <section id="student">
      <div class="page-header"><h3>Оюутаны функц</h3><hr class="notop"></div>
<pre class="prettyprint lang-plain linenums">
Оюутаны удирлагын самбар дээр багшийн тоо, хичээлийн тоо, нэхэмжлэлийн тоо, бүртгэлийн мэдээлэл,мэдэгдэлийн самбар ба календарь байна
Багш нарын мэдээлэл жагсаах харах
Тухайн оюутаны сонгосон хичээл харах
Шалгалтын хуваарь харах
Дүнгийн мэдээлэл харах
Хичээлийн хуваарь харах.
Ирцийн мэдээлэл харах
Нэхэмжлэлийн жагсаалт түүх харах
Мэдэгдэлийн жагсаах ба тухай мэдэгдэлийн дэлгэрэнгүй харах.
Бүртгэлийн мэдээлэл харах.
Нууц үг солих.
Хэл солих.
Мэдэгдэлийн анхааруулга.
</pre>
 <br>
  <p>
    <center>
      <h4>Оюутаны удирдагын самбар</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/student/student_view.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
 <br>

  <p>
    <center>
      <h4>Оюутаны ирц харах</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/student/student_view2.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
 <br>
</section>

    <section id="accountant">
      <div class="page-header"><h3>Нягтлан бодогчийн функц</h3><hr class="notop"></div>
<pre class="prettyprint lang-plain linenums">
Нягтлан бодогчийн удирлагын самбар дээр багшийн тоо, төлбөрийн төрөлийн тоо, нэхэмжлэлийн тоо,Зарлагын баримтын тоо, нягтлан бодогчийн бүртгэлийн мэдээлэл,
Мэдэгдэл болон календарь байна
Багшийн мэдээлэлийн жагсаалт харах
Нэхэмжлэлийн жагсаалт харах, нэмэх, засах, устгах, хэвлэх, pdf татах, pdf мэйл илгээх
Зардалын жагсаалт харах зардал нэмэх
Мэдэгдэлүүдийг харах.
Бүртгэлийн мэдээлэл үзэх.
Хэл солих.
Мэдэгдэлийн анхааруулга.
</pre>
  <br>
  <p>
    <center>
      <h4>Нягтлан бодогчийн удирлагын самбар</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/account/1.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
  <br>
  <p>
    <center>
      <h4>Нягтлан бодогч зардал нэмэх</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/account/2.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
  <br>
  <p>
    <center>
      <h4>Нягтлан бодогч нэхэмжлэх нэмэх</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/account/3.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
  <br>

  <p>
    <center>
      <h4>Нягтлан бодогч явуулсан нэхэмжлэхүүдийн жагсаалт харах</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/account/4.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
  <br>

  <p>
    <center>
      <h4>Нягтлан бодогч явуулсан нэхэмжлэхийн дэлгэрэнгүй харах</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/account/5.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
  <br>

  <p>
    <center>
      <h4>Нягтлан бодогч оюутаны төлбөр харах</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/account/6.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
  <br>

  <p>
    <center>
      <h4>Нягтлан бодогч төлбөрийн төрөлүүд харах</h4>
    </center>
  </p>
  <p><img src="<?php echo base_url('assets/documentation/images/account/7.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
  <br>
  

    </section>

  
    <section id="oyutan">
      <div class="page-header"><h3>Оюутан тохируулах</h3><hr class="notop"></div>
      <h4>1. Оюутан нэмэх</h4>
            Оюутан нэмэх. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Администратор эрхээр нэвтрэх
Оюутан цэсийг сонгох  
Оюутан нэмэх товч дарж бүх мэдээлэлийг оруулах
Дараа нь Оюутан нэмэх товч дарна
</pre>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/add_student.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
              <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/student_add_with_value.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
    </section>
    <section id="Dun_haragch">
      <div class="page-header"><h3>Дүн харагч тохируулах</h3><hr class="notop"></div>
      <h4>1. Дүн харагч нэмэх</h4>
            Дүн харагч нэмэх. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Администратор эрхээр нэвтрэх
Дүн харагч цэсийг сонгох  
Дүн харагч нэмэх товч дарж бүх мэдээлэлийг оруулах
Дараа нь Дүн харагч нэмэх товч дарна
</pre>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/add_parents.png'); ?>" width="1000" style="padding: 0px 20px;"></p>

              <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/parents_add_with_value.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
    </section>
    <section id="Bagsh">
      <div class="page-header"><h3>Багш тохируулах</h3><hr class="notop"></div>
        <h4>1. Багш нэмэх</h4>
            Багш нэмэх. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Администратор эрхээр нэвтрэх
Багш цэсийг сонгох  
Багш нэмэх товч дарж бүх мэдээлэлийг оруулах
Дараа нь Багш нэмэх товч дарна
</pre>
        <p>
          <img src="<?php echo base_url('assets/documentation/images/screenshots/new/add_teacher.png'); ?>" width="1000" style="padding: 0px 20px;"/>
        </p>
        <p>
          <img src="<?php echo base_url('assets/documentation/images/screenshots/new/add_teacher2.png'); ?>" width="1000" style="padding: 0px 20px;"/>
        </p>
    </section>
    <section id="Hereglegch">
      <div class="page-header"><h3>Хэрэглэгч тохируулах</h3><hr class="notop"></div>
      <h4>1. Хэрэглэгч нэмэх</h4>
            Хэрэглэгч нэмэх. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Администратор эрхээр нэвтрэх
Хэрэглэгч цэсийг сонгох  
Хэрэглэгч нэмэх товч дарж бүх мэдээлэлийг оруулах
Дараа нь Хэрэглэгч нэмэх товч дарна
</pre>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/hereglech.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
              <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/hereglech2.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
    </section>
    <section id="Angi">
      <div class="page-header"><h3>Анги тохируулах</h3><hr class="notop"></div>
      <h4>1. Анги нэмэх</h4>
            Анги нэмэх. Дараах алхмуудыг дагна уу : 
<pre class="prettyprint">
Администратор эрхээр нэвтрэх
Анги цэсийг сонгох  
Анги нэмэх товч дарж бүх мэдээлэлийг оруулах
Дараа нь Анги нэмэх товч дарна
</pre>
              <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/add_class.png'); ?>" width="1000" style="padding: 0px 20px;"></p>

              <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/class_add_with_value.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
    </section>
    <section id="Bvleg">
      <div class="page-header"><h3>Бүлэг тохируулах</h3><hr class="notop"></div>
      <h4>3. Бүлэг нэмэх</h4>
            Бүлэг нэмэх. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Администратор эрхээр нэвтрэх
Бүлэг цэсийг сонгох  
Тохиргоо өөрчлөх товч дарж бүх мэдээлэлийг оруулах
Дараа нь Бүлэг нэмэх товч дарна
</pre>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/add_section.png'); ?>" width="1000" style="padding: 0px 20px;"></p>

              <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/class_add_section_with_value.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
    </section>
    <section id="Hicheel">
      <div class="page-header"><h3>Хичээл тохируулах</h3><hr class="notop"></div>
      <h4>3. Хичээл нэмэх</h4>
            Хичээл нэмэх. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Администратор эрхээр нэвтрэх
Хичээл цэсийг сонгох  
Хичээл нэмэх товч дарж бүх мэдээлэлийг оруулах
Дараа нь Хичээл нэмэх товч дарна
</pre>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/hicheel.png'); ?>" width="1000" style="padding: 0px 20px;"></p>

              <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/hicheel2.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
    </section>
    <section id="Dungiin_zereg">
      <div class="page-header"><h3>Дүнгийн зэрэг тохируулах</h3><hr class="notop"></div>
      <h4>3. Дүнгийн зэрэг нэмэх</h4>
            Дүнгийн зэрэг нэмэх. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Администратор эрхээр нэвтрэх
Дүнгийн зэрэг цэсийг сонгох  
Дүнгийн зэрэг товч дарж бүх мэдээлэлийг оруулах
Дараа нь Дүнгийн зэрэг нэмэх товч дарна
</pre>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/dungin_zereg.png'); ?>" width="1000" style="padding: 0px 20px;"></p>

              <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/dungin_zereg2.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
    </section>
    <section id="Shalgalt">
      <div class="page-header"><h3>Шалгалт тохируулах</h3><hr class="notop"></div>
      <h4>3. Шалгалт нэмэх</h4>
            Шалгалт нэмэх. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Администратор эрхээр нэвтрэх
Шалгалт -> Шалгалт цэсийг сонгох  
Шалгалт нэмэх товч дарж бүх мэдээлэлийг оруулах
Дараа нь Шалгалт нэмэх товч дарна
</pre>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/shalgalt.png'); ?>" width="1000" style="padding: 0px 20px;"></p>

              <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/shalgalt2.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
              <h4>3. Шалгалтын хуваарь нэмэх</h4>
             Шалгалтын хуваарь нэмэх. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Администратор эрхээр нэвтрэх
Шалгалт -> Шалгалтын хуваарь цэсийг сонгох  
Шалгалтын хуваарь нэмэх товч дарж бүх мэдээлэлийг оруулах
Дараа нь Шалгалтын хуваарь нэмэх товч дарна
</pre>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/huwiap.png'); ?>" width="1000" style="padding: 0px 20px;"></p>

              <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/huwiap2.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
    </section>
    <section id="Dun">
      <div class="page-header"><h3>Дүн тохируулах</h3><hr class="notop"></div>
      <h4>3. Дүн нэмэх</h4>
            Дүн нэмэх. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Администратор эрхээр нэвтрэх
Дүн цэсийг сонгох  
Дүн нэмэх товч дарж бүх мэдээлэлийг сонгох
Дараа нь Дүн товч дарна
Харгалзах оюутнуудын дүн оруулна
Дүн нэмэх товч дарна
</pre>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/dun.png'); ?>" width="1000" style="padding: 0px 20px;"></p>

              <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/dun2.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
    </section>
    <section id="Hicheeliin_huwaari">
      <div class="page-header"><h3>Хичээлийн хуваарь тохируулах</h3><hr class="notop"></div>
        <h4>3. Хичээлийн хуваарь нэмэх</h4>
            Хичээлийн хуваарь нэмэх. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Администратор эрхээр нэвтрэх
Хичээлийн хуваарь цэсийг сонгох  
Хичээлийн хуваарь нэмэх товч дарж бүх мэдээлэлийг оруулах
Дараа нь Хичээлийн хуваарь нэмэх товч дарна
</pre>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/hicheel_huwiar.png'); ?>" width="1000" style="padding: 0px 20px;"></p>

              <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/hicheel_huwiar2.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
    </section>
    <section id="Irts">
      <div class="page-header"><h3>Ирц тохируулах</h3><hr class="notop"></div>
          <h4>1. Оюутны ирц нэмэх</h4>
            Оюутны ирц нэмэх. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Администратор эрхээр нэвтрэх
Ирц -> Оюутны ирц цэсийг сонгох  
Оюутны ирц нэмэх товч дарж бүх мэдээлэлийг сонгох
Дараа нь Ирц товч дарна
Дараа нь харгалзах оюутаныг нэмэхийн тулд чагтлана 
</pre>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/oyutan_ipts.png'); ?>" width="1000" style="padding: 0px 20px;"></p>

              <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/oyutan_ipts2.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
                <h4>2. Багшийн ирц нэмэх</h4>
            Багшийн ирц нэмэх. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Администратор эрхээр нэвтрэх
Ирц -> Багшийн ирц цэсийг сонгох  
Багшийн ирц нэмэх товч дарж бүх мэдээлэлийг сонгох
Дараа нь Ирц товч дарна
Дараа нь харгалзах багшийг нэмэхийн тулд чагтлана 
</pre>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/bagsh_ipts.png'); ?>" width="1000" style="padding: 0px 20px;"></p>

              <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/bagsh_ipts2.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
                <h4>3. Шалгалтын ирц нэмэх</h4>
            Шалгалтын ирц нэмэх. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Администратор эрхээр нэвтрэх
Ирц -> Шалгалтын ирц цэсийг сонгох  
Шалгалтын ирц нэмэх товч дарж бүх мэдээлэлийг сонгох
Дараа нь Ирц товч дарна
Дараа нь харгалзах шалгалтыг нэмэхийн тулд чагтлана 
</pre>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/shalgalt_ipts.png'); ?>" width="1000" style="padding: 0px 20px;"></p>

              <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/shalgalt_ipts2.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
    </section>
    <section id="Tolboriin_medeelel">
      <div class="page-header"><h3>Төлбөрийн мэдээлэл тохируулах</h3><hr class="notop"></div>
      <h4>1. Төлбөрийн төрөл нэмэх</h4>
            Төлбөрийн төрөл мэдээлэл нэмэх. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Администратор эрхээр нэвтрэх
Төлбөрийн мэдээлэл -> Төлбөрийн төрөл цэсийг сонгох  
Төлбөрийн төрөл нэмэх товч дарж бүх мэдээлэлийг оруулах
Дараа нь Төлбөрийн төрөл нэмэх товч дарна
</pre>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/tolbop_medelel.png'); ?>" width="1000" style="padding: 0px 20px;"></p>

              <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/tolbop_medelel2.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
              <h4>2. Нэхэмжлэх нэмэх</h4>
            Нэхэмжлэх нэмэх. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Администратор эрхээр нэвтрэх
Төлбөрийн мэдээлэл -> Нэхэмжлэх цэсийг сонгох  
Нэхэмжлэх нэмэх товч дарж бүх мэдээлэлийг оруулах
Дараа нь Нэхэмжлэх нэмэх товч дарна
</pre>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/nehemjlel.png'); ?>" width="1000" style="padding: 0px 20px;"></p>

              <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/nehemjlel2.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
              <h4>3. Төлбөр харах</h4>
            Төлбөр харах. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Администратор эрхээр нэвтрэх
Төлбөрийн мэдээлэл -> Төлбөр цэсийг сонгох  
Төлбөрийн мэдээлэл харах анги сонгоно
</pre>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/tolbop_medelel_tolbop.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
<h4>4. Үнэ</h4>
            Зардал нэмэх. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Администратор эрхээр нэвтрэх
Төлбөрийн мэдээлэл -> үнэ цэсийг сонгох  
Зардал нэмэх товч дарж бүх мэдээлэлийг оруулах
Дараа нь Зардал нэмэх товч дарна
</pre>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/une.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/une2.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
              
    </section>
    <section id="Bvleg_dewshilt">
      <div class="page-header"><h3>Бүлэг дэвшилт тохируулах</h3><hr class="notop"></div>
      <h4>1. Бүлэг дэвшилт</h4>
            Бүлэг дэвшилт. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Администратор эрхээр нэвтрэх
Бүлэг дэвшилт цэсийг сонгох  
Бүлэг дэвшүүлэх анги сонгоно
Бүлэг дэвшихэд тухайн хичээлд хамгийн бага байх оноог оруулна
Бүлэг дэвшилтийн дүнгийн тохируулга товч дарна
Бүлэг дэвшүүлэх болзол хангагдсан бол бүлэг дэвшүүлэх сонголтыг сонгоно
Дараа нь Дараагын бүлэгрүү дэвшүүлэх товч дарна 
</pre>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/buleg.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/buleg2.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
    </section>
    <section id="Mail_zurwas">
      <div class="page-header"><h3>Мэйл/Зурвас тохируулах</h3><hr class="notop"></div>
      <h4>1. Мэйл/Зурвас загвар нэмэх</h4>
            Мэйл/Зурвас загвар нэмэх. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Администратор эрхээр нэвтрэх
Мэйл/Зурвас -> Мэйл/Зурвас загвар цэсийг сонгох  
Загвар нэмэх товч дарж бүх мэдээлэлийг оруулах
Дараа нь Загвар нэмэх товч дарна
</pre>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/mail.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/mail2.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
        <h4>2. Мэйл/Зурвас илгээх</h4>
            Мэйл/Зурвас илгээх. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Администратор эрхээр нэвтрэх
Мэйл/Зурвас -> Мэйл/Зурвас цэсийг сонгох  
Мэйл/Зурвас нэмэх товч дарж бүх мэдээлэлийг оруулах
Дараа нь илгээх товч дарна
</pre>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/zurwas.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/zurwas2.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
    </section>
    <section id="Medegdel">
      <div class="page-header"><h3>Мэдэгдэл тохируулах</h3><hr class="notop"></div>
      <h4>2. Мэдэгдэл нэмэх</h4>
            Мэдэгдэл нэмэх. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Администратор эрхээр нэвтрэх
Мэдэгдэл цэсийг сонгох  
Мэдэгдэл нэмэх товч дарж бүх мэдээлэлийг оруулах
Дараа нь Мэдэгдэл нэмэх товч дарна
</pre>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/medegdel.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/medegdel2.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
    </section>
    <section id="Tailan">
      <div class="page-header"><h3>Тайлан</h3><hr class="notop"></div>
      <h4>1. Тайлан үүсгэх</h4>
            Тайлан үүсгэх. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Администратор эрхээр нэвтрэх
Тайлан цэсийг сонгох  
Дараа нь тухайн сонгосон тайланд харгалзах үүсгэх товч дарна
</pre>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/tailan.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
       
    </section>
    <section id="import">
      <div class="page-header"><h3>Импорт</h3><hr class="notop"></div>
      <h4>1. Импортолж оруулах</h4>
            Импортолж оруулах. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Администратор эрхээр нэвтрэх
Импорт цэсийг сонгох  
Тухайн импортлох файлаа сонгон импорт товч дарна
</pre>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/import.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
    </section>
    <section id="backup">
      <div class="page-header"><h3>Backup</h3><hr class="notop"></div>
      <h4>2. Backup Нөөшлөж авах</h4>
            Backup Нөөшлөж авах. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Администратор эрхээр нэвтрэх
Backup цэсийг сонгох  
Download sql товч дарна
</pre>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/backup.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
    </section>
    <section id="nuuts_ug">
      <div class="page-header"><h3>Нууц үг сэргээх</h3><hr class="notop"></div>
      <h4>1. Нууц үг сэргээх</h4>
            Нууц үг сэргээх. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Администратор эрхээр нэвтрэх
Нууц үг сэргээх цэсийг сонгох  
Тухайн нууц үг сэргээх хэрэглэгчийг сонгож шинэ нууц үг оруулна
</pre>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/nutsug.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
    </section>
    <section id="System_admin">
      <div class="page-header"><h3>Систем админ</h3><hr class="notop"></div>
        <h4>1. Системийн админ нэмэх</h4>
            Системийн админ нэмэх. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Администратор эрхээр нэвтрэх
Системийн админ цэсийг сонгох  
Системийн админ нэмэх товч дарж бүх мэдээлэлийг оруулах
Дараа нь Системийн админ нэмэх товч дарна
</pre>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/sistem_admin.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
         <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/sistem_admin2.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
    </section>

    <section id="Tohirgoo">
      <div class="page-header"><h3>Тохиргоо</h3><hr class="notop"></div>
      <h4>2. Тохиргоо өөрчлөх </h4>
            Тохиргоо өөрчлөх. Дараах алхмуудыг дагна уу :
<pre class="prettyprint">
Администратор эрхээр нэвтрэх
Тохиргоо цэсийг сонгох  
Өөрчлөх тохиргоог тааруулана
Дараа нь тохиргоо шинэчлэх товч дарна
</pre>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/tohipgoo.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
    </section>
<section id="export">
      <div class="page-header"><h3>Нөөцөлж авах</h3><hr class="notop"></div>
      <h4>1. Нөөцөлж авах хэрэглүүрүүд</h4>
<pre class="prettyprint">
Copy - Тухайн талбарт байгаа бүх утгыг хуулж авна
Excel - Тухайн талбарт байгаа бүх утгыг excel дээр хадгалж авна
CSV - Тухайн талбарт байгаа бүх утгыг CSV өргөтгөлөөр хадгалж авна
PDF - Тухайн талбарт байгаа бүх утгыг PDF өргөтгөлөөр хадгалж авна
</pre>
        <p><img src="<?php echo base_url('assets/documentation/images/screenshots/new/export.png'); ?>" width="1000" style="padding: 0px 20px;"></p>
    </section>


  </div>
</body>
</html>
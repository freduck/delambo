<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DE-LAMBO COLLEGE</title>
    <link rel="stylesheet" href="index.css">
    <style>
      .menu li a{
        color:white;
      }
      body{
        overflow-x:hidden;
      }
      .carousel {
  position: relative;
  width: 98vw;
  height: 600px;
  margin: 40px auto;
}


.carousel-item.active {
  opacity: 1;
}

.carousel-inner {
  position: relative;
  width: 100%;
  height: 100%;
  overflow: hidden;
}

.carousel-item {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display:none;

}

.carousel-item.active {
  display:block;
}

.carousel-prev, .carousel-next {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  font-size: 24px;
  cursor: pointer;
}

.carousel-prev {
  left: 20px;
}

.carousel-next {
  color:white;
  right: 20px;
  border:1px solid whitesmoke;
  background-color:cadetblue;
}
img{
    height: 600px;
    width: 100%;
}
    </style>
</head>
<body class=" body light dark">
    <div class="container">
        <div class="header" style="display: flex; flex-direction: row; width: 100%;">
            <div class="left" style="margin: 0 0 0 10px;">
                <h2>Welcome to</h2>
            </div>
            <div class="right" style="margin: 0 0 0 600px;">
                <h4 class="head" style="">
<?php 
require "admin/config.php";
 $settings=$conn->query("SELECT * FROM settings");
    if($settings->num_rows>0){
        $system=$settings->fetch_assoc();
        echo $system['school_name'];
    }else{
        echo "<h1>School Application</h1>";
    }


?>
                </h4>
      
</div>
</div>
<div class="nav-bar">
    <div class="drop-down">
    <span id="open-menu" style="color:crimson;">&#9776;Exams</span>
    <ul class="menu hidden">
        <!-- <li><a href="maths.php">Maths</a></li> -->
        <li><a href="english">English Language</a></li>
        <li><a href="intermediate">Intermediate Sc</a></li>
        <li><a href="history">Hostory</a></li>
           <li><a href="c.c.a">C.C.A</a></li>
        <li><a href="c.r.k">C.R.K</a></li>
        <li><a href="math">Mathematics</a></li>
        <li><a href="business">Business Studies</a></li>
        <li><a href="digital">Digital Technology</a></li>
        <li><a href="literature">Literature </a></li>
        <li><a href="phe">P.H.E</a></li>
        <li><a href="s.c.s">S.O.C</a></li>
        <li><a href="home-economics">Home Economics</a></li>
        <li><a href="yoruba.php">Yoruba Language</a></li>
    </ul>
</div>
<div style="color:crimson;">

  <a href="students/index.php" style="color:crimson;">Student Pannel</a>
  <a href="/teachers" style="color:crimson;">Teachers's Panell</a>
  <a href="/parents" style="color:crimson;">Parent's Panel</a>
  <a href="/admin" style="color:crimson;">Administrator's Panel</a>
  <a href="#" class="switch" style="color:crimson;">Switch To Dark Mode</a>
  <a href="#" class='about' style="color:crimson;">About Our School</a>
</div>

</div>
<div class="body">
    <div class="center">

        <p class="sub-title">
            <h1 id="s-title">

                the best school in abeokuta
            </h1>
        </p>
        <p>
            <!-- <div class="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="carousel-image/img1.jpg" alt="Image 1">
    </div>
    <div class="carousel-item">
      <img src="i2.jpg" alt="Image 2">
    </div>
    <div class="carousel-item">
      <img src="carousel-image/img3.jpg" alt="Image 3">
    </div>
    <div class="carousel-item">
      <img src="i4.jpg" alt="Image 3">
    </div>
    <div class="carousel-item">
      <img src="i5.jpg" alt="Image 3">
    </div>
</div>
  <button class="carousel-prev">Prev</button>
  <button class="carousel-next">Next</button>
</div> -->
  </div>
</p>
    </div>
    <div class="about-the-school">
        <h2 class="about-header">About My School</h2>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui minus aliquid atque odit. Quidem dolorem incidunt tempore nemo vitae. Veritatis illum et aut vitae qui ducimus esse ipsam facilis repudiandae.
        Explicabo, tempore odit obcaecati quasi quidem ullam adipisci esse veritatis similique, nisi doloribus nulla laborum soluta eius architecto quo aliquam, nihil quod! Magnam vero nam sint corporis pariatur? Possimus, quaerat.
        Totam, ab enim perspiciatis sequi nesciunt expedita tempora quos omnis architecto exercitationem voluptates quam excepturi, sit illum modi sapiente et mollitia. Eveniet nisi sequi eos praesentium sed velit, ad animi!
        Ipsa ex beatae quaerat maxime. Blanditiis nihil dolores ipsum, reiciendis perspiciatis iusto animi reprehenderit dolore, sed quisquam ipsam voluptas quam eos maiores error minus suscipit ipsa tenetur, commodi aspernatur enim.
        Mollitia neque incidunt fuga optio reprehenderit necessitatibus delectus autem nobis officia, quo et nihil modi eligendi dolore maiores alias sint. Obcaecati sapiente dolorum minima iste nemo est velit suscipit quis!
    </div>

        </div>
        <div class="footer">
            <footer id="footer">
                <div class="left">
                    <!-- Lorem ipsum dolor sit amet consectetur, adipisicing elit. Minus, repudiandae! Aspernatur minus similique rerum adipisci odio. Minima quia iste necessitatibus nobis? Sit nam aliquam sequi architecto, quia tempore eveniet quis. -->
                
                    <i class="fa fa-whats-app"></i>
                
                </div>
                <div class="footer-center">
                    <!-- Lorem ipsum, dolor sit amet consectetur adipisicing elit. Saepe nemo ullam voluptatibus, maiores ab hic distinctio esse minus, omnis nostrum inventore! Illum veniam doloribus atque expedita consequuntur earum rerum quam. -->
                <i class="fa fa-facebook"></i>
                </div>
                <div class="right">
                    <!-- Lorem ipsum, dolor sit amet consectetur adipisicing elit. Earum, eaque. Dolore ad sint consectetur mollitia delectus deleniti magni laboriosam dolorum iste modi cum, molestias sapiente animi voluptatem aliquam rem dolorem! -->
            <i class="fa fa-instagram"></i>
                </div>
            </footer>
        </div>
    </div>
    <script src="index.js"></script>
    <script>
        document.querySelector('.about').addEventListener('click',function(){
document.querySelector('.about-the-school').scrollIntoView({
    behavior:"smooth",
    
});
        });
        const switchMode= document.querySelector('.switch');
        switchMode.addEventListener('click',function(){
    if(document.body.style.backgroundColor=='black'){
        document.body.style.backgroundColor='';
        // document.body.style.color==''
    }else{
        // document.body.style.backgroundColor='';
        document.body.style.backgroundColor='black';
        document.body.style.color=='black';
        document.querySelector('.nav-bar').classList.add('dark');
    }
        });
const carouselInner = document.querySelector('.carousel-inner');
const carouselItems = document.querySelectorAll('.carousel-item');
const prevButton = document.querySelector('.carousel-prev');
const nextButton = document.querySelector('.carousel-next');
let currentIndex = 0;

function showNextItem() {
  carouselItems[currentIndex].classList.remove('active');
  currentIndex = (currentIndex + 1) % carouselItems.length;
  carouselItems[currentIndex].classList.add('active');
}

function showPrevItem() {
  carouselItems[currentIndex].classList.remove('active');
  currentIndex = (currentIndex - 1 + carouselItems.length) % carouselItems.length;
  carouselItems[currentIndex].classList.add('active');
}

nextButton.addEventListener('click', showNextItem);
prevButton.addEventListener('click', showPrevItem);

// Optional: Autoplay
setInterval(showNextItem, 3000);
  function closeDropdown(event) {
  if (!dropdown.contains(event.target) && !dropdownToggle.contains(event.target)) {
    dropdown.classList.remove('show');
  }
}
    </script>
</body>
</html>
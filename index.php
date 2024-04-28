<?php 
ob_start();

include ("components/header.php");

require("admin-panel/includes/config.php");

// Fetch blog posts from the database where is_published is published
$query = 
    $conn->
        query("SELECT blog_posts.*, blog_categories.name AS category_name
                       FROM blog_posts
                       JOIN blog_categories ON blog_posts.category_id = blog_categories.id
                       WHERE blog_posts.is_published = '1'"); 
        $posts = $query->fetchAll(PDO::FETCH_ASSOC);
?>

            <div class="popup-container" id="popup-container">
                <div id="popup" class="popup">
                    <div class="popup-content">
                        <h2 class="text-center">ADMISSIONS ARE OPEN</h2>
                    <p><em>Dear Prospective Applicant,</em><br>
                    Thank you for considering MICS GH.<br>
                    We are delighted to announce the admissions for ________ academic year.</p>
                        <a href="#" class="apply-link" id="applyNow">Please click here</a>
                    </div>
                </div>
            </div>
        <!-- <section class="quote-section">
            <div class="container">
                <div class="row">
                <div class="col-xs-12 quote-content">
                    <p>Education is not the filling of a pail, but the lighting of a fire</p>
                    <span>- William Butler Yeats</span>
                </div>
                </div>
            </div>
        </section> -->
		<!-- Background Area Start -->
        <section id="slider-container" class="slider-area"> 
            <div class="slider-owl owl-theme owl-carousel"> 
                <!-- Start Slingle Slide -->
                <div class="single-slide item" style="background-image: url(img/slider/slider1.png)">
                    <!-- Start Slider Content -->
                    <div class="slider-content-area">  
                        <div class="container">
                            <div class="row">
                                <div class="col-md-7 col-md-offset-left-5"> 
                                    <div class="slide-content-wrapper">
                                        <div class="slide-content">
                                            <h3>Embracing Cultural Diversity</h3>
                                            <p>Experience a rich tapestry of global traditions blended with African heritage, featuring our diverse student community.</p>
                                            <a class="default-btn" href="employment.php"style="text-decoration: none;">Explore Community</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <!-- Start Slingle Slide -->
                <div class="single-slide item" style="background-image: url(img/slider/slider2.png)">
                    <!-- Start Slider Content -->
                    <div class="slider-content-area">  
                        <div class="container">
                            <div class="row">
                                <div class="col-md-7 col-md-offset-left-5"> 
                                    <div class="slide-content-wrapper">
                                        <div class="slide-content">
                                            <h3>Empowering Minds, Building Futures</h3>
                                            <p>Unlock your potential with IBDP, Cambridge courses, and Ghana's educational system, alongside our diverse student body.</p>
                                            <a class="default-btn" href="programmes.php"style="text-decoration: none;">Enroll Today</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Start Slider Content -->
                </div>
                <!-- Start Slingle Slide -->
                <div class="single-slide item" style="background-image: url(img/slider/slider3.png)">
                    <!-- Start Slider Content -->
                    <div class="slider-content-area">  
                        <div class="container">
                            <div class="row">
                                <div class="col-md-7 col-md-offset-left-5"> 
                                    <div class="slide-content-wrapper">
                                        <div class="slide-content">
                                            <h3>Inspiring Global Leaders</h3>
                                            <p>Nurture leadership skills through global engagement and community impact, guided by our diverse student leaders.</p>
                                            <a class="default-btn" href="national.php" style="text-decoration: none;">Apply Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Start Slider Content -->
                </div>
                <!-- End Slingle Slide -->						
            </div>
            <a href="#intoview" id="scrollbtn">
            <img class="arrw-down" src="img/arrw_dwn.svg" alt="mics"/>
            </a>
        </section>
        <div></div>
        <section id="welcome-area" class="welcome-section-area pt-80 pb-120">
            <div class="container">
                <div class="row">
                    <!-- <div class="programs-logo" id="programs-logo">
                    <img src="img/programs.svg" alt="MICS programs offered"/>
                    </div> -->
                    <div class="welcome-content" >
                        <div class="box">
                            <!-- <img src="img/mark.svg" alt="MICS_icon"> -->
                            <!-- <h1><span>MICS</span>5</h1> -->
                            <div class="text-anime">
                                <h1 id="text1"></h1>
                                <h1 id="text2"></h1>
                            </div>
                            <svg id="filters">
                                <defs>
                                    <filter id="threshold">
                                        <!-- Basically just a threshold effect - pixels with a high enough opacity are set to full opacity, and all other pixels are set to completely transparent. -->
                                        <feColorMatrix in="SourceGraphic"
                                                type="matrix"
                                                values="1 0 0 0 0
                                                                0 1 0 0 0
                                                                0 0 1 0 0
                                                                0 0 0 255 -140" />
                                    </filter>
                                </defs>
                            </svg>
                        </div>
                        <div class="wlc-qte">
                            <h3>Why MICS<h3>
                            <p>Empowering futures globally with excellence in education. We have programs and initiatives that continue to give value to our students and enduring outcomes for all who come under our tutelage.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
       
        <!-- Choose Area End -->
        <!-- Courses Area Start -->
        <section class="courses-area text-center" id="intoview">
            <div class="container">
                <div class="row">
                    <div class="course-slides">
                        <div class="carousel-inner">
                           
                            <div class="course-owl owl-theme owl-carousel">
                                <div class="single-course-img"> 
                                            <div class="col-md-12 col-sm-12"> 
                                                <div class="course-slideimg">
                                                    <img src="img/course/slide/img4.png" alt="">
                                                </div>
                                            </div>
                                </div>
                                <div class="single-course-img"> 
                                            <div class="col-md-12 col-sm-12"> 
                                                <div class="course-slideimg">
                                                    <img src="img/course/slide/img3.png" alt="">
                                                </div>
                                            </div>
                                </div>
                                <div class="single-course-img"> 
                                            <div class="col-md-12 col-sm-12"> 
                                                <div class="course-slideimg">
                                                    <img src="img/course/slide/img1.png" alt="">
                                                </div>
                                            </div>
                                </div>
                                <div class="single-course-img"> 
                                            <div class="col-md-12 col-sm-12"> 
                                                <div class="course-slideimg">
                                                    <img src="img/course/slide/img2.png" alt="">
                                                </div>
                                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="courses-container">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="single-course">
                            <div class="course-section-title">
                                <h3>Diverse Programs</h3>
                                <p>Explore Morgan International Community School's diverse academic programs.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="course-cards">
                    <div class="row no-gutters">
                        <div class="col-md-3 col-sm-6 col-xs-12 ibdp">
                            <div class="single-course">
                                <div class="course-img">
                                    <a href="course-details.html">
                                        <!-- <img loading="lazy" src="img/course/img1.jpeg" alt="course"> -->
                                        <div class="course-content-desc">
                                            <h2>IBDP</h2>
                                            <p>The International Baccalaureate (IB) Diploma Programme is a challenging <em>two-year curriculum</em>, primarily aimed at students aged 16 to 19.</p>
                                        </div>
                                        <div class="course-hover">
                                            <div class="cover">
                                            <h3>IBDP</h3>
                                            <img src="img/link.svg" alt="mics_course_link">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 ckpt">
                            <div class="single-course">
                                <div class="course-img">
                                    <a href="course-details.html">
                                        <!-- <img loading="lazy" src="img/course/img2.jpeg" alt="course"> -->
                                        <div class="course-content-desc">
                                            <h2>IGCSE</h2>
                                            <p>MICS offers the Cambridge <em>Lower Secondary</em> which is typically for learners aged 11 to 14 years and the Cambridge <em>Upper Secondary</em> for learners aged 14 to 16 years.</p>
                                        </div>
                                        <div class="course-hover">
                                            <div class="cover">
                                            <h3>IGCSE</h3>
                                            <img src="img/link.svg" alt="mics_course_link">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 igcse">
                            <div class="single-course">
                                <div class="course-img">
                                    <a href="course-details.html" style="text-decoration: none;">
                                    <!-- <img loading="lazy" src="img/course/img3.jpeg" alt="course"> -->
                                    <div class="course-content-desc">
                                            <h2>CHECKPOINT</h2>
                                            <p>With students as young as four and nine years old, one gets the feel of a <em>family learning center</em> here on campus. Our curriculum is practical which gives learners a hands-on feel of the real world.</p>
                                        </div>
                                        <div class="course-hover">
                                            <div class="cover">
                                            <h3>CHECKPOINT</h3>
                                            <img src="img/link.svg" alt="mics_course_link">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-6 col-xs-12 nat">
                            <div class="single-course">
                                <div class="course-img">
                                    <a href="course-details.html">
                                        <!-- <img loading="lazy" src="img/course/img4.jpeg" alt="course"> -->
                                        <div class="course-content-desc">
                                            <h2>NATIONAL</h2>
                                            <p>MICS offers an enriched National Curriculum;Primary, Basic Education Certificate Examination <em>(B.E.C.E)</em>, and West Africa Secondary School Certificates Examination <em>(WASSCE)</em></p>
                                        </div>
                                        <div class="course-hover">
                                            <div class="cover">
                                            <h3>NATIONAL</h3>
                                            <img src="img/link.svg" alt="mics_course_link">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Courses Area End -->
        
          <!-- Event Area Start -->
          <section class="event-area pt-100 pb-150">
            <div class="container">
                <div class="row mb-40">
                    <div class="col-xs-12">
                        <div class="section-title text-center">
                            <?php
                            // Fetch event year from the database
                            $query = "SELECT * FROM events_year";
                            $result = $conn->query($query);
                            $eventYear = $result->fetch(PDO::FETCH_ASSOC);
                            $eventYearLabel = isset($eventYear['event_year']) ? $eventYear['event_year'] : '';

                            ?>
                            <h3>UPCOMING EVENTS - <?php echo $eventYearLabel; ?></h3>
                        </div>
                    </div>
                </div>
                <div class="row mt-80">
                    <?php
                    // Fetch events from the database
                    $query = "SELECT * FROM events ORDER BY event_date asc";
                    $result = $conn->query($query);

                    // Check if there are any events
                    if ($result->rowCount() > 0) {
                        // Loop through each event
                        foreach ($result as $event) {
                            // Define color class based on event color
                            $color_class = $event['event_color'] == 'green' ? 'g' : ($event['event_color'] == 'light' ? 'l' : 'o');
                    ?>
                            <div class="col-md-6 col-sm-12 col-xs-12 dates-right">
                                <!-- Date item  -->
                                <div class="single-event mb-30 ">
                                    <div class="event-date <?php echo $event['event_color']; ?>">
                                        <h3><?php echo date('d M', strtotime($event['event_date'])); ?></h3>
                                    </div>
                                    <div class="event-content">
                                        <div class="date-box">
                                            <div class="event-content-left"><span><?php echo date('D', strtotime($event['event_date'])); ?></span></div>
                                            <div class="color-shape <?php echo $color_class; ?>"></div>
                                        </div>
                                        <div class="event-content-right"><span><?php echo $event['event_title']; ?></span></div>
                                    </div>
                                </div>
                                <!-- End of Date item  -->
                            </div>
                    <?php
                        }
                    } else {
                       
                        echo "<h4  class='section-title text-center'>No upcoming events found.</h4>";
                    }
                    ?>
                </div>
            </div>
        </section>


        <!-- Notice Start -->
        <section class="notice-area two three">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="notice-left-wrapper">
                                <h3>A Welcome Message from the Head of School</h3>
                                <div class="notice-video">
                                    <!-- <div class="video-icon video-hover"> -->
                                        <video
                                            id="my-video"
                                            class="video-js"
                                            controls
                                            preload="auto"
                                            width="100%"
                                            height="382"
                                            poster="img/notice/video.g"
                                            data-setup="{}"
                                        >
                                            <!-- <source src="video/MicsSportsPreview.mp4" type="video/mp4" /> -->
                                            <source src="https://www.youtube.com/watch?v=rdlNmqMmPJw" type="video/mp4" />
                                            
                                        </video>
                                </div>
                        </div> 
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="notice-right-wrapper mt-90"> 
                            <div class="notice-left">
                                <div class="single-notice-left">
                                    <h4>The MICS Family</h4>
                                    <p>In this heartfelt message, our Head of School for National warmly welcomes you to Morgan International School. As she shares our commitment to excellence, character, and community, we invite you to join us on a journey of growth and success. Together, let's create a vibrant learning community where every student thrives.</p>
                                </div>
                                <a class="default-btn" href="https://www.youtube.com/watch?v=rdlNmqMmPJw" style="margin: 30px 0;">Watch full video</a>
                            </div>
                            
                        <div>
                            
                    </div>
                </div>
            </div>
        </section>
        <!-- Notice End -->
        
        <!-- Blog Start -->
        <section id="carouselExample nblog" class="carousel slide pt-110 pb-110">
                <div class="container">
                    <div class="row mb-40">
                        <div class="col-xs-12">
                            <div class="section-title mb-20">
                                <h3>LATEST NEWS</h3>
                                <p>Stay updated with the latest happenings and announcements.</p>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="nblog-area">
                            <div class="container">
                                <div class="row">
                                    <div class="nblog-owl owl-theme owl-carousel">
                                    <?php foreach ($posts as $post): ?>
                                        <div class="col-md-12 col-xs-12">
                                            <div class="single-nblog">
                                                <div class="nblog-info">
                                                    <div class="nblog-img">
                                                    <a href="blog.php?id=<?php echo $post['id']; ?>&topic=<?php echo urlencode($post['title']); ?>">
                                                        <img src="admin-panel/blog/asset/uploads/<?php echo $post['img'];?>" alt="MICS_BlogImg">
                                                        </a>
                                                    </div>
                                                    <div class="nblog-content">
                                                        <div class="date"><em class="dot">&#x2022; </em> <span><?php echo date('M Y', strtotime($post['created_date'])); ?></span></div>
                                                        <a href="blog.php?id=<?php echo $post['id']; ?>&topic=<?php echo urlencode($post['title']); ?>">
                                                        <div class="tp">
                                                            <?php 
                                                            $title = substr($post['title'], 0, 200);
                                                            $formattedTitle = ucfirst(strtolower($title));
                                                            ?>
                                                            <h2><?php echo $formattedTitle;?>...</h2>
                                                        </div>
                                                        </a>
                                                        <img src="img/blog/icons/Line.svg" alt="">
                                                        <div class="dwn">
                                                        <h4><?php echo $post['category_name'];?></h4>
                                                        <a href="blog.php?id=<?php echo $post['id']; ?>&topic=<?php echo urlencode($post['title']); ?>"><i class="fa-solid fa-arrow-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
                   
        </section>

        <!-- Testimial Start -->
        <section id="carouselExample testimonial" class="carousel slide">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="testimonial-area pt-110 pb-105 text-center">
                        <div class="container">
                            <div class="row">
                                <div class="testimonial-owl owl-theme owl-carousel">

                                    <div class="single-testimonial">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="testimonial-info">
                                                <div class="testimonial-img">
                                                    <img loading="lazy" src="img/Testimonials/cris.jpg" alt="MICS_testimonials">
                                                </div>
                                                <div class="testimonial-content">
                                                    <p>My seven-year journey at Morgan has wrought a remarkable metamorphosis in my character, attitude, and lifestyle. Beyond a mere academic pursuit, my time here has embedded me with invaluable core values that will shape my future. I have emerged a person of greater depth, maturity, and wisdom, thanks to the emotional and psychological journey I undertook. Morgan has instilled in me the importance of integrity, resilience, and a strong work ethic, which will serve me well in all future endeavors.</p>
                                                    <h4>Kristal Boakye</h4>
                                                    <h5>IBDP</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="single-testimonial">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="testimonial-info">
                                                <div class="testimonial-img">
                                                    <img src="img/testimonial/mar.jpg" alt="testimonial" style="height:77px;">
                                                </div>
                                                <div class="testimonial-content">
                                                    <p>My four years in Morgan has taught me that education is more than just pen to paper, or huge text books and mountains of homework. It's about the transformation in character and realization of self-worth. A journey that helped me discover who I am and what I am capable of. It's a journey that never ends and one that has lead me to accomplish great feats and continue on a path to success.</p>
                                                    <h4>Mario Amedoadjie</h4>
                                                    <h5>IBDP</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
        </section>
        
</body>
     
<?php
include ("components/footer.php");
?>
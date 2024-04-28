(function ($) {
"use strict";  
    
/*------------------------------------
	Sticky Menu 
--------------------------------------*/
 var windows = $(window);
    var stick = $(".header-sticky");
	windows.on('scroll',function() {    
		var scroll = windows.scrollTop();
		if (scroll < 5) {
			stick.removeClass("sticky");
		}else{
			stick.addClass("sticky");
		}
	});  
/*------------------------------------
	jQuery MeanMenu 
--------------------------------------*/
	$('.main-menu nav').meanmenu({
		meanScreenWidth: "767",
		meanMenuContainer: '.mobile-menu'
	});
    
    
    /* last  2 li child add class */
    $('ul.menu>li').slice(-2).addClass('last-elements');


/*------------------------------------
	Owl Carousel
--------------------------------------*/
    $('.slider-owl').owlCarousel({
        loop:true,
        nav:true,
        autoplay:true,
        autoplayTimeout: 4000,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 500,
        navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        responsive:{
            0:{
                items:1
            },
            768:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });



    $('.partner-owl').owlCarousel({
        loop:true,
        nav:true,
        navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        responsive:{
            0:{
                items:1
            },
            768:{
                items:3
            },
            1000:{
                items:5
            }
        }
    });  


    $('.nblog-owl').owlCarousel({
        loop:true,
        nav:true,
        autoplay:true,
        autoplayTimeout: 6000,
        navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        responsive:{
            0:{
                items:1
            },
            768:{
                items:1
            },
            1000:{
                items:3
            }
        }
    });



    $('.course-owl').owlCarousel({
        loop:true,
        nav:true,
        margin: 0,
        autoplay:true,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        // autoplayTimeout: 1000,
        navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        responsive:{
            0:{
                items:1
            },
            768:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });



    $('.testimonial-owl').owlCarousel({
        loop:true,
        nav:true,
        autoplay:true,
        // autoplayTimeout: 3000,
        navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        responsive:{
            0:{
                items:1
            },
            768:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

/*------------------------------------
	Video Player
--------------------------------------*/
    $('.video-popup').magnificPopup({
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        zoom: {
            enabled: true,
        }
    });
    
    $('.image-popup').magnificPopup({
        type: 'image',
        gallery:{
            enabled:true
        }
    }); 
/*----------------------------
    Wow js active
------------------------------ */
    new WOW().init();
/*------------------------------------
	Scrollup
--------------------------------------*/
    $.scrollUp({
        scrollText: '<i class="fa fa-angle-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });
/*------------------------------------
	Nicescroll
--------------------------------------*/
     $('body').scrollspy({ 
            target: '.navbar-collapse',
            offset: 95
        });
$(".notice-left").niceScroll({
            cursorcolor: "#EC1C23",
            cursorborder: "0px solid #fff",
            autohidemode: false,
            
        });

})(jQuery);	



/*------------------------------------
	scrollintoview
--------------------------------------*/




/*------------------------------------
	popup
--------------------------------------*/

// document.addEventListener('DOMContentLoaded', function() {
//     // Select the popup element
//     const popup = document.getElementById('popup');

//     // Display the popup
//     popup.style.display = 'block';

//     // Function to hide the popup when scrolling down
//     function hidePopupOnScroll() {
//         // Get the vertical scroll position
//         const scrollPosition = window.scrollY || window.pageYOffset;

//         // Specify the threshold (in pixels) to hide the popup
//         const hideThreshold = 200; // Adjust this value based on your layout

//         // If the scroll position exceeds the threshold, hide the popup
//         if (scrollPosition > hideThreshold) {
//             popup.style.display = 'none';
//             // Remove the scroll event listener once the popup is hidden
//             window.removeEventListener('scroll', hidePopupOnScroll);
//         }
//     }

//     // Attach scroll event listener to hide the popup on scroll
//     window.addEventListener('scroll', hidePopupOnScroll);

//     // Function to close the popup when clicking outside of it
//     function closePopup(event) {
//         if (event.target === popup) {
//             popup.style.display = 'none';
//             // Remove the scroll event listener once the popup is hidden
//             window.removeEventListener('scroll', hidePopupOnScroll);
//             document.removeEventListener('click', closePopup);
//         }
//     }

//     // Attach click event listener to close the popup
//     document.addEventListener('click', closePopup);

//     // Prevent clicks inside the popup from closing it
//     popup.addEventListener('click', function(event) {
//         event.stopPropagation();
//     });
// });


document.addEventListener('DOMContentLoaded', function() {
    const popup = document.getElementById('popup');

    function shouldDisplayPopup() {
        return localStorage.getItem('popupShown') !== 'true';
    }

    function hidePopup() {
        popup.style.animation = 'fadeOutDown 0.5s ease forwards';
        localStorage.setItem('popupShown', 'true');
        setTimeout(() => {
            popup.style.display = 'none';
        }, 500); // Delay hiding popup to match animation duration
    }

    if (shouldDisplayPopup()) {
        popup.style.display = 'block';
        popup.style.position = 'fixed';
        popup.style.top = '50%';
        popup.style.left = '50%';
        popup.style.transform = 'translate(-50%, -50%)';
        popup.style.animation = 'fadeInUp 0.5s ease forwards';

        const applyNowLink = document.getElementById('applyNow');
        applyNowLink.addEventListener('click', hidePopup);

        function closePopup(event) {
            if (event.target === popup) {
                hidePopup();
                document.removeEventListener('click', closePopup);
            }
        }

        document.addEventListener('click', closePopup);

        popup.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    }
});



// TEXT Animation


const elts = {
	text1: document.getElementById("text1"),
	text2: document.getElementById("text2")
};

// The strings to morph between. You can change these to anything you want!
const texts = [
	"MICS",
	"5",
	"?"
];

// Controls the speed of morphing.
const morphTime = 1;
const cooldownTime = 0.25;

let textIndex = texts.length - 1;
let time = new Date();
let morph = 0;
let cooldown = cooldownTime;

elts.text1.textContent = texts[textIndex % texts.length];
elts.text2.textContent = texts[(textIndex + 1) % texts.length];

function doMorph() {
	morph -= cooldown;
	cooldown = 0;
	
	let fraction = morph / morphTime;
	
	if (fraction > 1) {
		cooldown = cooldownTime;
		fraction = 1;
	}
	
	setMorph(fraction);
}

// A lot of the magic happens here, this is what applies the blur filter to the text.
function setMorph(fraction) {
	// fraction = Math.cos(fraction * Math.PI) / -2 + .5;
	
	elts.text2.style.filter = `blur(${Math.min(8 / fraction - 8, 100)}px)`;
	elts.text2.style.opacity = `${Math.pow(fraction, 0.4) * 100}%`;
	
	fraction = 1 - fraction;
	elts.text1.style.filter = `blur(${Math.min(8 / fraction - 8, 100)}px)`;
	elts.text1.style.opacity = `${Math.pow(fraction, 0.4) * 100}%`;
	
	elts.text1.textContent = texts[textIndex % texts.length];
	elts.text2.textContent = texts[(textIndex + 1) % texts.length];
}

function doCooldown() {
	morph = 0;
	
	elts.text2.style.filter = "";
	elts.text2.style.opacity = "100%";
	
	elts.text1.style.filter = "";
	elts.text1.style.opacity = "0%";
}

// Animation loop, which is called every frame.
function animate() {
	requestAnimationFrame(animate);
	
	let newTime = new Date();
	let shouldIncrementIndex = cooldown > 0;
	let dt = (newTime - time) / 1000;
	time = newTime;
	
	cooldown -= dt;
	
	if (cooldown <= 0) {
		if (shouldIncrementIndex) {
			textIndex++;
		}
		
		doMorph();
	} else {
		doCooldown();
	}
}

// Start the animation.
animate();
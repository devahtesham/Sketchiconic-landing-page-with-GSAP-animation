
const observer = lozad(); // lazy loads elements with default selector as '.lozad'
observer.observe();

$( document ).ready(function() {
     
    $("[data-fancybox]").fancybox({ toolbar: !1, smallBtn: !0, iframe: { preload: !1 } }),
    $('.play-btn-style').fancybox();
	$( '.nav-open' ).click(function(){
		$('.nav-bar').toggleClass('active');
		$('.mainoverlay').toggleClass('active');
	  });

	  $(document).on("click", function(e){
		if( 
		  $(e.target).closest(".nav-bar").length == 0 &&
		  $(".nav-bar").hasClass("active") &&
		  $(e.target).closest(".nav-open").length == 0
		){
		  $('.nav-bar').toggleClass('active');
		  $('.mainoverlay').toggleClass('active');
		}
	  });
	  $('.services').slick({
		dots: false,
		arrows: false,
		infinite: true,
		speed: 300,
		autoplay: true,
			autoplaySpeed: 2000,
		slidesToShow: 1,
		slidesToScroll: 1,
	});
	$('.clients').slick({
	  dots: false,
	  arrows: false,
	  infinite: true,
	  speed: 300,
	  autoplay: true,
  		autoplaySpeed: 2000,
	  slidesToShow: 4,
	  slidesToScroll: 1,
	  responsive: [
	    {
	      breakpoint: 1025,
	      settings: {
	        slidesToShow: 4,
	        slidesToScroll: 1,
	      }
	    },
	    {
	      breakpoint: 769,
	      settings: {
	        slidesToShow: 2,
	        slidesToScroll: 1
	      }
	    },
	    {
	      breakpoint: 600,
	      settings: {
	        slidesToShow: 2,
	        slidesToScroll: 1
	      }
	    },
	    {
	      breakpoint: 480,
	      settings: {
	        slidesToShow: 2,
	        slidesToScroll: 1
	      }
	    }
	    // You can unslick at a given breakpoint now by adding:
	    // settings: "unslick"
	    // instead of a settings object
	  ]
	});
	var $horizontal = $('.horizontal');

    $(window).scroll(function () {
        var s = $(this).scrollTop(),
            d = $(document).height(),
            c = $(this).height();

        scrollPercent = (s / (d - c));

        var position = (scrollPercent * ($(document).width() - $horizontal.width()));
        
        $horizontal.css({
            'left': position
        });
    });
	// assign captions from title-attributes:
    $("[data-fancybox]").each(function(){
        $(this).attr("data-caption", $(this).attr("title"));
    });
    // start fancybox on all elements with attribute 'data-fancybox':
    $("[data-fancybox]").fancybox();
    
    // $('.view-detail').on('click', function() {
    //     $('.view-detail').prev('.clist').removeClass('active');
    //     $('.view-detail').text('View Detail');
    //     $('.view-detail').not($(this)).removeClass('active-dropdown');
    //     $(this).toggleClass('active-dropdown');
    //     if ($(this).hasClass('active-dropdown')) {
    //         $(this).prev('.clist').addClass('active');
    //         $(this).text('Hide Detail');
    //     }
    // });
    $('.review-slider').slick({
      dots: false,
      arrows: true,
      infinite: true,
      speed: 300,
      autoplay: false,
        autoplaySpeed: 2000,
      slidesToShow: 2,
      slidesToScroll: 1,
       centerMode: false,
      responsive: [
		{
			breakpoint: 1367,
			settings: {
			  slidesToShow: 2,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 1025,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 769,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1
			}
		  },
		  {
			breakpoint: 600,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1
			}
		  },
		  {
			breakpoint: 480,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1
			}
		  }
      ]
    });
	
	// setTimeout(alertFunc, 6000);
    // function alertFunc()
    // {
        
    //     $('#get-a-quote-modal').modal('show');
    // }
	
            $(".chat").click(function(){
                return $zopim.livechat.window.toggle(),!1});
                AOS.init();
});
	// $(document).ready(function(){
	// 	setTimeout(alertFunc, 4000);
	// 	function alertFunc()
	// 	{
	// 		$('.overlayS').addClass('hide');
	// 		AOS.refresh();
			
	// 	}
	// 	AOS.init();
	// });

console.clear();

gsap.registerPlugin(ScrollTrigger, DrawSVGPlugin, MotionPathPlugin);

gsap.set(".pathBall", {xPercent: -50, yPercent: -50});

var dir;

var action = gsap.timeline({defaults: {duration: 1, ease:'none' },
  scrollTrigger: {
    trigger: "#path",
    scrub:0,
    start: "top top",
    end: "bottom +=200%", // new
    onUpdate: self => { 
      prog = self.progress.toFixed(2);
      console.log(prog);
    } // new: info for position
  }})
.fromTo(".pathLine", {drawSVG: "100% 100%"}, {drawSVG: "0% 100%"}, 0)
.from(".pathBall", {motionPath: {path: ".pathLine", align: ".pathLine", offsetX:0, offsetY:0,  }}, 0)
.to('#wrap', {y:'-=20',duration:0.25,},0)
.to('#wrap', {y:'-=50',duration:0.05,},0.40)
.to('#wrap', {y:'-=1000',duration:0.35,},0.5) 


gsap.to('.hscroll', {
	xPercent: -150,
	ease: "none",
	scrollTrigger: {
	  trigger: ".hscroll",
	  start: "top center",
	  end: "bottom top",
	  scrub: true,
	//   markers:true,

	}
  })


//   const demo = document.querySelector("#demo");
// // const controls = document.querySelector("#controls");
// const colorArray = ["#46a4cc", "#94c356", "#eae047", "#a63e4b", "#e3aa59", "#a63ba0", "#a2a2a2", "#4c42d1", "#cf5b21"];
// const swatches = gsap.utils.toArray("#swatches rect"); 
// let speed = 1;
// const tl = gsap.timeline({repeat:-1, defaults:{ease:"none"}});
// const ease2 = "power2.inOut";
// const highlight = "#3fa9f5";

// // basic alignment and initial color settings
// // gsap.set([controls, demo], {transformOrigin:"center center", xPercent:-50, autoAlpha:1});		
// gsap.set("#hand", { yPercent:-100, transformOrigin:"center center"});
// gsap.set("#handSlider", { x:26});
// gsap.set(".theWords path", {stroke:colorArray[0], drawSVG:0});
// gsap.set("#speedControl", {transformOrigin:"center center"});
// gsap.set(".theWords ellipse", {autoAlpha:0, stroke:colorArray[0]});
// gsap.set("#groupSizer", {autoAlpha:0});

// swatches.forEach((obj, i) => {
//   obj.index = i;
//   gsap.set(obj, {stroke:colorArray[i]})
//   obj.addEventListener("click", changeColor);
// });



// // toggle control timelines
// const iconTl = gsap.timeline({reversed: true, paused:true, defaults:{ease:"none", duration:0.35}});

// iconTl.to("#handSlider", {x:0, ease:"power4.inOut"});
// iconTl.to("#hand", {autoAlpha:0},0);
// iconTl.to(".off", {opacity:1, stroke:highlight}, 0);
// iconTl.to(".on", {opacity:0.35, stroke:"#fff"}, 0);

// const themeTl = gsap.timeline({reversed: true, paused:true, defaults:{ease:"none", duration:0.4}});

// themeTl.to("#themeSlider", {x:26, ease:"power4.inOut"});
// themeTl.to("#bg", {stroke:"#fff"}, 0);
// themeTl.to(".light", {opacity:1, stroke:highlight}, 0);
// themeTl.to(".dark", {opacity:0.35, stroke:"#fff"}, 0);

// // button listeners
// // document.querySelector("#playButton").addEventListener("click", playTimeline);
// // document.querySelector("#pauseButton").addEventListener("click", pauseTimeline);
// // document.querySelector("#handControl").addEventListener("click", function() {
// // 	toggle(iconTl)
// // });
// // document.querySelector("#themeControl").addEventListener("click", function() {
// // 	toggle(themeTl)
// // });

// // create the tween speed draggable
// // Draggable.create("#speedControl", {
// // 	type:"rotation",
// // 	bounds: {
// // 		minRotation:-136,
// // 		maxRotation: 136
// // 	},
// // 	onDrag: speedUpdate
		
// // 		});  // end draggable create

// // adjust the animation timeScale()
// function speedUpdate() {
// 	let r = this.rotation;
// 	if (r < 0) {
// 		speed = 1+(r/150);
// 	} else {
// 		speed = (r/25)+1;
// 	} 
// 	tl.timeScale(speed.toFixed(2));
// }

// // timeline play/pause controls
// // function playTimeline() {
// // 	if (tl.paused() ) {
// // 		tl.play();
// // 		gsap.to(tl, {duration: 0.75, timeScale:speed});
// // 		gsap.to(".play", {duration: 0.4, stroke:highlight, opacity:1, ease:"none"});
// // 		gsap.to(".pause", {duration: 0.4, stroke:"#fff", opacity:0.35, ease:"none"});
// // 	}
// // }




// // function for the toggle switch timelines
// function toggle(t) {
// 	t.reversed() ? t.play() : t.reverse();
	
// }


// //change the  color of the stroke and dots
// function changeColor() {
// 	let newColor = colorArray[ this.index ];
// 	gsap.to( ".theWords path", { duration: 1, stroke:newColor, ease:"none" });
// 	gsap.to( ".theWords ellipse", { duration: 1, stroke:newColor, ease:"none" });
// }	

// // main timeline creation
// tl.to("#hPipe", {duration: 0.35, drawSVG:true});
// tl.to("#hand", {duration: 0.35, motionPath:{path:"#hPipe", align:"#hPipe"}}, 0);
// // move to second part of h
// tl.to("#hand", {duration: 0.25, x:364.08, y:140.94, ease:ease2 });
// // start main h body
// tl.add("path2");
// tl.to("#s", {duration: 0.75, drawSVG:true}, "path2");
// tl.to("#hand", {duration: 0.75, motionPath:{path:"#s", align:"#s"} }, "path2");
// //move to main path of 'handwriting'
// tl.to("#hand", { duration: 0.25, x:430.67, y:293.63, ease:ease2 });
// // start rest of first word
// tl.add("path3");
// tl.to("#sketch", {duration: 5, drawSVG:true}, "path3");
// tl.to("#hand", { duration: 5, motionPath:{path:"#sketch", align:"#sketch"} }, "path3");
// // move to first dot over i
// tl.to("#hand", { duration: 0.5, x:926, y:271.97, ease:ease2 });
// tl.to("#dot2", {duration: 0.15, autoAlpha:1});
// // move to horizontal cross on t
// tl.to("#hand", { duration: 0.3, x:936.82, y:232.3, ease:ease2 });
// // start cross of t
// tl.add("path4");
// tl.to("#tCross", {duration: 0.25, drawSVG:true}, "path4");
// tl.to("#hand", { duration: 0.25, motionPath:{path:"#tCross", align:"#tCross"} }, "path4");
// // move to second i dot
// tl.to("#hand", { duration: 0.1, x:1056.39, y:271.97, ease:ease2 });
// tl.to("#dot1", {duration: 0.15, autoAlpha:1});
// // mpve to beginning of 'is'
// tl.to("#hand", { duration: 0.4, x:474.84, y:432, ease:ease2 });
// // start is path
// tl.add("path5");
// tl.to("#isPath", {duration: 0.75, drawSVG:true}, "path5");
// tl.to("#hand", { duration: 0.75, motionPath:{path:"#isPath", align:"#isPath"} }, "path5");
// // move to dot of the i in 'is'
// tl.to("#hand", { duration: 0.25, x:475.71, y:406.97, ease:ease2 });
// tl.to("#dot3", {duration: 0.15, autoAlpha:1});
// // move to beginning of 'easy'
// tl.to("#hand", { duration: 0.25, x:706, y:468.5, ease:ease2 });
// // start 'easy' path
// tl.add("path6");
// tl.to("#iconic", {duration: 2, drawSVG:true}, "path6");
// tl.to("#hand", { duration: 2, motionPath:{path:"#iconic", align:"#iconic"} }, "path6");
// // move to period at end of sentence
// tl.to("#hand", { duration: 0.25, x:1022.7, y:488.51, ease:ease2 });
// tl.to("#dot4", {duration: 0.15, autoAlpha:1});
// // move hand out of the way
// tl.to("#hand", { duration: 0.75, x:1300, y:675, ease:ease2 });
// // move to beginning and fade out text for a seamless loop
// tl.add("ending", "+=1");
// tl.to("#hand", { duration: 1, x:236.07, y:153.69, ease:ease2 }, "ending");
// tl.to(".theWords path, .theWords ellipse", {duration: 0.75,  autoAlpha:0}, "ending");


// // resize and center SVG demo and controls
// // function sizeAll() {
// // 	let h = window.innerHeight;
// // 	let	w = window.innerWidth;
	
// // 	if ( w > (h-250)*2) {
// // 		gsap.set(demo, {height:h-240, width:(h-250)*2});
// // 		gsap.set(controls, {y:h-240});	
// // 	}	else {
// // 		gsap.set(demo, {y:0, width:w-10, height:w/2});
// // 		gsap.set(controls, {y:w/2+10});	
// // 	}
// // }


// // window.addEventListener('resize', sizeAll);
// // sizeAll();
// draw();


// function draw(){
//   TweenMax.set(".container", {alpha:1})

//   TweenMax.fromTo(['#julie-path'], 20, { drawSVG: "0" }, { drawSVG:"100%" })
//   TweenMax.fromTo(['#dot-path'], 0.5, { drawSVG: "0" }, { drawSVG:"100%", delay: 2})

// }
// var tl5 = new TimelineMax({ repeat: -1, repeatDelay: 1});

// tl5.staggerFromTo('#logo path', 1, { drawSVG: "0%" }, { drawSVG: "100%", ease: Linear.easeNone }, 0.15);
// tl5.staggerTo('#logo path', 1, { stroke:"#ff0000"}, 0.15,0.6);

const demo = document.querySelector("#demo");
const controls = document.querySelector("#controls");
const colorArray = ["#fd1818", "#FF7900"];
const swatches = gsap.utils.toArray("#swatches rect"); 
let speed = 1;
const tl = gsap.timeline({repeat:-1, defaults:{ease:"none"}});
const ease2 = "power2.inOut";
const highlight = "#3fa9f5";

// basic alignment and initial color settings
gsap.set([controls, demo], {transformOrigin:"center center", xPercent:-50, autoAlpha:1});
gsap.set("#hand", { yPercent:-100, transformOrigin:"center center"});
gsap.set("#handSlider", { x:26});
gsap.set(".theWords path", {stroke:colorArray[0], drawSVG:0});
gsap.set("#speedControl", {transformOrigin:"center center"});
gsap.set(".theWords ellipse", {autoAlpha:0, stroke:colorArray[0]});
gsap.set("#groupSizer", {autoAlpha:0});

swatches.forEach((obj, i) => {
  obj.index = i;
  gsap.set(obj, {stroke:colorArray[i]})
  obj.addEventListener("click", changeColor);
});



// toggle control timelines
const iconTl = gsap.timeline({reversed: true, paused:true, defaults:{ease:"none", duration:0.35}});

iconTl.to("#handSlider", {x:0, ease:"power4.inOut"});
iconTl.to("#hand", {autoAlpha:0},0);
iconTl.to(".off", {opacity:1, stroke:highlight}, 0);
iconTl.to(".on", {opacity:0.35, stroke:"#fff"}, 0);

const themeTl = gsap.timeline({reversed: true, paused:true, defaults:{ease:"none", duration:0.4}});

themeTl.to("#themeSlider", {x:26, ease:"power4.inOut"});
themeTl.to("#bg", {stroke:"#fff"}, 0);
themeTl.to(".light", {opacity:1, stroke:highlight}, 0);
themeTl.to(".dark", {opacity:0.35, stroke:"#fff"}, 0);

// button listeners
document.querySelector("#playButton").addEventListener("click", playTimeline);
document.querySelector("#pauseButton").addEventListener("click", pauseTimeline);
document.querySelector("#handControl").addEventListener("click", function() {
	toggle(iconTl)
});
document.querySelector("#themeControl").addEventListener("click", function() {
	toggle(themeTl)
});
// create the tween speed draggable
Draggable.create("#speedControl", {
	type:"rotation",
	bounds: {
		minRotation:-136,
		maxRotation: 136
	},
	onDrag: speedUpdate
		
		});  // end draggable create
// adjust the animation timeScale()
function speedUpdate() {
	let r = this.rotation;
	if (r < 0) {
		speed = 1+(r/150);
	} else {
		speed = (r/25)+1;
	} 
	tl.timeScale(speed.toFixed(2));
}
// timeline play/pause controls
function playTimeline() {
	if (tl.paused() ) {
		tl.play();
		gsap.to(tl, {duration: 0.75, timeScale:speed});
		gsap.to(".play", {duration: 0.4, stroke:highlight, opacity:1, ease:"none"});
		gsap.to(".pause", {duration: 0.4, stroke:"#fff", opacity:0.35, ease:"none"});
	}
}
function pauseTimeline() {
	if (!tl.paused() ) {
		gsap.to(tl, 0.75, {
		timeScale:0, 
		onComplete: function() {
			tl.pause();
			}
		});
		gsap.to(".pause", {duration: 0.4, stroke:highlight, opacity:1, ease:"none"});
		gsap.to(".play", {duration: 0.4, stroke:"#fff", opacity:0.35, ease:"none"});
	}
}
// function for the toggle switch timelines
function toggle(t) {
	t.reversed() ? t.play() : t.reverse();
	
}
//change the  color of the stroke and dots
function changeColor() {
	let newColor = colorArray[ this.index ];
	gsap.to( ".theWords path", { duration: 1, stroke:newColor, ease:"none" });
	gsap.to( ".theWords ellipse", { duration: 1, stroke:newColor, ease:"none" });
}	

// main timeline creation
// tl.to("#hPipe", {duration: 0.35, drawSVG:true});
// tl.to("#hand", {duration: 0.35, motionPath:{path:"#hPipe", align:"#hPipe"}}, 0);
// move to second part of h
// tl.to("#hand", {duration: 0.25, x:364.08, y:140.94, ease:ease2 });
// start main h body
tl.add("path2");
tl.to("#s", {duration: 2, drawSVG:true}, "path2");
tl.to("#hand", {duration: 2, motionPath:{path:"#s", align:"#s"} }, "path2");
//move to main path of 'handwriting'
// tl.to("#hand", { duration: 0.25, x:430.67, y:293.63, ease:ease2 });
// start rest of first word
tl.add("path3");
tl.to("#sketch", {duration: 5, drawSVG:true}, "path3");
tl.to("#hand", { duration: 5, motionPath:{path:"#sketch", align:"#sketch"} }, "path3");
tl.add("path4");
tl.to("#tCross", {duration: 0.25, drawSVG:true}, "path4");
tl.to("#hand", { duration: 0.25, motionPath:{path:"#tCross", align:"#tCross"} }, "path4");
// // move to first dot over i

// // move to horizontal cross on t
// tl.to("#hand", { duration: 0.3, x:936.82, y:232.3, ease:ease2 });
// // start cross of t
// 

// // move to second i dot

// // mpve to beginning of 'is'
// tl.to("#hand", { duration: 0.4, x:474.84, y:432, ease:ease2 });

// // start 'easy' path
tl.add("path5");
tl.to("#iconic", {duration: 5, drawSVG:true}, "path5");
tl.to("#hand", { duration: 5, motionPath:{path:"#iconic", align:"#iconic"} }, "path5");

tl.add("path6");
tl.to("#hand", { duration: 0.5, motionPath:{path:"#dot2", align:"#dot2"} }, "path6");
tl.to("#dot2", {duration: 0.5, drawSVG:true}, "path6");
tl.add("path7");
tl.to("#hand", { duration: 0.5, motionPath:{path:"#dot1", align:"#dot1"} }, "path7");
tl.to("#dot1", {duration: 0.5,  drawSVG:true}, "path7");
tl.add("ending", "+=1");
tl.to("#hand", { duration: 1, x:236.07, y:153.69, ease:ease2 }, "ending");
tl.to(".theWords path, .theWords path", {duration: 0.75,  autoAlpha:0}, "ending");


// resize and center SVG demo and controls
function sizeAll() {
	let h = window.innerHeight;
	let	w = window.innerWidth;
	
	if ( w > (h-250)*2) {
		gsap.set(demo, {height:h-240, width:(h-250)*2});
		gsap.set(controls, {y:h-240});	
	}	else {
		gsap.set(demo, {y:0, width:w-10, height:w/2});
		gsap.set(controls, {y:w/2+10});	
	}
}


window.addEventListener('resize', sizeAll);
sizeAll();

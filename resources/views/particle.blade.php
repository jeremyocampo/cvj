<html>
    <head>
<style>
  body
	background: #142a5a
	overflow: hidden
	height: 100%
	width: 100%
	-webkit-font-smoothing: antialiased
	user-select: none

#particles-js, #parallax, .layer, .some-space, .some-more-space
	height: 100%
	position: absolute
	width: 100%

#particles-js
	opacity: .6

h1
	color: white
	font-size: 5em
	font-weight: 100
	letter-spacing: .2em
	position: absolute
	top: 50%
	left: 50%
	transform: translate3d(-50%,-50%,0)

a
	color: white
	border: 1px solid white
	display: table
	position: absolute
	top: 60%
	left: 50%
	letter-spacing: .05em
	transform: translate3d(-50%,-50%,0)
	text-decoration: none
	transition: all 200ms ease
	padding: 10px 15px
	&:hover
		background: white
		color: black

.some-space
	animation: rotate 18s .5s infinite linear reverse

.some-more-space
	animation: rotate 15s .1s infinite linear

@keyframes rotate
	0%
		transform: rotateZ(0deg) translate3d(0,1.5%,0) rotateZ(0deg)
	100%
		transform: rotateZ(360deg) translate3d(0,1.5%,0) rotateZ(-360deg)

</style>
    </head>


<body>
	
        .layer(data-depth="0.6")
		.some-space
			h1 PARALLAX
		
	.layer(data-depth="0.4")
		#particles-js
		
</body>

<script>
$('#parallax').parallax({
	invertX: true,
	invertY: true,
	scalarX: 10,
	 frictionY: .1
});


particlesJS("particles-js", {
  "particles": {
    "number": {
      "value": 150,
      "density": {
        "enable": true,
        "value_area": 800
      }
    },
    "color": {
      "value": "#ffffff"
    },
    "shape": {
      "type": "circle",
      "stroke": {
        "width": 0,
        "color": "#000000"
      },
      "polygon": {
        "nb_sides": 8
      },
      "image": {
        "src": "img/github.svg",
        "width": 100,
        "height": 100
      }
    },
    "opacity": {
      "value": 0.5,
      "random": false,
      "anim": {
        "enable": false,
        "speed": 1,
        "opacity_min": 0.1,
        "sync": false
      }
    },
    "size": {
      "value": 3,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 40,
        "size_min": 0.1,
        "sync": false
      }
    },
    "line_linked": {
      "enable": true,
      "distance": 150,
      "color": "#ffffff",
      "opacity": 0.4,
      "width": 1
    },
    "move": {
      "enable": true,
      "speed": 6,
      "direction": "none",
      "random": false,
      "straight": false,
      "out_mode": "out",
      "bounce": false,
      "attract": {
        "enable": false,
        "rotateX": 600,
        "rotateY": 1200
      }
    }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      "onhover": {
        "enable": true,
        "mode": "grab"
      },
      "onclick": {
        "enable": true,
        "mode": "push"
      },
      "resize": true
    },
    "modes": {
      "grab": {
        "distance": 140,
        "line_linked": {
          "opacity": 1
        }
      },
      "bubble": {
        "distance": 400,
        "size": 40,
        "duration": 2,
        "opacity": 8,
        "speed": 3
      },
      "repulse": {
        "distance": 200,
        "duration": 0.4
      },
      "push": {
        "particles_nb": 4
      },
      "remove": {
        "particles_nb": 2
      }
    }
  },
  "retina_detect": true
});
</script>

</html>
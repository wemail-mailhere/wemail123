<html>



	<head>
	
		<style>
			
			
	.cover {
    bottom: 0;
    left: 0;
    overflow: hidden;
    position: absolute;
    right: 0;
    top: 0;
    z-index: 1;
}

.cover img, .cover video {
    display: block;
    height: auto;
    left: auto;
    max-width: none;
    min-height: 100%;
    min-width: 100%;
    right: auto;
    position: absolute;
    top: 0;
    width: auto;
    z-index: 1;
}

@supports (transform: translateX(-50%)) {

    .cover img, .cover video {
        left: 50%;
        top: 50%;
        transform: translateX(-50%) translateY(-50%);
    }

}

@media screen and (min-aspect-ratio: 16/9){/* Make this the same aspect ratio as your video */

    .cover img, .cover video {
        max-width: 100vw;
        min-width: 100vw;
        width: 100vw;
    }

}

@media screen and (max-aspect-ratio: 16/9){/* Make this the same aspect ratio as your video */

    .cover img, .cover video {
        height: 100vh;
        max-height: 100vh;
        min-height: 100vh;
    }

}
			
			
</style>
</head>
<body>

<div class="cover">
        <video  id="videohome"  class="cover" preload="auto" autoplay="true" loop="loop" muted="" volume="0">
            <source src="video.mp4" type="video/mp4" />
        </video>

	</div>
	</body>




</html>





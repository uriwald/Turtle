<?php
    if (session_id() == '')
        session_start();
    $crouselDir =   $rootDir ."files/carousel/"; 
?>
<!-- carousel CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo $crouselDir; ?>demo/css/base.css" media="all" /> 
	<link rel="stylesheet" type="text/css" href="<?php echo $crouselDir; ?>dist/css/jquery.rs.carousel.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo $crouselDir; ?>demo/css/demo.css" media="all" />
<?php
/*
        <!-- lib -->
<script type="text/javascript" src="<?php echo $crouselDir; ?>vendor/jquery.js"></script>
<script type="text/javascript" src="<?php echo $crouselDir; ?>vendor/jquery.ui.widget.js"></script>
<!-- if using touch -->
<script type="text/javascript" src="<?php echo $crouselDir; ?>vendor/jquery.event.drag.js"></script>
<!-- if using touch and translate3d -->
<script type="text/javascript" src="<?php echo $crouselDir; ?>vendor/jquery.translate3d.js"></script>
*/
?>
<!-- carousel core -->

        <script type="text/javascript" src="<?php echo $crouselDir; ?>dist/js/jquery.rs.carousel.js?locale=<?php echo $locale ?>"></script>

<!-- carousel extensions (optional) -->
<script type="text/javascript" src="<?php echo $crouselDir; ?>dist/js/jquery.rs.carousel-autoscroll.js"></script> 
<script type="text/javascript" src="<?php echo $crouselDir; ?>dist/js/jquery.rs.carousel-continuous.js"></script>
<script type="text/javascript" src="<?php echo $crouselDir; ?>dist/js/jquery.rs.carousel-touch.js"></script>

<!-- <script type="text/javascript" src="<?php echo $crouselDir; ?>demo/js/demo.js"></script> -->

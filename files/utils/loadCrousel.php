<?php
    if (session_id() == '')
        session_start();
    $crousel_dir =   $root_dir ."files/carousel/"; 
?>
<!-- carousel CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo $crousel_dir; ?>demo/css/base.css" media="all" /> 
	<link rel="stylesheet" type="text/css" href="<?php echo $crousel_dir; ?>dist/css/jquery.rs.carousel.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo $crousel_dir; ?>demo/css/demo.css" media="all" />
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

        <script type="text/javascript" src="<?php echo $crousel_dir; ?>dist/js/jquery.rs.carousel.js?locale=<?php echo $locale_domain ?>"></script>

<!-- carousel extensions (optional) -->
<script type="text/javascript" src="<?php echo $crousel_dir; ?>dist/js/jquery.rs.carousel-autoscroll.js"></script> 
<script type="text/javascript" src="<?php echo $crousel_dir; ?>dist/js/jquery.rs.carousel-continuous.js"></script>
<script type="text/javascript" src="<?php echo $crousel_dir; ?>dist/js/jquery.rs.carousel-touch.js"></script>

<!-- <script type="text/javascript" src="<?php echo $crousel_dir; ?>demo/js/demo.js"></script> -->

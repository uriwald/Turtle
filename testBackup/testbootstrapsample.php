<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>docs - 1ClickEdit CMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="docs">
    <base href="http://1clickedit.org/"/>
    
    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
	<!-- Atom Feeds Blog -->
	<link rel="alternate" type="application/atom+xml" href="feed.php/post" title="Article - 1ClickEdit CMS"/>
	<link rel="alternate" type="application/atom+xml" href="feed.php/comment" title="Commentaire - 1ClickEdit CMS"/>
	<!-- Atom Feeds Forum -->
	<link rel="alternate" type="application/atom+xml" href="feed.php/topic" title="Sujet - 1ClickEdit CMS"/>
	<link rel="alternate" type="application/atom+xml" href="feed.php/reply" title="Réponse - 1ClickEdit CMS"/>
    <!-- Le styles -->

    <link rel="stylesheet" type="text/css" href="theme/bootstrap/assets/css/1ce.min.css?ver=2.0.4"/>
    <link rel="stylesheet" href="theme/bootstrap/assets/css/bootstrap.min.css?ver=2.0.4" type="text/css"/>
    <link rel="stylesheet" href="theme/bootstrap/assets/css/bootstrap-responsive.min.css?ver=2.0.4" type="text/css"/>

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="theme/bootstrap/assets/ico/favicon.ico">

    <link rel="apple-touch-icon" href="theme/bootstrap/assets/ico/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="theme/bootstrap/assets/ico/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="theme/bootstrap/assets/ico/apple-touch-icon-114x114.png">
    <!-- Jquery lib load
    ================================================== -->    
    <script src="theme/bootstrap/assets/js/jquery.min.js"></script>
    <!-- SeoExtend Pack Plugin --><meta name="author" content="1ClickEdit" /><meta name="robots" content="index,follow" /><meta name="keywords" content="1clickedit, content management system, simple, lightweight CMS, Light Weight CMS Solutions, Light CMS, cms, no database cms, no sql cms, Json, web design CMS, HTML5, xHTML, w3c, javascript, jquery, CSS, CSS3" /><meta http-equiv="X-UA-Compatible" content="IE=edge" /><meta name="google-site-verification" content="y8rTRi4SUYc4xV_i_qCrYWqSmJAPjOrMmiLFHTxQCVw" />
<meta name="msvalidate.01" content="20787FF4433A94C688E75E9BB9C5080F" />
<meta name="wot-verification" content="c5b1e27fc40314668bc6"/><link rel="canonical" href="http://1clickedit.org/view.php/plugin/docs" />
	<meta name="generator" content="Powered by 1ClickEdit CMS" /><!-- /SeoExtend Pack Plugin End -->  <!-- thumb -->
  <link href="plugin/thumb/assets/style.css" rel="stylesheet" type="text/css" />
  <!-- /thumb -->        <script type="text/javascript">
          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-28744925-1']);
          _gaq.push(['_trackPageview']);

          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();
        </script>  </head>

  <body id="docs" data-spy="scroll" data-target=".navbar" data-offset="50">
  
    
<!-- Navbar
================================================== -->

  <header class="navbar navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <a class="brand" href="./">1ClickEdit CMS</a>
        <div class="nav-collapse">
          <ul class="nav">
            <li class="divider-vertical"></li>
            <!-- Menu -->
            <li class="active"><a href="view.php/plugin/docs"><i class="icon-white icon-book"></i> Documentation</a></li> 
                       
            <!-- Blog -->      
            <li class="dropdown">
              <a href="blog.php/post" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-white icon-list-alt"></i> Blog <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li ><a href="blog.php/post"><i class="icon-list-alt"></i> Article</a></li>
	            <li ><a href="blog.php/comment"><i class="icon-comment"></i> Commentaire</a></li>
	            <li class="divider"></li>
	            <li ><a href="search.php/post"><i class="icon-search"></i> Rechercher</a></li>
              </ul>
            </li> 

            <!-- Forum -->      
            <li class="dropdown">
              <a href="forum.php/forum" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-white icon-th-list"></i> Forum <b class="caret"></b></a>
              <ul class="dropdown-menu">
	            <li ><a href="forum.php/forum"><i class="icon-comment"></i> Forum</a></li>              
                <li ><a href="forum.php/new"><i class="icon-list-alt"></i> Nouveau</a></li>
	            <li class="divider"></li>
	            <li ><a href="search.php/topic"><i class="icon-search"></i> Rechercher</a></li>
              </ul>
            </li>                       
          </ul>
          
          <ul class="nav pull-right"> 
            <!-- Flux Rss -->      
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-white icon-signal"></i> Fil Rss <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="feed.php/post"><i class="icon-star-empty"></i> Article</a></li> 
	            <li><a href="feed.php/comment"><i class="icon-star-empty"></i> Commentaire</a></li>
	            <li class="divider"></li>
	            <li><a href="feed.php/topic"><i class="icon-star-empty"></i> Sujet</a></li> 
	            <li><a href="feed.php/reply"><i class="icon-star-empty"></i> Réponse</a></li>
              </ul>
            </li>

            <!-- Connexion / Paramètres -->
            <li><a href="auth.php/login"><i class="icon-white icon-user"></i> Connexion</a></li>          </ul>
          
          <!-- Recherche -->
            
          
        </div><!-- /.nav-collapse -->
      </div>
    </div><!-- /navbar-inner -->
  </header><!-- /navbar -->

      <!-- Content
       ================================================== -->
     <div class="container" role="docs">
     
      <div class="row">    

                    <article class="span12 docs">
			            <header class="page-header"><h1>Documentation</h1></header>
                        				<div class="span3">
					<div class="well" style="padding: 8px 0;">
						<ul class="nav nav-list" id="Doc">
							<li class="nav-header">Documentation</li>
							<li class="active"><a href="#installation" data-toggle="tab"><i class="icon-flag"></i> Installation</a></li>
							<li><a href="#configuration" data-toggle="tab"><i class="icon-cog"></i> Configuration</a></li>
							<li><a href="#theme" data-toggle="tab"><i class="icon-tint"></i> Thèmes</a></li>
							<li><a href="#plugin" data-toggle="tab"><i class=" icon-star"></i> Plugins</a></li>
							<li><a href="#developpeur" data-toggle="tab"><i class="icon-wrench"></i> Développeurs</a></li>
						</ul>
					</div>
				</div>
				<div id="doc" class="span8">
                                    <div class="tab-content">
                                            <div class="tab-pane active" id="installation">
					       <h2>Requis</h2>
					      <ol>
   					         <li>PHP 5.2</li>
					         <li>allow_url_fopen=on dans votre php.ini</li>
					      </ol>    
					       <h2>Installation</h2>
					       <h5>2 possibilités s'offre à vous</h5>
					          <ul>
					             <li>En envoyant directement sur votre Ftp à l'emplacement ou vous souhaitez installer <b>1ClickEdit</b> le fichier index.php, et la il vous suffit d'atteindre la page d'installation automatique <em>(ex: <b>http://monsite.com/1clickedit/</b>)</em> et d'attendre environ 5 secondes pour que le script télécharge, décompresse et s'installe automatiquement sur votre serveur <em>(allow_url_fopen doit être activé et vous serez averti de l'état d'avancement)</em>.</li>

					             <li>En téléchargent et en décompressant l'archive de 1ClickEdit en envoyant tout les fichiers par votre client Ftp (Filezilla, Cyberduck...) à l'emplacement désiré et dans votre navigateur pointer sur votre domaine et/ou dossier de <b>1ClickEdit</b> <em>(ex: <b>http://monsite.com/1clickedit/</b>)</em> pour débuter le processus d'installation.</li>
					          </ul>
					       <p> 
					            Dans les 2 cas l'installation est dite «silencieuse» car rien ne vous est demandé pendant le processus. Il vous suffira de modifier le mot de passe par défaut qui est: <b><u>demo</u></b> depuis votre interface de configuration du mot de passe.
					       </p>              
                                            </div><!--/ installation -->

                                            <div class="tab-pane" id="configuration">
                                                <h2>Configuration</h2>
					      <p>En cours de rédaction…</p>
                                            </div><!-- / Config -->

                                            <div class="tab-pane" id="theme">
                                                <h2>Thèmes</h2>
					      <p>En cours de rédaction…</p>
                                            </div><!-- / Theme -->

                                            <div class="tab-pane" id="plugin">
                                                <h2>Plugins</h2>
					      <p>En cours de rédaction…</p>
                                            </div><!-- / Plugin -->

                                            <div class="tab-pane" id="developpeur">
                                                <h2>Développeurs</h2>
					      <p>En cours de rédaction…</p>
                                            </div><!-- / Dev -->
                                    </div>
				</div>
             </article>
      </div> <!--/row-->
      
     </div>

     <!-- Footer
      ================================================== -->
      
      <footer class="container footer">
        <p class="pull-right">Motorisé par <a href="http://1clickedit.org/" rel="tooltip" title="Cms, blog et forum à base de Json"><strong>1ClickEdit</strong></a> 0.001s &bull; 1.98MB  <i class="icon-time"></i> Compression GZIP activée</p>
        <p>Copyright &copy; 2013 <strong>1ClickEdit CMS</strong>, tous droits réservés.</p>
        <div class="btn-group">
	            <span class="btn btn-small"><i class="icon-user"></i> Visiteur</span>
	            <span class="btn btn-small"> 1</span>
	        </div>      </footer>     


    <!-- Le javascript
    ================================================== -->    
    <script src="theme/bootstrap/assets/js/bootstrap.min.js?ver=2.0.4"></script>
    <script src="theme/bootstrap/assets/js/application.min.js?ver=2.0.4"></script>
    <div style="position: fixed; left: 0; top: 20%;"><span class='st_twitter_large'></span><br /><span class='st_facebook_large'></span><br /><span class='st_sharethis_large'></span><br /></div><script type="text/javascript">var switchTo5x=true;</script><script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script><script type="text/javascript">stLight.options({publisher:'2da24328-c408-4eea-b984-11607777d3e1'});</script><script src="http://1clickedit.org/plugin/core/assets/js/jquery.slugify.js" type="text/javascript"></script>
	<script src="http://1clickedit.org/plugin/core/assets/google-code-prettify/prettify.js"></script>
	<script src="http://1clickedit.org/plugin/core/assets/js/core.min.js"></script><script src="plugin/core/assets/js/bbcode.js"></script><script src="plugin/core/assets/js/loadreply.js"></script><script src="plugin/core/assets/js/loadform.js"></script><script src="plugin/core/assets/js/imgzoom.js"></script>
  </body>
</html>
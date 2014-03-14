<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<meta name="Description" content="Information architecture, Web Design, Web Standards." />
<meta name="Keywords" content="your, keywords" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="Distribution" content="Global" />
<meta name="Author" content="Erwin Aligam - ealigam@gmail.com" />
<meta name="Robots" content="index,follow" />

<link rel="stylesheet" href="images/CoolWater.css" type="text/css" />
<?php session_start() ?>

<title>CoolWater</title>
</head>

<body>
	<?php
	if(isset($_GET['id'])){$titulo=$_GET['id'];}else{$titulo="";}
	if(isset($_GET['src'])){$destino=$_GET['src'];}else{$destino="";}
	?>
<!-- wrap starts here -->
<div id="wrap">
		
	<!--header -->
	<div id="header">			
				
		<h1 id="logo-text"><a href="index.html">coolwater</a></h1>		
		<p id="slogan">put your site slogan here...</p>		
			
			<div id="header-links">
			<p>
            <?php
			if( isset($_SESSION['user'])){ 
			echo '<a href="logout.php">LogOut</a>';
			}
			?>
			</p>		
		</div>		
						
	</div>
		
	<!-- navigation -->	
	<div  id="menu">
		<ul>
			<li><a href="index.php">Inicio</a></li>
			<?php
			if( (isset($_SESSION['user']))&&($_SESSION['user']=='master') ){ ?>
			<li id="current"><a href="socios.php">Socios</a></li>
			<li><a href="index.html">Unidades</a></li>
			<li><a href="index.html">Polizas</a></li>
			<?php } ?>		
		</ul>
	</div>					
			
	<!-- content-wrap starts here -->
	<div id="content-wrap">
		
		<div id="main">				
			<h2><?php echo $titulo ?></h2>
            <p>
            <iframe name="contenedor" src="<?php echo $destino ?>" width="100%" frameborder="0" allowtransparency="true" height="700px"></iframe>
            </p>
		</div>
		
			
		<div id="sidebar">
			
						
		  <h2>Menu</h2>
			<ul class="sidemenu">				
				<li><a href="socios.php?id=Agregar Nuevo Socio&src=agregarsocio.php">Nuevo Socio</a></li>
				<li><a href="#TemplateInfo">Template Info</a></li>
				<li><a href="#SampleTags">Sample Tags</a></li>
				<li><a href="http://www.styleshout.com/">More Free Templates</a></li>	
				<li><a href="http://www.dreamtemplate.com" title="Web Templates">Web Templates</a></li>
			</ul>	
				
			<h2>Links</h2>
			<ul class="sidemenu">
				<li><a href="http://www.pdphoto.org/">PDPhoto.org</a></li>
				<li><a href="http://www.squidfingers.com/patterns/">Squidfingers</a></li>
				<li><a href="http://www.alistapart.com">Alistapart</a></li>					
				<li><a href="http://www.cssmania/">CSS Mania</a></li>
			</ul>
			
			<h2>Sponsors</h2>
			<ul class="sidemenu">
				<li><a href="http://www.dreamtemplate.com" title="Website Templates">
                    <strong>DreamTemplate</strong></a> <br /> Over 6,000+ Premium Web Templates</li>
				<li><a href="http://www.themelayouts.com" title="WordPress Themes">
                    <strong>ThemeLayouts</strong></a> <br /> Premium WordPress &amp; Joomla Themes</li>
				<li><a href="http://www.imhosted.com" title="Website Hosting">
                    <strong>ImHosted.com</strong></a> <br /> Affordable Web Hosting Provider</li>
				<li><a href="http://www.dreamstock.com" title="Stock Photos">
                    <strong>Dreamstock</strong></a> <br /> Download Amazing Stock Photos</li>
				<li><a href="http://www.evrsoft.com" title="Website Builder">
                    <strong>Evrsoft</strong></a> <br /> Website Builder Software &amp; Tools</li>
				<li><a href="http://www.webhostingwp.com" title="Web Hosting">
                    <strong>Web Hosting</strong></a> <br /> Top 10 Hosting Reviews</li>
			</ul>
				
			<h2>Wise Words</h2>
				
			<p>&quot;To have a quiet mind is to possess one's mind wholly; to have a calm spirit is to 
			possess one's self.&quot; </p>
					
			<p class="align-right">- Hamilton Mabie</p>
			
			<h2>Support Styleshout</h2>
			<p>If you are interested in supporting my work and would like to contribute, you are
			welcome to make a small donation through the 
			<a href="http://www.styleshout.com/">donate link</a> on my website - it will 
			be a great help and will surely be appreciated.</p>
				
					
	  </div>
				
	<!-- content-wrap ends here -->	
	</div>
					
	<!--footer starts here-->
	<div id="footer">
			
		<p>
		&copy; 2010 <strong>Your Company</strong> |
		<a href="http://www.bluewebtemplates.com/" title="Website Templates">website templates</a> by <a href="http://www.styleshout.com/">styleshout</a> |
		Valid <a href="http://validator.w3.org/check?uri=referer">XHTML</a> | 
		<a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a>   		
   	</p>
				
	</div>	

<!-- wrap ends here -->
</div>
</body>
</html>

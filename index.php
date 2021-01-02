<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.marielouise
 *
 * @copyright   (C) 2017 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;

/** @var Joomla\CMS\Document\HtmlDocument $this */

$app = Factory::getApplication();
$wa  = $this->getWebAssetManager();

// Browsers support SVG favicons
$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon.svg', '', [], true, 1), 'icon', 'rel', ['type' => 'image/svg+xml']);
$this->addHeadLink(HTMLHelper::_('image', 'favicon.ico', '', [], true, 1), 'alternate icon', 'rel', ['type' => 'image/vnd.microsoft.icon']);
$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon-pinned.svg', '', [], true, 1), 'mask-icon', 'rel', ['color' => '#000']);

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');
$menu     = $app->getMenu()->getActive();
$pageclass = $menu !== null ? $menu->getParams()->get('pageclass_sfx', '') : '';

// Template path
$templatePath = 'templates/' . $this->template;

// Color Theme
$paramsColorName = $this->params->get('colorName', 'colors_standard');
$assetColorName  = 'theme.' . $paramsColorName;
$wa->registerAndUseStyle($assetColorName, $templatePath . '/css/global/' . $paramsColorName . '.css');
$this->getPreloadManager()->prefetch($wa->getAsset('style', $assetColorName)->getUri(), ['as' => 'style']);

// Use a font scheme if set in the template style options
$paramsFontScheme = $this->params->get('useFontScheme', false);

if ($paramsFontScheme)
{
	// Prefetch the stylesheet for the font scheme, actually we need to prefetch the font(s)
	$assetFontScheme  = 'fontscheme.' . $paramsFontScheme;
	$wa->registerAndUseStyle($assetFontScheme, $templatePath . '/css/global/' . $paramsFontScheme . '.css');
	$this->getPreloadManager()->prefetch($wa->getAsset('style', $assetFontScheme)->getUri(), ['as' => 'style']);
}

// Enable assets
$wa->usePreset('template.marielouise.' . ($this->direction === 'rtl' ? 'rtl' : 'ltr'))
	->useStyle('template.active.language')
	->useStyle('template.user')
	->useScript('template.user');

// Override 'template.active' asset to set correct ltr/rtl dependency
$wa->registerStyle('template.active', '', [], [], ['template.marielouise.' . ($this->direction === 'rtl' ? 'rtl' : 'ltr')]);

// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="' . Uri::root() . htmlspecialchars($this->params->get('logoFile'), ENT_QUOTES) . '" alt="' . $sitename . '">';
}
elseif ($this->params->get('siteTitle'))
{
	$logo = '<span title="' . $sitename . '">' . htmlspecialchars($this->params->get('siteTitle'), ENT_COMPAT, 'UTF-8') . '</span>';
}
else
{
	$logo = '<img src="' . $templatePath . '/images/logo.svg" class="logo d-inline-block" alt="' . $sitename . '">';
}

$hasClass = '';

if ($this->countModules('sidebar-left'))
{
	$hasClass .= ' has-sidebar-left';
}

if ($this->countModules('sidebar-right'))
{
	$hasClass .= ' has-sidebar-right';
}

// Container
$wrapper = $this->params->get('fluidContainer') ? 'wrapper-fluid' : 'wrapper-static';

$this->setMetaData('viewport', 'width=device-width, initial-scale=1');

$stickyHeader = $this->params->get('stickyHeader') ? 'position-sticky sticky-top' : '';

?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="metas" />
	<jdoc:include type="styles" />
	<jdoc:include type="scripts" />
</head>

    <!-- Bootstrap core CSS -->
	<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  .bd-placeholder-img {
	font-size: 1.125rem;
	text-anchor: middle;
	-webkit-user-select: none;
	-moz-user-select: none;
	user-select: none;
  }

  @media (min-width: 768px) {
	.bd-placeholder-img-lg {
	  font-size: 3.5rem;
	}
  }
</style>


<!-- Custom styles for this template -->
<link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="blog.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo
$this->template ?>/css/blog.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo
$this->template ?>/css/navbar.css" type="text/css" />
</head>
<body>

<div class="container">
<header class="blog-header py-3">
<div class="row flex-nowrap justify-content-between align-items-center">
  <div class="col-4 pt-1">
	<a class="link-secondary" href="#">Subscribe</a>
  </div>
  <div class="col-4 text-center">
	<a class="blog-header-logo text-dark" href="#">Large</a>
  </div>
  <div class="col-4 d-flex justify-content-end align-items-center">
	<a class="link-secondary" href="#" aria-label="Search">
	  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
	</a>
	<a class="btn btn-sm btn-outline-secondary" href="#">Sign up</a>
  </div>
</div>
</header>

<div class="nav-scroller py-1 mb-2">
<nav class="nav d-flex justify-content-between">
<jdoc:include type="modules" name="menu" style="none" />
</nav>
</div>
</div>

<main class="container">
<div class="p-4 p-md-5 mb-4 rounded bg-dark text-white">
	<?php if ($this->countModules('banner')) : ?>
			<div class="grid-child container-banner">
				<jdoc:include type="modules" name="banner" style="html5" />
			</div>
	<?php endif; ?>
</div>
</div>

<div class="row mb-2">
<div class="col-md-6">
  <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
	<div class="col p-4 d-flex flex-column position-static">
	  <strong class="d-inline-block mb-2 text-primary">World</strong>
	  <h3 class="mb-0">Featured post</h3>
	  <div class="mb-1 text-muted">Nov 12</div>
	  <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
	  <a href="#" class="stretched-link">Continue reading</a>
	</div>
	<div class="col-auto d-none d-lg-block">
	  <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>

	</div>
  </div>
</div>
<div class="col-md-6">
  <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
	<div class="col p-4 d-flex flex-column position-static">
	  <strong class="d-inline-block mb-2 text-success">Design</strong>
	  <h3 class="mb-0">Post title</h3>
	  <div class="mb-1 text-muted">Nov 11</div>
	  <p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
	  <a href="#" class="stretched-link">Continue reading</a>
	</div>
	<div class="col-auto d-none d-lg-block">
	  <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>

	</div>
  </div>
</div>
</div>

<div class="row">
<div class="col-md-8">
  <h3 class="pb-4 mb-4 font-italic border-bottom">
	From the Firehose
  </h3>

  <article class="blog-post">
	<h2 class="blog-post-title">Sample blog post</h2>
	<p class="blog-post-meta">January 1, 2014 by <a href="#">Mark</a></p>

	<p>This blog post shows a few different types of content that’s supported and styled with Bootstrap. Basic typography, images, and code are all supported.</p>
	<hr>
	<p>Cum sociis natoque penatibus et magnis <a href="#">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>
	<blockquote>
	  <p>Curabitur blandit tempus porttitor. <strong>Nullam quis risus eget urna mollis</strong> ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
	</blockquote>
	<p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
	<h2>Heading</h2>
	<p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
	<h3>Sub-heading</h3>
	<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
	<pre><code>Example code block</code></pre>
	<p>Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>
	<h3>Sub-heading</h3>
	<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
	<ul>
	  <li>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li>
	  <li>Donec id elit non mi porta gravida at eget metus.</li>
	  <li>Nulla vitae elit libero, a pharetra augue.</li>
	</ul>
	<p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.</p>
	<ol>
	  <li>Vestibulum id ligula porta felis euismod semper.</li>
	  <li>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</li>
	  <li>Maecenas sed diam eget risus varius blandit sit amet non magna.</li>
	</ol>
	<p>Cras mattis consectetur purus sit amet fermentum. Sed posuere consectetur est at lobortis.</p>
  </article><!-- /.blog-post -->

  <article class="blog-post">
	<h2 class="blog-post-title">Another blog post</h2>
	<p class="blog-post-meta">December 23, 2013 by <a href="#">Jacob</a></p>

	<p>Cum sociis natoque penatibus et magnis <a href="#">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>
	<blockquote>
	  <p>Curabitur blandit tempus porttitor. <strong>Nullam quis risus eget urna mollis</strong> ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
	</blockquote>
	<p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
	<p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
  </article><!-- /.blog-post -->

  <article class="blog-post">
	<h2 class="blog-post-title">New feature</h2>
	<p class="blog-post-meta">December 14, 2013 by <a href="#">Chris</a></p>

	<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
	<ul>
	  <li>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li>
	  <li>Donec id elit non mi porta gravida at eget metus.</li>
	  <li>Nulla vitae elit libero, a pharetra augue.</li>
	</ul>
	<p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
	<p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.</p>
  </article><!-- /.blog-post -->

  <nav class="blog-pagination" aria-label="Pagination">
	<a class="btn btn-outline-primary" href="#">Older</a>
	<a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Newer</a>
  </nav>

</div>

<div class="col-md-4">
  <div class="p-4 mb-3">
  	<?php if ($this->countModules('sidebar-right')) : ?>
		<div class="grid-child container-sidebar-right">
			<jdoc:include type="modules" name="sidebar-right" style="default" />
		</div>
	<?php endif; ?>
  </div>

  <div class="p-4">
	<h4 class="font-italic">Archives</h4>
	<ol class="list-unstyled mb-0">
	  <li><a href="#">March 2014</a></li>
	  <li><a href="#">February 2014</a></li>
	  <li><a href="#">January 2014</a></li>
	  <li><a href="#">December 2013</a></li>
	  <li><a href="#">November 2013</a></li>
	  <li><a href="#">October 2013</a></li>
	  <li><a href="#">September 2013</a></li>
	  <li><a href="#">August 2013</a></li>
	  <li><a href="#">July 2013</a></li>
	  <li><a href="#">June 2013</a></li>
	  <li><a href="#">May 2013</a></li>
	  <li><a href="#">April 2013</a></li>
	</ol>
  </div>

  <div class="p-4">
	<h4 class="font-italic">Elsewhere</h4>
	<ol class="list-unstyled">
	  <li><a href="#">GitHub</a></li>
	  <li><a href="#">Twitter</a></li>
	  <li><a href="#">Facebook</a></li>
	</ol>
  </div>
</div>

</div><!-- /.row -->

</main><!-- /.container -->

<footer class="blog-footer">
<p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
<p>
<a href="#">Back to top</a>
</p>
</footer>



</body>


<div class="container">
  <div class="row">
    <div class="col-sm">
		<a href="<?php echo $this->baseurl; ?>/">
			<?php echo $logo; ?>
		</a>
		<?php if ($this->params->get('siteDescription')) : ?>
			<div class="site-description"><?php echo htmlspecialchars($this->params->get('siteDescription')); ?></div>
		<?php endif; ?>
    </div>
    <div class="col-sm">
      Colonne du milieu
    </div>
    <div class="col-sm">
      Colonne de droite
    </div>
  </div>

	<div class="row">
    	<div class="col-8">
			<?php if ($this->countModules('position-1')): ?>
				<div id="nav" class="row<?php echo $fluid ?>">
				<jdoc:include type="modules" name="position-1" style="none" />
				</div>
			<?php endif; ?>
		</div>
    <div class="col-4">
		
		<?php if ($this->countModules('search')) : ?>
			<div class="form-inline">
			<jdoc:include type="modules" name="search" style="none" />
			</div>
		<?php endif; ?>
	
	</div>
  </div>

</div>

<div class="container">
	
  
</div>

<body class="site-grid site <?php echo $option
	. ' ' . $wrapper
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ' ' . $pageclass
	. $hasClass;
	echo ($this->direction == 'rtl' ? ' rtl' : '');
?>">
	<div class="grid-child container-header full-width <?php echo $stickyHeader; ?>">
		<header class="header">
			<nav class="grid-child navbar navbar-expand-lg">
				<div class="navbar-brand">
					<a href="<?php echo $this->baseurl; ?>/">
						<?php echo $logo; ?>
					</a>
					<?php if ($this->params->get('siteDescription')) : ?>
						<div class="site-description"><?php echo htmlspecialchars($this->params->get('siteDescription')); ?></div>
					<?php endif; ?>
				</div>

				<?php if ($this->countModules('menu') || $this->countModules('search')) : ?>
					<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="<?php echo Text::_('TPL_CASSIOPEIA_TOGGLE'); ?>">
						<span class="fas fa-bars" aria-hidden="true"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbar">
						<jdoc:include type="modules" name="menu" style="none" />
						<?php if ($this->countModules('search')) : ?>
							<div class="form-inline">
								<jdoc:include type="modules" name="search" style="none" />
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>

			</nav>
			<?php if ($this->countModules('banner')) : ?>
			<div class="grid-child container-banner">
				<jdoc:include type="modules" name="banner" style="html5" />
			</div>
			<?php endif; ?>
		</header>
	</div>

	<?php if ($this->countModules('top-a')) : ?>
	<div class="grid-child container-top-a">
		<jdoc:include type="modules" name="top-a" style="cardGrey" />
	</div>
	<?php endif; ?>

	<?php if ($this->countModules('top-b')) : ?>
	<div class="grid-child container-top-b">
		<jdoc:include type="modules" name="top-b" style="card" />
	</div>
	<?php endif; ?>

	<?php if ($this->countModules('sidebar-left')) : ?>
	<div class="grid-child container-sidebar-left">
		<jdoc:include type="modules" name="sidebar-left" style="default" />
	</div>
	<?php endif; ?>

	<div class="grid-child container-component">
		<jdoc:include type="modules" name="main-top" style="cardGrey" />
		<jdoc:include type="message" />
		<jdoc:include type="modules" name="breadcrumbs" style="none" />
		<main>
		<jdoc:include type="component" />
		</main>
		<jdoc:include type="modules" name="main-bottom" style="cardGrey" />
	</div>

	

	<?php if ($this->countModules('bottom-a')) : ?>
	<div class="grid-child container-bottom-a">
		<jdoc:include type="modules" name="bottom-a" style="cardGrey" />
	</div>
	<?php endif; ?>

	<?php if ($this->countModules('bottom-b')) : ?>
	<div class="grid-child container-bottom-b">
		<jdoc:include type="modules" name="bottom-b" style="card" />
	</div>
	<?php endif; ?>

	<?php if ($this->countModules('footer')) : ?>
	<footer class="grid-child container-footer footer">
		<hr>
		<p class="float-right">
			<a href="#top" id="back-top" class="back-top">
				<span class="fas fa-arrow-up" aria-hidden="true"></span>
				<span class="sr-only"><?php echo Text::_('TPL_CASSIOPEIA_BACKTOTOP'); ?></span>
			</a>
		</p>
		<jdoc:include type="modules" name="footer" style="none" />
	</footer>
	<?php endif; ?>

	<jdoc:include type="modules" name="debug" style="none" />

</body>
</html>

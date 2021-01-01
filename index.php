<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.bs_blank
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;

/** @var Joomla\CMS\Document\HtmlDocument $this */

$app = Factory::getApplication();
$wa  = $this->getWebAssetManager();

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');
$menu     = $app->getMenu()->getActive();
$pageclass = $menu->getParams()->get('pageclass_sfx');

// Enable assets
$wa->usePreset('template.bs_blank.' . ($this->direction === 'rtl' ? 'rtl' : 'ltr'))
	->useStyle('template.active.language')
	->useStyle('template.user')
	->useScript('template.user');

// Override 'template.active' asset to set correct ltr/rtl dependency
$wa->registerStyle('template.active', '', [], [], ['template.bs_blank.' . ($this->direction === 'rtl' ? 'rtl' : 'ltr')]);

// Preload the stylesheet for the font, actually we need to preload the font
$this->getPreloadManager()->preload('https://fonts.googleapis.com/css?family=Fira+Sans:400', array('as' => 'style'));

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
	$logo = '<img src="' . $this->baseurl . '/templates/' . $this->template . '/images/logo.svg" class="logo d-inline-block" alt="' . $sitename . '">';
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


<div class="container">

<div class="nav-scroller py-1 mb-2">

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  		<div class="container-fluid">
   			<a class="navbar-brand" href="#">Marie-Louise</a>
    		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      		<span class="navbar-toggler-icon"></span>
    		</button>
    		<div class="collapse navbar-collapse" id="navbarSupportedContent">
      			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
        		<li class="nav-item">
          			<a class="nav-link active" aria-current="page" href="#">Accueil</a>
       			</li>
        		<li class="nav-item">
          			<a class="nav-link" href="#">Link</a>
        		</li>
        		<li class="nav-item dropdown">
          			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
          			<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            		<li><a class="dropdown-item" href="#">Action</a></li>
            		<li><a class="dropdown-item" href="#">Another action</a></li>
            		<li><hr class="dropdown-divider"></li>
            		<li><a class="dropdown-item" href="#">Something else here</a></li>
          			</ul>
        		</li>
        		<li class="nav-item">
          			<a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        		</li>
      			</ul>
    			<form class="d-flex">
        		<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        		<button class="btn btn-outline-success" type="submit">Rechercher</button>
      			</form>
    		</div>
  		</div>
	</nav>

</div>
</div>

<main class="container">
<div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
	<div class="col-md-6 px-0">
		<h1 class="display-4 font-italic">Position Banner</h1>
		<p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.</p>
		<p class="lead mb-0"><a href="#" class="text-white fw-bold">Continuer la lecture...</a></p>
	</div>
</div>

<div class="row mb-2">
	<div class="col-md-6">
		<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
			<div class="col p-4 d-flex flex-column position-static">
				<strong class="d-inline-block mb-2 text-primary">Catégorie 1</strong>
				<h3 class="mb-0">Module Top A</h3>
				<div class="mb-1 text-muted">Date</div>
				<p class="card-text mb-auto">Introduction du texte de l'article.</p>
				<a href="#" class="stretched-link">Continuer la lecture</a>
			</div>
			<div class="col-auto d-none d-lg-block">
				<svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Miniature</text></svg>

			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
			<div class="col p-4 d-flex flex-column position-static">
				<strong class="d-inline-block mb-2 text-success">Catégorie 2</strong>
				<h3 class="mb-0">Module Top A</h3>
				<div class="mb-1 text-muted">Date</div>
				<p class="mb-auto">Introduction du texte de l'article.</p>
				<a href="#" class="stretched-link">Continuer la lecture</a>
			</div>
			<div class="col-auto d-none d-lg-block">
				<svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Miniature</text></svg>

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
			<h1 class="blog-post-title">Article blog en vedette</h1>
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
		<div class="p-4 mb-3 bg-light rounded">
			<h4 class="font-italic">About</h4>
			<p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
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

	<jdoc:include type="modules" name="debug" style="none" />

</body>
</html>

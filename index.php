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
		<header class="blog-header py-3">
		<div class="row flex-nowrap justify-content-between align-items-center">
		  <div class="col-4 pt-1">
			<a class="text-muted" href="#">Subscribe</a>
		  </div>
		  <div class="col-4 text-center">
			<a class="blog-header-logo text-dark" href="#">Large</a>
		  </div>
		  <div class="col-4 d-flex justify-content-end align-items-center">
			<a class="text-muted" href="#" aria-label="Search">
			  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24" focusable="false"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
			</a>
			<a class="btn btn-sm btn-outline-secondary" href="#">Sign up</a>
		  </div>
		</div>
		</header>

		<div class="nav-scroller py-1 mb-2">
		<nav class="nav d-flex justify-content-between">
		  <a class="p-2 text-muted" href="#">World</a>
		  <a class="p-2 text-muted" href="#">U.S.</a>
		  <a class="p-2 text-muted" href="#">Technology</a>
		  <a class="p-2 text-muted" href="#">Design</a>
		  <a class="p-2 text-muted" href="#">Culture</a>
		  <a class="p-2 text-muted" href="#">Business</a>
		  <a class="p-2 text-muted" href="#">Politics</a>
		  <a class="p-2 text-muted" href="#">Opinion</a>
		  <a class="p-2 text-muted" href="#">Science</a>
		  <a class="p-2 text-muted" href="#">Health</a>
		  <a class="p-2 text-muted" href="#">Style</a>
		  <a class="p-2 text-muted" href="#">Travel</a>
		</nav>
		</div>

		<div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
		<div class="col-md-6 px-0">
		  <h1 class="display-4 font-italic">Title of a longer featured blog post</h1>
		  <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.</p>
		  <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Continue reading...</a></p>
		</div>
		</div>

		<div class="row mb-2">
		<div class="col-md-6">
		  <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
			<div class="col p-4 d-flex flex-column position-static">
			  <strong class="d-inline-block mb-2 text-primary">World</strong>
			  <h3 class="mb-0">Featured post</h3>
			  <div class="mb-1 text-muted">Nov 12</div>
			  <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
			  <a href="#" class="stretched-link">Continue reading</a>
			</div>
			<div class="col-auto d-none d-lg-block">
			  <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
			</div>
		  </div>
		</div>
		<div class="col-md-6">
		  <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
			<div class="col p-4 d-flex flex-column position-static">
			  <strong class="d-inline-block mb-2 text-success">Design</strong>
			  <h3 class="mb-0">Post title</h3>
			  <div class="mb-1 text-muted">Nov 11</div>
			  <p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
			  <a href="#" class="stretched-link">Continue reading</a>
			</div>
			<div class="col-auto d-none d-lg-block">
			  <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
			</div>
		  </div>
		</div>
		</div>
	</div>

	<main role="main" class="container">
		<jdoc:include type="message" />
	  <div class="row">
		<div class="col-md-8 blog-main">
			<div class="container-component">
				<jdoc:include type="component" />
				<jdoc:include type="modules" name="main-bottom" style="cardGrey" />
			</div>

		</div><!-- /.blog-main -->

		<aside class="col-md-4 blog-sidebar">
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
		</aside><!-- /.blog-sidebar -->

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

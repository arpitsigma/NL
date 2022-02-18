<?php
function cmpg_add_instructions()
{
	add_options_page('Instructions', 'Cactus Masonry', 'manage_options', 'cactus-masonry-options.php', 'cmpg_instructions_page');
}

function cmpg_instructions_page()
{
?>
	<h2>Cactus Masonry Instructions</h2>
	<p>
		For a detailed description of the plugin, thorough instructions, and some really useful tools, visit the <a href="http://cactuscomputers.com.au/masonry" target="_blank">Cactus Masonry website</a>.
	</p>
	<h3>What is Cactus Masonry?</h3>
	<p>
		Cactus Masonry is a highly customizable gallery plugin that can display a list of post or page thumbnails almost anywhere on a WordPress website.
	</p>
	<p>
		Cactus Masonry is also shortcode plugin.  This means the plugin has no global options.  This also means that Cactus Masonry can be used just about anywhere you want on your website and in a different way each time.
	</p>
	<p>
		The catch however is that you have to type a shortcode to use the plugin.  This can be complicated, but don’t worry – we have supplied just the tools you need to get Cactus Masonry up and running in no time.
	</p>
	<h3>How to Use Cactus Masonry</h3>
	<p>
		To use Cactus Masonry, just place the Cactus Masonry shortcode on any page or post on your site.  You can even place Cactus Masonry in a text widget if you are using the Widgets Everywhere plugin.  
	</p>
	<p>
		The Cactus Masonry shortcode will look like this <code>[cactus-masonry]</code> at its most simple.  Viewing (or previewing) any page containing this will display a basic gallery – but it won’t look very nice.  To make the gallery look nice, you will need to specify different settings, like which posts you want to display, how wide you want the images to be, and so forth.  There are a lot of settings to choose from, so without help this could become pretty complicated.
	</p>
	<p>
		Here is a demonstration shortcode to get you started: <code>[cactus-masonry width='33.3%' show_pages='true']</code>.
	</p>
	<p>
		Pasting this into one of your posts or pages will cause a gallery to appear containing the thumbnails of your posts and pages.  Each image in the gallery will be one third of the gallery area wide.
	</p>
	<p>
		It may still look complex, but never fear!  We have created a special shortcode generator that will help you set up the plugin just how you want.  Just copy the shortcode from the generator and into your WordPress website and it will be good to go.
	</p>
	<h3>Cactus Masonry is only showing square cropped images in the gallery</h3>
	<p>
		The gallery can only the images available on your site.  If WordPress is cropping your images to be squares - then Cactus Masonry will only show squares.  
	</p>
	<p>
		In WordPress, under Settings | Media, there is the option to "Crop thumbnail to exact dimensions (normally thumbnails are proportional)".  Deselecting this will allow Cactus Masonry to function normally.  You may also want to specify some more relevant (and larger) thumbnail sizes here to optimize performance.
	</p>
	<p>
		If changes here seem to have no effect on the gallery, try hard refreshing the page to remove old versions of the thumbnails from your browsers cache - i.e. Ctrl+F5.
	</p>
	<p>
		If there is still no improvement, you will need to rebuild your media thumbnails.  This can easily be done by installing and running a plugin such as "Regenerate Thumbnails".  Try hard refreshing the gallery again to see the new non-cropped thumbnails.
	</p>
	<h3>Important Links:</h3>
	<ul style="list-style: none; font-size:1.1em;">
		<li>
			<a href="http://cactuscomputers.com.au/masonry" target="_blank">
				The Cactus Masonry Home Page
			</a>
		</li>
		<li>
			<a href="http://cactuscomputers.com.au/masonry/how-to-use/" target="_blank">
				Instructions
			</a>
		</li>
		<li>
			<a href="http://cactuscomputers.com.au/masonry/shortcode-generator/" target="_blank">
				Shortcode Generator
			</a>
		</li>
		<li>
			<a href="http://cactuscomputers.com.au/masonry/gallery-options/" target="_blank">
				Shortcode Settings List
			</a>
		</li>
		<li>
			<a href="http://cactus.cloud/support/" target="_blank">
				Support Forum
			</a>
		</li>
	</ul>
	<br/>
	<p>
		While Cactus Masonry is completely free, we do accept <a href='https://www.paypal.com/cgi-bin/webscr?cmd=_donations&amp;business=cactus%40cactuscomputers%2ecom%2eau&amp;lc=AU&amp;currency_code=AUD&amp;bn=PP%2dDonationsBF%3abtn_donate_LG%2egif%3aNonHosted'>donations</a> from anyone who is happy with what we are doing.
	 </p>
<?php
}
?>
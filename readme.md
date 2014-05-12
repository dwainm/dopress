DoPress
=======

An elegant to do list app built on WordPress. Now you own your todo list data.

Roadmap:
=======

v2 (wordpress plugin)

* implement page take over 
* add admin link to footer

API
* configure api plugin / set DoPress inactive when this plugin is not loaded and give linke to install this plugin directly fromt th admin interface
* implement access so that post types only show for certain users/owner (if author == current user show list yay !) do this in the API

Front End:
* hook up models with WordPress data
* delete items from the front end
* hightlight all text when editing
* implement local storage 

Finalize 2.0.0
* comment all files / commit comments / comment classes :

 * Checkout
 *
 * The WooCommerce checkout class handles the checkout process, collecting user data and processing the payment.
 *
 * @class 		WC_Cart
 * @version		2.1.0
 * @package		WooCommerce/Classes
 * @category	Class
 * @author 		WooThemes

* create the branch 
* set 2.1 goals
* Launch on WP.org and on dwainm.com

Future
* multiple lists / via taxonomies 
* integrate customizer on the page that shows the todo (user clicks customize [only if setup correctly ]) and ti take them to the selected page in the customizer with some basic customizer settings

HOURS log (just to see how many dev hours it took from version 1 to 2):
-	20 (thursday 1 -friday 2 may ) cpt errors and structuring admin menu
- 	8  custom meta boxes (creating and saving)
-	

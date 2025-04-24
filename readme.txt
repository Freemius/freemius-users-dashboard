=== Freemius Customer Portal ===
Contributors: freemius, svovaf
Plugin URI: https://freemius.com
License: MIT
License URI: https://opensource.org/licenses/mit
Tags: freemius, users dashboard, members dashboard, customers portal, members area
Requires at least: 3.1
Tested up to: 4.9
Stable tag: 1.0.0

An easy way to embed a fully-featured Customer Portal for Freemius powered shops and products.

== Description ==

An easy way to embed a fully-featured Customer Portal for Freemius powered shops and products.

= How to use it? =
1. Create a new page on your website. We recommend using one of the following slugs: `users`, `account`, `members`.
2. Login to your Freemius dashboard and go to the store settings by hovering the mouse over the top-right menu and clicking “My Store”.
3. Paste the URL address of the page that you’ve just created into the “Dashboard URL” setting. Make sure that the protocol (HTTP or HTTPS) is accurate, otherwise, the dashboard will not load!
4. Copy and replace the `<storeID>` with your store ID, `<storePublicKey>` with your store’s public key, and `<headerHeight>` with your site’s header height in the following shortcode and add it to your newly created page:
  `[fs_members store_id="<storeID>" public_key="<storePublicKey>" position="fixed" left="0" right="0" top="<headerHeight>px" bottom="0"]`
  
  If your site’s header height is responsive, you can customize the portal’s position with media queries by styling the iframe’s `<div id=”fs_dashboard_container”>` container.

[Complete installation instructions](http://freemius.com/fs-site/help/documentation/selling-with-freemius/users-account/)

== Installation ==

1. Upload the `freemius-users-dashboard` folder to the `/wp-content/plugins/` directory
2. Activate the Freemius WordPress Customer Portal plugin from the 'Plugins' menu in the WordPress Administration section.

== Changelog ==

=1.0.0=
* Initial release.
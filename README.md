# Post Data to JavaScript
## WordPress Plugin

Post Data to JavaScript (PDJ) finds custom fields in any post type, converts them into a JavaScript object and puts them on the DOM for any other JavaScript script, library or framework to use. The object lives on the global scope and is namespaced with the object name `postData`.

If compared to a REST API or something that allows full database functions via HTTP (create, read, update, delete), then PDJ may be considered similar to a `GET` function. If you are looking for a more comprehensive API for fully interacting with the database, then this plugin is not for you. Try [WP-API](http://v2.wp-api.org/) instead, or wait until it gets fully integrated into WordPress core.

PDJ is best for a quick and low-maintenance way to put custom field data onto the DOM as JavaScript. This way, depending on the nature of your data, you may manage it with libraries and frameworks like React, Knockout, Backbone (which ships natively in WordPress, by the way), jQuery (also native), and more. You can also use specialized libraries like D3 and chart.js to graphically render data. How cool is that?

PDJ deliberately excludes fields that begin with underscore `_` which are considered private, i.e. `_my_private_field`. It is not a good idea to expose to your users more than necessary.

### How to use Post Data to JavaScript
Install the plugin by cloning this repository or uploading the zip file to your WordPress installation. Follow the instructions in the `Settings -> Post Data to JavaScript` menu and select the post or posts whose custom fields you want on the DOM.

After selecting the post types to use, your custom JavaScript files will have access to the `postData` object. See below how the object is built.

One usage suggestion is to write a custom script similar to `post-data-to-javascript-sample.js` that ships as an example with this plugin in the folder `/public/js/`. Put the following code in your PHP template files to display the JavaScript data:

`<div id="postdata"></div>`

and then render it on the DOM with your favorite JavaScript tools. Here is a simple example using jQuery in the sample JavaScript file:

`$('#postdata').html(postData.myCustomField)`

##### Remember to keep your data secure and use all recommended validation, sanitization and escaping techniques with your data. For simplicity, these security tools are omitted in the sample JavaScript file.

Depending on how your WordPress theme is set up, this code snippet or any script to render the `postData` JavaScript object may go into any of these files:
`single.php`
`singular.php`
`page.php`
`single-{my-custom-post-type}.php`
`index.php`

Aside from that, you should implement your own scripts to render the data to your liking. Remember to enqueue all scripts properly. See the WordPress Codex for more information.

When enqueuing your custom script, add jQuery as a dependency with the line `array( 'jquery' )` so that your script loads after it. Otherwise your script may not see the `postData` and not render it properly. See the documentation on `wp_enqueue_script` in the WordPress Codex for more details.

##### Caution: This plugin has not been designed or tested for WordPress archive pages, including `index.php` when it is used as an archive or a 'blog posts' page. Results will be unpredictable and may break your site!

### What does my JavaScript Object look like?
The object looks as follows. Remember that it will be placed on the global scope.

```
postData: {
  custom_field_one: "value1",
  custom_field_two: "value2",
  custom_field_three: "value3"
}
```

### Feature Wishlist
These are some features I may add in the future:
- ability to select which custom fields from each post type will be used
- ability to specify native fields, such as title, author, content, excerpt, taxonomy
- ability to set the name of the JavaScript object in order to avoid namespace collisions


### Caution
As this plugin is based on the excellent [WordPress Plugin Boilerplate](http://wppb.io/), it is optimized for performance and safety. See its documentation for more information. Use caution when putting this plugin onto a production site and be sure to follow all recommendations for security and stability.

Every input from the user and output from the database should be sanitized, validated and escaped as appropriate. Use at your own risk.


#### Dependencies
- Built on WordPress 4.5.3. Not tested with earlier versions of WordPress.
- jQuery

Do NOT deregister WordPress's native jQuery and replace it with a newer version of jQuery, such as from a remote CDN or your own build. The `postData` object is attached to the native WordPress jQuery and will be lost.


#### Documentation
This is work in progress. I will add more to it as I add more features. Pull requests are welcome!


#### License
GPL2

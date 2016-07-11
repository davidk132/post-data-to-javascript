# Post Type to JavaScript
## WordPress Plugin

Post Type to JavaScript (PTJ) finds custom fields in any post type, converts them into a JavaScript object and puts them on the DOM for any other JavaScript script, library or framework to use. The object lives on the global scope and is namespaced with the object name `postData`.

If compared to a REST API or something that allows full database functions via HTTP (create, read, update, delete), then PTJ may be considered a `GET` function. If you are looking for a more comprehensive API for fully interacting with the database, then this plugin is not for you. You may wish to try [WP-API](http://v2.wp-api.org/) instead, or wait until it gets full integrated into WordPress core.

PTJ is best used for a quick and low-maintenance to put custom field data onto the DOM as a JavaScript. This way, depending on the nature of your data, you may manage it with libraries and frameworks like React, Knockout, Backbone (which ships natively in WordPress, by the way), jQuery (also native), and more. You can also use specialized libraries like D3 and chart.js to graphically render data. How cool is that?

PTJ deliberately excludes fields that begin with underscore `\` which are considered private, i.e. `_my_private_field`. It is not a good idea to expose to your users more than necessary.

### How to use Post Data to JavaScript
Install the plugin by cloning this repository or uploading the zip file to your WordPress installation. Follow the instructions in the `Settings -> Post Data to JavaScript` menu and select the post or posts whose custom fields you want on the DOM.

Your HTML may include the following code to display the JavaScript data:

`<div id="postdata"></div>`

Depending on how your WordPress theme is set up, this code snippet or any script to render the `postData` JavaScript object may go into any of these files:
`single.php`
`singular.php`
`page.php`
`single-{my-custom-post-type}.php`
`index.php`

Aside from that, you should implement your own scripts to render the data to your liking. Remember to enqueue all scripts properly. See the WordPress Codex for more information.

##### Caution: This plugin has not been designed or tested for archive pages, include `index.php` when it is an archive or a `posts` page. Results will be unpredictable and may break your site!

### What does my JavaScript Object look like?
The object looks as follows. Remember that it will be placed on the global scope.

`
postData: {
  custom_field_one: "value1",
  custom_field_two: "value2",
  custom_field_three: "value3"
}
`

### Feature Wishlist
These are some features I may add in the future:
- ability to select which custom fields from each post type will be used
- ability to specify native fields, such as title, author, content, excerpt, taxonomy


### Warning
As this plugin is based on the excellent [WordPress Plugin Boilerplate](http://wppb.io/), it is optimized for performance and safety. Use caution when putting this plugin onto a production site and be sure to follow all recommendations for security and stability.

Every input from the user and output from the database should be sanitized, validated and escaped as appropriate. Use at your own risk.

#### Documentation
This is work in progress. I will add more to it as I add more features.

#### License
GPL2

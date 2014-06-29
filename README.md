Simple Course Creator Post Meta
=====================

View it on WordPress: (http://wordpress.org/plugins/simple-course-creator-post-meta/)

This is an add-on plugin for use with the [Simple Course Creator](https://github.com/sdavis2702/simple-course-creator) plugin.

Simple Course Creator is designed to easily link posts together in a series and output that series list in the content of each included post.

This post meta add-on outputs additional information about each post in the post listing. The information displays right beneath the post title.

### How It Works
---

Once activated, the post authors and dates published will appear beneath the post titles.

![Simple Course Creator Post Meta](http://buildwpyourself.com/wp-content/uploads/edd/2014/03/sccpm-output.png)

### Settings and Customizer
---

Once activated, new options will be added to the SCC settings page under the display tab. You can hide the author, date, or both.

![Simple Course Creator Post Meta Settings](http://buildwpyourself.com/wp-content/uploads/edd/2014/03/sccpm-settings.png)

New customizer options will also be available. If you have [Simple Course Creator Customizer](http://buildwpyourself.com/downloads/scc-customizer/) installed, your new settings will be merged. Otherwise, they will appear on their own.

**With Simple Course Creator Customizer:**

![Simple Course Creator Post Meta Customizer Settings](http://buildwpyourself.com/wp-content/uploads/edd/2014/03/sccpm-sccc.png)

**Without Simple Course Creator Customizer:**

![Simple Course Creator Post Meta Customizer Settings](http://buildwpyourself.com/wp-content/uploads/edd/2014/03/sccpm-customizer.png)

### Theme Overrides
---

You can edit the post meta output using the following filters in your **theme** functions file.

For the "written by" text:

```php
function your_filter_name( $content ) {
	$content = str_replace( 'written by', 'post author', $content );
	return $content;
}
add_filter( 'written_by', 'your_filter_name' );
```

For the "on" text:

```php
function your_other_filter_name( $content ) {
	$content = str_replace( 'on', 'date', $content );
	return $content;
}
add_filter( 'written_on', 'your_other_filter_name' );
```

### Bugs and Contributions
---

If you notice any mistakes, feel free to fork the repo and submit a pull request with your corrections. The same is true of any features you feel should be added or changes that can be made. 

### License
---

This plugin, like WordPress, is licensed under the GPL. Do what you want with it. I seriously don't care. 

### Developer
---

I'm Sean. I created the [Volatyl Framework](http://volatylthemes.com) for WordPress. I like to do most of my WordPress stuff on [Build WordPress Yourself](http://buildwpyourself.com/). I also write stuff on my [personal site](http://seandavis.co) and [SDavis Media](http://sdavismedia.com). Follow me on the [Twitter](http://sdvs.me/twitter) machine.

Meanwhile, tell me... is this plugin useful to you? If so, consider buying me a box of "Tazo: Awake - English Breakfast Black Tea." I need ALL the energiez. Thanks. [Donate Black Tea](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=52HQDSEUA542S)
This is an unmaintained fork for WP Comments Fields Manager plugin

Original: https://wordpress.org/plugins/wp-comment-fields/

All that has been really been done is fixing some path references and removing die() functions.
Both of these were causing breakage, including to WP CLI.

The original used a hardcoded slug and which in turn was being put into an object $plugin_meta,
however, then that object was get called in methods that didn't actually have access to it.
Rather than fix that I just replaced those usages with get functions which is how I prefer
to do things.

While this fork may work for you, I'd encourage you to switch back to the offical
version from the .org repo as soon as it is updated.

Please see this forum thread for more info
https://wordpress.org/support/topic/plugin-still-kills-cli-execution-2/

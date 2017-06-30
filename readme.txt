IOM Meta is a simple custom post type for WordPress, that includes the following meta fields:

Text
Email
URL
Textarea
Time picker
Color picker
Checkbox
Radio buttons
Select dropdown
Text editor
Single image/file upload
Multiple image/file upload
Embed video (Youtube, Twitter and such)


Installation:

1. Put the ion-meta folder in your plugin folder

2. Move the single-iom.php file to the theme folder !IMPORTANT - The file will work in the plugin directory, but when you update the plugin your changes will be erased if you do not move it.

3. Save your permalink to “Post name” under settings. Even if you have this already, you need to save changes again.

3. Ready!


Customisation:

1. You can edit the single-iom page, which shows the single content. In the file you will find examples on how you output the meta fields.

2. As default the plugin uses the themes archive.php for showing posts. You can override this, by moving the archive-iom.php to the theme folder.

3. In the iom-meta.php file, you can edit the post-type name, add/edit or delete meta fields

4. The URL for the archive is the post-type name, by default /iom/. When you change the post name, the URL will change as well.

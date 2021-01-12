# Laravel App Menus for UAB Pathology - GDB

### Requires
* Bootstrap 4 for default view
* FontAwesome if using icons
* Menu only displays for authenticated views
* isAdmin() implemented in the User model
* user_groups table using id as the primary key

### Getting Started
Install the package via composer, publish the vendor files, and migrate the new menu tables
```shell
composer require aflanry/menus --dev
php artisan vendor:publish
php artisan migrate
```

Edit config/menu.php using the template with your menu. Then you can seed the database with the values in the config file.

```shell
php artisan db:seed --class=MenuSeeder
```

Finally the sass and javascript for the menus must be added to your bundles
```sass
@import("vendor/menu/_menu");
```

```javascript
require('./vendor/menu/menu');
```



### Editing the menu view
The menu view is published in the resources/views/vendor/menu folder
You can edit the menu as you see fit!

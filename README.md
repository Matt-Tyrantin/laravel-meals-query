# laravel-meals-query
Laravel URL query for fetching specific meals from database. Includes seeds and migrations for filling the required database. 
This isn't a serious project, rather an experiment.

**menu** database consists of various tables: **meals**, **categories**, **ingredients**, **tags** with their respective translation 
and pivot tables. [dimsav/laravel-translatable](https://github.com/dimsav/laravel-translatable) is used for translation tables/models.
# Usage
## Config
You can configure number of seeded items in *\config\seeder.php*. Seeder uses [fzaninotto/Faker](https://github.com/fzaninotto/Faker) 
and [jzonta/FakerRestaurant](https://github.com/jzonta/FakerRestaurant) with unique attributes, so it is possible to not have enough 
names - keep the numbers low.

If you are not using PHPMyAdmin or have changed username/password, head over to *\\.env* and change
```
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=menu
DB_USERNAME=root
DB_PASSWORD=
```
to the ones that match your settings.
## Filling tables
Make sure you navigate with CmdUtl to the project's folder. To immediatly migrate and seed tables use:
```
php artisan migrate:refresh --seed
```
This instruction can be used to refresh tables with new data.
## Query
Query has parameters:
- *per_page* - (optional) indicates how many items are shown per page
- *page* - (optional) indicates the current page user is on. Is always shown.
- *category* - (optional) filters all **meals** by a *category_id*. It can be NULL or !NULL, in which case it will show **meals** without a 
**category** or all **meals** with a **category**
- *tags* - (optional) searches **meals** with indicated **tags** (their id). Several can be listed (seperated by comma), in which case
selects only those **meals** that have all listen **tags**
- *with* - (optional) list of keywords (ingredients, tags, category) which indicate if we want them to be shown in JSON
- *lang* - (required) language in which attributes will be returned. Since all translatable data is filled with fakers, the translated
attributes won't make sense
- *diff_time* - (optional) UNICODE timestamp. If used, returns all **meals** which were created, modified or deleted after that date

An example of a query would be 
```
http://localhost/meals?per_page=5&tags=2&lang=hr&with=ingredients,category,tags&diff_time=1493902343&page=2
```

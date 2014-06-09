Webnula
=======

WebNula content system managment based on Yii framework.

## Installation

You must have installed svn and git on you server.

```
cd path/to/your/web/root
composer create-project -s dev webnula/webnula .
```

Then import `frontend/runtime/dump.sql` to your MySQL database and path db section in `common.config.php` file.


## Admin panel

Go to `http://site.ru/cms/` and log in with login: `admin` and password: `guest123`.

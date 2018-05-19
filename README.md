***Apache LOG Files Parser***
========================
**Intro**

Parser for command line
 
**Create database**

```
bin/console doctrine:database:create
```

**Execute migrations**
```
bin/console doctrine:migrations:migrate
```

**Usage**
On project dir
```
bin/console parser:run
```

**Apache Configuration**

Virtual host example
```
<VirtualHost *:80>
	ServerName test.loc
	ServerAdmin kenanduman1988@gmail.com
	DocumentRoot /var/www/html/test
	ErrorLog ${APACHE_LOG_DIR}/error.log
	LogFormat "%h %l %u %t \"%r\" %>s %b" testloc
	CustomLog ${APACHE_LOG_DIR}/test_access.log testloc
</VirtualHost>
```

**Description**

If you want to change default log directory from "/var/log/apache2" to another please edit access_log_path in app/config/parameters.yml file

--------------


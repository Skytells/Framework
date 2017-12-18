<?
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['dsn']      The full DSN string describe a connection to the database.
|	['host'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['driver'] The database driver. e.g.: mysqli.
|			Currently supported:
|				 cubrid, ibase, mssql, mysql, mysqli, oci8,
|				 odbc, pdo, postgre, sqlite3, sqlsrv
|	['prefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Query Builder class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['charset'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['encrypt']  Whether or not to use an encrypted connection.
|
|			'mysql' (deprecated), 'sqlsrv' and 'pdo/sqlsrv' drivers accept TRUE/FALSE
|			'mysqli' and 'pdo/mysql' drivers accept an array with the following options:
|
|				'ssl_key'    - Path to the private key file
|				'ssl_cert'   - Path to the public key certificate file
|				'ssl_ca'     - Path to the certificate authority file
|				'ssl_capath' - Path to a directory containing trusted CA certificates in PEM format
|				'ssl_cipher' - List of *allowed* ciphers to be used for the encryption, separated by colons (':')
|				'ssl_verify' - TRUE/FALSE; Whether verify the server certificate or not ('mysqli' only)
|
|	['compress'] Whether or not to use client compression (MySQL only)
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|	['ssl_options']	Used to set various SSL options that can be used when making SSL connections.
|	['failover'] array - A array with 0 or more data for connections if the main should fail.
|	['save_queries'] TRUE/FALSE - Whether to "save" all executed queries.
| 				NOTE: Disabling this will also effectively disable both
| 				$this->db->last_query() and profiling of DB queries.
| 				When you run a query, with this setting set to TRUE (default),
| 				Skytells Framework will store the SQL statement for debugging purposes.
| 				However, this may cause high memory usage, especially if you run
| 				a lot of SQL queries ... disable this to avoid that problem.
|
|	['raw'] TRUE/FALSE - allows models to access to the pure handlers such as (mysqli)
| The $dbconfig['ACTIVE_GROUP']  variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $dbconfig['QUERYBUILDER'] variables lets you determine whether or not to load
| the query builder class.
*/

$dbconfig['ACTIVE_GROUP'] = 'Default';
$dbconfig['QUERYBUILDER'] = FALSE;


// Here you can use a multiple databases.
$DBGroups['Default'] = Array (
			'dsn'	=> '',
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => 'mysql',
			'database' => 'test',
			'driver' => 'mysqli',
			'port'		 => 3306,
			'charset'   => 'utf8',
		  'collation' => 'utf8_unicode_ci',
		  'prefix'    => '',
			'pconnect' => FALSE,
			'db_debug' => (ENVIRONMENT !== 'production'),
			'cache_on' => FALSE,
			'cachedir' => '',
			'swap_pre' => '',
			'encrypt' => FALSE,
			'compress' => FALSE,
			'stricton' => FALSE,
			'failover' => array(),
			'save_queries' => TRUE,
			'raw' => TRUE,
			'illuminate' => FALSE,
			'illuminatedriver' => 'mysql');




/*
| -------------------------------------------------------------------
| ILLUMINATE DATABASES & Eloquents Relationships
| -------------------------------------------------------------------
| Database tables are often related to one another.
| For example, a blog post may have many comments, or an order could be
| related to the user who placed it. Eloquent makes managing and working
| with these relationships easy, and supports several different types of
| relationships:
| * One To One
| * One To Many
| * Many To Many
| * Has Many Through
| * Polymorphic Relations
| * Many To Many Polymorphic Relations
| Eloquent relationships are defined as methods on your Eloquent model classes.
| Since, like Eloquent models themselves, relationships also serve as powerful
| query builders, | defining relationships as methods provides powerful method
| chaining and querying capabilities
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	$Illuminate['ORM'] Enables or Disables ORM
|	$Illuminate['DATABASE'] The Default Database Group which used for creating
| the first Connection.
| NOTE: That you can also use a multiple databases.
| SEE: https://developers.skytells.net/Framework for more info.
| -------------------------------------------------------------------*/

$Illuminate = [
	'ORM' => FALSE,
	'DATABASE' => 'Default',
];

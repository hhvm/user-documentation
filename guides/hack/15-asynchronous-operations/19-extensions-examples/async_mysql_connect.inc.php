<?hh

namespace Hack\UserDocumentation\AsyncOps\Extensions\Examples\AsyncMysql;

class ConnectionInfo {
  /*
  Default values are "localhost", "testuser", database "testdb" and
  "testpassword" password. Change the values if you want to use another
  configuration.
  */

  public static string $host = "localhost";
  public static int $port = 3306;
  public static string $user = "testuser";
  public static string $passwd = "testpassword";
  public static string $db = "testdb";
}

/*

This is the test table too

CREATE TABLE test_table (
userID SMALLINT UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
name VARCHAR(40) NOT NULL,
age SMALLINT NULL,
email VARCHAR(60) NULL,
PRIMARY KEY (userID)
);

*/

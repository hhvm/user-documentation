<?hh

function get_connection_info(): array<mixed> {
  /*
  Default values are "localhost", "testuser", database "testdb" and
  "testpassword" password. Change the values if you want to use another
  configuration.
  */

  $host   = "localhost";
  $port   = 3306;
  $user   = "testuser";
  $passwd = "testpassword";
  $db     = "testdb";
  return array($host, $port, $db, $user, $passwd);
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

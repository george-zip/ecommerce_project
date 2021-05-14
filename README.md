### Notes for running on cpanel

These issues did not come up while running locally unfortunately.

1. SQL is case-sensitive so make sure table and column names are correct.
2. Redirect i.e. `header(foo.php)` will not work if the page echos any output before the `header` command. So get rid of
   any debug `echo` statements before the redirect. There's one in `connection.php` FYI. Here's some background on this
   issue: https://stackoverflow.com/questions/21226166/php-header-location-redirect-not-working.
3. Cpanel enforces naming conventions for the database and minimal password requirements.
    - You will need to create your own user and password and give it access to your cpanel copy of DrumCenterWorld.
    - Update `connection.php` to use the user and password you create (and remember database name is case-sensitive too)
      .
4. The original `DrumCenterWorld.sql` will not work without changes. I've removed what I believe are the offending parts
   any updated the version in the repo.

Please update this doc if you find other issues.

var page = require('webpage').create();
page.open('http://cheapfirstclass.com/api/test.php', function() {
  page.render('/home/admin/web/cheapfirstclass.com/public_html/api/screen.png');
  phantom.exit();
});

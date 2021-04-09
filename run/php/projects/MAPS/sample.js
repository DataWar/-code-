var casper = require('casper').create();

casper.start('http://casperjs.org/', function() {
    this.echo(this.getTitle());
});

casper.thenOpen('http://phantomjs.org', function() {
    this.echo(this.getTitle());
});

casper.run();


// http://docs.casperjs.org/en/latest/quickstart.html
// Run it (on windows):
// C:\casperjs\bin> casperjs.exe sample.js
//https://github.com/segmentio/nightmare
// https://stackoverflow.com/questions/2910221/how-can-i-login-to-a-website-with-python/28628514#28628514  # python webbot

// https://github.com/ariya/phantomjs/issues/13923

// https://stackoverflow.com/questions/36481481/casperjs-memory-exhausted
// var casper = require('casper').create();
var casper = require('casper').create({
verbose : true,
logLevel : "info",
pageSettings : {
loadImages : false, // do not load images
loadPlugins : false // do not load NPAPI plugins (Flash, Silverlight, ...)
}
});



var fs = require('fs');
var utils = require('utils');

var x = require("casper").selectXPath;

// casper.userAgent("Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
casper.userAgent('Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/536.5 (KHTML, like Gecko) Chrome/19.0.1084.56 Safari/536.5');






// http://docs.casperjs.org/en/latest/cli.html
	// console.dir(casper.cli);
	// utils.dump(casper.cli);
	
	// casper.run();

// casper.start('https://jcb.lunaimaging.com/luna/servlet/view/all', function() {
    // this.echo(this.getTitle());
// });

var remote 	= casper.cli.raw.get('remote');
console.log("\n\n" + remote + "\n\n");

casper.start(remote, function() {
    this.echo(this.getTitle());
});
 

var sleep 	= casper.cli.raw.get('sleep'); 
console.log("\n\n" + sleep + "\n\n");
casper.wait(sleep);

var local 	= casper.cli.raw.get('local'); 
console.log("\n\n" + local + "\n\n");

casper.then(function() {
		// casper.capture("Image.png");
		var content = this.evaluate(function() {
			return document; 
		});
		
		// this.echo(content.all[0].outerHTML); 
		page = content.all[0].outerHTML;
		fs.write(local, page, "wb");
		
		
});

casper.run();

// casperjs get.remote.html.js --remote=https://jcb.lunaimaging.com/luna/servlet/view/all?os=0 --local=Q:/project-MAPS/2021-04/jcb/pages/0001/index.html --sleep=250

// "https://jcb.lunaimaging.com/media/Size2/JCBMAPS-3-NA/1065/JRB001.jpg" 
// change to Size4 ... 1 to 4 works
// extra-large is ZIP ... JRB0017659538119963068053.zip
// no jp2?

// https://www.davidrumsey.com/rumsey/download.pl?image=/D5005/6388007.sid
// https://www.extensis.com/support/geoviewer-9

// https://jcb.lunaimaging.com/luna/servlet/iiif/JCBMAPS~3~3~3593~101754/info.json


// C:\_git_\__NIC__\run\php\projects\MAPS>casperjs jcb.js --remote='https://jcb.lunaimaging.com/luna/servlet/view/all?os=0' --local='Q:/project-MAPS/2021-04/jcb/pages/0001/index.html'


// C:\_git_\__NIC__\run\php\projects\MAPS>casperjs jcb.js --remote=https://jcb.lunaimaging.com/luna/servlet/view/all?os=0 --local=Q:/project-MAPS/2021-04/jcb/pages/0001/index.html

// CNTRL-SHIFT F ... exportMedia




// http://docs.casperjs.org/en/latest/quickstart.html
// Run it (on windows):
// C:\casperjs\bin> casperjs.exe jcb.js

// ThumbnailViewContainer
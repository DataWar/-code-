#!/usr/bin/env python
import argparse
import sys
import os
import time




# stackoverflow.com/questions/230751/how-to-flush-output-of-print-function
# https://opensource.com/article/19/7/parse-arguments-python
def getOptions(args=sys.argv[1:]):
    parser = argparse.ArgumentParser(description="Parses command.")
    parser.add_argument("-r", "--remote", help="Remote url")
    parser.add_argument("-l", "--local",  help="Local Path")
    parser.add_argument("-o", "--open", help="Open Browser Headless")
    parser.add_argument("-s", "--sleep", type=int, help="Milliseconds to wait for DOM to settle.")
    parser.add_argument("-v", "--verbose",dest='verbose',action='store_true', help="Verbose mode.")
    options = parser.parse_args(args)
    return options
    
options = getOptions()    
print(options)

img_small = options.local + "small.png"

# if it is cached, let's quit 
if os.path.isfile(img_small):
    print("\n cached \n")
    quit()

#https://stackoverflow.com/questions/53657215/running-selenium-with-headless-chrome-webdriver
from selenium import webdriver 
from selenium.webdriver.chrome.options import Options
chrome_options = Options()
chrome_options.add_argument("user-agent=[Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/536.5 (KHTML, like Gecko) Chrome/19.0.1084.56 Safari/536.5]")
chrome_options.add_argument("--disable-extensions")
chrome_options.add_argument("window-size=1920,10080")  # very large so it won't crop my big image 
# driver.set_window_size(1920, 1080)
chrome_options.add_argument("--disable-gpu")
chrome_options.add_argument("--verbose")
#chrome_options.add_argument("--no-sandbox") # linux only


if options.open != "true":
    chrome_options.add_argument("--headless") # if headless, I need a window size ...
    # chrome_options.headless = True # also works



# C:/python3/python.exe C:/_git_/__NIC__/run/php/projects/BLB/get.strongs.py --remote=https://www.blueletterbible.org/lang/Lexicon/Lexicon.cfm?strongs=H1234 --local=S:/project-BLB/2021-04/strongs/hebrew/1234/ --sleep=250 --open=true
    
    

# downloaded from chromium.org, version 89
# chromedriver.chromium.org/downloads
driver = webdriver.Chrome(options=chrome_options, executable_path='C:/chromedriver/chromedriver.exe')



from selenium.common.exceptions import NoSuchElementException
def check_exists_by_id(id):
    try:
        driver.find_element_by_id(id)
    except NoSuchElementException:
        return False
    return True

driver.get(options.remote)
# print(driver.page_source.encode("utf-8"))

time.sleep(options.sleep/1000)

if check_exists_by_id('agree-button'):
    driver.find_element_by_id('agree-button').click()
    
time.sleep(3*options.sleep/1000)

print(driver.execute_script("return document.title;"))


os.makedirs(options.local, exist_ok=True)

# options.local is a path
html_file = options.local + "page.html"

html = str(driver.page_source.encode("utf-8"))

f = open(html_file, 'w')
f.write(html)
f.close()

img_small = options.local + "small.png"

# stackoverflow.com/questions/17361742/download-image-with-selenium-python
with open(img_small, 'wb') as file:
    file.write(driver.find_element_by_id('lexImage').screenshot_as_png)
    
#    file.write(driver.find_element_by_xpath('/html/body/div[1]/div[5]/div[2]/table[1]/tbody/tr/td[1]/a/div').screenshot_as_png)
    



if check_exists_by_id('moreTG'):
    driver.find_element_by_id('moreTG').click()
    time.sleep(3*options.sleep/1000)
    img_full = options.local + "full.png"
    with open(img_full, 'wb') as file:
        file.write(driver.find_element_by_id('lexImage').screenshot_as_png)
    

# lexPronunc
# <div id="lexPronunc" data-pronunc="BA4BC936634F8B96EACD2BAB19093EF729C96BDE619B85D5DE79CB1C35C07E95B32332529F29E93D2869EDA61A23B204F8D14843783306"><img class="show-for-medium parse-speaker" id="pronunciationSpeaker" src="/assets/images/audio/speaker3_a.svg" width="31" height="25" /><span class="hide-for-medium">Listen</span></div>
# https://www.blueletterbible.org/lang/lexicon/lexPronouncePlayer.cfm?skin=BA4BC936634F8B96EACD2BAB19093EF729C96BDE619B85D5DE79CB1C35C07E95B32332529F29E93D2869EDA61A23B204F8D14843783306
# SAVE AS MP3

driver.quit()
quit()

# https://selenium-python.readthedocs.io/




# https://medium.com/@erika_dike/how-to-download-100-pictures-from-a-site-with-selenium-e23b7ecacb85
# https://towardsdatascience.com/advanced-web-scraping-concepts-to-help-you-get-unstuck-17c0203de7ab


# https://stackoverflow.com/questions/17361742/download-image-with-selenium-python

# https://towardsdatascience.com/hierarchical-clustering-an-application-to-world-currencies-a24c12940a7e









# https://stackoverflow.com/questions/17361742/download-image-with-selenium-python












# https://webbot.readthedocs.io/en/latest/webbot.html#selenium.webdriver.Chrome.implicitly_wait
from webbot import Browser 
web = Browser()
web.go_to(options.remote)

# web.implicitly_wait(options.remote/1000)
time.sleep(options.remote/1000)

print(web.get_title())
html = str(get_page_source())

f = open(options.local, 'w')
f.write(html)
f.close()

quit()

# https://stackoverflow.com/questions/64927909/failed-to-read-descriptor-from-node-connection-a-device-attached-to-the-system
# https://stackoverflow.com/questions/65080685/usb-usb-device-handle-win-cc1020-failed-to-read-descriptor-from-node-connectio/65134639#65134639

# https://stackoverflow.com/questions/59515319/web-scraping-using-webbot

 # In Chrome I followed chrome://flags and enabled Enable new USB backend option, after that the log message disappeared –
 
 # https://www.toolsqa.com/selenium-webdriver/selenium-headless-browser-testing/

























#https://docs.python.org/3.7/library/argparse.html    
import argparse
# create parser
parser = argparse.ArgumentParser()

# https://opensource.com/article/19/7/parse-arguments-python
# add arguments to the parser
parser.add_argument("-r", "--remote")
parser.add_argument("-l", "--local")
parser.add_argument("-s", "--sleep")
 
# parse the arguments
args = parser.parse_args()

# https://www.geeksforgeeks.org/print-lists-in-python-4-different-ways/
print(*args, sep = "\n")

quit()

from webbot import Browser 
web = Browser()

web.go_to('google.com')


get_title()


# //https://github.com/segmentio/nightmare
# // https://stackoverflow.com/questions/2910221/how-can-i-login-to-a-website-with-python/28628514#28628514  # python webbot

# // https://github.com/ariya/phantomjs/issues/13923

# // https://stackoverflow.com/questions/36481481/casperjs-memory-exhausted
# // var casper = require('casper').create();
# var casper = require('casper').create({
# verbose : true,
# logLevel : "info",
# pageSettings : {
# loadImages : false, // do not load images
# loadPlugins : false // do not load NPAPI plugins (Flash, Silverlight, ...)
# }
# });



# var fs = require('fs');
# var utils = require('utils');

# var x = require("casper").selectXPath;

# // casper.userAgent("Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
# casper.userAgent('Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/536.5 (KHTML, like Gecko) Chrome/19.0.1084.56 Safari/536.5');






# // http://docs.casperjs.org/en/latest/cli.html
	# // console.dir(casper.cli);
	# // utils.dump(casper.cli);
	
	# // casper.run();

# // casper.start('https://jcb.lunaimaging.com/luna/servlet/view/all', function() {
    # // this.echo(this.getTitle());
# // });

# var remote 	= casper.cli.raw.get('remote');
# console.log("\n\n" + remote + "\n\n");

# casper.start(remote, function() {
    # this.echo(this.getTitle());
# });
 

# var sleep 	= casper.cli.raw.get('sleep'); 
# console.log("\n\n" + sleep + "\n\n");
# casper.wait(sleep);

# var local 	= casper.cli.raw.get('local'); 
# console.log("\n\n" + local + "\n\n");

# casper.then(function() {
		# // casper.capture("Image.png");
		# var content = this.evaluate(function() {
			# return document; 
		# });
		
		# // this.echo(content.all[0].outerHTML); 
		# page = content.all[0].outerHTML;
		# fs.write(local, page, "wb");
		
		
# });

# casper.run();

# // casperjs get.remote.html.js --remote=https://jcb.lunaimaging.com/luna/servlet/view/all?os=0 --local=Q:/project-MAPS/2021-04/jcb/pages/0001/index.html --sleep=250

# // "https://jcb.lunaimaging.com/media/Size2/JCBMAPS-3-NA/1065/JRB001.jpg" 
# // change to Size4 ... 1 to 4 works
# // extra-large is ZIP ... JRB0017659538119963068053.zip
# // no jp2?

# // https://www.davidrumsey.com/rumsey/download.pl?image=/D5005/6388007.sid
# // https://www.extensis.com/support/geoviewer-9

# // https://jcb.lunaimaging.com/luna/servlet/iiif/JCBMAPS~3~3~3593~101754/info.json


# // C:\_git_\__NIC__\run\php\projects\MAPS>casperjs jcb.js --remote='https://jcb.lunaimaging.com/luna/servlet/view/all?os=0' --local='Q:/project-MAPS/2021-04/jcb/pages/0001/index.html'


# // C:\_git_\__NIC__\run\php\projects\MAPS>casperjs jcb.js --remote=https://jcb.lunaimaging.com/luna/servlet/view/all?os=0 --local=Q:/project-MAPS/2021-04/jcb/pages/0001/index.html

# // CNTRL-SHIFT F ... exportMedia




# // http://docs.casperjs.org/en/latest/quickstart.html
# // Run it (on windows):
# // C:\casperjs\bin> casperjs.exe jcb.js

# // ThumbnailViewContainer
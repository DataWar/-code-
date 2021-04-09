#!/usr/bin/env python -u
import argparse
import sys
import os
import time
import datetime
import random  



start_time = str(time.time())

def getOptions(args=sys.argv[1:]):
    parser = argparse.ArgumentParser(description="Parses command.")
    parser.add_argument("-r", "--remote", help="Remote url")
    parser.add_argument("-l", "--local",  help="Local Path")
    parser.add_argument("-n", "--new", help="Is this the New Testament?")
    parser.add_argument("-o", "--open", help="Open Browser Headless")
    parser.add_argument("-s", "--sleep", type=int, help="Milliseconds to wait for DOM to settle.")
    parser.add_argument("-v", "--verbose",dest='verbose',action='store_true', help="Verbose mode.")
    options = parser.parse_args(args)
    return options
    
options = getOptions()    
print(options)


wait_seconds = 8
sleep_factor_min = 3
sleep_factor_max = 5

def randomSleep():
    #mysleepr = random.randint(sleep_factor_min,sleep_factor_max)
    mysleepr = random.uniform(sleep_factor_min,sleep_factor_max)
    mysleep = mysleepr * options.sleep / 1000
    time.sleep(mysleep)

page_is_complete = options.local + "is.complete"

# if it is cached, let's quit 
if os.path.isfile(page_is_complete):
    print("\n cached \n")
    quit()
    

from selenium import webdriver 
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC

chrome_options = Options()
chrome_options.add_argument("user-agent=[Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/536.5 (KHTML, like Gecko) Chrome/19.0.1084.56 Safari/536.5]")
#chrome_options.add_argument("user-agent=[Mozilla/5.0 (iPad; CPU OS 9_3_5 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13G36 Safari/601.1]")
# chrome_options.add_argument("--disable-extensions")  
# chrome_options.add_argument("window-size=1920,1080")  
# driver.set_window_size(1920, 1080)
chrome_options.add_argument("--disable-gpu")
chrome_options.add_argument("--verbose")
#chrome_options.add_argument("--no-sandbox") # linux only

if options.open != "true":
    chrome_options.add_argument("--headless") # if headless, I need a window size ...
    # chrome_options.headless = True # also works
    
# C:/python3/python.exe C:/_git_/__NIC__/run/php/projects/BLB/get.tools.py --remote=https://www.blueletterbible.org/kjv/lev/22/1 --local=S:/project-BLB/2021-04/bible-verse/lev/22/ --sleep=250 --open=true

# downloaded from chromium.org, version 89
# chromedriver.chromium.org/downloads
driver = webdriver.Chrome(options=chrome_options, executable_path='C:/chromedriver/chromedriver.exe') 
#driver.set_window_size(1920, 1080)


from selenium.common.exceptions import NoSuchElementException
def check_exists_by_id(id):
    try:
        driver.find_element_by_id(id)
    except NoSuchElementException:
        return False
    return True
    
#from selenium.common.exceptions import StaleElementReferenceException

driver.get(options.remote)

randomSleep()

# cookie "okay button"
if check_exists_by_id('agree-button'):
    randomSleep()
    driver.find_element_by_id('agree-button').click()
    randomSleep()

randomSleep()
print(driver.execute_script("return document.title;"))
randomSleep()

html = str(driver.page_source.encode("utf-8"))
page_html = options.local + "page.html"
if os.path.exists(page_html):
    print("\n\n page exists -- \n\n")
else:
    f = open(page_html, 'w', encoding="utf-8")
    f.write(html)
    f.close()



# https://stackoverflow.com/questions/36449732/selenium-python-element-is-not-clickable-at-point
def wait_located_old(dr, x):
    element = WebDriverWait(dr, wait_seconds).until(
        EC.presence_of_element_located((By.XPATH, x))
    )
    return element
    
    
def wait_located(dr, x):
    try:
        element = WebDriverWait(dr, wait_seconds).until(
            EC.presence_of_element_located((By.XPATH, x))
            )
        return element
    except:
        return False
    
def wait_and_click(dr, x):
    try:
        element = WebDriverWait(dr, wait_seconds).until(
            EC.element_to_be_clickable((By.XPATH, x))
            ).click()
        return True
    except:
        return False

def grabHTMLcontent(outpath,key):
    outfile = outpath + key + ".html"
    if os.path.exists(outfile):
        return False
    else:
        return True
    
    

def saveToHTML(outpath,key):
    outfile = outpath + key + ".html"
    f = open(outfile, 'w', encoding="utf-8")
    html = driver.find_element_by_id("interruptDiv").get_attribute("outerHTML")
    f.write(html)
    f.close()
    

global_all_good = True

def getVerseContent(v, myid):
    global global_all_good
    all_good = True
    s_time = str(time.time())   
    # v = int(myid[-3:].lower())
    print("\n\n");
    outpath = options.local + str(v) + "/"
    os.makedirs(outpath, exist_ok=True)
    print(outpath)
    print("\n\n");
    print( str(datetime.datetime.now() ))
    is_complete = outpath + "is.complete"
    if os.path.exists(is_complete):
        print("\n\n")
        print("-- cached ... SKIPPING --")
        print("\n\n")
    else:
        print("\n\n")
        myxpath = "//a[@data-bible-id='" + str(myid) + "']"
        #myobj = driver.find_element_by_xpath(myxpath)
        myobj = wait_located(driver, myxpath)
        randomSleep()
        print(myxpath)
        # driver.execute_script("window.scrollTo(0,"+myobj.get_attribute('offsetTop')+")")
        randomSleep()
        wait_and_click(driver, myxpath)
        print("\n\n")
        randomSleep()
        
        tabs = ['corr', 'comms', 'refs', 'misc']
        random.shuffle(tabs)
        
        for tab in tabs:
            if grabHTMLcontent(outpath,tab):
                print(tab)
                print("\n\n")
                randomSleep()
                tab_xpath = "//span[@data-bible-tool='" + tab + "']"
                randomSleep()
                tobj = wait_located(driver, tab_xpath)
                randomSleep()
                if wait_and_click(driver, tab_xpath):
                    randomSleep()
                    saveToHTML(outpath,tab)                
                else:
                    all_good = False
                    global_all_good= False
        
        
        # this is all or nothing ... 
        all_or_nothing = True
        is_complete_conc = outpath + "conc.is.complete"
        ss_time = str(time.time())   
        
        if os.path.exists(is_complete_conc):
            print("\n\n")
            print("-- cached [conc] ... SKIPPING --")
            print("\n\n")
        else:
            print("\n\n") 
            tab = 'conc'
            print(tab)
            print("\n\n")            
            tab_xpath = "//span[@data-bible-tool='" + tab + "']"
            tobj = wait_located(driver, tab_xpath)
            if wait_and_click(driver, tab_xpath):                
                randomSleep()
                saveToHTML(outpath, tab + "_0-1")
            else:
                all_good = False
                global_all_good= False
                all_or_nothing = False
            
            
            if options.new != "true":
                sobj = wait_located(driver, "//img[@id='changeCant']")
                if wait_and_click(driver, "//img[@id='changeCant']"):
                    print("_1-1 \n\n")
                    randomSleep()
                    saveToHTML(outpath, tab + "_1-1")
                else:
                    all_good = False
                    global_all_good= False
                    all_or_nothing = False
                # driver.find_element_by_id('changeCant').click()
                randomSleep()
                saveToHTML(outpath, tab + "_1-1")
            
            if options.new != "true":
                sobj = wait_located(driver, "//img[@id='changeVowels']")
                if wait_and_click(driver, "//img[@id='changeVowels']"):
                    print("_1-0 \n\n")
                    randomSleep()
                    saveToHTML(outpath, tab + "_1-0")
                else:
                    all_good = False
                    global_all_good= False
                    all_or_nothing = False
            
            if options.new != "true":
                sobj = wait_located(driver, "//img[@id='changeCant']")
                if wait_and_click(driver, "//img[@id='changeCant']"):
                    print("_0-0 \n\n")
                    randomSleep()
                    saveToHTML(outpath, tab + "_0-0")    
                else:
                    all_good = False
                    global_all_good= False
                    all_or_nothing = False
            
            
            # septuagint is not in "new testament"
            if options.new != "true":
                sub_xpath = "//span[contains(@class, 'off') and text() = 'Septuagint']"
                sobj = wait_located(driver, sub_xpath)
                if wait_and_click(driver, sub_xpath):
                    print("_septuagint \n\n")
                    randomSleep()
                    saveToHTML(outpath, tab + "_septuagint")
                else:
                    all_good = False
                    global_all_good= False
                    all_or_nothing = False
            
            
            sub_xpath = "//span[contains(@class, 'off') and text() = 'Interlinear']"
            sobj = wait_located(driver, sub_xpath)
            if wait_and_click(driver, sub_xpath):
                print("_interlinear \n\n")
                randomSleep()
                saveToHTML(outpath, tab + "_interlinear")
            else:
                all_good = False
                global_all_good= False
                all_or_nothing = False
                
            ee_time = str(time.time())  
            tt_time = str( float(ee_time) - float(ss_time) )
            stst_time = ss_time + "\n" + ee_time + "\n" + tt_time
            
            if all_or_nothing:
                f = open(is_complete_conc, 'w', encoding="utf-8")
                f.write( stst_time )
                f.close()    

        
        # end of the road 
        
        e_time = str(time.time())  
        t_time = str( float(e_time) - float(s_time) )
        st_time = s_time + "\n" + e_time + "\n" + t_time
        
        if all_good:
            f = open(is_complete, 'w', encoding="utf-8")
            f.write( st_time )
            f.close()    
        
        randomSleep()
        randomSleep()
    #quit()
    

from bs4 import BeautifulSoup
soup = BeautifulSoup(html, "html.parser")  # or lxml 
verses = soup.find_all('a', {"data-bible-id": True, "href": False})

myids = []
for link in verses:
    myids.append(link.get("data-bible-id"))
    
 
# random.shuffle(myids)  # if I shuffle then I have to get the verse from the shuffle ...
# print(myids)    
    
mylen = len(myids)    

for i in range(0, mylen):
    myid = myids[i]
    getVerseContent((i+1),myid)
    
    
end_time = str(time.time())    
total_time = str( float(end_time) - float(start_time) )
str_time = start_time + "\n" + end_time + "\n" + total_time

if global_all_good:
    f = open(page_is_complete, 'w', encoding="utf-8")
    f.write( str_time )
    f.close()    


print(str_time)

driver.quit()        
quit()


# stackoverflow.com/questions/52859981/selenium-generating-error-element-is-not-interactable
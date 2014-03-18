#! /usr/bin/env python

import re
import argparse
import textwrap
import os
import requests
from xml.etree import ElementTree as ET


'''

    dividend_download 
    downloads dividend history from yahoo finance site in .csv format
    execute python script by running in command line ./dividend_download "file_name.csv"
    csv file must have list of stock symbols in first column and option second column for company name
    file needs to consist of 2 columns stock symbol in the first and stock name in the second
    
'''

class StockListFile:
   def __init__(self, a_file):
      self.lst = []
      with open(a_file) as f:
         for line in f:
            fileline = StockFileLine(line)
            self.lst.append(fileline)

   def printList(self):
       l = self.lst
       for s in l:
           print s.array[0]
    
   def downloadFromSite(self, link):
       from_date = "&a=1&b=1&c=1990"
       to_date = "&d=3&e=10&f=2014"
       interval = "&g=v"
       static_part = "&ignore=.csv"
       exchange = "nasdaq"
       index_folder = exchange + "/"
       url = link
       
       for s in self.lst:
           if s.array[0] == 'Symbol':
               continue
           
           link_s = link + s.array[0] + from_date + to_date + interval + static_part
           #print link_s
           path = index_folder + s.array[0]
           # check if directory exists
           check_dir(path)
           
           # Retrieve the webpage as a string
           #print s.array[0]
           
           os.chdir(path)
           # comment out if already downloaded from yahoo site
           #self.requestFromSite(link_s)
           
           """
               open csv file and create stockfile objects
           """
           
           list = []
           with open('dividend_history.csv') as f:
               
               for line in f:
                   fileline = StockFileLine(line)
                   list.append(fileline)
               # comment out to disable create XML file
               
               createXMLFile(list, s.array[0], exchange)    
           """
            function to create XML files for dividend_history.csv
            when downloaded from yahoo finance they come in .csv files
           """            
           os.chdir('..')
           os.chdir('..')      
           
       return 0
   
   def requestFromSite(self, link_s):
       """
           requests csv file from site
        
       """
       
       with open('dividend_history.csv', 'wb') as handle:
           request = requests.get(link_s, stream=True)
           
           for block in request.iter_content(1024):
               if not block:
                   break
       
               handle.write(block)
               

def createXMLFile(list, stock_symbol, market):
    """
    createXMLFile
    for dividend history
    creates a xml file in the format:
    
    <root>
        <stock symbol="APPL">
            <dividend_date date="01/01/1990">
                <price>some price</price>
            </dividend_date>
        </stock>
    </root>
    
    """
    
    stock = ET.Element("stock")
            
    stock.set("source", 'yahoo finance')
    exchange = ET.SubElement(stock, "exchange")
    exchange.set("market", market)
    
    for s in list:    
    
        if s.array[0] == 'Date' or list[0].array[0] != 'Date':
            continue
        dividend_date = ET.SubElement(exchange, "dividend_date")
        dividend_date.set("date", s.array[0])
        
        price = ET.SubElement(dividend_date, "price")
        price.text = s.array[1]
     
        
    indent(stock)
    tree = ET.ElementTree(stock)
  
    tree.write("dividend_history.xml", xml_declaration=True, encoding='utf-8', method="xml")
    print 'xml created for ' + stock_symbol
       
def indent(elem, level=0):
    i = "\n" + level*"  "
    if len(elem):
        if not elem.text or not elem.text.strip():
            elem.text = i + "  "
        if not elem.tail or not elem.tail.strip():
            elem.tail = i
        for elem in elem:
            indent(elem, level+1)
        if not elem.tail or not elem.tail.strip():
            elem.tail = i
    else:
        if level and (not elem.tail or not elem.tail.strip()):
            elem.tail = i

def check_dir(path):
    """ check_dir
        checks if directory exists for stock symbol if there is none then 
        it will make a new one
        @param f: file directory
    """
    
    if not os.path.exists(path):
        os.makedirs(path)
        print path

class StockFileLine:
   def __init__(self, a_string):
      self.array = cleanCommas(a_string).split(',')
   def getSymbol(self):
      return self.array[0]
   def getNames(self):
      return self.array[1]
   def getMarket(self):
      return self.array[2]

def cleanCommas(a_line):
   isBetweenCommas = False
   ans = ''
   for char in a_line:
       isBetweenCommas = (not isBetweenCommas if char == '\"' else isBetweenCommas)
       ans += (' ' if isBetweenCommas and char == ',' else char)
   return ans
    
def main():
    parser = argparse.ArgumentParser(formatter_class=argparse.RawDescriptionHelpFormatter,\
         description=textwrap.dedent('''\
            lists all items over x
            Usage: ./dividend_download.py nasdaq.csv
            '''))
    parser.add_argument('file', 
                        help="CSV file where stock symbols are; \
                        Must have 2 columns stock symbol first and optional company name in second ")

    args = parser.parse_args()
    stockFile = StockListFile(args.file)
    
    link = "http://ichart.yahoo.com/table.csv?s="
    
    stockFile.downloadFromSite(link)
    
if __name__ == "__main__":
   main()



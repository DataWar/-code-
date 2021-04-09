<?PHP
# require.author.cleanup.php


		$astr = str_replace("()", "", $astr); # betaCvMfit()  # RobPer 
		$astr = str_replace("(CC-BY)", "CC-BY", $astr); # lightr  
		$astr = str_replace("(QRMlib)", "QRMlib", $astr); # QRM 
		$astr = str_replace("optimizeR(", "optimizeR", $astr); # Rmpfr 
		$astr = str_replace('"GoldenRatio")', '"GoldenRatio"', $astr); # Rmpfr 
		# $astr = str_replace('optimizeR(*', '"GoldenRatio")', "", $astr);  # Rmpfr
		$astr = str_replace("(c)", "", $astr); # betaCvMfit()  # nsyllable 
		
		
		# $astr = str_replace("(Initial (2001) R port from S (to my everlasting shame -- how could I have been so slow to adopt R!) and for numerous other suggestions and useful advice)", "(Initial [2001] R port from S [to my everlasting shame -- how could I have been so slow to adopt R!] and for numerous other suggestions and useful advice)", $astr); # quantreg
		
		# sentencepiece
		$astr = str_replace("(Files at src/third_party/absl (Apache License, Version 2.0)", "(Files at src/third_party/absl (Apache License, Version 2.0))", $astr);
		$astr = str_replace("(Files at src/sentencepiece/src (Apache License, Version 2.0)", "(Files at src/sentencepiece/src (Apache License, Version 2.0))", $astr);
		$astr = str_replace("(Files at src/third_party/darts_clone (BSD-3 License)", "(Files at src/third_party/darts_clone (BSD-3 License))", $astr);
		
		# tttplot
		$astr = str_replace("based on the work of Ribeiro and Rosseti (2015).", "(based on the work of Ribeiro and Rosseti (2015).)", $astr);
		
		# bujar
#print_r($astr); echo"\n\n";		
		$astr = str_replace("&lt;https://orcid.org/0000-0002-0773-0052&gt; and others (see COPYRIGHTS)", "(<https://orcid.org/0000-0002-0773-0052> and others (see COPYRIGHTS))", $astr);
		
		# dfoptim
		
		
$astr = str_replace("Ravi Varadhan[aut, cre], Johns Hopkins University, Hans W. Borchers[aut], ABB Corporate Research, and Vincent Bechard[aut], HEC Montreal (Montreal University)", "Ravi Varadhan [aut, cre] (Johns Hopkins University), Hans W. Borchers [aut] (ABB Corporate Research), Vincent Bechard [aut] (HEC Montreal (Montreal University))", $astr);



$astr = str_replace("RcppEnsmallen author details", "(RcppEnsmallen author details)", $astr);

$astr = str_replace("Deville. Contributors:", "Deville, ", $astr);



		
		
print_r($astr); echo"\n\n";
		
		# https://stackoverflow.com/questions/20569306/how-to-write-a-recursive-regex-that-matches-nested-parentheses
		# $pattern = '~ \( (?: [^()]+ | (?R) )*+ \) ~x';
		# preg_match_all('/\((.*?)\)/', $astr, $matches);
		preg_match_all('~ \( (?: [^()]+ | (?R) )*+ \) ~x', $astr, $matches);
		
		$numberOfIdiots = count($matches[0]); 
		$strLengthIdiots = 0;
		if($numberOfIdiots > 0)
			{
			echo"<PRE> MATCHES ::: "; print_r($matches[0]);
			print_r($matches);
			#echo"\n\n"; print_r($astr); echo"\n\n";
			foreach($matches[0] as $idiot)
				{
				$tmp = $idiot;
				$tmp = rtrim($tmp, ")");
				$tmp = ltrim($tmp, "(");
				if(is_substring("(", $tmp))
					{
					# echo"<PRE>  DOUBLE ::: "; print_r($tmp); echo"\n\n";
					}
				$astr = str_replace($idiot, "", $astr);
				$strLengthIdiots += strlen($idiot);
				}
			}
############################################		
		$astr = str_replace("MongoDB, Inc", "MongoDB Inc", $astr); # mongolite 
		$astr = str_replace("mongolite author details", " ", $astr); # mongolite 
		
		# coder
		# (v. 0.12.1)
		
		$astr = str_replace("packaging by", " ", $astr); # risksetROC  

		$astr = str_replace("originally packaged for R by", " ", $astr); # xgobi   
		$astr = str_replace("originally packaged for R by", " ", $astr); # xgobi  
		$astr = str_replace("based on the S code in the XGobi distribution. Windows port based on this and earlier work by", " ", $astr); # xgobi  
		
		$astr = str_replace("with additional code from", " ", $astr); # bipartite  
		$astr = str_replace("also based on C-code developed by", " ", $astr); # bipartite  
		$astr = str_replace("Aaron Clauset/Rouven Strauss", " Aaron Clauset , Rouven Strauss ", $astr); # bipartite 

		
		$astr = str_replace("with some Fortran code adapted by", " ", $astr); # BiplotGUI  
		$astr = str_replace("from the original by", " , ", $astr); # BiplotGUI 


$astr = str_replace("with contributions by", " , ", $astr); # digest 	
$astr = str_replace(". Based on earlier work by", " , ", $astr); # ade4 	

		# EnviroStat|Runge-Kutta-Fehlberg method implementation by H.A. Watts
		$astr = str_replace("Runge-Kutta-Fehlberg method implementation by", " ", $astr); # EnviroStat   


		$astr = str_replace("with code for case-control data contributed by", " ", $astr); # hapassoc  
		
		# RAP|M.Subbiah with considerable contribution from M.R.Srinivasan|2|NA|1|2|3|0|0|0

		$astr = str_replace("with considerable contribution from", " , ", $astr); # RAP 
		
		# FuzzyToolkitUoN|Nathan Karimian with supervision from Dr. Jon Garibaldi|3|NA|1|4|4|0|0|0
		$astr = str_replace("with supervision from", " , ", $astr); # FuzzyToolkitUoN 
		
		#based on original code by 
		$astr = str_replace("based on original code by", " , ", $astr); 
		# sfa	under the supervision of
		$astr = str_replace("under the supervision of", " , ", $astr); 

		$astr = str_replace("; original C code for ARMS by", " , ", $astr); # HI  

		$astr = str_replace("Ported to R by", " ", $astr); # norm  
		$astr = str_replace("Original by", " ", $astr); # norm  
		
		$astr = str_replace("R port by", " ", $astr); # NISTnls 		
		$astr = str_replace("original from National Institutes for Standards and Technology  http://www.itl.nist.gov/div898/strd/nls/nls_main.shtml", " National Institutes for Standards and Technology , ", $astr); # NISTnls 
		
		$astr = str_replace(" Ted Harding and Fernando Tusell.   Joseph L. Schafer. ", " Ted Harding , Fernando Tusell ,  Joseph L. Schafer ", $astr); # cat
		
		
		$astr = str_replace(" Original by  ", "   ", $astr);
		$astr = str_replace(" with contribution from   ", " ,  ", $astr);
		$astr = str_replace(" with contributions by  ", "  , ", $astr);
		$astr = str_replace(" ; based on the work of  ", " ,  ", $astr);
		$astr = str_replace(" , Jr.,  ", "  Jr., ", $astr);
		$astr = str_replace(" See AUTHORS file.  boilerpipeR author details  ", "  Mario Annau ", $astr); # boilerpipeR
		
		
		# rCMA|Nikolaus Hansen &lt;hansen .AT. lri.fr&gt;|2|NA|1|2|3|0|0|0
		$astr = str_replace(" &lt;hansen .AT. lri.fr&gt; ", "   ", $astr);
		
		$astr = str_replace(" and ", " , ", $astr);
		$astr = str_replace(" &amp; ", " , ", $astr);
		
		$astr = str_replace("Observational Health Data Science , Informatics", " Observational Health Data Science and Informatics ", $astr);
		# Andromeda 
		
		$astr = str_replace("Fish , Wildlife Compensation Program", "Fish and Wildlife Compensation Program", $astr);
		# klexdatr 
		$astr = str_replace("Idaho Department of Fish , Game", "Idaho Department of Fish and Game", $astr);
		# klexdatr 
		
##################################  NIC #1

$astr = str_replace("Eli Lilly , Company", "Eli Lilly and Company", $astr);
$astr = str_replace("JavaScript , CSS libraries authors", "JavaScript and CSS libraries authors", $astr);
$astr = str_replace("Satija Lab , Collaborators", "Satija Lab and Collaborators", $astr);
$astr = str_replace(", Paul D. McNicholas", "Paul D. McNicholas", $astr);
$astr = str_replace("College of William , Mary", "College of William and Mary", $astr);
$astr = str_replace("Research Institute for Nature , Forest", "Research Institute for Nature and Forest", $astr);
$astr = str_replace("Observational Health Data Sciences , Informatics", "Observational Health Data Sciences and Informatics", $astr);
$astr = str_replace("R Core Team , contributors worldwide", "R Core Team and contributors worldwide", $astr);
$astr = str_replace("Institute of Formal , Applied Linguistics, Faculty of Mathematics , Physics, Charles University in Prague, Czech Republic", "Institute of Formal and Applied Linguistics, Faculty of Mathematics and Physics, Charles University in Prague, Czech Republic", $astr);
$astr = str_replace("National Center for Ecological Analysis , Synthesis", "National Center for Ecological Analysis and Synthesis", $astr);
$astr = str_replace("Merck Sharp , Dohme Corp", "Merck Sharp and Dohme Corp", $astr);
$astr = str_replace("James Long , contributors", "James Long and contributors", $astr);
$astr = str_replace("Marine , Freshwater Research Institute", "Marine and Freshwater Research Institute", $astr);
$astr = str_replace("MIRACUM - Medical Informatics in Research , Care in University Medicine", "MIRACUM - Medical Informatics in Research and Care in University Medicine", $astr);
$astr = str_replace("Imperial College of Science, Technology , Medicine", "Imperial College of Science, Technology and Medicine", $astr);
$astr = str_replace("Centre for Ecology , Hydrology", "Centre for Ecology and Hydrology", $astr);
$astr = str_replace("Swiss Foundation KORA Carnivore Ecology , Wildlife Management", "Swiss Foundation KORA Carnivore Ecology and Wildlife Management", $astr);
$astr = str_replace("Ingo Feinerer , Kurt Hornik", "Ingo Feinerer and Kurt Hornik", $astr);
$astr = str_replace("Merck , Co., Inc", "Merck and Co., Inc", $astr);
$astr = str_replace("Solar Durability , Lifetime Extension research center", "Solar Durability and Lifetime Extension research center", $astr);
$astr = str_replace("Emotion team , other contributors", "Emotion team and other contributors", $astr);
$astr = str_replace("Water , Sanitation for the Urban Poor", "Water and Sanitation for the Urban Poor", $astr);
$astr = str_replace("Laboratoire Act , Risk", "Laboratoire Act and Risk", $astr);
$astr = str_replace("Natural Sciences , Engineering Research Council of Canada", "Natural Sciences and Engineering Research Council of Canada", $astr);
$astr = str_replace("Bocconi Institute for Data Science , Analytics", "Bocconi Institute for Data Science and Analytics", $astr);
$astr = str_replace("President , Fellows of Harvard College", "President and Fellows of Harvard College", $astr);
$astr = str_replace("Army Research Laboratory , the U.S. Army Research Office", "Army Research Laboratory and the U.S. Army Research Office", $astr);
$astr = str_replace("Joyent, Inc. , other Node contributors", "Joyent, Inc. and other Node contributors", $astr);

$astr = str_replace("International Maize , Wheat Improvement Center", "International Maize and Wheat Improvement Center", $astr);
$astr = str_replace("Centers for Disease Control , Prevention", "Centers for Disease Control and Prevention", $astr);
$astr = str_replace("Institute of Medical Biometry , Informatics - University of Heidelberg", "Institute of Medical Biometry and Informatics - University of Heidelberg", $astr);

$astr = str_replace("2019 The President , Fellows of Harvard College", "2019 The President and Fellows of Harvard College", $astr);
$astr = str_replace("Engineering , Physical Sciences Research Council", "Engineering and Physical Sciences Research Council", $astr);
$astr = str_replace("State Key Laboratory of Remote Sensing Science, Institute of Remote Sensing Science and Engineering, Beijing Normal University", "State Key Laboratory of Remote Sensing Science, Institute of Remote Sensing Science and Engineering, Beijing Normal University", $astr);
$astr = str_replace("Systems Biology , Bioinformatics Group http://sysbiobig.dei.unipd.it/", "Systems Biology and Bioinformatics Group", $astr);
$astr = str_replace("R Core Team , contributors worldwide", "R Core Team and contributors worldwide", $astr);
$astr = str_replace("Merck , Co. Inc", "Merck and Co. Inc", $astr);
$astr = str_replace("Imperial College of Science, Technology , Medicine", "Imperial College of Science, Technology and Medicine", $astr);
$astr = str_replace("United States Centers for Disease Control , Prevention", "United States Centers for Disease Control and Prevention", $astr);
$astr = str_replace("B. D. Ripley author of original lda , qda functions", "B. D. Ripley", $astr);
$astr = str_replace("W. N. Venables author of original lda , qda functions", "W. N. Venables", $astr);
$astr = str_replace("International Business Machines Corporation , others", "International Business Machines Corporation and others", $astr);
$astr = str_replace("Authors , copyright holder of the Swiss Ephemeris", "Authors and copyright holder of the Swiss Ephemeris", $astr);
$astr = str_replace("(Files at src/parallel_hashmap , The Abseil Authors", "The Abseil Authors", $astr);

$astr = str_replace("Blokhina Scientific Research Institute of Epidemiology , Microbiology of Nizhny Novgorod, Russia", "Blokhina Scientific Research Institute of Epidemiology and Microbiology of Nizhny Novgorod, Russia", $astr);
$astr = str_replace("French National Institute of Health , Medical Research", "French National Institute of Health and Medical Research", $astr);
$astr = str_replace("Merck Sharp , Dohme Corp. a subsidiary of Merck , Co., Inc., Kenilworth, NJ, USA", "Merck Sharp and Dohme Corp. a subsidiary of Merck and Co., Inc., Kenilworth, NJ, USA", $astr);

$astr = str_replace("Craig Otis , others", "Craig Otis and others", $astr);

####### "Author": "Andrey Kostin [aut, cre], Aleksey Zemnitskiy [aut], Oleg Nechaev [aut], Craig Otis and others [ctb, cph] (OpenFAST library), Daniel Lemire, Muraoka Taro and others [ctb, cph] (JavaFastPFOR library), Joe Walnes, Jorg Schaible and others [ctb, cph] (XStream library), Dain Sundstrom [ctb, cph] (Snappy library), Extreme! Lab, Indiana University [ctb, cph] (XPP3 library), The Apache Software Foundation [ctb, cph] (Apache Log4j and Commons Lang libraries), Google, Inc. [ctb, cph] (GSON library), Free Software Foundation [ctb, cph] (GNU Trove and GNU Crypto libraries)",
## PortfolioEffectHFT
 $astr = str_replace("Daniel Lemire, Muraoka Taro , others", "Daniel Lemire [ctb, cph], Muraoka Taro [ctb, cph], others [ctb, cph]", $astr);
 $astr = str_replace("Joe Walnes, Jorg Schaible , others", "Joe Walnes [ctb, cph], Jorg Schaible [ctb, cph],  others [ctb, cph]", $astr); 

## rkafkajars
 $astr = str_replace("Coda Hale , Yammer Inc", "Coda Hale [ctb,cph], Yammer Inc [ctb,cph]", $astr);
 $astr = str_replace("David E. Clark , Turner M. Osler , David R. Hahn", "David E. Clark [auth], Turner M. Osler [auth], David R. Hahn [auth],", $astr);
## corpus 
 $astr = str_replace("Martin Porter , Richard Boulton", "Martin Porter [ctb, cph, dtc], Richard Boulton [ctb, cph, dtc]", $astr);
 $astr = str_replace("Carlo Strapparava , Alessandro Valitutti", "Carlo Strapparava [cph, dtc], Alessandro Valitutti [cph, dtc]", $astr);
## hmma
 $astr = str_replace("Robert Gentleman , Ross Ihaka", "Robert Gentleman [cph], Ross Ihaka [cph]", $astr);


#########################################
		
		
		$astr = str_replace(" Taylor , Francis ", " Taylor and Francis ", $astr);
		# RcppMsgPack 
		$astr = str_replace(" ; the authors , contributors of MsgPack  RcppMsgPack author details ", " , the authors of MsgPack ", $astr);
		
		# R2WinBUGS
		$astr = str_replace(" . With considerable contributions by ", " ,  ", $astr);
		$astr = str_replace(". Ported to S-PLUS by", " ,  ", $astr);
		
		$astr = str_replace(" . Excerpts adapted from Fortran code Copyright ", " ,  ", $astr);
		$astr = str_replace(" based in part on C code written by ", "  ", $astr);
		$astr = str_replace(" Maechler partly based on code from Robert", " ,  Robert", $astr);
		$astr = str_replace("adopted to recent S-PLUS by", " ,  ", $astr);
		$astr = str_replace("David W. Scott   Albrecht Gebhardt", " David W. Scott ,  Albrecht Gebhardt ", $astr);
		
		$astr = str_replace("jQuery Foundation , contributors", " jQuery Foundation  ", $astr);
		$astr = str_replace("with \code{hwexact} from", "  ", $astr);
		
		$astr = str_replace("Aydin Demircioglu; Tobias Glasmachers; Urun Dogan", " Aydin Demircioglu, Tobias Glasmachers, Urun Dogan ", $astr);
		
		$astr = str_replace("R port + extensions by", "  ", $astr);
		
		$astr = str_replace(", authors of the ARPACK library. See file AUTHORS for details.  rARPACK author details", "  ", $astr);
		
		
		$astr = str_replace("dlib package authors   dlib author details", "  ", $astr);
		
		$astr = str_replace("with contributions by", " , ", $astr);
		$astr = str_replace("some package testing by", "  ", $astr);
		
		$astr = str_replace("contributors in file inst/AUTHORS  volesti author details", "  ", $astr);
		
		
		
		# sppmix
		
		$astr = str_replace(". Significant contributions on the package skeleton creation, plotting functions , other code by", "  , ", $astr);
		
print_r($astr); echo"\n\n";  
				# Go, Vue, JavaScript, R, and Amazon Web Services,
				# Our software is powered by a wide range of technologies including C++, Java, JavaScript using CMake, Jenkins, Docker, and Kubernetes. We also work with the AWS, GCP and Azure ecosystems to ensure our products function seamlessly in those environments.
				# We’re currently using Vue, TypeScript, Go, and Amazon Web Services,

				
		$astr = str_replace("(http", "http", $astr); # shinyChakraSlider
		$astr = str_replace("))", ")", $astr);		
		$astr = str_replace(".org)", ".org", $astr);
		
		
		$astr = str_replace("]   ,", "]", $astr);
		$astr = str_replace("]  ,", "]", $astr);
		$astr = str_replace("] ,", "]", $astr);
		$astr = str_replace("],", "]", $astr);

?>
<?PHP

	
	if($key == "SystemRequirements" && $this->currentPackage == "iai")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "Julia (>= 1.0), Interpretable AI System Image (>= 1.0.0)";
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "PTXQC")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "pandoc";
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "RcppCWB")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "GLib (Win/MacOS)";
		}

	if($key == "SystemRequirements" && $this->currentPackage == "RcppParallel")
		{
		# "SystemRequirements": "GNU make, Windows: cmd.exe and cscript.exe, Solaris: g++ is required",
		# $ninfo = "GNU make (linux), cmd.exe (Windows), cscript.exe (Windows), g++ (Solaris)";
		$ninfo = "GNU make, cmd.exe, cscript.exe, g++";
		}
	if($key == "SystemRequirements" && $this->currentPackage == "texreg")
		{
		# ""SystemRequirements": "pandoc (>= 1.12.3) suggested for using wordreg function; LaTeX packages tikz, booktabs, dcolumn, rotating, thumbpdf, longtable, paralist for the vignette",
            
		# $ninfo = "GNU make (linux), cmd.exe (Windows), cscript.exe (Windows), g++ (Solaris)";
		$ninfo = "pandoc (>= 1.12.3), wordreg, LaTeX, tikz, booktabs, dcolumn, rotating, thumbpdf, longtable, paralist";
		}
	if($key == "SystemRequirements" && $this->currentPackage == "rodeo")
		{
		# "SystemRequirements": "The tools to run 'R CMD SHLIB' on 'Fortran' code. The used 'Fortran' compiler must support pointer initialization which is a feature of the 2008 standard. The compiler from Oracle Developer Studio 12.6 on Solaris 10 currently does not meet this requirement.",
            
		# $ninfo = "GNU make (linux), cmd.exe (Windows), cscript.exe (Windows), g++ (Solaris)";
		$ninfo = "R CMD SHLIB, Fortran compiler";
		}	





	$ninfo = str_replace(". On Windows, no prior installations are necessary, as pre-built (i.e. cross-compiled) binaries of required libraries are downloaded from a GitHub repository (&lt;https://github.com/PolMine/libcl>) during installation. On macOS, static libraries of Glib are downloaded (&lt;https://github.com/PolMine/libglib>) if Glib is not present.", " ", $ninfo);  # Rcpp


	if($key == "SystemRequirements" && $this->currentPackage == "mscstexta4r")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "Microsoft's Cognitive Services API key";
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "couchDB")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "couchDB";
		}
		
	
		
		
	# rgdal
	if($key == "SystemRequirements" && $this->currentPackage == "rgdal")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "PROJ (>= 4.8.0), GDAL (>= 1.11.4)";
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "image.textlinedetector")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "C++11 , OpenCV (>= 3), libopencv-dev (Debian), opencv-devel (Fedora)";
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "PRIMME")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "POSIX (Linux or MacOS), GNU make";
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "RPostgres")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "libpq (>= 9.0), libpq-dev (deb), postgresql-devel (rpm)";
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "baseflow")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "GNU make, Cargo (>= 1.42.0)";
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "ieeeround")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "C with functions fe[s/g]etround";
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "xgobi")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "standalone program xgobi";
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "localsolver")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "trial version of LocalSolver";
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "R2WinBUGS")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "OpenBugs, WinBUGS (>= 1.4)";
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "Phxnlme")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "Phoenix NLME with ML license";
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "caRpools")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "MAGeCK (>= 0.51), bowtie2";
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "permGPU")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "NVIDIA CUDA toolkit (>= 6)";
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "spgrass6")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "GRASS (>= 6.3 v.6 only)";
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "PKI")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "OpenSSL";
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "elexr")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "Python (>= 3.5), elex";
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "coreNLP")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "Java (>= 7), Stanford CoreNLP (>= 3.5.2)";
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "gcbd")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "Debian, Goto Blas, Intel MKL, NVIDIA GPU with CUDA, Atlas development build";
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "AncestryMapper")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "RAM (>= 12GB)";
		}

	if($key == "SystemRequirements" && $this->currentPackage == "mleap")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "Apache Spark (>= 2.0), Apache Maven (>= 3.5), Java JDK (>= 8), MLeap Runtine (>= 0.10.1)";
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "rapport")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "pandoc";
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "RsSimulx")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "'Simulx'";
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "Rsmlx")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "'Monolix'";
		}
		
		
	if($key == "SystemRequirements" && $this->currentPackage == "blogdown")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "Hugo, Pandoc";
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "feamiR")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "Python (>=3.6), sreformat, patman";
		}
		
		
	if($key == "SystemRequirements" && $this->currentPackage == "altair")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "Python (>= 3.5.0), Python Altair (>= 4.0.0), nodejs (> 8), MacOS (X11)";
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "specmine")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "Python (>= 3.5.2), Python nmrglue";
		}
			
	if($key == "SystemRequirements" && $this->currentPackage == "bbsBayes")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "JAGS (>= 4.3.0)";
		}
			
	if($key == "SystemRequirements" && $this->currentPackage == "JointAI")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "JAGS";
		}

	if($key == "SystemRequirements" && $this->currentPackage == "magick")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "ImageMagick++";
		}

	if($key == "SystemRequirements" && $this->currentPackage == "GeneralizedUmatrix")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "pandoc (>= 1.12.3)";
		}

	if($key == "SystemRequirements" && $this->currentPackage == "vegawidget")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "nodejs, MacOS (X11)";		
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "adimpro")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "Image Magick, dcraw";		
		}

	if($key == "SystemRequirements" && $this->currentPackage == "bigsnpr")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "PLINK";		
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "git2r")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "libgit2, zlib, openssl, libssh2";		
		}	
		
	if($key == "SystemRequirements" && $this->currentPackage == "rgl")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "OpenGL, GLU Library, XQuartz (on OSX), zlib (optional), libpng (>=1.2.9), FreeType (optional), pandoc (>=1.14)";		
		}		
		
	if($key == "SystemRequirements" && $this->currentPackage == "eplusr")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "EnergyPlus (>= 8.3), udunits2 ";		
		}			
	
	if($key == "SystemRequirements" && $this->currentPackage == "RMariaDB")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "libmariadbclient-dev,  mariadb-devel, mariadb-connector-c";		
		}	
	if($key == "SystemRequirements" && $this->currentPackage == "RMySQL")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "libmariadbclient-dev,  mariadb-devel, mariadb-connector-c";		
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "mlpack")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "C++11 compiler (>= 4.8),  gcc (>= 4.9)";		
		}	
	
	if($key == "SystemRequirements" && $this->currentPackage == "seqinr")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "zlib";		
		}	
	
	if($key == "SystemRequirements" && $this->currentPackage == "pbdZMQ")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "ZeroMQ (>= 4.0.4/7), OpenCSW (Solaris)";		
		}		
	
	if($key == "SystemRequirements" && $this->currentPackage == "copula")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "TexLive, pdfcrop";		
		}	

	if($key == "SystemRequirements" && $this->currentPackage == "unix")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "POSIX (>= 1-2001), AppArmor";		
		}	

	if($key == "SystemRequirements" && $this->currentPackage == "reproducible")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "unrar, 7-zip";		
		}	

	if($key == "SystemRequirements" && $this->currentPackage == "NPMLEmix")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "MOSEK (license)";		
		}

	if($key == "SystemRequirements" && $this->currentPackage == "wordnet")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "Java (>= 5.0),  WordNet database";		
		}
	if($key == "SystemRequirements" && $this->currentPackage == "pomp")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "Rtools";		
		}
	if($key == "SystemRequirements" && $this->currentPackage == "Rsymphony")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "SYMPHONY";		
		}	

	if($key == "SystemRequirements" && $this->currentPackage == "ggdemetra")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "Java SE (>= 8)";		
		}	

	if($key == "SystemRequirements" && $this->currentPackage == "RcppTOML")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "C++11 compiler, g++";		
		}	

	if($key == "SystemRequirements" && $this->currentPackage == "mRpostman")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "libcurl";		
		}	

	if($key == "SystemRequirements" && $this->currentPackage == "anticlust")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "pandoc, GLPK";		
		}	
	if($key == "SystemRequirements" && $this->currentPackage == "SDMtune")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "JAVA (>= 8), maxent.jar (>= 3.4.1)";		
		}	
	if($key == "SystemRequirements" && $this->currentPackage == "salso")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "Cargo (>= 1.40.0)";		
		}		
		
	if($key == "SystemRequirements" && $this->currentPackage == "netmhc2pan")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "NetMHC2pan";		
		}	
		
	if($key == "SystemRequirements" && $this->currentPackage == "tmhmm")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "TMHMM";		
		}	
		
	if($key == "SystemRequirements" && $this->currentPackage == "DIZutils")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "libpq (>= 9.0), libpq-dev , postgresql-devel";		
		}	
	if($key == "SystemRequirements" && $this->currentPackage == "tabr")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "LilyPond (>= 3.3.0)";		
		}		
	if($key == "SystemRequirements" && $this->currentPackage == "ML2Pvae")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "TensorFlow, Keras, TensorFlow";		
		}	
	if($key == "SystemRequirements" && $this->currentPackage == "RCBR")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "MOSEK (license)";		
		}	
	if($key == "SystemRequirements" && $this->currentPackage == "jqr")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "libjq,  jq-devel  , libjq-dev";		
		}		
	if($key == "SystemRequirements" && $this->currentPackage == "lubridate")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "zoneinfo,  C++11 compiler, g++(>= 4.8) ";		
		}
	if($key == "SystemRequirements" && $this->currentPackage == "ip2proxy")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "Python IP2Proxy";		
		}	
	if($key == "SystemRequirements" && $this->currentPackage == "colorizer")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "ImageMagick++";		
		}
	if($key == "SystemRequirements" && $this->currentPackage == "V8")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "JavaScript (>= ES5), V8 (>= 6), libv8-dev, libnode-dev";		
		}
	if($key == "SystemRequirements" && $this->currentPackage == "JavaGD")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "GNU make, Java JDK (>= 1.2)";		
		}
	if($key == "SystemRequirements" && $this->currentPackage == "mauricer")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "BEAST2";		
		}
	if($key == "SystemRequirements" && $this->currentPackage == "beastier")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "BEAST2";		
		}	
	if($key == "SystemRequirements" && $this->currentPackage == "kantorovich")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "GMP";		
		}
	if($key == "SystemRequirements" && $this->currentPackage == "pbixr")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "Microsoft PowerShell, Microsoft Power BI";		
		}
	if($key == "SystemRequirements" && $this->currentPackage == "redland")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "Mac OSX, redland (>= 1.014), librdf0-dev (>= 1.014) ";		
		}

	if($key == "SystemRequirements" && $this->currentPackage == "tidycwl")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "PhantomJS, pandoc";		
		}


	if($key == "SystemRequirements" && $this->currentPackage == "tiledb")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "cmake, git";		
		}
	if($key == "SystemRequirements" && $this->currentPackage == "rTorch")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "conda, Python (>= 3.6), numpy ( >= 1.14.0), pytorch (>=1.4), qpdf ( >= 7.0), pandoc (>= 2.0), pytorch, torchvision, cpuonly, matplotlib, pandas";		
		}

	if($key == "SystemRequirements" && $this->currentPackage == "clipr")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "xclip, xsel";		
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "NetRep")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "C++11 compiler, Rtools  (>= 3.3.0)";		
		}

	if($key == "SystemRequirements" && $this->currentPackage == "timechange")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "zoneinfo, C++11 compiler, g++  (>= 4.8)";		
		}

	if($key == "SystemRequirements" && $this->currentPackage == "kerastuneR")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "TensorFlow (>= 2.0)";		
		}


	if($key == "SystemRequirements" && $this->currentPackage == "fftwtools")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "fftw3, libfftw3-dev, fftw-devel";		
		}
	if($key == "SystemRequirements" && $this->currentPackage == "devEMF")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "Xft, zlib";		
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "JuliaConnectoR")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "Julia (>= 1.0)";		
		}

	if($key == "SystemRequirements" && $this->currentPackage == "rjdmarkdown")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "Java SE (>= 8.0)";		
		}
	if($key == "SystemRequirements" && $this->currentPackage == "av")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "FFmpeg (>= 3.2),  libx264, lame, libavfilter-dev, ffmpeg-devel, ffmpeg";		
		}

	if($key == "SystemRequirements" && $this->currentPackage == "av")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "Spark (>= 2.x)";		
		}

	if($key == "SystemRequirements" && $this->currentPackage == "opencv")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "OpenCV (>= 3), libopencv-dev, opencv-devel";		
		}
	if($key == "SystemRequirements" && $this->currentPackage == "tables")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "pandoc (>= 1.12.3)";		
		}

	if($key == "SystemRequirements" && $this->currentPackage == "openssl")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "OpenSSL (>= 1.0.1)";		
		}
	if($key == "SystemRequirements" && $this->currentPackage == "inlmisc")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "pandoc, phantomjs";		
		}
	if($key == "SystemRequirements" && $this->currentPackage == "RNetCDF")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "netcdf, udunits-2";		
		}


	if($key == "SystemRequirements" && $this->currentPackage == "MBNMAdose")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "JAGS (>= 4.3.0)";			
		}


	if($key == "SystemRequirements" && $this->currentPackage == "rgeos")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "GEOS (>= 3.2.0)";			
		}

	if($key == "SystemRequirements" && $this->currentPackage == "fmf")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "libarmadillo, libblas, liblapack, libarpack++2, gfortran";		
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "OpenImageR")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "libarmadillo, libblas, liblapack, libarpack++2, gfortran, libjpeg-dev, libpng-dev, libfftw3-dev, libtiff5-dev";		
		}

	if($key == "SystemRequirements" && $this->currentPackage == "virtuoso")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "virtuoso-opensource";		
		}

	if($key == "SystemRequirements" && $this->currentPackage == "MaOEA")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "Python (>= 3.x), Python PyGMO, Python NumPy, cloudpickle";		
		}


	if($key == "SystemRequirements" && $this->currentPackage == "RcppCCTZ")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "POSIX OS (64-bit), C++11 compiler, g++ (>= 4.9), zoneinfo, std::get_time, LLVM libc++ ";		
		}

	if($key == "SystemRequirements" && $this->currentPackage == "lcra")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "JAGS (>= 4.x.y), WinBUGS (>= 1.4) ";		
		}


	if($key == "SystemRequirements" && $this->currentPackage == "lcra")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "Boost";		
		}


	if($key == "SystemRequirements" && $this->currentPackage == "tfprobability")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "TensorFlow Probability";		
		}

	if($key == "SystemRequirements" && $this->currentPackage == "neo4jshell")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "neo4j, cypher-shell";		
		}
		
		
	if($key == "SystemRequirements" && $this->currentPackage == "neo4jshell")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "RAM (>= 4GB), build-essential, libxml2-dev, libssl-dev, libcurl4-openssl-dev, Rtools (>= 3.5)";		
		}		
		
	if($key == "SystemRequirements" && $this->currentPackage == "pureseqtmr")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "PureseqTM";		
		}
		
		
	if($key == "SystemRequirements" && $this->currentPackage == "camtrapR")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "ExifTool";		
		}	
		
		
		
	if($key == "SystemRequirements" && $this->currentPackage == "camtrapR")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "ExifTool";		
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "IRkernel")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "jupyter, jupyter_kernel_test";		
		}	
		
		
	if($key == "SystemRequirements" && $this->currentPackage == "Cairo")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "cairo (>= 1.2)";		
		}		
		
	if($key == "SystemRequirements" && $this->currentPackage == "klic")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "MOSEK (license)";		
		}	
		
	if($key == "SystemRequirements" && $this->currentPackage == "rJava")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "GNU make, Java JDK (>= 1.2), JRI/REngine JDK (>= 1.4)";		
		}	
	if($key == "SystemRequirements" && $this->currentPackage == "docxtractr")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "LibreOffice";		
		}	

	if($key == "SystemRequirements" && $this->currentPackage == "admixr")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "ADMIXTOOLS";		
		}
	if($key == "SystemRequirements" && $this->currentPackage == "nloptr")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "NLopt (>= 2.4.0)";		
		}
		
	if($key == "SystemRequirements" && $this->currentPackage == "dccvalidator")
		{
		# echo"<PRE>"; echo"\n\n $key \n\n"; print_r($this); exit;
		$ninfo = "synapseclient";		
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		

		
	$ninfo = str_replace("| file README.md", "  ", $ninfo);  # PMCMRplus	

	$ninfo = str_replace("in path and NumPy module installed, ", "  ", $ninfo);  # RWebLogo

	$ninfo = str_replace("NVIDIA CUDA GPU with compute capability 3.0 or above and NVIDIA CUDA Toolkit 9.0 or above", " VIDIA CUDA GPU (>= 3), NVIDIA CUDA Toolkit (>= 9)", $ninfo);  # DesignCTPB


	$ninfo = str_replace("- http://pandoc.org", " ", $ninfo);  # vitae
	$ninfo = str_replace("; https://pandoc.org", " ", $ninfo);  # dataReporter

	$ninfo = str_replace("(https://www.xpdfreader.com/download.html)", " ", $ninfo);  # PDE



	$ninfo = str_replace("- http://www.rstudio.com/products/rstudio/", " ", $ninfo);  # manipulate

	$ninfo = str_replace("&lt;https://github.com/gnames/gnparser", " ", $ninfo);  # rgnparser


	$ninfo = str_replace(", by default rasciidoc uses a system installation of asciidoc. If a system installation of asciidoc is not available, it downloads the sources from (&lt;http://gitlab.com/asciidoc>). GNU source-highlight is recommended.", " ", $ninfo);  # rasciidoc

	$ninfo = str_replace("python >= 2.6", "python (>= 2.6) ", $ninfo);  # rasciidoc

	$ninfo = str_replace("Java version 8 or higher", "Java (>= 8) ", $ninfo);  # EvidenceSynthesis
	$ninfo = str_replace("https://www.java.com/", " ", $ninfo);  # EvidenceSynthesis


	$ninfo = str_replace("(&lt;http://simulx.lixoft.com/)", " ", $ninfo);  # RsSimulx
	$ninfo = str_replace("(&lt;http://monolix.lixoft.com/)", " ", $ninfo);  # Rsmlx


	$ninfo = str_replace("(https://www.beast2.org/)", " ", $ninfo);  # mcbette
	
	
	$ninfo = str_replace("(http://phantomjs.org/)", " ", $ninfo);  # shinytest
	$ninfo = str_replace("(https://neptune.ai/)", " ", $ninfo);  # neptune
	
	$ninfo = str_replace("(https://surfer.nmr.mgh.harvard.edu/)", " ", $ninfo);  # freesurfer
	
	$ninfo = str_replace("(http://www.openkomodo.com)", " ", $ninfo);  # svKomodo
	$ninfo = str_replace("(http://www.sciviews.org/SciViews-K)", " ", $ninfo);  # svKomodo

	$ninfo = str_replace("(http://mcmc-jags.sourceforge.net)", " ", $ninfo);  # bayescount

	$ninfo = str_replace("(https://gnupg.org/)", " ", $ninfo);  # GnuPG
	
	$ninfo = str_replace("(https://pytorch.org/)", " ", $ninfo);  # torch
	$ninfo = str_replace("(https://www.graphviz.org/", " ", $ninfo);  # proffer
	$ninfo = str_replace("(https://github.com/google/pprof)", " ", $ninfo);  # proffer

	$ninfo = str_replace("(http://tapkee.lisitsyn.me/)", " ", $ninfo);  # tapkee
	
	

	$ninfo = str_replace(" OR ", " , ", $ninfo);  # ISEtools
	$ninfo = str_replace("(see http://mcmc-jags.sourceforge.net)", "", $ninfo); # morse
	$ninfo = str_replace("version >= 1.14", "(>= 1.14)", $ninfo); # ridge

	$ninfo = str_replace("version >= 1.8", "(>= 1.8)", $ninfo); # topicmodels


	$ninfo = str_replace("; for AWS S3 support on Linux,", " ", $ninfo);  # arrow
	$ninfo = str_replace("libcurl and openssl (optional)", " , libcurl, openssl", $ninfo);  # arrow


	$ninfo = str_replace("Package vignettes based on R Markdown v2 or reStructuredText require Pandoc (http://pandoc.org). The function rst2pdf() require rst2pdf (https://github.com/rst2pdf/rst2pdf).", "pandoc", $ninfo);  # knitr


	$ninfo = str_replace("(http://proj.maptools.org/)", "  ", $ninfo);  # proj4
	$ninfo = str_replace("4.4.6 or higher", " (>= 4.4.6)", $ninfo);  # proj4

	$ninfo = str_replace("Python and TensorFlow are needed for Bayesian inference computations; ", "  ", $ninfo);  # causact
	$ninfo = str_replace("with header files and shared library; TensorFlow (= v1.14; https://www.tensorflow.org/); TensorFlow Probability (= v0.7.0; https://www.tensorflow.org/probability/)", " , TensorFlow (>= v1.14) ,  TensorFlow Probability (= v0.7.0) ", $ninfo);  # causact


	$ninfo = str_replace(": libgit2-devel (rpm) or libgit2-dev (deb). A PPA is available for older Ubuntu LTS versions.", "  ", $ninfo);  # gert

	 
	$ninfo = str_replace("for taking screenshots", " ", $ninfo);  # nomnoml
	
	
	$ninfo = str_replace(", needed for the vignette", " ", $ninfo);  # rminizinc
	
	$ninfo = str_replace("&lt;http://admb-project.org>", "  ", $ninfo);  # IRATER
	
	$ninfo = str_replace("- http://johnmacfarlane.net/pandoc", "  ", $ninfo);  # tutorial
	
	$ninfo = str_replace("pandoc with https support", " pandoc ", $ninfo);  # rminizinc

?>
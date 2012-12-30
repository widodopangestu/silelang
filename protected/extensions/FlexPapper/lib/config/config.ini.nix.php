; <?php exit; ?> DO NOT REMOVE THIS LINE
[general]
 allowcache = true
 path.pdf = "/home/wirekom/web_office/images/surat/"
 path.swf = "/home/wirekom/web_office/images/swf/"
 
[external commands]
 cmd.conversion.singledoc 	= "/usr/local/bin/pdf2swf {path.pdf}{pdffile} -o {path.swf}{pdffile}.swf -f -T 9 -t -s storeallcharacters"
 cmd.conversion.splitpages 	= "/usr/local/bin/pdf2swf {path.pdf}{pdffile} -o {path.swf}{pdffile}%.swf -f -T 9 -t -s storeallcharacters -s linknameurl"
 cmd.searching.extracttext = "/usr/local/bin/swfstrings {path.swf}{swffile}"

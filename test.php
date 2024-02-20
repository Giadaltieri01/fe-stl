<?php>

private function renderToPdf(string $xmlFile) : ?SimpleFileProxy
    {
        $dir = $_ENV['SHARED_FOLDER'].'/fe-stl';
        try {
            copy($xmlFile, $dir.'/input.xml');
            $cmd = "cd $dir && xsltproc fe.xsl input.xml > output.html";
            shell_exec($cmd);
            $c = new Html2PdfConverter(); # faster
#            $c = new BrowserShotHtml2PdfConverter();
            $pdfinput = SimpleFileProxy::fromFileSystem($dir.'/output.html');
            $r 
            et = $c->convert($pdfinput, 'pdf');
            return $ret;
        } catch (\Exception $e) {
            return null;
        } finally {
            @unlink($dir.'/input.xml');
            @unlink($dir.'/output.html');
        }
    }
}
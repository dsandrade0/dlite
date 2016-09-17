<?php
class WebController extends Controller {
  public $js;
  public $css;

  public final function composePage() {
    $html = "

<!DOCTYPE html>
<html lang='pt'>

<head>

    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='description' content=''>
    <meta name='author' content=''>

    <title>".$this->setTitle()."</title>

    <!-- Bootstrap Core CSS -->
    <link type='text/css' href='/htdocs/bower_components/bootstrap/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link type='text/css' href='/htdocs/bower_components/bootstrap/dist/css/bootstrap-theme.min.css' rel='stylesheet'>

    <!-- MetisMenu CSS -->
    <link type='text/css' href='/htdocs/bower_components/metisMenu/dist/metisMenu.min.css' rel='stylesheet'>

    <!-- Timeline CSS -->
    <link type='text/css' href='/htdocs/dist/css/timeline.css' rel='stylesheet'>

    <!-- Custom CSS -->
    <link type='text/css' href='/htdocs/dist/css/sb-admin-2.css' rel='stylesheet'>

    <!-- Morris Charts CSS -->
    <link type='text/css' href='/htdocs/bower_components/morrisjs/morris.css' rel='stylesheet'>

    <!-- Custom Fonts -->
    <link type='text/css' href='/htdocs/bower_components/font-awesome/css/font-awesome.min.css' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'></script>
        <script src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js'></script>
    <![endif]-->

    <script src='/htdocs/bower_components/jquery/dist/jquery.min.js'></script>
</head>

".$this->getMsg().(string)$this->composeBody()."
<script src='/htdocs/bower_components/bootstrap/dist/js/bootstrap.min.js'></script>
<script src='/htdocs/bower_components/bootstrap-datepicker/bootstrap-datepicker.js'></script>
<script src='/htdocs/bower_components/jquery-validation/dist/jquery.validate.min.js'></script>
<script src='/htdocs/bower_components/metisMenu/dist/metisMenu.min.js'></script>
<script src='/htdocs/bower_components/raphael/raphael-min.js'></script>
<script src='/htdocs/bower_components/morrisjs/morris.min.js'></script>
<!--<script src='/htdocs/js/morris-data.js'></script>-->
<script src='/htdocs/js/jquery-mask.js'></script>
<script src='/htdocs/dist/js/sb-admin-2.js'></script>
<script src='/htdocs/bower_components/bootbox.js/bootbox.js'></script>
<!--<script src='/htdocs/js/utils.js'></script>-->
</html>
";
    $clicky = "<a title='Web Analytics' href='http://clicky.com/100969968'><img alt='Web Analytics' src='//static.getclicky.com/media/links/badge.gif' border='0' /></a>
      <script src='//static.getclicky.com/js' type='text/javascript'></script>
<script type='text/javascript'>try{ clicky.init(100969968); }catch(e){}</script>
<noscript><p><img alt='Clicky' width='1' height='1' src='//in.getclicky.com/100969968ns.gif' /></p></noscript>";
    return $html.$clicky.$this->setJs();
  }

/*
 * This function can be fragmented in minimal functions to make a page
 */

  protected function composeBody() {
  }

  protected function processRequest() {
  }

  protected function setTitle() {
  }

  public function setCss() {
    $html = '<link type="text/css" href="/htdocs/css/layout.css" rel="stylesheet">';
    if (!empty($this->css)) {
      foreach ($this->css as $css) {
       $html .= '<link rel="stylesheet" type="text/css"'.
         'href="/htdocs/css/'.$css.'.css"/>'; 
      }
    } 
    return $html;
  }


  public function setJs() {
    $html = '';
    if (!empty($this->js)) {
      foreach ($this->js as $js) {
       $html .= '<script type="text/javascript"'.
         'src="/lib/third/didijudo/compressor/compressor.php?__a=htdocs/js/'.$js.'.js"></script>'; 
      }
    } 
    return $html;
  }

  protected function setHead() {
    $r = $GLOBALS['head'];
    $GLOBALS['head'] = '';
    return $r;
  }

  protected function getRequest() {
    if ($this->request) {
     return $this->request;
    }
  }
}

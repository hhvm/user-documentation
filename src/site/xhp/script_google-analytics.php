<?hh // strict

class :script:google-analytics extends :x:element {
  attribute
    string trackingID @required;

  protected function render(): XHPRoot {
    $tracking_id = json_encode($this->:trackingID);
    $js = <<<EOF
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', $tracking_id, 'auto');
ga('send', 'pageview');
EOF;
    return <script>{$js}</script>;
  }
}

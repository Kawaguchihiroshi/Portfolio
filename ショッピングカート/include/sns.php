<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<div class="row mt-3 justify-content-between" style="margin-right:7px;">
<div class="col-4 mt-1">
<!-- Load Twitter Share Button -->
<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button rounded" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
</div><!-- /col-4 -->
<div class="col-4" style="margin-left:-35px;">
<!-- Your share button code -->
<div class="fb-share-button rounded" 
data-href="
<?php
// empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>" 
data-layout="button">
</div>
</div><!-- /col-4 -->
<div class="col-4 mt-1" style="margin-left:-45px;">
<!-- Load LINE Share Button -->
<div class="line-it-button" data-lang="ja" data-type="share-a" data-ver="3" data-url="https://pf01.newheadworks.com/category.php?pg=1&amp;level=4" data-color="default" data-size="small" data-count="false" style="display: none;"></div>
 <script src="https://www.line-website.com/social-plugins/js/thirdparty/loader.min.js" async="async" defer="defer"></script>
</div><!-- /col-4 -->
</div><!-- /row -->
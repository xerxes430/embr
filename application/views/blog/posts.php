<ul class="toolbox">
  <li class="toolbox_element delete delete"><a href="<?=base_url()?>delete/<?=strtolower( str_replace(" ","-",$post['content']['title']) )?>">Delete</a>
  <li class="toolbox_element edit"><a href="<?=base_url()?>edit/<?=strtolower( str_replace(" ","-",$post['content']['title']) )?>">Edit</a>
  <li class="toolbox_element reblog_element retweet"><strong>Reblog</strong><span class="hidden_url"><?=base64_encode($_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"])?></span>
</ul>

<div class="post blog_post <?php if(strlen($post['content']['image'])) echo "image"; ?>">
<?php
	$time = strtotime ($post['content']["datet"]);

  //Check for an image, if present create an image post
  if(strlen($post['content']['image'])){
    echo "<a href=\"".$post['content']['image']."\"><img alt=\"".$post['content']['title']."\" class=\"image_box\" src=\"".(strstr($post['content']['image'],"http") ? $post['content']['image'] : base_url()."img/uploads/".$post['content']['image'])."\" /></a>";
  	echo "<p class=\"info info_image\"><span class=\"post_date\"><span class=\"day\">".date("D",$time)."</span><span class=\"date\">".date("j",$time)."</span><span class=\"month\">".date("M",$time)."</span><span class=\"year\">".date("Y",$time)."</span></span></p>";
  	
    //If the post has a source, display it
    if( $post['content']['source'] )
      echo "<div class=\"image_source\">Source: <a href=\"".$post['content']['source']."\">".$post['content']['source']."</a></div>";
  }

  //Otherwise assume the post is a text post
  else{
    echo "<div class=\"post_inner\">";
    echo "<h2>".$post['content']['title']."</h2>";
    if( $post['content']['category'] )
	    echo "<p class=\"info\"><span class=\"author\">Posted by $first_name</span><span class=\"info_separator\"> on </span><span class=\"post_date\"><span class=\"day\">".date("D",$time)."</span><span class=\"date\">".date("j",$time)."</span><span class=\"month\">".date("M",$time)."</span><span class=\"year\">".date("Y",$time)."</span></span> in <a href=\"".base_url()."category/".strtolower( str_replace(" ","-",$post['content']['category']) )."\">".$post['content']['category']."</a></p>";
    else
      echo "<p class=\"info\"><span class=\"author\">Posted by $first_name</span><span class=\"info_separator\"> on </span><span class=\"post_date\"><span class=\"day\">".date("D",$time)."</span><span class=\"date\">".date("j",$time)."</span><span class=\"month\">".date("M",$time)."</span><span class=\"year\">".date("Y",$time)."</span></span></p>";


    echo $this->typography->auto_typography( $post['content']['content'] );
    echo "</div>";

	if( count( $post['tags'] ) || $post['content']['source'] ){
      echo "<div class=\"tags\">";
      if( count( $post['tags'] ) ){
      echo "Tagged: ";
        $count = 0;
        foreach ($post['tags'] as $tag){
          echo "<a href=\"".base_url()."tag/".strtolower(str_replace(" ","-",$tag['tag']))."\">".$tag['tag']."</a>";
          if( $count < count($post['tags'])-1 )
            echo ", ";
          $count++;
        }
      }else echo "&nbsp;";
	    if( $post['content']['source'] )
	      echo "<span class=\"source\">Source: <a href=\"". $post['content']['source']."\">". $post['content']['source']."</a></span>";
	  echo "</div>";
    }
  }
?>

</div>
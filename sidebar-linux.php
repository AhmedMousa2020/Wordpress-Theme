<?php
$comments_args=array(
    'staus'=>'approve'
);
$comments_count=0;
$all_comments=get_comments($comments_args);
foreach($all_comments as $comment)
{
      $post_id=$comment->comment_post_ID;

      if(! in_category('linux',$post_id))
      {
          continue;
      }
      $comments_count++;
}

//get category posts count
  $cat=get_queried_object();
  $posts_count=$cat->count;
?>
<div class="sidebar-linux">
   <div class="widget">
        <h3 class="widget-title"><?php single_cat_title() ?> Statistics</h3>
        <div class="widget-content">
            <ul class="list-unstyled">
                <li><span>Comments Count: <?php echo $comments_count ?></span></li>
                <li><span>Posts Count: <?php echo $posts_count ?></span></li>
            </ul>

        </div>    
   </div>
   <div class="widget">
        <h3 class="widget-title">Latest PHP Posts</h3>
        <div class="widget-content">
            <ul class="list-unstyled">
            <?php
              $posts_args=array(
                 'posts_per_page'=>3,
                 'cat'           =>'php' 
              );
               $query=new WP_Query($posts_args);
               if($query->have_posts())
               {
                   while($query->have_posts())
                   {
                     $query->the_post();  ?>
                        <li>
                           <a target="_blank" href="<?php the_permalink()?>"><?php the_title()?></a>
                        </li>
                   <?php
                   }
               }
              ?>
              </ul>
        </div>    
   </div>
   <div class="widget">
        <h3 class="widget-title">Hot Post by Comment</h3>
        <div class="widget-content">
        <ul class="list-unstyled">
            <?php
              $hotposts_args=array(
                 'posts_per_page'    =>1,
                 'orderby'           =>'comment_count' 
              );
               $hotquery=new WP_Query($hotposts_args);
               if($hotquery->have_posts())
               {
                   while($hotquery->have_posts())
                   {
                     $hotquery->the_post();  
                     ?>
                        <li>
                           <a target="_blank" href="<?php the_permalink()?>"><?php the_title()?></a>
                           <br>
                            This Post has: 
                           <?php comments_popup_link('0 Comments','One Comment','% Comment','comment-url','comment Disabled')?>
                           <hr>
                        </li>
                   <?php
                   }
                   wp_reset_postdata();
               }
              ?>
              </ul>        </div>    
   </div>
</div>
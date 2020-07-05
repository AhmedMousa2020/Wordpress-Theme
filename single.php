<?php 
get_header();
include(get_template_directory() . '/includes/breadcrumb.php');
?>
<div class="container post-page">
<?php 
if(have_posts()){
   while(have_posts())
   {
        the_post() ?>
      <div class="main-post">
         <?php edit_post_link('Edit <i class="fa fa-pencil"></i>') ?>
        <h3 class="post-title">
           <a href="<?php the_permalink() ?>">
              <?php the_title() ?>
           </a>
        </h3>
        <span class="post-author">
         <i class="fa fa-user fa-fw"></i><?php the_author_posts_link() ?> 
         </span>
        <span class="post-date">
        <i class="fa fa-calendar fa-fw"></i> <?php the_time('F j,Y') ?>
        </span>
        <span class="post-comments">
        <i class="fa fa-comments-o fa-fw"></i> <?php comments_popup_link('No Comments','One Comment','% Comment','comment-url','Comments OFF') ?> 
        </span>
            <?php 
                if ( has_post_thumbnail() ) { 
                ?>
                <a href="<?php the_permalink()?>">
                <?php
                the_post_thumbnail('', ['class' => 'img-responsive img-thumbnail', 'title' => get_the_title() ]); 
                }else{?>
                    <a href="<?php the_permalink()?>">
                    <img src="http://placehold.it/500x340/011" class="img-responsive img-thumbnail" alt="'<?php get_the_title() ?>"/>
                    </a>
                <?php
                }
                ?>
                </a>   
        
         
              <div class="post-content"><?php the_content() ?> </div>
      
                  
        
                <hr>
                <p class="categories"><i class="fa fa-tags fa-fw"></i> <?php the_category(', ') ?> </p>
                <p class="post-tags">
                
                   <?php 
                   if(has_tag())
                   {
                      the_tags();
                   }else
                      echo 'Tags:There no tags';
                
                ?>
                </p>
               

      </div>
     <?php
   }
  }
  echo '<div class="clearfix"></div>';?>

<?php
  /*
  $post_per_page=5;
  $random_posts_arguments=array(
        'posts_per_page' =>5,
        'orderby'        =>'rand',
        'category__in'   =>wp_get_post_categories(get_queried_object_id()),
        'post__not_in'   =>array(get_queried_object_id())
  );    
   $random_posts=new wp_Query($random_posts_arguments);
  if($random_posts->have_posts()){
     while($random_posts->have_posts())
     {
         $random_posts->the_post() ?>
         <div class="author-posts">   
            <h3 class="post-title">
               <a href="<?php the_permalink() ?>">
                  <?php the_title() ?>
               </a>
            </h3>
         </div>
      <?php 
         }
         }
         wp_reset_postdata();
         */
         ?>  
  <div class="row">
     <div class="col-md-2">
         <?php
         $avatar_arguments=array(
            'class'=>'img-responsive img-thumbnail center-block'
         ); 
         echo get_avatar(get_the_author_meta('ID'),128,'','User Avatar',$avatar_arguments);
         
         ?> 
      </div>
      <div class="col-md-10 author-info">
         <h4>
            <?php the_author_meta('first_name')?>
            <?php the_author_meta('last_name')?>
            (<span class="nickname"> <?php the_author_meta('nickname')?></span> )
         </h4>
         <?php if(get_the_author_meta('description')){?>
            <p><?php the_author_meta('description')  ?></p>
         <?php }else
         {
            echo 'No Discreption Avilable';
         }
         ?>
      </div>
   </div>
     <div class="author-stats">
       <p>
     <i class="fa fa-tags"></i> User Post Count: <span class="post-count"><?php echo count_user_posts(get_the_author_meta('ID'))?></span>
      </p>
      <p>
      <i class="fa fa-user"></i> User Profile Liink: <span><strong><?php the_author_posts_link()?></strong></span>
      </p>
      </div>
   <?php
  echo '<hr class="comment-separator">';
  echo '<div class="post-pagination">';
  if(get_previous_post_link())
     {
      previous_post_link('%link','<i class="fa fa-chevron-left  fa-lg" aria-hidden="true"></i> %title');
     }else
     {
        echo '<span class="previous-span">Prev </span>';
     }
     if(get_next_post_link())
     {
      next_post_link('%link','%title <i class="fa fa-chevron-right  fa-lg" aria-hidden="true"></i>');
     }else
     {
        echo '<span class="previous-span">Next</span>';
     }
     echo '</div>';
     echo '<hr class="comment-separator">';
     comments_template();
  ?> 

</div>
<?php get_footer() ?>
<?php get_header()?>
 <div class="container author-page">
 <h1 class="profile-header"><?php the_author_meta('nickname')?> Page</h1>
  <div class="author-main-info">
   <div class="row">
    <div class="col-md-3">
    <?php
         $avatar_arguments=array('class'=>'img-responsive img-thumbnail center-block'); 
         echo get_avatar(get_the_author_meta('ID'),196,'','User Avatar',$avatar_arguments);
         ?> 
    </div>
    <div class="col-md-9">
       <ul class="author-names list-unstyled">
            <li><span>First Name:</span> <?php the_author_meta('first_name')?></li>
            <li><span>Last Name:</span><?php the_author_meta('last_name')?></li>
            <li><span>Nickname:</span><?php the_author_meta('nickname')?></li>
       </ul>
       <hr>
       <?php if(get_the_author_meta('description')){?>
            <p><?php the_author_meta('description')  ?></p>
         <?php }else
         {
            echo 'No Discreption Avilable';
         }
         ?>
    </div>
   </div>
   </div>

   
   <div class="row author-stats">
    <div class="col-md-6">
        <div class="post-count">
           <p>Post Count</p>
           <span><?php echo count_user_posts(get_the_author_meta('ID'))?></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="comments-count">
           <p>Comments Count</p>
           <span>
               <?php
                 $commentscount_arguments=array(
                     'user_id' => get_the_author_meta('ID'),
                     'count'   =>true
                 );
                 echo get_comments($commentscount_arguments);
                ?>
                </span>
        </div>
    </div>
   </div>

   <?php
  
     $post_per_page=5;
     $author_posts_arguments=array(
           'author'         =>get_the_author_meta('ID'),
           'posts_per_page' => $post_per_page
     );    
      $author_posts=new wp_Query($author_posts_arguments);
     if($author_posts->have_posts()){?>

       <h3 class="author-posts-title">
         <?php
             if(count_user_posts(get_the_author_meta('ID')) >= $post_per_page)
             {
                 echo 'Lastes '.$post_per_page .' Posts of ';

                 the_author_meta('nickname');

             }else
             {
                 echo 'Lastes Posts of';
                 the_author_meta('nickname');
             }
             ?>
       </h3>
     <?php
        while($author_posts->have_posts())
        {
            $author_posts->the_post() ?>
            <div class="author-posts">
             <div class="row">
               <div class="col-sm-2">
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
          </div>
           <div class="col-sm-10">
             <h3 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a>
             </h3>
             <span class="post-date">
             <i class="fa fa-calendar fa-fw"></i> <?php the_time('F j,Y') ?>
             </span>
             <span class="post-comments">
             <i class="fa fa-comments-o fa-fw"></i> <?php comments_popup_link('No Comments','One Comment','% Comment','comment-url','Comments OFF') ?> 
             </span>  
                   <div class="post-content"><?php the_excerpt() ?> </div>
            
            </div>
        </div>
        </div>
            <div class="clearfix"></div>
          <?php
          
        }
       }
       wp_reset_postdata();

       $comments_per_page=5;
       $comments_arguments=array(
             'user_ID'         =>get_the_author_meta('ID'),
             'status'          => 'approve',
             'number'          => $comments_per_page,
             'post_status'     =>'publish',
             'post_type'       =>'post'
       );  
       
        $comments=get_comments($comments_arguments);
        if($comments)
        {?>
            <h3 class="author-posts-title">
         <?php
             if(get_comments($comments_arguments) >= $comments_per_page)
             {
                 echo 'Lastes [ '. $comments_per_page .' ] comments of ';

                 the_author_meta('nickname');

             }else
             {
                 echo 'Lastes comments of';
                 the_author_meta('nickname');
             }
             ?>
       </h3>
          <?php
            foreach($comments as $comment)
            {?>
            <div class="author-comments"> 
                <h3 class="post-title">
                <a href="<?php get_permalink($comment->comment_post_ID)?>">
                   <?php echo get_the_title($comment->comment_post_ID)?>
                </a>
               </h3>
              <div class="post-date">
                  <i class="fa fa-calendar fa=fw"></i>
                   <?php echo 'Added on '.mysql2date('l,F,j,Y',$comment->comment_date); ?>
              </div>
              <div class="post-content">
                <?php echo $comment->comment_content ?>
              </div>                 
            </div>
            <?php
            }
        }else
        {
            echo 'thare is no comments';
        }
       ?>
       </div>
 </div>
<?php get_footer()?>
<?php get_header() ?>
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
<div class="container home-page">
<div class="aha">
<div class="row">
    <div class="category-info text-center">
        <div class="col-md-4">
            <h1 class=" category-title"><?php single_cat_title() ?></h1>
        </div>
        <div class="col-md-4">
          <div class="category-description"><?php echo category_description()?></div>
        </div>
        <div class="col-md-4">
            <div class="category-stats">
                <span>Posts Count: <?php echo $posts_count ?></span>
                <span>  Comments Count: <?php echo $comments_count ?></span>
            </div>
        </div>   
    </div>
</div>

</div>
        <?php 
        if(have_posts()){
        while(have_posts())
        {
                the_post() ?>
            <div class="col-sm-6">
            <div class="main-post">
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
                        
                        <div class="post-content"><?php the_excerpt() ?> </div>
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
            </div>
            <?php
        }
        }
        /*
        echo '<div class="clearfix"></div>';
        
        echo '<div class="post-pagination">';
        if(get_previous_posts_link())
            {
            previous_posts_link('<i class="fa fa-chevron-left  fa-lg" aria-hidden="true"></i>Prev');
            }else
            {
                echo '<span class="previous-span">Prev </span>';
            }
            if(get_next_posts_link())
            {
            next_posts_link('<i class="fa fa-chevron-right  fa-lg" aria-hidden="true"></i>Next');
            }else
            {
                echo '<span class="previous-span">Next</span>';
            }
            echo '</div>';
            //  echo numbering_pagination();
            */
            ?>
            <div class="pagination-numbers"> 
            <?php echo numbering_pagination(); ?>
            </div> 
      
     </div>
<?php get_footer() ?>
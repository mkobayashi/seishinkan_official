<?php get_header(); ?>
    <div class="container-fluid local-header">
      <div class="row">
        <div class="col-xs-12 local-header-title text-center">
          <h2 class="h2-28 ryu-mincho"><?php the_title(); ?></h2>
        </div>
      </div>
      
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
      <article class="container">
      <hr class="sta-fixspace-sm" />

      <div class="row seminar-detail">
        <div class="col-xs-12 col-sm-8">
<?php the_content(); ?>
        </div>
      </div><!-- .seminar-detail -->
      </article>
    
    <hr class="sta-space">

<?php endwhile; ?>
    </div>

<?php get_footer(); ?>
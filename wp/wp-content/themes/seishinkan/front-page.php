<?php get_header(); ?>

    <!-- Local header -->
    <div class="container local-header">
      <div class="row">
        <div class="col-xs-12 local-header-img_top tile">
        <div id="top-header-fade" class="crossfader">
          <img src="/image/top_01.jpg" class="img-responsive" alt="">
          <img src="/image/top_02.jpg" class="img-responsive" alt="">
          <img src="/image/top_03.jpg" class="img-responsive" alt="">
          <img src="/image/top_04.jpg" class="img-responsive" alt="">
          <img src="/image/top_05.jpg" class="img-responsive" alt="">
        </div>
        </div>
        <div class="container sta-label-con">
          <div class="local-label top ryu-mincho">
            <p>人生万般に通ずる道を体得する</p>
          </div>
        </div>
      </div>
    </div><!-- Local header -->
    <!-- Local Contents -->
    <hr class="sta-space-xs">
    <div class="container" id="page-down">
<?php
$args = array(
  "category_name"    => "info",
  "posts_per_page "  => 3
);
$the_query = new WP_Query( $args );
?>
<?php if ( $the_query->have_posts() ): ?>
      <div class="row news-info">
        <div class="col-xs-12">
          <table class="table">
<?php while( $the_query->have_posts() ): $the_query->the_post(); ?>
            <tr class="top">
              <td class="col-xs-6 col-sm-2"><?php the_time('Y年m月d日'); ?></td>
              <td class="tags col-xs-6 col-sm-2">
                <span class="label sta-label-guide">活動報告</span>
              </td>
              <td class="col-xs-12 col-sm-8 text"><p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p></td>
            </tr>
<?php endwhile; ?>
          </table>
        </div>
      </div>
<?php wp_reset_postdata(); endif; ?>
    </div>
    <!-- Local Contents -->
    <hr class="sta-space-xs">

<?php get_template_part( 'template-parts/home', 'main' ); ?>

<?php get_footer(); ?>
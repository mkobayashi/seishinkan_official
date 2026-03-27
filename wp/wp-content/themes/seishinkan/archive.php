<?php get_header(); ?>
    <div class="container-fluid local-header">
      <div class="row">
        <div class="col-xs-12 local-header-title text-center">
          <h2 class="h2-28 ryu-mincho"><?php the_archive_title( '', '' ); ?></h2>
        </div>
      </div>
      

      <article class="container">
      <div class="row seminar-title">
        <div class="col-xs-12 col-sm-7 text-info">
          <h4>記事一覧</h4>
        </div>
      </div><!-- .seminar-title -->
      <hr class="sta-fixspace-sm" />

      <div class="row seminar-detail">
        <div class="col-xs-12 col-sm-12">
          <table class="table">
<?php while ( have_posts() ) : the_post(); ?>
            <tr class="top">
              <td class="col-xs-3 col-sm-2"><?php the_time('Y年m月d日'); ?></td>
              <td class="tags col-xs-1 col-sm-2">
                <span class="label sta-label-guide">活動報告</span>
              </td>
              <td class="col-xs-8 col-sm-8 text"><p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p></td>
            </tr>
<?php endwhile; ?>
          </table>
        </div>
      </div><!-- .seminar-detail -->
      </article>
    
    <hr class="sta-space">

    </div>

<?php get_footer(); ?>
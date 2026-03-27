<?php get_header(); ?>
      
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <!-- Local header -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 local-header-title text-center">
          <h2 class="h2-28 ryu-mincho">道場・教室一覧</h2>
        </div>
      </div>
    </div>

    <!-- Local Contents -->
    <div class="container">
      <div class="row news-info">
        <div class="col-xs-12 dojo-bread">
          <div>
            <h4 class="text-info"><?php the_field('area'); ?></h4>
          </div>
        </div>
      </div>

      <div class="row news-info dojo-detail">
        <div class="col-xs-12 title">
          <h2 class="text-info"><?php the_title(); ?></h2>
			          <h4 class="text-info"><?php the_field('info'); ?></h4>
        </div>

        <div class="col-xs-12 col-sm-8 tile">
          <table class="table">
            <?php if (get_field('address') ): ?><tr>
              <th class="col-xs-3 text-info">住所</th>
              <td class="col-xs-9"><?php the_field('address'); ?></td>
            </tr><?php endif; ?>
                        <?php if (get_field('aikido') ): ?><tr>
              <th class="col-xs-3 text-info">合氣道クラス</th>
              <td class="col-xs-9"><?php the_field('aikido'); ?></td>
            </tr><?php endif; ?>
            <?php if (get_field('ki') ): ?><tr>
              <th class="col-xs-3 text-info">氣のクラス</th>
              <td class="col-xs-9"><?php the_field('ki'); ?></td>
            </tr><?php endif; ?>
            <?php if (get_field('kids') ): ?><tr>
              <th class="col-xs-3 text-info">子どもクラス</th>
              <td class="col-xs-9"><?php the_field('kids'); ?></td>
            </tr><?php endif; ?>
            <?php if (get_field('reserve') ): ?><tr>
              <th class="col-xs-3 text-info">見学・無料体験</th>
              <td class="col-xs-9"><?php the_field('reserve'); ?></td>
            </tr><?php endif; ?>
          </table>

        </div> <!-- end table -->

        <div class="col-xs-12 col-sm-4 map">
            <!-- Google Map -->
            <div class="sta ggmap mapdisplay"></div>
        </div>

      </div>
    </div>

         <div class="container">
      <div class="row dojo-btn">
        <div class="col-xs-12 text-center">
          <?php
          $cat_id = get_category_by_slug('dojo');
          $cat_link = get_category_link($cat_id);
          ?>
          <form action="<?php echo $cat_link; ?>" method="post">
            <input type="hidden" name="searchword" value="">
            <input type="hidden" name="country" value="0">
            <input type="hidden" name="prefecture" value="1">
            <input type="hidden" name="page" value="0">
            <input type="submit" value="一覧に戻る" class="btn btn-default btn-lg">
          </form>
        </div>
      </div>
    </div>  

<?php endwhile; ?>

<?php get_footer(); ?>
<?php get_header(); ?>
    
    <div class="container-fluid local-header">
      <div class="row">
        <div class="col-xs-12 local-header-title text-center">
          <h2 class="h2-28 ryu-mincho">道場・教室</h2>
        </div>
      </div>

      
    <div class="container-fluid local-header">
      <div class="row">
        <div class="col-xs-12 local-header-img">
          <img src="/image/dojo.jpg" class="img-responsive">
        </div>
      </div>
    </div>
    </div>
    <!-- Contents -->

    <div class="sta-space-sm"></div>

    
    <div class="container corp-info">
      <div class="row"><div class="col-xs-12 text-center text-primary local-title no-border kozuka-mincho">
          <h2 class="h2-28">道場・教室一覧</h2>
      </div>
      </div>
      
<!--- News Information , List--->
    <div class="container">
      <div class="row news-info list">
        <div class="col-xs-12">
          <table id="dojoName" class="table">
<?php while ( have_posts() ) : the_post(); ?>
            <tr class="top page0">
              <td class="col-xs-12 col-sm-3 title">
                <h4 class="h4-16 text-info"><?php the_title(); ?></h4>
				                  <p><?php the_field('info'); ?></p>
              </td>
              <td class="col-xs-12 col-sm-7 text"><?php the_field('address'); ?><br><br></td>
              <td class="col-xs-12 col-sm-3 text link">
                <form action="<?php the_permalink(); ?>" method="post">
                  <input type="hidden" name="id" value="107">
                  <input type="hidden" name="searchword" value="">
                  <input type="hidden" name="country" value="0">
                  <input type="hidden" name="prefecture" value="1">
                  <input type="hidden" name="page" value="0">
                  <input type="submit" value="詳細を見る" class="btn btn-lg btn-warning">
                </form><br>
              </td>
            </tr>
<?php endwhile; ?>
          </table>
<p>※毎月第5週は休みの場合があります。事務局までお問い合わせください。</p>

      </div>
    </div>
</div>

</div>

    <!-- Footer Contents -->
    <div class="container">
      <div class="row btnlink2">
        <a href="http://www.seishinkan.org/reserve/"><div class="col-xs-12 col-lg-8 col-lg-push-2 text-center yu-gothic">
          <span class="btn-lg btn-block">
            見学・無料体験のご予約<br class="visible-xs">
          </span>
            </div></a>
      </div>
    </div>
    <!-- Footer Contents -->
<?php get_footer(); ?>
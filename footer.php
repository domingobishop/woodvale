<footer id="footer" class="bc-footer">
  <div class="container">
    <div class="row">
      <div class="col-md-8 site-info">
          <div class="branding">
              <a href="<?php bloginfo('siteurl'); ?>/"
                 title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" class="img-responsive">
              </a>
          </div>
        <p>Copyright © <?php echo date("Y"); ?> <br>
            Woodvale Vintners<br>
          <small>Website by <a href="http://creatistic.com.au/" target="_blank">Creatistic</a></small></p>
      </div>
    </div>
  </div>
</footer>
<!-- #foot -->

<?php wp_footer(); ?>

</body>
</html>
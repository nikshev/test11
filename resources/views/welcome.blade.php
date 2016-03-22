

<?php if (\Auth::check()) : ?>
  <?php echo \View::make('dashboard'); ?>
<?php else :?>
  <?php echo \View::make('auth/login'); ?>
<?php endif; ?>


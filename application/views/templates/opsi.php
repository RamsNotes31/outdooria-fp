<?php if (empty($_SESSION)) : ?>
    <div class="d-flex justify-content-center">
        <a href="<?php echo base_url('login'); ?>" class="btn btn-lg btn-neoraised btn-primary px-4 py-2 fw-bolder">Login</a>
    </div>
<?php else : ?>
    <div class="d-flex justify-content-center">
        <a href="<?php echo base_url('rental'); ?>" class="btn btn-lg btn-neoraised btn-warning px-4 py-2 fw-bolder">Get Started</a>
    </div>
<?php endif; ?>
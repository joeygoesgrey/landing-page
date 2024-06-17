<?php
get_header(); ?>

<?php get_header(); ?>

<?php get_template_part('template-parts/hero'); ?>
<?php get_template_part('template-parts/results'); ?>
<?php get_template_part('template-parts/testimonials'); ?>
<?php get_template_part('template-parts/about'); ?>
<?php get_template_part('template-parts/countdown-timer'); ?>

<div class="flex items-center justify-center mt-8">
    <div class="flex flex-row justify-center items-center">
        <button id="openModalButton2" class="bg-red-500 p-5 rounded animate__rubberBand animate__backInDown">
            <span class="text-md md:text-xl text-white">Get it First</span>
        </button>
    </div>
</div>

<?php get_footer(); ?>
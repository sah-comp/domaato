<?php
/**
 * The Domaato website.
 *
 * @package Domaato
 * @subpackage Template
 * @author $Author$
 * @version $Id$
 */
?>
<header>
    <h1 class="brand ir"><a href="<?php echo Url::build( '/' ) ?>" title="<?php echo I18n::__( 'app_name_domaato' ) . ' ' . I18n::__( 'app_claim_domaato' ) ?>">Domaato</a></h1>
</header>
<div id="splash">
    
    <section id="home" data-tooltip="<?php echo I18n::__( 'domaato_section_home' ) ?>">
        <h1 class="brand ir">Domaato</h1>
        <h2><?php echo I18n::__( 'app_claim_domaato' ) ?></h2>
    </section>
    
    <section id="testimonials" data-tooltip="<?php echo I18n::__( 'domaato_section_testimonials' ) ?>">

        <div class="slide">

            <div class="testimonial-wrap testimonial">
                <blockquote cite="<?php echo Url::build('/profile/1') ?>">
                    <p>Cras ut suscipit leo. Sed fermentum sodales nibh eget porta. Sed fringilla arcu ut lacinia rutrum. Suspendisse et urna sapien.</p>
                </blockquote>
                <div class="testimonial-attribution">
                    <p class="testimonial-author"><a href="#max">Stephan Hombergs</a></p>
                    <div class="testimonial-thumb" style="background-image: url(<?php echo Gravatar::src( 'info@sah-company.com', 120 ) ?>)"></div>
                </div>
            </div>

        </div>

        <div class="slide">

            <div class="testimonial-wrap testimonial">
                <blockquote cite="<?php echo Url::build('/profile/1') ?>">
                    <p>Sed fermentum sodales nibh eget porta. Sed fringilla arcu ut lacinia rutrum. Suspendisse et urna sapien.</p>
                </blockquote>
                <div class="testimonial-attribution">
                    <p class="testimonial-author"><a href="#max">Alexander Berg</a></p>
                    <div class="testimonial-thumb" style="background-image: url(<?php echo Gravatar::src( 'ich@7ich.de', 120 ) ?>)"></div>
                </div>
            </div>

        </div>

        <div class="slide">

            <div class="testimonial-wrap testimonial">
                <blockquote cite="<?php echo Url::build('/profile/1') ?>">
                    <p>Sed fringilla arcu ut lacinia rutrum. Suspendisse et urna sapien. Sed fermentum sodales nibh eget porta</p>
                </blockquote>
                <div class="testimonial-attribution">
                    <p class="testimonial-author"><a href="#max">Max Mustermann</a></p>
                    <div class="testimonial-thumb" style="background-image: url(<?php echo Gravatar::src( 'max@7ich.de', 120 ) ?>)"></div>
                </div>
            </div>

        </div>

    </section>

    <section id="customers" data-tooltip="<?php echo I18n::__( 'domaato_section_customers' ) ?>">
        
        <div class="slide">
            <h2>Apple</h2>
        </div>

        <div class="slide">
            <h2>Edelhelfer</h2>
        </div>

        <div class="slide">
            <h2>Fielmann</h2>
        </div>

    </section>

</div>

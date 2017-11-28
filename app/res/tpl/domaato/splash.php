<?php
/**
 * The Domaato website.
 *
 * @package Domaato
 * @subpackage Template
 * @author $Author$
 * @version $Id$
 */

/**
 * Find three users who have testimonials.
 */
$_users = R::find('user', " testimonial > '' LIMIT 3 ");

/**
 * Load the initial count information.
 */
$_counter = Controller_Api::status(false);
?>
<header>
    <h1 class="brand ir"><a href="<?php echo Url::build('/') ?>" title="<?php echo I18n::__('app_name_domaato') . ' ' . I18n::__('app_claim_domaato') ?>">Domaato</a></h1>
</header>
<div id="splash" class="animatedParent">

    <section id="home" data-tooltip="<?php echo I18n::__('domaato_section_home') ?>">
        <h1 class="brand ir">Domaato</h1>
        <h2><?php echo I18n::__('app_claim_domaato') ?></h2>
        <a href="#explore" class="nextSlide animated bounceInUp delay-666"><?php echo I18n::__('domaato_ahref_explore') ?></a>
    </section>

    <section id="testimonials" data-tooltip="<?php echo I18n::__('domaato_section_testimonials') ?>">

<?php foreach ($_users as $_id => $_user): ?>

    <div class="slide">

        <div class="testimonial-wrap testimonial">
            <blockquote cite="">
                <p><?php echo htmlspecialchars($_user->testimonial) ?></p>
            </blockquote>
            <div class="testimonial-attribution">
                <p class="testimonial-author"><a href="<?php echo Url::build('/profile/' . $_user->getId()) ?>"><?php echo htmlspecialchars($_user->getName()) ?></a></p>
                <div class="testimonial-thumb" style="background-image: url(<?php echo Gravatar::src($_user->email, 120) ?>)"></div>
            </div>
        </div>

    </div>

<?php endforeach ?>

    </section>

    <section id="facts" data-tooltip="<?php echo I18n::__('domaato_section_facts') ?>">

        <div class="row">

            <div class="span4 counter">
                <p id="count-report" class="counter" data-target="<?php echo $_counter['count']['report'] ?>">1</p>
                <p><?php echo I18n::__('domaato_counter_reports') ?></p>
            </div>

            <div class="span4 counter">
                <p id="count-company" class="counter" data-target="<?php echo $_counter['count']['customer'] ?>">1</p>
                <p><?php echo I18n::__('domaato_counter_companies') ?></p>
            </div>

            <div class="span4 counter">
                <p id="count-user" class="counter" data-target="<?php echo $_counter['count']['user'] ?>">1</p>
                <p><?php echo I18n::__('domaato_counter_users') ?></p>
            </div>

        </div>

        <div id="newsletter-container" class="newsletter-form">

            <h2><?php echo I18n::__('domaato_headline_newsletter') ?></h2>
            <p><?php echo I18n::__('domaato_paragraph_newsletter') ?></p>

            <form
                id="newsletter-optin"
                class="ajaxed"
                action="<?php echo Url::build('/newsletter/opt-in') ?>"
                data-container="newsletter-container"
                method="POST"
                accept-charset="utf-8"
                enctype="multipart/form-data">
                <fieldset>
                    <input
                        type="email"
                        id="newsletter-email"
                        name="dialog[email]"
                        placeholder="<?php echo I18n::__('domaato_placeholder_email') ?>"
                        value="<?php echo htmlspecialchars('') ?>"
                        size="48"
                        required="required" />
                    <input type="submit" name="submit" value="<?php echo I18n::__('domaato_newsletter_submit') ?>" />
                </fieldset>
            </form>
        </div>

    </section>

    <section id="customers" data-tooltip="<?php echo I18n::__('domaato_section_customers') ?>">

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

    <section id="contact" data-tooltip="<?php echo I18n::__('domaato_section_contact') ?>">

        <div class="row">

            <div class="span4">

                <div class="contact-wrapper">

                    <h2><?php echo I18n::__('domaato_headline_contact') ?></h2>

                    <p>
                    Domaato<br />
                    Kochstraße 6<br />
                    34121 Kassel<br />
                    Germany
                    </p>

                    <p>
                    Telefon +49 561 123 456 67
                    </p>

                    <p>
                    E-Mail <a href="mailto:info@domaato.de">info@domaato.de</a><br />
                    Web <a href="https://domaato.de">https://domaato.de</a>
                    </p>

                </div>

            </div>

            <div class="span8">

                Contact form or map or whatever.

            </div>

        </div>

    </section>

</div>

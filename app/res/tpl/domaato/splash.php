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
 * Find at most three users who have testimonials and are willing to be published.
 */
$_users = R::find('user', "testimonial <> '' AND public = 1 ORDER BY RAND() LIMIT 3");

/**
 * Find at most three customers (person beans) who have testimonials and are willing to be published.
 */
$_customers = R::find('person', "testimonial <> '' AND public = 1 AND enabled = 1 ORDER BY RAND() LIMIT 3");

/**
 * Load the initial count information.
 *
 * You have to use your API key to construct a api controller which you than can use
 * to question the status or everything else. The API may answer with JSON encoded
 * data or PHP arrays, depending on the parameter given.
 */
$api_controller = new Controller_Api('52fa2902eaad05b96cc35b750c2d635d8c9d4bc7');
$_counter = $api_controller->status(false);// we want a PHP array

?>
<header>
    <h1 class="brand ir"><a href="<?php echo Url::build('/') ?>" title="<?php echo I18n::__('app_name_domaato') . ' ' . I18n::__('app_claim_domaato') ?>">Domaato</a></h1>
    <ul class="account-navigation">
    <?php if (! Flight::has('user')): ?>
        <li><a href="<?php echo Url::build('/profile') ?>" rel="nofollow"><?php echo I18n::__('domaato_account_login') ?></a></li>
        <li><a href="<?php echo Url::build('/register') ?>" rel="nofollow"><?php echo I18n::__('domaato_account_register') ?></a></li>
    <?php else: ?>
        <li>
            <a
                href="<?php echo Url::build('/profile/') ?>">
    			<img
    				src="<?php echo Gravatar::src(Flight::get('user')->email, 24) ?>"
                    class="circular circular-24 no-shadow"
    				width="24"
    				height="24"
    				alt="<?php echo htmlspecialchars(Flight::get('user')->getName()) ?>" />
    			<?php echo htmlspecialchars(Flight::get('user')->getName()) ?>
            </a>
        </li>
        <li><a href="<?php echo Url::build('/logout') ?>"><?php echo I18n::__('domaato_account_logout') ?></a></li>
    <?php endif; ?>
    </ul>
</header>
<div id="splash" class="animatedParent">

    <section id="home" data-tooltip="<?php echo I18n::__('domaato_section_home') ?>">
        <h1 class="brand ir">Domaato</h1>
        <h2><?php echo I18n::__('app_claim_domaato') ?></h2>
        <a href="#explore" class="nextSlide animated bounceInUp delay-666"><?php echo I18n::__('domaato_ahref_explore') ?></a>
    </section>

    <section id="tell-me" data-tooltip="<?php echo I18n::__('domaato_section_tellme') ?>">
        <h1>Form to tell a report</h1>
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
                data-container="newsletter-answer"
                data-emptybeforeappend="yes"
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
            <div id="newsletter-answer" class="animatedParent"></div>
        </div>

    </section>

    <section id="customers" data-tooltip="<?php echo I18n::__('domaato_section_customers') ?>">

<?php foreach ($_customers as $_id => $_person): ?>

    <div class="slide">

        <div class="testimonial-wrap testimonial">
            <blockquote cite="">
                <p><?php echo htmlspecialchars($_person->testimonial) ?></p>
            </blockquote>
            <div class="testimonial-attribution">
                <p class="testimonial-author"><a href="<?php echo Url::build('/business/' . $_person->getId()) ?>"><?php echo htmlspecialchars($_person->getName()) ?></a></p>
                <div class="testimonial-thumb" style="background-image: url(<?php echo Gravatar::src($_person->email, 120) ?>)"></div>
            </div>
        </div>

    </div>

<?php endforeach ?>

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

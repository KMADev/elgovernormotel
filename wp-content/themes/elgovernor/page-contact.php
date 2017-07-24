<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package KMA_DEMO
 */
get_header();
//default settings
define(ADMIN_EMAIL, 'support@kerigan.com');
define(DOMAIN_NAME, 'elgovernormotel.net');
$passCheck = TRUE;

date_default_timezone_set('America/Chicago' );

//display successful flash message

$leads         = new kmaLeads();
$honeypot      = new Akismet(site_url(), '16d52e09a262');

if ($_POST['customer_name']) {
    //print_r($_POST);
//assign vars to our post items
    $customer_name  = $_POST['customer_name'];
    $customer_phone = $_POST['customer_phone'];
    $customer_email = $_POST['customer_email'];
    $comments       = htmlentities(stripslashes($_POST['comments']));
    $math           = $_POST['math'];
//Run our own checks on submitted data

    $adderror = array(); //make array of error data so we can loop it later

    if ($customer_name == '') {
        $passCheck  = FALSE;
        $adderror[] = 'Name is required. How else will we know who you are?';
    }
    if ($customer_email == '') {
        $passCheck  = FALSE;
        $adderror[] = 'Please include your email address.';
    }
    if ($math != 6) {
        $passCheck  = FALSE;
        $adderror[] = 'Your math wasn\'t quite right on the last step. Bust out that calculator and try again...';
    }

//assign vars to honeypot submission
    $honeypot->setCommentAuthor($customer_name);
    $honeypot->setCommentAuthorEmail($customer_email);
    $honeypot->setCommentContent($comments);
    $honeypot->setPermalink(strtolower(str_replace(' ', '-', $_POST['customer_name']) . '-' . date('Y-m-d')));

    $successmessage = '<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span><span class="sr-only">Success:</span> ';
    $errormessage   = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> ';

    if ($honeypot->isCommentSpam()) {
        //THIS IS SPAM
        //TODO: insert post marked as spam... how do we do that again?

        $passCheck = FALSE; //Why not?
        $errormessage .= 'Your message was flagged by our state-of-the-art spam checker.';

    } else { //NOT SPAM

        //Passed all checks
        if ($passCheck) {

            //SET UP AND SEND LEAD VIA EMAIL
            //Set up headers
            $sendadmin   = array(
                'to'      => ADMIN_EMAIL,
                'from'    => 'El Governor Motel <noreply@' . DOMAIN_NAME . '>',
                'subject' => 'Info request from website',
                'bcc'     => '',
                'replyto' => $customer_email
            );
            $sendreceipt = array(
                'to'      => $customer_email,
                'from'    => 'El Governor Motel <noreply@' . DOMAIN_NAME . '>',
                'subject' => 'Thanks for contacting us',
                'bcc'     => 'support@kerigan.com'
            );

            //datafields for email
            $postvars = array(
                'Name'          => $customer_name,
                'Email Address' => $customer_email,
                'Phone Number'  => $customer_phone,
                'Comments'      => $comments,
            );

            $fontstyle     = 'font-family: sans-serif;';
            $headlinestyle = 'style="font-size:20px; ' . $fontstyle . ' color:#000;"';
            $copystyle     = 'style="font-size:16px; ' . $fontstyle . ' color:#333;"';
            $labelstyle    = 'style="padding:4px 8px; background:#fafafa; border:1px solid #fff; font-weight:bold; ' . $fontstyle . ' font-size:14px; color:#333; width:150px;"';
            $datastyle     = 'style="padding:4px 8px; background:#fafafa; border:1px solid #fff; ' . $fontstyle . ' font-size:14px; color:#333; "';

            $adminintrocopy   = '<p ' . $copystyle . '>Details are below:</p>';
            $receiptintrocopy = '<p ' . $copystyle . '>Thank you for contacting El Governor Motel. We review requests each day and will get back with you soon. What you submitted is below:</p>';
            $dateofemail = '<p ' . $copystyle . '>Date Submitted: ' . date('M j, Y') . ' at ' . date('h:i a') . '</p>';

            $submittedData = '<table cellpadding="0" cellspacing="0" border="0" style="width:100%" ><tbody>';
            foreach ($postvars as $key => $var) {
                if (!is_array($var)) {
                    $submittedData .= '<tr><td ' . $labelstyle . ' >' . $key . '</td><td ' . $datastyle . '>' . $var . '</td></tr>';
                } else {
                    $submittedData .= '<tr><td ' . $labelstyle . ' >' . $key . '</td><td ' . $datastyle . '>';
                    foreach ($var as $k => $v) {
                        $submittedData .= '<span style="display:block;width:100%;">' . $v . '</span><br>';
                    }
                    $submittedData .= '</ul></td></tr>';
                }
            }
            $submittedData .= '</tbody></table>';

            $emaildata   = array(
                'headline'  => '<h2 ' . $headlinestyle . '>' . $sendadmin['subject'] . '</h2>',
                'introcopy' => $adminintrocopy . $submittedData . $dateofemail,
            );
            $receiptdata = array(
                'headline'  => '<h2 ' . $headlinestyle . '>' . $sendreceipt['subject'] . '</h2>',
                'introcopy' => $receiptintrocopy . $submittedData . $dateofemail,
            );

            $leads->sendEmail($sendadmin, $emaildata);
            $leads->sendEmail($sendreceipt, $receiptdata);

            //Insert Post based on form submission
            $leads->wp_insert_post(
                array( //POST INFO
                    'post_content'   => '',
                    'post_status'    => 'publish',
                    'post_type'      => 'lead',
                    'post_title'     => $customer_name . ' on ' . date('M j, Y'),
                    'comment_status' => 'closed',
                    'ping_status'    => 'closed',
                    'meta_input'     => array( //POST META
                        'lead_info_name'          => $customer_name,
                        'lead_info_phone_number'  => $customer_phone,
                        'lead_info_email_address' => $customer_email,
                        'lead_info_message'       => $comments,
                    )
                ), true
            );

            $successmessage .= '<strong>Thank you for contacting El Governor Motel. We review requests each day and will get back with you soon.</strong>';
            $showAlert = '<div class="alert alert-success" role="alert">' . $successmessage . '</div>';

        } else { // Pass failed. Let's show an error message.

            $listErrors = '';
            foreach ($adderror as $errorDirection) {
                $listErrors .= '<br>• ' . $errorDirection;
            }
            $errormessage .= '<strong>Errors were found in your submission. Please correct the indicated fields below and try again.</strong>';
            $showAlert = '<div class="alert alert-danger" role="alert">' . $errormessage . $listErrors . '</div>';

        }
    }
}


if (!is_front_page()) {
    ?>
    <div class="container">
        <div class="row">
            <div id="primary" class="content-area col-lg-8">
                <main id="main" class="site-main" >

                    <?php
                    while (have_posts()) : the_post();

                        get_template_part('template-parts/content', 'page');

                    endwhile; // End of the loop.
                    ?>
                    <div>
                        <?php if ($adderror) {
                            foreach ($adderror as $k => $v) {
                                echo $v;
                            }
                        } ?>
                    </div>
                    <?php if ($_POST['customer_name']) {
                        echo $showAlert;
                    } ?>
                    <form id="contact-form" class="form" action="" method="post" style="padding: 0 3rem; border: 2px solid darkred; border-top: 0; border-bottom: 0;">
                        <section id="step1" class="form-section">
                                    <div class="row">
                                    <div class="col small text-right" style="padding-bottom:5px;">* = required</div>
                                    </div>
                                    <div class="form-group row justify-content-center">
                                        <div class="col-md-6">
                                            <input class="form-control fill contact-field <?php if (!$passCheck && $customer_name == '') {
                                                echo 'has-danger';
                                            } ?>" name="customer_name" placeholder="First and Last Name *"
                                                   value="<?php if (!$passCheck && $customer_name != '') {
                                                       echo $customer_name;
                                                   } ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control fill" name="customer_phone"
                                                   placeholder="Phone Number *" value="<?php if (!$passCheck) {
                                                echo $customer_phone;
                                            } ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row justify-content-center contact-field">
                                        <div class="col <?php if (!$passCheck && $customer_email == '' || $emailFormattedBadly) {
                                            echo 'has-danger';
                                        } ?>">
                                            <input class="form-control fill contact-field" name="customer_email"
                                                   placeholder="Email Address *"
                                                   value="<?php if (!$passCheck && $customer_email != '') {
                                                       echo $customer_email;
                                                   } ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>What else should we know?</label>
                                        <textarea class="form-control fill" style="min-height:100px;"
                                                  name="comments"><?php if (!$passCheck && $comments != '') {
                                                echo $comments;
                                            } ?></textarea>
                                    </div>


                        </section>
                        <section id="step4" class="form-section">
                            <div class="row justify-content-center">
                                <div class="col-md-7">
                                    <label>Please confirm that you are not a robot by answering the simple math problem. *</label>
                                </div>
                                <div class="col-md-5">

                                    <div class="form-group row align-items-center">
                                        <div class="col-6 col-sm-8 col-md-8 text-right">
                                            <label>4 + 2 = ?</label>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-4">
                                             <input class="form-control fill<?php if (!$passCheck && $math == '') {
                                                echo 'has-danger';
                                            } ?>" name="math" placeholder=""
                                                   value="<?php if (!$passCheck && $math != '') {
                                                       echo $math;
                                                   } ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section id="step5" class="form-section">
                            <div class="form-group row">
                                <div class="col">
                                    <input type="text" value="" class="sec" name="sec" style="position:absolute; height:1px; width:1px; visibility:hidden; top:-1px; left: -1px;">
                                    <button class="btn btn-default phone-button btn-yellow" type="submit">Submit</button>
                                </div>
                            </div>
                        </section>
                    </form>
                </main><!-- #main -->
            </div><!-- #primary -->
            <div class="secondary col-lg-4">
                <?php //Get Sidebat Info
                $weathersidebar  = get_post_meta($post->ID, 'sidebar_include_weather', true);
                $beachcamsidebar = get_post_meta($post->ID, 'sidebar_include_beach_cam', true);
                $sidebartext     = get_post_meta($post->ID, 'sidebar_custom_sidebar_text', true);
                ?>
                <?php if ($weathersidebar) { ?>
                    <div class="weather-module support">
                        <?php echo do_shortcode('[getweather days="3" format="mini" location="Mexico Beach, FL"]'); ?>
                    </div>
                <?php } ?>
                <?php if ($beachcamsidebar) { ?>
                    <div class="webcam-button-desktop text-center">
                        <p class="tagline">All of our rooms<br><strong>face the gulf!</strong></p>
                        <a class="cam-text" href="http://mexicobeach.com/mexico-beach/beach-cam/" target="_blank">Live
                            Beach Cam
                            <svg id="arrowsvg" data-name="arrowsvg" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 16.67 26.93">
                                <defs>
                                    <style>.cls-1 {
                                            fill: #fff;
                                            fill-rule: evenodd;
                                        }</style>
                                </defs>
                                <path class="cls-1" d="M119.49,380.55l-7.9-13h-8.78l8.78,13-8.78,13.9h8.78Z" transform="translate(-102.82 -367.52)"/>
                            </svg>
                        </a>
                    </div>
                <?php } ?>
                <?php if ($sidebartext) { ?>
                    <div class="sidebar-text support" style="margin-left: 1rem; margin-top: 6rem;">
                        <?php echo $sidebartext; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php
}
//get_sidebar();
get_footer();

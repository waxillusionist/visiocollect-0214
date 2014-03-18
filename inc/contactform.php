<?php

/* =============================================================================
   Process form post data
   ========================================================================== */

function vc_contactform_handler() {
    if( strtolower($_SERVER['REQUEST_METHOD'])=='post' && isset($_POST['cfd']) && $_POST['cfd']=='1' ) {

        // success
        $cfs = false;
        // errors
        $cfe = array();

        // contact form data
        $cfd = array(
            'name'     => isset($_POST['cfd_name'])    ? trim($_POST['cfd_name'])    : '',
            'email'    => isset($_POST['cfd_email'])   ? trim($_POST['cfd_email'])   : '',
            'phone'    => isset($_POST['cfd_phone'])   ? trim($_POST['cfd_phone'])   : '',
            'subject'  => isset($_POST['cfd_subject']) ? trim($_POST['cfd_subject']) : '',
            'msg'      => isset($_POST['cfd_msg'])     ? trim($_POST['cfd_msg'])     : '',
            'sendcopy' => isset($_POST['cfd_sendcopy']) && $_POST['cfd_sendcopy']=='1' ? true : false
        );

        $str_filter = array( &$cfd['name'], &$cfd['phone'], &$cfd['subject'] );
        foreach( $str_filter as $k => $v )
            $str_filter[$k] = preg_replace( '/[\n\r,;]+/', '', $v );

        if( !empty($cfd['name']) && is_email($cfd['email']) && !empty($cfd['msg']) ) {
            $site_name = get_bloginfo('name');
            $site_url = get_home_url();
            $recipient = $site_name." <".get_bloginfo('admin_email').">";
            $sender = $cfd['name']." <".$cfd['email'].">";
            $subject = '['.$site_name.'] '.( !empty($cfd['subject']) ? utf8_decode($cfd['subject']) : '(kein Betreff)' );
            $header = "From: ".$sender.
                "\nReply-To: ".$sender.
                ( $cfd['sendcopy'] ? "\nCC: ".$sender : '' ).
                "\nX-Mailer: ".$site_name." (".$site_url.") [PHP ".phpversion()."]".
                "\nX-Priority: 3 (Normal)".
                "\nMIME-Version: 1.0".
                "\nContent-Type: text/plain; charset=iso-8859-1".
                "\nContent-Transfer-Encoding: 8bit".
                "\n\n".utf8_decode($cfd['msg']).
                "\n\n--".
                "\nName: ".utf8_decode($cfd['name']).
                "\nE-Mail: ".utf8_decode($cfd['email']).
                ( !empty($cfd['phone']) ? "\nTelefon: ".utf8_decode($cfd['phone']) : '' );
            if( mail( $recipient, $subject, '', $header ) )
                $cfs = '<strong>Ihre Nachricht wurde erfolgreich gesendet.</strong>'.( $cfd['sendcopy'] ? '<br>Eine Kopie wurde an ihr Postfach gesendet.' : '' );
            else
                array_push( $cfe, array( '#', '<strong>Es ist ein unerwarteter Fehler aufgetreten.</strong><br>Die Nachricht konnte leider nicht gesendet werden.' ) );
        }
        else {
            if( empty($cfd['name']) )
                array_push( $cfe, array( 'name', 'Bitte geben Sie ihren Namen ein.' ) );
            if( empty($cfd['email']) )
                array_push( $cfe, array( 'email', 'Bitte geben Sie ihre E-Mail ein.' ) );
            elseif( !is_email($cfd['email']) )
                array_push( $cfe, array( 'email', 'Bitte überprüfen Sie ihre Eingabe.' ) );
            if( empty($cfd['msg']) )
                array_push( $cfe, array( 'msg', 'Bitte geben Sie eine Nachricht ein.' ) );
        }

        $json = array(
            'success' => $cfs,
            'errors' => $cfe
        );
        header("Content-type: text/plain");
        echo json_encode($json);
        die();
    }
}
add_action( 'wp', 'vc_contactform_handler' );

/* =============================================================================
   SHORTCODE: Contact Form
   ========================================================================== */

function vc_shortcode_contactform( $atts, $content=null ) {
    extract( shortcode_atts( array(
        'subject' => '',
        'class' => ''
    ), $atts ) );

    $html = '<form action="'.get_permalink().'" method="post" role="form" class="form-contact'.
        ( $class!=='' ? ' '.$class : '' ).
        '">'.
            '<div class="row">'.
                '<div class="col col-sm-6">'.
                    '<div class="form-group has-feedback">'.
                        '<label for="cfd_name" class="sr-only">Ihr Name</label>'.
                        '<input type="text" class="form-control" name="cfd_name" id="cfd_name" placeholder="Ihr Name" aria-required="true">'.
                        '<span class="glyphicon glyphicon-asterisk form-control-feedback"></span>'.
                    '</div>'.
                '</div>'.
                '<div class="col col-sm-6">'.
                    '<div class="form-group has-feedback">'.
                        '<label for="cfd_email" class="sr-only">Ihre E-Mailadresse</label>'.
                        '<input type="email" class="form-control" name="cfd_email" id="cfd_email" placeholder="Ihre E-Mailadresse">'.
                        '<span class="glyphicon glyphicon-asterisk form-control-feedback"></span>'.
                    '</div>'.
                '</div>'.
            '</div>'.
            '<div class="row">'.
                '<div class="col col-sm-6">'.
                    '<div class="form-group">'.
                        '<label for="cfd_subject" class="sr-only">Betreff</label>'.
                        '<input type="text" class="form-control" name="cfd_subject" id="cfd_subject" placeholder="Betreff" value="'.esc_attr($subject).'">'.
                    '</div>'.
                '</div>'.
                '<div class="col col-sm-6">'.
                    '<div class="form-group">'.
                        '<label for="cfd_phone" class="sr-only">Ihre Telefonnummer</label>'.
                        '<input type="tel" class="form-control" name="cfd_phone" id="cfd_phone" placeholder="Ihre Telefonnummer">'.
                    '</div>'.
                '</div>'.
            '</div>'.
            '<div class="form-group has-feedback">'.
                '<label for="cfd_msg" class="sr-only">Ihre Nachricht</label>'.
                '<textarea class="form-control" rows="5" name="cfd_msg" id="cfd_msg" placeholder="Ihre Nachricht"></textarea>'.
                '<span class="glyphicon glyphicon-asterisk form-control-feedback"></span>'.
            '</div>'.
            '<div class="row">'.
                '<div class="col col-sm-6 col-sm-push-6">'.
                    '<div class="checkbox">'.
                        '<label>'.
                            '<input type="checkbox" name="cfd_sendcopy" id="cfd_sendcopy" checked="checked" value="1"> eine Kopie an ihr Postfach senden'.
                        '</label>'.
                    '</div>'.
                    '<p class="help-block"><small><span class="glyphicon glyphicon-asterisk"></span> = Pflichtfelder</small></p>'.
                '</div>'.
                '<div class="col col-sm-6 col-sm-pull-6">'.
                    '<button type="submit" class="btn btn-primary" name="cfd_submit" id="cfd_submit">E-Mail senden</button>'.
                    '<span class="loading-indicator"></span>'.
                '</div>'.
            '</div>'.
        '</form>';
    return $html;
}
add_shortcode( 'contactform', 'vc_shortcode_contactform' );



?>

<?php
defined('__VERN') or die('Restricted access');

class data
{


    /*

    Sample usage of isGoodCaptcha()...
    Put code like this, wherever you check $_POST[] for input from a form

        if (strtolower(\ipinga\options::get('use_recaptcha')) == 'yes') {
            if (\data::isGoodCaptcha($_POST['g-recaptcha-response']) == false) {
                $v->message .= 'Captcha Failed';    // $v is an instance of \ipinga\validator
            };
        };

    */
    public static function isGoodCaptcha($recaptchaResponse)
    {
        $r = \data::curlPost(\ipinga\options::get('recaptcha_siteverify_url'),
            array(),
            array(
                'secret' => \ipinga\options::get('recaptcha_secret_key'),
                'response' => $recaptchaResponse,
                'remoteip' => $_SERVER['REMOTE_ADDR']
            )
        );
        \ipinga\log::info( 'reCaptcha $recaptchaResponse == '. $recaptchaResponse );
        \ipinga\log::info( 'reCaptcha remoteip == '. $_SERVER['REMOTE_ADDR'] );
        \ipinga\log::info( 'reCaptcha siteverify response == '. var_export($r,true) );
        \ipinga\log::notice( 'reCaptcha '. ( $r['success'] ? ' Success!' : ' Failure' ) );
        return $r['success'];
    }


    /**
     * @param $url string
     * @param $urlVariables array
     * @param $postData array
     *
     * @return mixed
     */
    public static function curlPost($url, $urlVariables, $postData)
    {
        // data should be a list of values to post

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_TIMEOUT, 90);

        $expandedUrl = $url;
        foreach ($urlVariables as $k => $v) {
            if (strpos($expandedUrl, '?') === false) {
                $expandedUrl .= '?';
            } else {
                $expandedUrl .= '&';
            }
            $expandedUrl .= $k . '=' . $v;
        }

        curl_setopt($ch, CURLOPT_URL, $expandedUrl);
        curl_setopt($ch, CURLOPT_POST, count($postData));
        // curl_setopt($ch, CURLOPT_HTTPHEADER,  array('Content-Type: text/plain'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

}

?>
<?php

namespace App\Utilities;

/**
 * Handles regular expressions and patterns for attributes in the application.
 *
 * @package App\Utilities
 */
class Regex
{
    /**
     * Returns the regex version of a given string for controller validation.
     *
     * @return string
     */
    public static function regexify($string)
    {
        return 'regex:/' . $string . '$/i';
    }

    /**
     * Returns the pattern string for a valid Facebook profile.
     *
     * @return string
     */
    public static function get_facebook_url_pattern()
    {
        return Regex::get_media_url_pattern('facebook');
    }

    /**
     * Returns the pattern string for a valid Instagram profile.
     *
     * @return string
     */
    public static function get_instagram_url_pattern()
    {
        return Regex::get_media_url_pattern('instagram');
    }

    /**
     * Returns the pattern string for a valid LinkedIn profile.
     *
     * @return string
     */
    public static function get_linkedin_url_pattern()
    {
        return Regex::get_media_url_pattern('linkedin');
    }

    /**
     * Returns the pattern string for a valid email.
     *
     * @return string
     */
    public static function get_email_pattern()
    {
        return '(.*[^@])@svsu\.edu';
    }

    /**
     * Returns the pattern string for a valid phone number.
     *
     * @return string
     */
    public static function get_phone_number_pattern()
    {
        return '[0-9]{3}-[0-9]{3}-[0-9]{4}';
    }

    /**
     * Get valid social media url provided the given site's name.
     *
     * @param string $site
     * @return string
     */
    private static function get_media_url_pattern($site)
    {
        return 'https:\/\/www\.' .  $site . '\.com\/([\w\-\.\/]*)';
    }

}
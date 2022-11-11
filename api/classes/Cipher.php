<?php

declare(strict_types=1);

namespace VAVT\UP;

require_once __DIR__ . '/../../config.php';

class Cipher
{
    /**
     *
     */
    const SSL_ENCRYPT_KEY = SSL_ENCRYPT_KEY;

    /**
     * @param $value
     * @return string
     */
    public static function encryptSSL(string $value): string
    {
        $ivlen = \openssl_cipher_iv_length($cipher = "AES-128-CBC");
        $iv = \openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = \openssl_encrypt($value, $cipher, self::SSL_ENCRYPT_KEY, $options = OPENSSL_RAW_DATA, $iv);
        $hmac = \hash_hmac('sha256', $ciphertext_raw, self::SSL_ENCRYPT_KEY, $as_binary = true);
        $ciphertext = \base64_encode($iv . $hmac . $ciphertext_raw);
        return $ciphertext;
    }

    /**
     * @param $ciphertext
     * @return string|null
     */
    public static function decryptSSL(string $ciphertext): ?string
    {
        $c = \base64_decode($ciphertext);
        $ivlen = \openssl_cipher_iv_length($cipher = "AES-128-CBC");
        $iv = \substr($c, 0, $ivlen);
        $hmac = \substr($c, $ivlen, $sha2len = 32);
        $ciphertext_raw = \substr($c, $ivlen + $sha2len);
        $original_plaintext = \openssl_decrypt($ciphertext_raw, $cipher, self::SSL_ENCRYPT_KEY, $options = OPENSSL_RAW_DATA, $iv);
        $calcmac = \hash_hmac('sha256', $ciphertext_raw, self::SSL_ENCRYPT_KEY, $as_binary = true);

        return (hash_equals($hmac, $calcmac)) ? $original_plaintext : null;
    }
}

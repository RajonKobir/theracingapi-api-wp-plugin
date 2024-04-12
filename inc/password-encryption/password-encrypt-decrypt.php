<?php


function encrypt_password($password){

    // Storingthe cipher method
    $ciphering = "AES-128-CTR";

    // Using OpenSSl Encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;

    // Non-NULL Initialization Vector for encryption
    $encryption_iv = '1234567890112233';

    // Storing the encryption key
    $encryption_key = "mediavita";

    // Using openssl_encrypt() function to encrypt the data
    $encrypted_password = openssl_encrypt($password, $ciphering, $encryption_key, $options, $encryption_iv);

    return $encrypted_password;

}



function decrypt_password($password){

    // Storingthe cipher method
    $ciphering = "AES-128-CTR";

    // Using OpenSSl Encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;

    // Non-NULL Initialization Vector for encryption
    $encryption_iv = '1234567890112233';

    // Storing the encryption key
    $encryption_key = "mediavita";

    // Using openssl_encrypt() function to encrypt the data
    $decrypted_password = openssl_decrypt($password, $ciphering, $encryption_key, $options, $encryption_iv);

    return $decrypted_password;

}









<?php

namespace App\Livewire;

use Livewire\Component;

class RSA extends Component
{
    public $publicKey;
    public $privateKey;
    public $crypted;
    public $decrypted;
    
    public function mount()
    {
        $config = [
            'config' => 'C:\laragon\www\HakimProject\public\ssh\openssl.cnf', // Adjust the path based on your system
            'digest_alg' => 'sha512', // 'default_md' has been deprecated, use 'digest_alg' instead
            'private_key_bits' => 2048, // Corrected the key name 512 2048 4096
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
        ];
    
        $keypair = openssl_pkey_new($config);
        openssl_pkey_export($keypair, $this->privateKey, null, $config);
    
        $publickey = openssl_pkey_get_details($keypair);
        $this->publicKey = $publickey['key'];
    
        $plaintext = 'hello ';
    
        // Encrypt with the public key
        openssl_public_encrypt($plaintext, $this->crypted, $this->publicKey, OPENSSL_PKCS1_PADDING);
        $this->crypted = base64_encode($this->crypted);
    
        // Decrypt with the private key
        openssl_private_decrypt(base64_decode($this->crypted), $this->decrypted, $this->privateKey, OPENSSL_PKCS1_PADDING);
    }

    public function render()
    {
        return view('livewire.rsa');
    }
}

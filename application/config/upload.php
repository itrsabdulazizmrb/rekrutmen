<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['upload_config'] = array(
    'upload_path' => './uploads/profile_pictures/',
    'allowed_types' => 'gif|jpg|jpeg|png',
    'max_size' => 2048, // 2MB
    'file_name' => 'profile_' . time() . '_' . rand(1000, 9999),
    'overwrite' => FALSE,
    'remove_spaces' => TRUE,
    'encrypt_name' => FALSE
); 
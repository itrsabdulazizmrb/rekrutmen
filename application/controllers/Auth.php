<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model_pengguna');
        $this->load->model('model_pelamar');
        $this->load->library('form_validation');
        $this->load->library('email');
    }

    public function index() {
        
        redirect('auth/login');
    }

    public function login() {
        
        if ($this->session->userdata('logged_in')) {
            
            if (in_array($this->session->userdata('role'), ['admin', 'direktur', 'hrd', 'staff'])) {
                redirect('admin');
            } else if ($this->session->userdata('role') == 'pelamar') {
                redirect('pelamar');
            } else {
                redirect('beranda');
            }
        }

        
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            
            $data['title'] = 'Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            
            $user = $this->model_pengguna->verifikasi_login($username, $password);

            if ($user) {
                
                if ($user->status == 'aktif') {
                    
                    $remember = $this->input->post('remember_me') ? TRUE : FALSE;

                    
                    if ($remember) {
                        $this->config->set_item('sess_expiration', 60*60*24*30); 
                    }

                    
                    $session_data = array(
                        'user_id' => $user->id,
                        'username' => $user->nama_pengguna,
                        'email' => $user->email,
                        'full_name' => $user->nama_lengkap,
                        'role' => $user->role,
                        'profile_picture' => $user->foto_profil,
                        'logged_in' => TRUE,
                        'remember_me' => $remember
                    );

                    
                    $this->session->set_userdata($session_data);

                    
                    $this->model_pengguna->perbarui_pengguna($user->id, array('login_terakhir' => date('Y-m-d H:i:s')));

                    
                    if (in_array($user->role, ['admin', 'direktur', 'hrd', 'staff'])) {
                        redirect('admin');
                    } else if ($user->role == 'pelamar') {
                        redirect('pelamar');
                    } else {
                        redirect('beranda');
                    }
                } else {
                    
                    $this->session->set_flashdata('error', 'Akun Anda tidak aktif. Silakan hubungi administrator.');
                    redirect('auth/login');
                }
            } else {
                
                $this->session->set_flashdata('error', 'Username atau password salah.');
                redirect('auth/login');
            }
        }
    }

    public function daftar() {
        
        if ($this->session->userdata('logged_in')) {
            
            if ($this->session->userdata('role') == 'admin') {
                redirect('admin');
            } else if ($this->session->userdata('role') == 'pelamar') {
                redirect('pelamar');
            } else {
                redirect('beranda');
            }
        }

        
        $this->form_validation->set_rules('full_name', 'Nama Lengkap', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[pengguna.nama_pengguna]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[pengguna.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'trim|required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            
            $data['title'] = 'Daftar';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/daftar');
            $this->load->view('templates/auth_footer');
        } else {
            
            $data = array(
                'nama_lengkap' => $this->input->post('full_name'),
                'nama_pengguna' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role' => 'pelamar',
                'status' => 'aktif',
                'dibuat_pada' => date('Y-m-d H:i:s')
            );

            
            $user_id = $this->model_pengguna->tambah_pengguna($data);

            if ($user_id) {
                
                $this->model_pelamar->buat_profil($user_id);

                
                $this->session->set_flashdata('success', 'Pendaftaran berhasil. Silakan login.');
                redirect('auth/login');
            } else {
                
                $this->session->set_flashdata('error', 'Gagal mendaftar. Silakan coba lagi.');
                redirect('auth/daftar');
            }
        }
    }

    public function lupa_password() {
        
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            
            $data['title'] = 'Lupa Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/lupa_password');
            $this->load->view('templates/auth_footer');
        } else {
            
            $email = $this->input->post('email');
            $user = $this->model_pengguna->dapatkan_pengguna_dari_email($email);

            if ($user) {
                
                $token = bin2hex(random_bytes(32));
                $token_data = array(
                    'email' => $email,
                    'token' => $token,
                    'created_at' => date('Y-m-d H:i:s')
                );

                
                $this->db->insert('password_resets', $token_data);

                
                $this->email->from('noreply@sirek.com', 'SIREK');
                $this->email->to($email);
                $this->email->subject('Reset Password');
                $this->email->message('Klik link berikut untuk reset password Anda: ' . base_url('auth/reset_password/' . $token));

                if ($this->email->send()) {
                    $this->session->set_flashdata('success', 'Link reset password telah dikirim ke email Anda.');
                } else {
                    $this->session->set_flashdata('error', 'Gagal mengirim email reset password. Silakan coba lagi.');
                }
            } else {
                $this->session->set_flashdata('error', 'Email tidak ditemukan.');
            }

            redirect('auth/lupa_password');
        }
    }

    public function reset_password($token) {
        
        $this->db->where('token', $token);
        $query = $this->db->get('password_resets');
        $reset = $query->row();

        if (!$reset) {
            $this->session->set_flashdata('error', 'Token reset password tidak valid.');
            redirect('auth/login');
        }

        
        $token_created = new DateTime($reset->created_at);
        $now = new DateTime();
        $interval = $token_created->diff($now);
        $hours = $interval->h + ($interval->days * 24);

        if ($hours > 24) {
            $this->session->set_flashdata('error', 'Token reset password sudah kadaluarsa.');
            redirect('auth/login');
        }

        
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'trim|required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            
            $data['title'] = 'Reset Password';
            $data['token'] = $token;
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/reset_password', $data);
            $this->load->view('templates/auth_footer');
        } else {
            
            $email = $reset->email;
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

            
            $this->db->where('email', $email);
            $this->db->update('pengguna', array('password' => $password));

            
            $this->db->where('token', $token);
            $this->db->delete('password_resets');

            
            $this->session->set_flashdata('success', 'Password berhasil direset. Silakan login.');
            redirect('auth/login');
        }
    }

    public function logout() {
        
        $this->session->sess_destroy();

        
        redirect('auth/login');
    }
}

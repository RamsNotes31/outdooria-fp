<?php
defined('BASEPATH') or
    header("Location: error");



class Home extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'Hikyu | Home';
        $this->load->view('templates/header', $data);
        $this->load->model('Home_model');
        $data['feedbacks'] = $this->Home_model->get_feedback_with_user(3);
        $data['average_rating'] = $this->Home_model->get_average_rating();
        $data['count_feedback'] = $this->Home_model->count_feedback();
        $data['admins'] = $this->Home_model->get_admin_details();

        // Debugging: pastikan data terisi
        if (empty($data['feedbacks'])) {
            log_message('error', 'No feedback data retrieved');
        }

        $this->load->view('home', $data);
        $this->load->view('templates/footer');
    }
}

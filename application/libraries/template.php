<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Template
{
    private $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    public function view($content, $id_role, $datacontent = NULL, $data = NULL)
    {
        if (!$this->is_ajax()) {
            if ($id_role == 1) {
                $nav = "template/admin/main_navigation";
                $top_nav = "template/admin/top_navigation";
            } else if ($id_role == 2) {
                $nav = "template/pegawai/main_navigation";
                $top_nav = "template/pegawai/top_navigation";
            } else if ($id_role == 3) {
                $nav = "template/atasan/main_navigation";
                $top_nav = "template/atasan/top_navigation";
            }

            $template['id_role'] = $id_role;
			$template['navigation'] = $this->ci->load->view($nav, $datacontent, TRUE);
			$template['top_navigation'] = $this->ci->load->view($top_nav, $datacontent, TRUE);
			$template['content'] = $this->ci->load->view($content, $datacontent, TRUE);
            //$template['nav_header'] = $this->ci->load->view('template/nav_header', NULL, TRUE);
            $this->ci->load->view('template/index', $template);
        } else {
            //$this->ci->load->view($content, $data);
        }
    }

    private function is_ajax()
    {
        return ($this->ci->input->server('HTTP_X_REQUESTED_WITH') && ($this->ci->input->server('HTTP_X_REQUESTED_WITH') == 'XMLHttpRequest'));
    }
}

/* End of file Template.php */
/* Location: ./application/libraries/Template.php */

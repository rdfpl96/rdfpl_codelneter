
<?php
defined('BASEPATH') or exit('No direct script access allowe');

class Offers extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();

        date_default_timezone_set('Asia/Kolkata');

        $this->load->library('my_libraries');
        $this->load->model('admin/offers_model', 'offers');
        $this->load->helper(array('form', 'url')); // Load form and URL helpers
        $this->load->library('session'); // Load session library for flash messages
        $session = $this->session->userdata('admin');
        $this->load->library('pagination');

        $_SERVER['REQUEST_URI'] = "admin";

        if (basename($_SERVER['REQUEST_URI']) != 'admin') {
            if (!isset($session) && $session['is_login'] != 1) {
                // redirect(base_url('login'));
                redirect(base_url('admin'));
            }
        }
    }


    public function index()
    {

        // Pagination configuration
        $config = array();
        $config["base_url"] = base_url() . "admin/offers";
        $config["total_rows"] = $this->offers->get_offers_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="paginate_button page-item page-link">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="paginate_button page-item page-link">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="paginate_button page-item page-link">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_open'] = '<li class="paginate_button page-item page-link">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="paginate_button page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="paginate_button page-item page-link">';
        $config['num_tag_close'] = '</li>';

        // Initialize pagination
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['offer_list'] = $this->offers->get_all_offers($config["per_page"], $page);


        $data['pagination'] = $this->pagination->create_links();

        //  echo '<pre>';
        // print_r($data);
        // die();

        $option = '';
        if (is_array($data['offer_list']) && count($data['offer_list']) > 0) {
            $i = $page + 1;
            foreach ($data['offer_list'] as $keyval) {
                $offer_type = ($keyval['offer_type'] == 1) ? 'Percentage' : 'Fixed Amount';
                $pack_size_units = $keyval['pack_size'] . ' ' . $keyval['units'];
                $option .= '<tr> 
                                <td>' . $i . '</td>
                                <td>' . $offer_type . '</td>
                                <td>' . $keyval['description'] . '</td>
                                <td>' . $keyval['value'] . '</td>
                                  <td>' . $keyval['product_name'] . '</td>
                                 <td>' . $pack_size_units . '</td> 
                                <td><a href="' . base_url() . 'admin/offers/edit/' . $keyval['id'] . '" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> Edit</a></td>
                                <td><a href="javascript:deleteRowtablesub(' . $keyval['id'] . ')" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="" title="Delete"><i class="fa fa-trash"></i>Delete</a></td>
                           </tr>';
                $i++;
            }
        } else {
            $option .= '<tr><td colspan="5" style="color:red;text-align:center">No record</td></tr>';
        }

        $output = array('array_data' => $option, 'pagination' => $data['pagination']);


        if ($this->input->post('method') == "changepage") {
            echo json_encode($output);
            exit();
        } else {
            $this->load->view('admin/offers/index', $output);
        }
    }




    public function Search_offer()
    {
        $keywords = $this->input->post('searchText');
        $array_data = $this->offers->getSearch_offerDetails($keywords);




        $option = '';
        $i = 1;
        if (is_array($array_data) && count($array_data) > 0) {
         
            foreach ($array_data as $keyval) {
                $offer_type = ($keyval->offer_type == 1) ? 'Percentage' : 'Fixed Amount';
                $pack_size_units = $keyval['pack_size'] . ' ' . $keyval['units'];
                $option .= '<tr>
                            <td>' . $i . '</td>
                           <td>' . $offer_type . '</td>
                            <td>' . $keyval['description'] . '</td>
                            <td>' . $keyval['value'] . '</td>
                            <td>' . $keyval['product_name'] . '</td>
                            <td>' . $pack_size_units . '</td> 
                            <td><a href="' . base_url() . 'admin/offers/edit/' . $keyval['id'] . '" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="edit"><i class="fa fa-pencil"></i>Edit</a></td>
                           <td><a href="javascript:deleteRowtablesub(' . $keyval['id'] . ')" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="" title="Delete"><i class="fa fa-trash"></i>Delete</a></td>
                        </tr>';
                $i++;
            }
        } else {

            $option .= '<tr><td colspan="7" style="color:red;text-align:center">No record</td></tr>';
        }
        echo $option;
    }












    public function create()
    {
        $data['productList'] = $this->offers->getProductList();
        $this->load->view('admin/offers/create', $data);
    }



    public function store()
    {
        $product_variant = $this->input->post('product_variant');
        $offer_data = array(
            'offer_type' => $this->input->post('offer_type'),
            'description' => $this->input->post('description'),
            'value' => $this->input->post('value'),
            'product_id' => $this->input->post('product_id')
        );

        $success = true;

        foreach ($product_variant as $variant_id) {
            $offer_data['variant_id'] = $variant_id;

            if (!$this->offers->store($offer_data)) {
                $success = false;
                break;
            }
        }

        if ($success) {
            $this->session->set_flashdata('msg', 'Offers inserted successfully.');
        } else {
            $this->session->set_flashdata('msg', 'Failed to insert Offers.');
        }

        redirect('admin/offers/create');
    }




    public function getvariantbycategory()
    {
        $category_id = $this->input->post('category_id');
        $variantList = $this->offers->get_variants($category_id);
        $option = '';
        foreach ($variantList as $variant) {
            $option .= '<option value="' . $variant['variant_id'] . '">' . $variant['pack_size'] . ' ' . $variant['units'] . '</option>';
        }
        echo json_encode($option);
        exit();
    }





    public function edit()
    {


        $id = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['productList'] = $this->offers->getProductList();
        $data['offer'] = $this->offers->get_offer_by_id($id);
        $data['variant'] = $this->offers->get_variants_by_product_id($data['offer'][0]['product_id']);

        $this->load->view('admin/offers/edit', $data);
    }



    public function update()
    {
        $offer_type = $this->input->post('offer_type');
        $description = $this->input->post('description');
        $value = $this->input->post('value');
        $product_id = $this->input->post('product_id');
        $product_variant = $this->input->post('product_variant');


        $product_id_old = $this->input->post('old_product_id');

        $offer_data = array(
            'offer_type' => $offer_type,
            'description' => $description,
            'value' => $value,
            'product_id' => $product_id
        );


        $update_success = $this->offers->delete_offers($product_id_old);

        if ($update_success) {
            $success = true;

            foreach ($product_variant as $variant_id) {
                $offer_data['variant_id'] = $variant_id;

                if (!$this->offers->store($offer_data)) {
                    $success = false;
                    break;
                }
            }

            if ($success) {
                echo json_encode(['status' => 'success', 'message' => 'Offer updated successfully.']);
            } else {
                echo json_encode(['status' => 'success', 'message' => 'Offer failed.']);
            }
        } else {
            $this->session->set_flashdata('msg', 'Failed to insert Offers.');
        }
    }

   

    public function delete_offer()
    {
        $id = $this->input->post('id');
        $response = $this->offers->delete_offer($id);
        if ($response == '1') {

            $Flag = 'True';
        } else {
            $Flag = 'False';
        }
        echo json_encode($Flag);
        exit();
        redirect('admin/offers');
    }
}


?>
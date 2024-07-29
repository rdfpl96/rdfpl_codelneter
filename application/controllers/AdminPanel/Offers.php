
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
    
        $option = '';
        if (is_array($data['offer_list']) && count($data['offer_list']) > 0) {
            $i = $page + 1;
            foreach ($data['offer_list'] as $keyval) {
                $offer_type = ($keyval->offer_type == 1) ? 'Percentage' : 'Fixed Amount';
                $option .= '<tr> 
                            <td>' . $i . '</td>
                            <td>' . $offer_type . '</td>
                            <td>' . $keyval->description . '</td>
                            <td>' . $keyval->value . '</td>
                            <td><a href="' . base_url() . 'admin/offers/edit/' . $keyval->id . '" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> Edit</a></td>
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
    






    public function create()
    {
        $data['productList'] = $this->offers->getProductList();
        $this->load->view('admin/offers/create', $data);
    }


    // public function store()
    // {
    //     $product_variant = $this->input->post('product_variant');
    //     $lastKey = array_key_last($product_variant);
    //     // echo '<pre>'; print_r($lastKey);die();

    //     foreach ($product_variant as $key => $val){
    //         $data = array(
    //             'offer_type' => $this->input->post('offer_type'),
    //             'description' => $this->input->post('description'),
    //             'value' => $this->input->post('value'),
    //             'product_id' => $this->input->post('product_id'),
    //             'variant_id' => $val
    //         );

    //         $responce = $this->offers->store($data);
    //         if($key === $lastKey){
    //             if ($responce) {
    //                 $this->session->set_flashdata('msg', 'Offers inserted successfully.');
    //             } else {
    //                 $this->session->set_flashdata('msg', 'Failed to insert Offers.');
    //             }
        
    //             redirect('admin/offers/create');
    //         }

    //     }

    //     // $product_ids = is_array($product_id_array) ? implode(',', $product_id_array) : '';
        

        
    // }

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




    public function getvariantbycategory(){
        $category_id=$this->input->post('category_id');
        $variantList = $this->offers->get_variants($category_id);   
        $option='';
        foreach ($variantList as $variant) {
            $option.='<option value="'.$variant['variant_id'].'">'.$variant['pack_size'].' '.$variant['units'].'</option>';
        }
        echo json_encode($option);
        exit();
    }





    // public function edit($id) {
    //     $data['subcategory'] = $this->subcategory->get_subcategory($id);
    //     $data['categories'] = $this->category->get_categories();
    //     $this->load->view('admin/subcategory/edit', $data);
    // }

    // public function update($id) {
    //     $data = array(
    //         'cat_id' => $this->input->post('cat_id'),
    //         'subCat_name' => $this->input->post('subcategory_name'),
    //         'slug' => $this->input->post('slug'),
    //     );
    //     $this->subcategory->update_subcategory($id, $data);
    //     $this->session->set_flashdata('success_message', 'Subcategory updated successfully');
    //     redirect('admin/subcategory');
    // }






    public function Search_offer()
    {
        $keywords = $this->input->post('searchText');
        $array_data = $this->offers->getSearch_offerDetails($keywords);
        $option = '';
        $i = 1;
        if (is_array($array_data) && count($array_data) > 0) {
            $offer_type = ($keyval->offer_type == 1) ? 'Percentage' : 'Fixed Amount';
            foreach ($array_data as $keyval) {
                $option .= '<tr>
                            <td>' . $i . '</td>
                           <td>' . $offer_type . '</td>
                            <td>' . $keyval['description'] . '</td>
                            <td>' . $keyval['value'] . '</td>
                            <td><a href="' . base_url() . 'admin/offers/edit/' . $keyval['id'] . '" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="edit"><i class="fa fa-pencil"></i>Edit</a></td>
                        </tr>';
                $i++;
            }
        } else {

            $option .= '<tr><td colspan="7" style="color:red;text-align:center">No record</td></tr>';
        }
        echo $option;
    }
}
?>
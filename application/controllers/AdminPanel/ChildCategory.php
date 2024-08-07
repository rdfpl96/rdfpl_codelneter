
<?php
defined('BASEPATH') or exit('No direct script access allowe');

class ChildCategory extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->library('my_libraries');
        $this->load->library('pagination');

        $this->load->model('admin/Child_category_model', 'Child_category_model');

    }

    // public function index()
    // {
    //     $data['childcatdetails'] = $this->Child_category_model->get_Childcategory_data();
    //     $this->load->view('admin/childcatgory/index', $data);
    // }



    

    public function index()
{   
    
   
    $config['base_url'] = base_url() . "admin/childcategory";
    $config['total_rows'] = $this->Child_category_model->Child_category_count_all(); 
    $config['per_page'] = 10; 
    $config['uri_segment'] = 2; 
      $config['full_tag_open'] = '<ul class="pagination">';
      $config['full_tag_close'] = '</ul>';
      $config['first_link'] = 'First';
      $config['first_tag_open'] = '<li class="paginate_button page-item page-link"><a href="#">';
      $config['first_tag_close'] = '</a></li>';
      $config['last_link'] = 'Last';
      $config['last_tag_open'] = '<li class="paginate_button page-item page-link"><a href="#">';
      $config['last_tag_close'] = '</a></li>';
      $config['next_link'] = 'Next';
      $config['next_tag_open'] = '<li class="paginate_button page-item page-link"><a href="#">';
      $config['next_tag_close'] = '</a></li>';
      $config['prev_link'] = 'Previous';
      $config['prev_tag_open'] = '<li class="paginate_button page-item page-link"><a href="#">';
      $config['prev_tag_close'] = '</a></li>';
      $config['cur_tag_open'] = '<li class="paginate_button page-item active"><a href="#" class="page-link">';
      $config['cur_tag_close'] = '</a></li>';
      $config['num_tag_open'] = '<li class="paginate_button page-item page-link">';
      $config['num_tag_close'] = '</li>';
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
    $data['pagination_links'] = $this->pagination->create_links();
    
    $data['childcatdetails'] = $this->Child_category_model->get_Childcategory_data($config['per_page'], $page);

   $output=array(
     'pagination_links' => $data['pagination_links'],
     'childcatdetails' => $data['childcatdetails'],
   );

//    echo "<pre>";
//    print_r($output);
//    die();

    $this->load->view('admin/childcatgory/index', $output);
}













    
    public function create()
    {
        $data['category'] = $this->Child_category_model->getCategories();
        $this->load->view('admin/childcatgory/create', $data);
    }

    public function store()
    {

        $cat_id = $this->input->post('cat_id');
        $subcategory = $this->input->post('Subcategory');
        $childcategory_name = $this->input->post('ChildcategoryName');
        $slug = $this->input->post('slug');
        $data = array(
            'cat_id' => $cat_id,
            'sub_cat_id' => $subcategory,
            'childCat_name' => $childcategory_name,
            'slug' => $slug,
        );
        $this->Child_category_model->insertChildCategory($data);
        redirect('admin/childcategory');
    }

    public function get_subcategories()
    {
        $cat_id = $this->input->post('cat_id');
        $subcategories = $this->Child_category_model->getSubcategoriesByCategory($cat_id);
        $options = '<option value="">Please select a Subcategory</option>';
        foreach ($subcategories as $subcategory) {
            $options .= '<option value="' . $subcategory['sub_cat_id'] . '">' . $subcategory['subCat_name'] . '</option>';
        }
        echo json_encode($options);
        exit();
    }


    public function delete_child_category(){
       $cat_id =$this->input->post('child_cat_id');
       $response= $this->Child_category_model->deleteChildcategory($cat_id);
        if($response=='1'){
            $Flag= 'True';
        }else{
            $Flag= 'False';
        }
        echo json_encode($Flag);
        exit();
        redirect('admin/childcategory');
    }


}

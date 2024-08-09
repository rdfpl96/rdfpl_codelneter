<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

  function __construct()
  {
    parent::__construct();

    $this->load->model('product_model', 'productObj');
    $this->load->model('common_model');
    $this->load->library('my_libraries');
    $this->load->library('customlibrary');
    $this->load->library('pagination');

  }




  public function index($slug1 = "", $slug2 = "", $slug3 = "")
  {

    $breadcrum = "";
    $products = $this->productObj->getProdcutListBySlug($slug1, $slug2, $slug3);
    // echo'<pre>';
    // print_r($products);
    // exit();

    if (is_array($products) && count($products) > 0) {

      $sidecategories = array();

      $topDetail = $this->customlibrary->getTopCatDetailId($products[0]['cat_id']);
      $subDetail = $this->customlibrary->getSubCatDetailId($products[0]['sub_cat_id']);
      $childDetail = $this->customlibrary->getChildCatDetailId($products[0]['child_cat_id']);

      if ($slug1 != "" && $slug2 != "" && $slug3 != "") {

        $breadcrum = '<span></span><a href="/shop/' . $topDetail['slug'] . '">' . $topDetail['category'] . '</a>';

        $breadcrum .= '<span></span><a href="/shop/' . $topDetail['slug'] . '/' . $subDetail['slug'] . '">' . $subDetail['subCat_name'] . '</a>';

        $breadcrum .= '<span></span>' . $childDetail['childCat_name'];

        $categoryName = $this->customlibrary->SubCatName($products[0]['sub_cat_id']);
        $sidecategories = $this->customlibrary->getChilCategory($products[0]['cat_id'], $products[0]['sub_cat_id']);
        $categoryLevel = 2;
      } else if ($slug1 != "" && $slug2 != "") {
        $categoryLevel = 2;
        $categoryName = $this->customlibrary->SubCatName($products[0]['sub_cat_id']);
        $sidecategories = $this->customlibrary->getChilCategory($products[0]['cat_id'], $products[0]['sub_cat_id']);

        $breadcrum = '<span></span><a href="/shop/' . $topDetail['slug'] . '">' . $topDetail['category'] . '</a>';

        $breadcrum .= '<span></span>' . $subDetail['subCat_name'];
      } else if ($slug1 != "" && $slug2 == "") {
        $categoryLevel = 1;
        $categoryName = $this->customlibrary->TopCatName($products[0]['cat_id']);
        $sidecategories = $this->customlibrary->getSubCategoryByCatId($products[0]['cat_id']);

        $breadcrum = '<span></span>' . $topDetail['category'];
      }
      //$sidecategories=$this->customlibrary->getTopCategory();

      $data['bread'] = '<a href="shop">Shop</a>' . $breadcrum;
      $data['productCount'] = count($products);
      $data['sidecategories'] = $sidecategories;
      $data['categoryName'] = $categoryName;
      $data['categoryLevel'] = $categoryLevel;
      $data['products'] = $this->load->view('frontend/component/productItem', array("productItems" => $products, 'pcol' => 4), TRUE);
    }

    $data['price_range'] = $this->productObj->getPriceRange();

    $this->load->view("frontend/product/index", $data);
  }

public function shop($slug1=null, $slug2=null, $slug3=null)
{
    $total_rows = $this->productObj->get_Product_count($slug1, $slug2, $slug3);
    $config = array();
    $config["base_url"] = base_url() ."shop";
    $config['total_rows'] = $total_rows;
    $config["per_page"] = 12;
    $config["uri_segment"] = 2;
    $config['full_tag_open'] = '<ul class="pagination" style="padding-bottom:20px;">';
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
    $config['cur_tag_open'] = '<li class="paginate_button page-item active"><a href="#" class="page-link active-page" style="background-color: green !important;
    border-color: green;">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li class="paginate_button page-item page-link">';
    $config['num_tag_close'] = '</li>';
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
    // Fetch product list
    $products = $this->productObj->getProdcutListBySlug_pagination($slug1, $slug2, $slug3, $config["per_page"], $page);
    $data['pagination_links'] = $this->pagination->create_links();
    $data['productCount'] = $total_rows;
    $data['sidecategories'] = $this->customlibrary->getTopCategory();
    $data['categoryName'] = "";
    $data['categoryLevel'] = "";
    $data['bread'] = 'Shop';
    $data['products'] = $this->load->view('frontend/component/productItem', array("productItems" => $products,"productRatings" =>$productRatings, 'pagination' => $data['pagination_links'], 'pcol' => 4), TRUE);
    $data['price_range'] = $this->productObj->getPriceRange();
  
    $this->load->view("frontend/product/index", $data);
}

public function Price_range() {
  $data['price_range'] = $this->productObj->getPriceRange();
  echo "<pre>";
  print_r($data['price_range']);
  die();
}

public function detail($pslug)
  {
    $userCookies = getCookies('customer');
    $pdetail = $this->productObj->getProductDetailBySlug($pslug);

    $simillerProduct = array();

    if (count($pdetail) > 0) {
      $simillerProduct = $this->productObj->getProdcutListBySlug($pdetail['top_cat_slug'], $pdetail['sub_cat_slug'], $pdetail['child_cat_slug']);
      $reviews = $this->common_model->getReviewsByProductId($pdetail['product_id']);
      
      $productRate = $this->customlibrary->getProductRatingSummary($pdetail['product_id']);
    }
    

    //$this->load->view("frontend/product/detail", array('pdetail' => $pdetail, 'simillerProduct' => $simillerProduct, 'popupar' => $simillerProduct));

    $isCustomerLogin=isset($userCookies['isCustomerLogin']) ? $userCookies['isCustomerLogin'] : 0 ;
  

    $this->load->view("frontend/product/detail",array('pdetail' => $pdetail, 'simillerProduct' => $simillerProduct, 'popupar' => $simillerProduct,'reviews' =>$reviews,'isCustomerLogin'=>$isCustomerLogin));
  }

  public function search()
  {
    // searchbyselect
    $min_price = isset($_POST['min_price']) ? trim($_POST['min_price']) : "";

    $max_price = isset($_POST['max_price']) ? trim($_POST['max_price']) : "";

    $rating = isset($_POST['rating']) ? trim($_POST['rating']) : "";

    $searchbyselect = isset($_POST['searchbyselect']) ? trim($_POST['searchbyselect']) : "";
    $slug1 = $_POST['slug1']; 
    $slug2 = $_POST['slug2']; 
    $slug3 = $_POST['slug3'];



    //$productArraId=$this->productObj->getProductIdByPriceRange($min_price,$max_price,$searchbyselect);

    //print_r($productArraId);

    $products = $this->productObj->filterProduct($slug1, $slug2, $slug3, $min_price, $max_price, $searchbyselect, $rating);


    $products = $this->load->view('frontend/component/productItem', array("productItems" => $products, 'pcol' => 4, 'min_price' => $min_price, 'max_price' => $max_price), TRUE);

    echo json_encode(array('status' => 0, 'data' => $products));
    exit();
  }

  public function review_rating()
  {
    $user = $this->my_libraries->mh_getCookies('customer');

    if (!empty($user) && isset($user['customer_id'])) {
      $customer_id = $user['customer_id'];
      $item_id = base64_decode($this->input->get('itm'));
      $pro_id = base64_decode($this->input->get('por'));

      $where = array('cust_id' => trim($customer_id), 'product_id' => $pro_id, 'order_id' => $item_id);
      $data['review'] = $this->sqlQuery_model->sql_select_where('tbl_rate_and_review', $where);

      $data['content'] = 'frontend/product/rating_review_details';
      $this->load->view('frontend/template', $data);
    } else {
      redirect(base_url(), 'refresh');
    }
  }
}

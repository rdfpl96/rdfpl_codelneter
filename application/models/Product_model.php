<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
    //$this->load->database();
  }

  public function getItemDetailByProductAndItemId($productId, $itemId)
  {
    $array_data = array();
    $this->db->select('*');
    $this->db->from('tbl_product_variants');
    // $this->db->where('status',1);
    $this->db->where('variants_product_id', $productId);
    $this->db->where('variant_id', $itemId);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      $array_data = $query->row_array();
    }

    return $array_data;
  }


  public function getOtherProductById($product_type_id)
  {
    $array_data = array();
    $this->db->select('P.product_id,P.product_name,P.cat_id');
    $this->db->from('tbl_product AS P');
    $this->db->where('P.status', 1);
    $this->db->where('OP.product_type_id', $product_type_id);
    $this->db->join('tbl_other_product AS OP', 'OP.product_id = P.product_id');
    $query = $this->db->get();
    if ($query->num_rows() > 0) {

      $array_data = $query->result_array();
    }

    return $array_data;
  }

  public function getProdcutListBySubcategory($per_page, $limit_per_page, $sub_cat_id)
  {
    $array_data = array();
    $this->db->select('P.*,C.cat_id,C.sub_cat_id,C.child_cat_id');
    $this->db->from('tbl_product AS P');
    $this->db->where('P.status', 1);
    $this->db->where('C.sub_cat_id', $sub_cat_id);
    $this->db->join('tbl_mapping_category_with_product AS C', 'C.mapping_product_id = P.product_id');
    $query = $this->db->get();
    if ($query->num_rows() > 0) {

      $array_data = $query->result_array();
    }

    return $array_data;
  }

  public function getProductDetailBySlug($slug)
  {
    $array_data = array();
    $this->db->select('P.*,TC.category AS top_cat_name,TC.slug AS top_cat_slug,SC.subCat_name AS sub_cat_name,SC.slug AS sub_cat_slug,CC.childCat_name AS child_cat_name, CC.slug AS child_cat_slug');
    $this->db->from('tbl_mapping_category_with_product AS PWM');
    $this->db->where('P.status', 1);
    $this->db->where('TC.status', 1);
    $this->db->where('SC.status', 1);
    $this->db->where('CC.status', 1);
    $this->db->where('P.slug', $slug);
    $this->db->join('tbl_product AS P', 'PWM.mapping_product_id = P.product_id');
    $this->db->join('tbl_category AS TC', 'PWM.cat_id = TC.cat_id');
    $this->db->join('tbl_sub_category AS SC', 'PWM.sub_cat_id = SC.sub_cat_id');
    $this->db->join('tbl_child_category AS CC', 'PWM.child_cat_id = CC.child_cat_id');
    $query = $this->db->get();
    if ($query->num_rows() > 0) {

      $array_data = $query->row_array();
    }

    return $array_data;
  }

  public function getProdcutListBySlug($slug1, $slug2, $slug3)
  {



    // SELECT P.product_name,P.slug,P.feature_img,TC.category as tc_name,TC.slug as tc_slug,SC.subCat_name as sc_name, SC.slug as sc_slug, CC.childCat_name as cc_name, CC.slug as cc_slug from tbl_mapping_category_with_product AS PWM INNER tbl_product as P ON P.product_id=PWM.mapping_product_id INNER JOIN tbl_category AS TC ON TC.cat_id=PWM.cat_id INNER JOIN tbl_sub_category as SC ON SC.sub_cat_id=PWM.sub_cat_id INNER JOIN tbl_child_category as CC ON CC.child_cat_id=PWM.child_cat_id;

    $array_data = array();
    $this->db->select('P.product_id,P.product_name,P.slug,P.feature_img,PWM.cat_id,PWM.sub_cat_id,PWM.child_cat_id');

    $this->db->from('tbl_product AS P');

    $this->db->where('P.status', 1);
    $this->db->where('TC.status', 1);
    $this->db->where('SC.status', 1);
    $this->db->where('CC.status', 1);
    if ($slug1 != "") {
      $this->db->where('TC.slug', $slug1);
    }
    if ($slug2 != "") {
      $this->db->where('SC.slug', $slug2);
    }
    if ($slug3 != "") {
      $this->db->where('CC.slug', $slug3);
    }

    $this->db->join('tbl_mapping_category_with_product AS PWM', 'P.product_id = PWM.mapping_product_id');
    $this->db->join('tbl_category AS TC', 'PWM.cat_id = TC.cat_id');
    $this->db->join('tbl_sub_category AS SC', 'PWM.sub_cat_id = SC.sub_cat_id');
    $this->db->join('tbl_child_category AS CC', 'PWM.child_cat_id = CC.child_cat_id');
    // $this->db->limit(30,0);

    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      $array_data = $query->result_array();
    }

    return $array_data;
  }


 public function getProdcutListBySlug_pagination($slug1, $slug2, $slug3, $per_page, $offset)
{
    $array_data = array();
    $this->db->select('P.product_id, P.product_name, P.slug, P.feature_img, PWM.cat_id, PWM.sub_cat_id, PWM.child_cat_id');
    $this->db->from('tbl_product AS P');
    $this->db->join('tbl_mapping_category_with_product AS PWM', 'P.product_id = PWM.mapping_product_id');
    $this->db->join('tbl_category AS TC', 'PWM.cat_id = TC.cat_id');
    $this->db->join('tbl_sub_category AS SC', 'PWM.sub_cat_id = SC.sub_cat_id');
    $this->db->join('tbl_child_category AS CC', 'PWM.child_cat_id = CC.child_cat_id');
    $this->db->where('P.status', 1);
    $this->db->where('TC.status', 1);
    $this->db->where('SC.status', 1);
    $this->db->where('CC.status', 1);
    if ($slug1 != "") {
        $this->db->where('TC.slug', $slug1);
    }
    if ($slug2 != "") {
        $this->db->where('SC.slug', $slug2);
    }
    if ($slug3 != "") {
        $this->db->where('CC.slug', $slug3);
    }
    $this->db->limit($per_page, $offset);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        $array_data = $query->result_array();
    }
    return $array_data;
}
 





  public function searchProductByKeyword($pkeyword)
  {
    $array_data = array();
    $this->db->select('P.product_name,P.product_id,P.slug AS product_slug,P.feature_img,TC.category AS top_cat_name,TC.slug AS top_cat_slug,SC.subCat_name AS sub_cat_name,SC.slug AS sub_cat_slug,CC.childCat_name AS child_cat_name, CC.slug AS child_cat_slug');
    $this->db->from('tbl_mapping_category_with_product AS PWM');
    $this->db->where('P.status', 1);
    $this->db->where('TC.status', 1);
    $this->db->where('SC.status', 1);
    $this->db->where('CC.status', 1);
    $this->db->like('PK.keyword', $pkeyword);
    $this->db->join('tbl_product AS P', 'PWM.mapping_product_id = P.product_id');
    $this->db->join('tbl_category AS TC', 'PWM.cat_id = TC.cat_id');
    $this->db->join('tbl_sub_category AS SC', 'PWM.sub_cat_id = SC.sub_cat_id');
    $this->db->join('tbl_child_category AS CC', 'PWM.child_cat_id = CC.child_cat_id');
    $this->db->join('tbl_product_keyword AS PK', 'PK.product_id = P.product_id');

    $query = $this->db->get();
    if ($query->num_rows() > 0) {

      $array_data = $query->result_array();
    }

    return $array_data;
  }

  public function filterProduct($slug1, $slug2, $slug3, $min_price, $max_price, $searchbyselect, $rating)
  {

    $array_data = array();
    $this->db->select('P.product_id,P.product_name,P.slug,P.feature_img,PWM.cat_id,PWM.sub_cat_id,PWM.child_cat_id,PV.price');

    $this->db->from('tbl_mapping_category_with_product AS PWM');
    $this->db->join('tbl_product AS P', 'PWM.mapping_product_id = P.product_id');
    $this->db->join('tbl_product_variants AS PV', 'PV.variants_product_id = P.product_id');
    $this->db->join('tbl_category AS TC', 'PWM.cat_id = TC.cat_id');
    $this->db->where('P.status', 1);
    $this->db->where('TC.status', 1);

    if ($min_price != "" && $max_price != "") {
      $this->db->where('PV.price >=', $min_price);
      $this->db->where('PV.price <=', $max_price);
      $this->db->order_by('PV.price', 'ASE');
    }

    if ($searchbyselect == 'low_to_high') {
      $this->db->order_by('PV.price', 'ASE');
    }
    if ($searchbyselect == 'high_to_low') {
      $this->db->order_by('PV.price', 'DESC');
    }

    if ($rating != '') {
      $this->db->join('tbl_rate_and_review AS RAR', 'RAR.product_id = P.product_id');
      $this->db->where('RAR.cust_rate', $rating);
    }

    if ($slug1 != "") {
      $this->db->where('TC.slug', $slug1);
    }
    if ($slug2 != "") {
      $this->db->join('tbl_sub_category AS SC', 'PWM.sub_cat_id = SC.sub_cat_id');
      $this->db->where('SC.status', 1);
      $this->db->where('SC.slug', $slug2);
    }
    if ($slug3 != "") {
      $this->db->join('tbl_child_category AS CC', 'PWM.child_cat_id = CC.child_cat_id');
      $this->db->where('CC.status', 1);
      $this->db->where('CC.slug', $slug3);
    }
    // $this->db->limit(50, 0);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {

      $array_data = $query->result_array();
    }

    return $array_data;
  }


  public function get_Product_count($slug1 = '', $slug2 = '', $slug3 = '')
  {
    // Build the query
    $this->db->select('P.product_id');
    $this->db->from('tbl_product AS P');
    $this->db->join('tbl_mapping_category_with_product AS PWM', 'P.product_id = PWM.mapping_product_id');
    $this->db->join('tbl_category AS TC', 'PWM.cat_id = TC.cat_id');
    $this->db->join('tbl_sub_category AS SC', 'PWM.sub_cat_id = SC.sub_cat_id');
    $this->db->join('tbl_child_category AS CC', 'PWM.child_cat_id = CC.child_cat_id');
    $this->db->where('P.status', 1);
    $this->db->where('TC.status', 1);
    $this->db->where('SC.status', 1);
    $this->db->where('CC.status', 1);
    if ($slug1 != "") {
      $this->db->where('TC.slug', $slug1);
    }
    if ($slug2 != "") {
      $this->db->where('SC.slug', $slug2);
    }
    if ($slug3 != "") {
      $this->db->where('CC.slug', $slug3);
    }


    return $this->db->count_all_results();
  }



 public function getPriceRange() {
  
  $this->db->select_min('price', 'min_price');
  $this->db->select_max('price', 'max_price');
  $query = $this->db->get('tbl_product_variants');
  return $query->row_array();
}

public function get_product_ratings($product_id) {
    $this->db->select('cust_rate, COUNT(*) as count');
    $this->db->from('tbl_rate_and_review');
    $this->db->where('product_id', $product_id);
    $this->db->group_by('cust_rate');
    $query = $this->db->get();
    return $query->result_array();
}

public function get_offername($product_id) {
      $this->db->select('offers.offer_name,offers.description,offers.value, tbl_product.product_name, tbl_product.product_id,tbl_product_variants.pack_size, tbl_product_variants.units');
      $this->db->from('offers');
      $this->db->join('tbl_product', 'offers.product_id = tbl_product.product_id', 'left');
      $this->db->join('tbl_product_variants', 'offers.variant_id = tbl_product_variants.variant_id', 'left');
      $this->db->where('offers.product_id', $product_id);
      $query = $this->db->get();
      return $query->result_array();
  }

  public function get_review_by_id($rate_id) {
        $this->db->where('rate_id', $rate_id);
        $query = $this->db->get('tbl_rate_and_review');
        return $query->row_array();
    }

  public function update_thumb_action($rate_id, $thumb_value) {
      if (!$rate_id) {
          log_message('error', 'Rate ID is missing.');
          return false;
      }
      $this->db->set('thumb_action', $thumb_value);
      $this->db->where('rate_id', $rate_id);
      if (!$this->db->update('tbl_rate_and_review')) {
          log_message('error', 'Database update failed: ' . $this->db->last_query());
          return false;
      }

      return true;
  }

public function get_thumb_counts($rate_id) {
    $this->db->select('SUM(thumb_action) as likes, COUNT(*) - SUM(thumb_action) as dislikes');
    $this->db->where('rate_id', $rate_id);
    $query = $this->db->get('tbl_rate_and_review');
    
    return $query->row_array();
}


public function getProductRatingSummary($product_id) {
$this->db->select('
            COUNT(*) as total_ratings,
            SUM(CASE WHEN cust_rate = 5 THEN 1 ELSE 0 END) AS five_star,
            SUM(CASE WHEN cust_rate = 4 THEN 1 ELSE 0 END) AS four_star,
            SUM(CASE WHEN cust_rate = 3 THEN 1 ELSE 0 END) AS three_star,
            SUM(CASE WHEN cust_rate = 2 THEN 1 ELSE 0 END) AS two_star,
            SUM(CASE WHEN cust_rate = 1 THEN 1 ELSE 0 END) AS one_star,
            AVG(cust_rate) AS average_rating,
            COUNT(comment) as total_reviews
        ');
        $this->db->from('tbl_rate_and_review');
        $this->db->where('product_id', $product_id);
        $this->db->where('status', 1);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return array(
                'total_ratings' => 0,
                'five_star' => 0,
                'four_star' => 0,
                'three_star' => 0,
                'two_star' => 0,
                'one_star' => 0,
                'average_rating' => 0,
                'total_reviews' => 0
            );
        }
}

}

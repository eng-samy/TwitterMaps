<?php class Admin_model extends CI_Model {
public function check_can_log_in($username, $password){
       
        $query = "select id,access_level from admin where admin=? and password=?  ";
      $result=$this->db->query($query,array($username,$password));
       if ( $result) {
          $result=array('id'=>$result->row(0)->id,'level'=>$result->row(0)->access_level);
	   return  $result; 
        } else {
            return false;
        }
        }
///////////////////////////////////////////////////////////////
		    public function can_log_in(){
        $email=  $this->input->post('email');
        $password= md5($this->input->post('password'));
		
        $query = "select id from admin where admin=? and password=?";
        $result=$this->db->query($query,array($email,$password));
        
        if($result->num_rows() == 1){
            return true;
        } else {
            return false;
        }
        
    }
//////////////////////

public function get_admin_info($id){
     	$this->db->where('id',$id);
		$query = $this->db->get('admin');
	  return $query->result();
	  $this->db->close();
	  }		
//////////////////
	  public function get_manager_info($id){
		 $this->db->where('id',$id);
			 $query= $this->db->get('managers');
				return $query->result();
	  $this->db->close();
		 }
	//////////////
	public function get_supplier_info($id){
		 $this->db->where('id',$id);
			 $query= $this->db->get('suppliers');
				return $query->result();
	  $this->db->close();
		 }	 	 	
	//////////////  	 
	 public function get_user_info($id){
		 $this->db->where('id',$id);
			 $query= $this->db->get('users');
				return $query->result();
	  $this->db->close();
		 }
		///////////  
		public function get_product_info($id){
		 $this->db->where('id',$id);
			 $query= $this->db->get('nego_list');
				return $query->result();
	  $this->db->close();
		 }
		/////////
		public function delete($id,$table)
    {
        $this->db->where('id', $id);
        if($this->db->delete($table)){
			return true;
			}else{
				return false;
				}
			$this->db->close();	
    }
	//////
	  public function get_banner($page,$postion){
		 $this->db->where('page',$page);
		 $this->db->where('postion',$postion);
			 $query= $this->db->get('banners');
				return $query->result();
	  $this->db->close();
		 }
	//////
	public function keyword_search($keyword,$table,$field){
		 $this->db->like($field, $keyword);
		  $query= $this->db->get($table);
				return $query->result();
	  $this->db->close();
		 }
	//////
	
	public function get_welcome_by_id($id,$table){
		 $this->db->where('id',$id);
			 $query= $this->db->get($table);
				if($query){
				 $row = $query->row();
				 $welcome= $row->welcome;
				 return $welcome;
			}
		 }
	////////	 
		public function get_cat($type){
		 $this->db->where('cat_type',$type);
			 $query= $this->db->get('category');
				return $query->result();
	  $this->db->close();
		 }
		 //////////
		 public function get_meta($id,$table,$field){
		 $this->db->where('id',$id);
			 $query= $this->db->get($table);
				return $query->row()->$field;
	  $this->db->close();
		 }
		 ////
		 public function get_order_limit_items($field,$limit,$table){
			 $this->db->order_by($field, "desc");
			 $this->db->limit($limit);
			 $query= $this->db->get($table);
				return $query->result();
	  $this->db->close();
		 }
		 ////
		 public function get_by_country_shops($field,$limit,$country){
		 	$this->db->where('country_id', $country);
		 	$this->db->where('active',1);
			 $this->db->order_by($field, "desc");
			 $this->db->limit($limit);
			 $query= $this->db->get('shop');
				return $query->result();
	  $this->db->close();
		 }
		 ////////
		 public function get_slider_products(){
			 $this->db->order_by("id", "desc");
			 $query= $this->db->get('product');
				return $query->result();
	  $this->db->close();
		 } 
		 ///
		  public function get_home_services(){
			  $this->db->order_by("id", "desc");
			 $this->db->limit(4);
			 $query= $this->db->get('service');
				return $query->result();
	  $this->db->close();
		 }
		//////
		public function get_one_photo($field,$id){
		 $this->db->where($field,$id);
			 $this->db->limit(1);
			 $query= $this->db->get('photos');
				return $query->row()->img;
	  $this->db->close();	
	}
	
	////////
	public function get_one_item($cat_d,$table){
		 $this->db->where('cat_id',$cat_d);
			 $this->db->limit(1);
			 $query= $this->db->get($table);
				return $query->row()->id;
	  $this->db->close();	
	}
	///
	public function get_one_country(){
		 $this->db->order_by('sort_id', 'asc');
			 $this->db->limit(1);
			 $query= $this->db->get('country');
				return $query->row();
	  $this->db->close();	
	}
	//////
	public function get_id_by_name($title,$table){
		$this->db->select('id');
		 $this->db->where('keyword',$title);
			 $query= $this->db->get($table);
			 if($query->num_rows() != 0){
				return $query->row()->id;
			 }else{
				 return false;
				 }
	  $this->db->close();	
	}
	////
		public function get_id_by_title($title,$table){
		$this->db->select('id');
		 $this->db->where('title',$title);
			 $query= $this->db->get($table);
			 if($query->num_rows() != 0){
				return $query->row()->id;
			 }else{
				 return false;
				 }
	  $this->db->close();	
	}
	//////
	public function get_keyword_by_id($id,$table){
		$this->db->select('keyword');
		 $this->db->where('id',$id);
			 $query= $this->db->get($table);
			 if($query->num_rows() != 0){
				return $query->row()->keyword;
			 }else{
				 return false;
				 }
	  $this->db->close();	
	}
	////
	public function get_title_by_id($id,$table){
		$this->db->select('title');
		 $this->db->where('id',$id);
			 $query= $this->db->get($table);
			 if($query->num_rows() != 0){
				return $query->row()->title;
			 }else{
				 return false;
				 }
	  $this->db->close();	
	}
	////
	public function get_sub_one_item($cat_d,$table){
		 $this->db->where('sub_cat_id',$cat_d);
			 $this->db->limit(1);
			 $query= $this->db->get($table);
				return $query->row()->id;
	  $this->db->close();	
	}
////////////	
		public function get_one_photo_cat($field,$id,$table){
			 $this->db->select('*');
    $this->db->from($table);
    $this->db->join('photos', 'photos.'.$field.' = '.$table.'.id'); 
	$this->db->join('category', 'category.id = '.$table.'.cat_id'); 
	 $this->db->where($table.'.cat_id',$id);
    $query = $this->db->get();
    return $query->result();
	  $this->db->close();	
	}
	///////
	public function is_active($id,$key){
			 $this->db->where('id',$id);
			 $this->db->where('en_key',$key);
			 $query = $this->db->get('users');
			 if($query->num_rows() != 0){
				 return true;
				 } else {
					 
					 return false ;
					 }
			 }
			 ///
			 public function shop_active($id){
			 	$this->db->select('active');
			 $this->db->where('id',$id);
			 $query = $this->db->get('shop');
			 return $query->row()->active;
			 }
	/////////
	public function is_sub_cat_valid($id,$title){
			 $this->db->where('id',$id);
			 $this->db->where('title',$title);
			 $query = $this->db->get('sub_category');
			 
			 if($query->num_rows() != 0){
				 return true;
				 } else {
					 
					 return false ;
					 }
			 }		 
	///////////	
			  public function is_cat_exit($cat){
		$this->db->where('title',$cat);
		$query = $this->db->get('other_cat');
		 if($query->num_rows() > 0){
			 return $query->row()->id;
			 }else{
				 return false;
				 }
				$this->db->close(); 
		} 
	/////////////	 
		public function get_sub_cat($cat_id){
		 $this->db->where('cat_id',$cat_id);
			 $query= $this->db->get('sub_category');
				return $query->result();
	  $this->db->close();
		 }
		 ////
		 public function cat($cat_id){
		 $this->db->where('id',$cat_id);
			 $query= $this->db->get('category');
				return $query->row();
	  $this->db->close();
		 }
		 ///////
		 public function sub_cat($cat_id){
		 $this->db->where('id',$cat_id);
			 $query= $this->db->get('sub_category');
				return $query->row();
	  $this->db->close();
		 } 
	////
	public function get_cat_by_id($id){
		 $this->db->where('id',$id);
			 $query= $this->db->get('category');
				return $query->row()->title;
	  $this->db->close();
		 }
		 /////
		 public function get_key_email($email){
		 	$this->db->select('en_key');
		 $this->db->where('email',$email);
			 $query= $this->db->get('users');
				return $query->row()->en_key;
	  $this->db->close();
		 }
		 ///
		  public function get_email_key($key){
		  	$this->db->select('email');
		 $this->db->where('en_key',$key);
			 $query= $this->db->get('users');
				return $query->row()->email;
	  $this->db->close();
		 }
		 ///
		   public function get_id_email($email){
		  	$this->db->select('id');
		 $this->db->where('email',$email);
			 $query= $this->db->get('users');
				return $query->row()->id;
	  $this->db->close();
		 }
		 ///
		  public function get_id_key($key){
		  	$this->db->select('id');
		 $this->db->where('en_key',$key);
			 $query= $this->db->get('users');
				return $query->row()->id;
	  $this->db->close();
		 }
	//////////
	public function get_sub_cat_by_id($id){
		 $this->db->where('id',$id);
			 $query= $this->db->get('sub_category');
				return $query->row()->title;
	  $this->db->close();
		 }	
	/////
	public function get_all_items($table){
		$this->db->order_by('sort_id', 'asc');
			 $query= $this->db->get($table);
				return $query->result();
	  $this->db->close();
		 }
		 /////
	public function items($table){
		$this->db->order_by('id', 'desc');
			 $query= $this->db->get($table);
				return $query->result();
	  $this->db->close();
		 }
		 //
		 public function items_unorder($table){
			 $query= $this->db->get($table);
				return $query->result();
	  $this->db->close();
		 }
	////
	public function get_items($field,$value,$table){
		$this->db->where($field,$value);
			 $query= $this->db->get($table);
				return $query->result();
	  $this->db->close();
		 }
		 ////
		 public function get_by($field,$value,$out,$table){
		 	$this->db->select($out);
		$this->db->where($field,$value);
			 $query= $this->db->get($table);
				return $query->row()->$out;
	  $this->db->close();
		 }
		 ///
		 public function get_by_country($country_id,$table){
		$this->db->where('country_id',$country_id);
			 $query= $this->db->get($table);
				return $query->result();
	  $this->db->close();
		 }
		 /////
		 public function get_by_country_name($country,$table){
		$this->db->where('country',$country);
			 $query= $this->db->get($table);
				return $query->result();
	  $this->db->close();
		 }
		 /////
		 public function get_shows_media($id,$type){
		$this->db->where('show_id',$id);
		$this->db->where('type',$type);
			 $query= $this->db->get('show_media');
				return $query->result();
	  $this->db->close();
		 }
		 ///
		  public function get_one_show_photo($id){
		$this->db->where('show_id',$id);
		$this->db->where('type','photo');
		$this->db->order_by('id');
		$this->db->limit(1);
			 $query= $this->db->get('show_media');
				return $query->row();
	  $this->db->close();
		 }
		 ////
		 public function get_items_order($field,$value,$table,$order){
		$this->db->where($field,$value);
		$this->db->order_by($order, 'desc');
			 $query= $this->db->get($table);
				return $query->result();
	  $this->db->close();
		 }
		 /////
		 public function get_items_order_country($id,$country){
		$this->db->where('cat_id',$id);
		$this->db->where('country_id',$country);
		$this->db->where('active',1);
		$this->db->order_by('viewers', 'desc');
			 $query= $this->db->get('shop');
				return $query->result();
	  $this->db->close();
		 }
		 public function get_items_order_country_city($id,$country){
		$this->db->where('city',$id);
		$this->db->where('country_id',$country);
		$this->db->where('active',1);
		$this->db->order_by('viewers', 'desc');
			 $query= $this->db->get('shop');
				return $query->result();
	  $this->db->close();
		 }
		///////
		public function get_photos_type($id,$type){
		$this->db->where('item_id',$id);
		$this->db->where('type',$type);
			 $query= $this->db->get('photos');
				return $query->result();
	  $this->db->close();
		 }	  	 	  	  
	//////
	public function get_photos($field,$id){
		 $this->db->where($field,$id);
			 $query= $this->db->get('photos');
				return $query->result();
	  $this->db->close();	
	}
	///
	public function get_photos_limit($id,$type){
		 $this->db->where('item_id',$id);
		  $this->db->where('type',$type);
		 $this->db->limit(3);
			 $query= $this->db->get('photos');
				return $query->result();
	  $this->db->close();	
	}
	/////////
		public function get_newsletter(){
			 $query= $this->db->get('newsletter');
				return $query->result();
	  $this->db->close();	
	}
	////////
		public function get_gallery(){
			 $query= $this->db->get('p_gallery');
				return $query->result();
	  $this->db->close();	
	}
	/////////
		public function get_slider(){
			$this->db->order_by("sort_id");
			 $query= $this->db->get('slider');
				return $query->result();
	  $this->db->close();	
	}

	//
		public function get_slider_country($country_id){
			$this->db->where('country_id', $country_id);
			$this->db->order_by("sort_id");
			 $query= $this->db->get('slider');
				return $query->result();
	  $this->db->close();	
	}
	/////////
	public function get_home_trips(){
		 $this->db->where('home',1);
			 $query= $this->db->get('trip');
				return $query->result();
	  $this->db->close();	
	}
	////////
	public function get_special_trips(){
		 $this->db->where('special',1);
			 $query= $this->db->get('trip');
				return $query->result();
	  $this->db->close();	
	}
	////////
	public function get_recommend_trips($id){
		$this->db->where('cat_id',$id);
		 $this->db->where('recommend',1);
			 $query= $this->db->get('trip');
				return $query->result();
	  $this->db->close();	
	}
	////////
	public function get_home_recommend_trips(){
		 $this->db->where('recommend',1);
		 $this->db->limit(10);
			 $query= $this->db->get('trip');
				return $query->result();
	  $this->db->close();	
	}
	//////////
	public function get_left_recommend_trips(){
		 $this->db->where('recommend',1);
		 $this->db->limit(4);
			 $query= $this->db->get('trip');
				return $query->result();
	  $this->db->close();	
	}
	////////
		public function get_videos(){
			 $query= $this->db->get('video');
				return $query->result();
	  $this->db->close();	
	}
	////////
	////////
		public function get_requests(){
			$this->db->order_by('date_reg', 'desc');
			 $query= $this->db->get('requests');
				return $query->result();
	  $this->db->close();	
	}
	//////////
	public function get_check(){
			 $query= $this->db->get('check_av');
				return $query->result();
	  $this->db->close();	
	}
	
	////////
		public function get_faqs(){
			 $query= $this->db->get('faq');
				return $query->result();
	  $this->db->close();	
	}
	////////////
	public function get_faq($id){
		 $this->db->where('id',$id);
			 $query= $this->db->get('faq');
				return $query->row();
	  $this->db->close();	
	}
 public function get_cities($id){
		 $this->db->where('country_id',$id);
		 $this->db->order_by('sort_id', 'asc');
			 $query= $this->db->get('city');
				return $query->result();
	  $this->db->close();
		 }
		 ///
		 public function get_su_cities(){
		 $this->db->order_by('title', 'asc');
			 $query= $this->db->get('su_city');
				return $query->result();
	  $this->db->close();
		 }
	///////////
	public function get_it($id,$table){
		$this->db->select('itinerary');
		 $this->db->where('id',$id);
			 $query= $this->db->get($table);
				return $query->row()->itinerary;
	  $this->db->close();	
	}
	/////////
	public function get_des($id,$table){
		$this->db->select('des');
		 $this->db->where('id',$id);
			 $query= $this->db->get($table);
				return $query->row()->des;
	  $this->db->close();	
	}
	//////
		public function get_price_table($id){
		 $this->db->where('trip_id',$id);
			 $query= $this->db->get('prices');
				return $query->result();
	  $this->db->close();	
	}
	///////////////
	public function get_in($id,$table){
		$this->db->select('inclusions');
		 $this->db->where('id',$id);
			 $query= $this->db->get($table);
				return $query->row()->inclusions;
	  $this->db->close();	
	}
	public function get_ex($id,$table){
		$this->db->select('exclusions');
		 $this->db->where('id',$id);
			 $query= $this->db->get($table);
				return $query->row()->exclusions;
	  $this->db->close();	
	}
	/////
	public function get_item($id,$table){
		 $this->db->where('id',$id);
			 $query= $this->db->get($table);
				return $query->row();
	  $this->db->close();	
	}
	//
	public function get_cat_id($id){
		$this->db->select('cat_id');
		 $this->db->where('id',$id);
			 $query= $this->db->get('shop');
				return $query->row()->cat_id;
	  $this->db->close();	
	}
	///////////
	public function get_cat_items($id,$table){
		 $this->db->where('cat_id',$id);
		 $this->db->order_by("id", "desc");
			 $query= $this->db->get($table);
				return $query->result();
	  $this->db->close();	
	}
	////////////
	public function get_sub_cat_items($id,$table){
		 $this->db->where('sub_cat_id',$id);
			 $query= $this->db->get($table);
				return $query->result();
	  $this->db->close();	
	}
	//////
		public function is_cat_exist($id,$table){
			 $this->db->where('cat_id',$id);
			 $query = $this->db->get($table);
			 
			 if($query->num_rows() != 0){
				 return true;
				 } else {
					 
					 return false ;
					 }
			 }
			 //////
			 public function is_email_exist($email){
			 $this->db->where('email',$email);
			 $query = $this->db->get('users');
			 
			 if($query->num_rows() != 0){
				 return true;
				 } else {
					 
					 return false ;
					 }
			 }
			 //
			  public function is_key_exist($key){
			 $this->db->where('en_key',$key);
			 $query = $this->db->get('users');
			 if($query->num_rows() != 0){
				 return true;
				 } else {
					 
					 return false ;
					 }
			 }
			//////
				public function is_bannar_exist($country_id,$page,$position){
			 $this->db->where('country_id',$country_id);
			 $this->db->where('page',$page);
			 $this->db->where('position',$position);
			 $query = $this->db->get('bannars');
			 
			 if($query->num_rows() != 0){
				 return $query->row()->id;
				 } else {
					 
					 return false ;
					 }
			 } 
			 /////
			 public function get_bannar($country_id,$page,$position){
			 $this->db->where('country_id',$country_id);
			 $this->db->where('page',$page);
			 $this->db->where('position',$position);
			 $query = $this->db->get('bannars');
			 if($query->num_rows() != 0){
				 return $query->row();
				 } else {
					 
					 return false ;
					 }
			}
			///
			public function get_ads($position){
			 $this->db->where('position',$position);
			 $query = $this->db->get('ads');
			 if($query->num_rows() != 0){
				 return $query->row()->img;
				 } else {
					 
					 return false ;
					 }
			}
	//////
	public function is_sub_cat_exist($id,$table){
			 $this->db->where('sub_cat_id',$id);
			 $query = $this->db->get($table);
			 
			 if($query->num_rows() != 0){
				 return true;
				 } else {
					 
					 return false ;
					 }
			 }		 
	////
	function youtube_id($url){
		$parsed_url = parse_url($url);
/*
 * Do some checks on components if necessary
 */
parse_str($parsed_url['query'], $parsed_query_string);
$v = $parsed_query_string['v'];
return $v;
		
		}	 
///////////
	public function trip_in_prices($id){
			 $this->db->where('trip_id',$id);
			 $query = $this->db->get('prices');
			 if($query->num_rows() != 0){
				 return true;
				 } else {
					 
					 return false ;
					 }
			 }		
		 
		 public function right_url($id,$title,$table){
			 $this->db->where('id',$id);
			 $this->db->where('title',$title);
			 $query = $this->db->get($table);
			 
			 if($query->num_rows() != 0){
				 return true;
				 } else {
					 
					 return false ;
					 }
			 }
			 /////////////
			 	public function get_trip_cat($cat_id){
		 $this->db->where('cat_id',$cat_id);
		 $this->db->limit(4);
			 $query= $this->db->get('trip');
				return $query->result();
	  $this->db->close();
		 }
		 ////////
		 /////////////
		 public function items_count($field,$value,$table){
		$this->db->where($field, $value);
		$this->db->from($table);
return $this->db->count_all_results();
		}
		//
		 public function count_all($table){
		$this->db->from($table);
return $this->db->count_all_results();
		}
		//
		public function count_all_requests($type){
			$this->db->where('request_field', $type);
		$this->db->from('users_requests');
return $this->db->count_all_results();
		}
		///////////
			 	public function get_by_id($id,$table){
		 $this->db->where('id',$id);
			 $query= $this->db->get($table);
				return $query->row();
	  $this->db->close();
		 }
		 ///
		 	public function get_user_requests($type){
		 $this->db->where('request_field',$type);
			 $query= $this->db->get('users_requests');
				return $query->result();
	  $this->db->close();
		 }
		 //
		 	public function get_news($id){
		 		$this->db->order_by('id', "desc");
		 $this->db->where('section_id',$id);
			 $query= $this->db->get('news');
				return $query->result();
	  $this->db->close();
		 }
		 ///
		 	public function get_city_by_country($id){
		 $this->db->where('country_id',$id);
			 $query= $this->db->get('city');
				return $query->result();
	  $this->db->close();
		 }
		 /////////
		 public function get_name($id,$table){
		 $this->db->where('id',$id);
			 $query= $this->db->get($table);
				return $query->row()->title;
	  $this->db->close();
		 }
		 ////
		 public function get_shop_user($id){
		 $this->db->where('user_id',$id);
			 $query= $this->db->get('shop');
				return $query->row();
	  $this->db->close();
		 }
		 /////////////
		 public function get_trip($id){
		 $this->db->where('id',$id);
			 $query= $this->db->get('trip');
				return $query->row();
	  $this->db->close();
		 }
		 /////////////
		 public function get_related_products($id,$shop_id){
		 $this->db->where('id !=',$id);
		 $this->db->where('shop_id',$shop_id);
		 $this->db->limit(4);
			 $query= $this->db->get('product');
				return $query->result();
	  $this->db->close();
		 }
		 //////////
		 public function get_related_trips_sub($id,$cat_id){
		 $this->db->where('sub_cat_id !=',$id);
		 $this->db->where('cat_id',$cat_id);
		 $this->db->limit(4);
			 $query= $this->db->get('trip');
				return $query->result();
	  $this->db->close();
		 }
		 ///////////
		 public function get_related_trips_cat($cat_id){
		 $this->db->where('cat_id != ',$cat_id);
		 $this->db->limit(4);
			 $query= $this->db->get('trip');
				return $query->result();
	  $this->db->close();
		 }
		 //////////////
		 public function get_trip_sub_cat($sub_cat_id){
		 $this->db->where('sub_cat_id',$sub_cat_id);
		 $this->db->limit(2);
			 $query= $this->db->get('trip');
				return $query->result();
	  $this->db->close();
		 }
		////
		///////////
		public function get_all_trips_cat($cat_id){
		 $this->db->where('cat_id',$cat_id);
			 $query= $this->db->get('trip');
				return $query->result();
	  $this->db->close(); 
		}
		////////
		public function get_all_trips_sub_cat($sub_cat_id){
		 $this->db->where('sub_cat_id',$sub_cat_id);
			 $query= $this->db->get('trip');
				return $query->result();
	  $this->db->close(); 
		}

		//////////
		public function get_all_sub_cat($cat_id){
		 $this->db->where('cat_id',$cat_id);
			 $query= $this->db->get('sub_category');
				return $query->result();
	  $this->db->close(); 
		}
			// 
	function arabic_date($your_date){
		
		$months = array(
    "Jan" => "يناير",
    "Feb" => "فبراير",
    "Mar" => "مارس",
    "Apr" => "أبريل",
    "May" => "مايو",
    "Jun" => "يونيو",
    "Jul" => "يوليو",
    "Aug" => "أغسطس",
    "Sep" => "سبتمبر",
    "Oct" => "أكتوبر",
    "Nov" => "نوفمبر",
    "Dec" => "ديسمبر"
);
 // The Current Date

$en_month = date("M", strtotime($your_date));

foreach ($months as $en => $ar) {
    if ($en == $en_month) {
        $ar_month = $ar;
    }
}

$find = array (

    "Sat",
    "Sun",
    "Mon",
    "Tue",
    "Wed" ,
    "Thu",
    "Fri"

);

$replace = array (

    "السبت",
    "الأحد",
    "الإثنين",
    "الثلاثاء",
    "الأربعاء",
    "الخميس",
    "الجمعة"

);

$ar_day_format = date('D'); // The Current Day

$ar_day = str_replace($find, $replace, $ar_day_format);
$standard = array("0","1","2","3","4","5","6","7","8","9");
$eastern_arabic_symbols = array("٠","١","٢","٣","٤","٥","٦","٧","٨","٩");
$current_date = $ar_day.' '.date('d').' '.$ar_month.' '.date('Y');
$arabic_date = str_replace($standard , $eastern_arabic_symbols , $current_date);

// Echo Out the Date
return $arabic_date;

	}
/////////
	function en_ar($string){
		$standard = array("0","1","2","3","4","5","6","7","8","9");
$eastern_arabic_symbols = array("٠","١","٢","٣","٤","٥","٦","٧","٨","٩");
$arabic_data = str_replace($standard , $eastern_arabic_symbols , $string);

// Echo Out the Date
return $arabic_data;

	}
function related_keyword($keywords,$id){
	
	$returned_result=array();
	$where="`id` != $id and (";
	
	$keywords=preg_split('/[,\s]+/',$keywords);
	$total_keywords=count($keywords);
	foreach($keywords as $key=>$keyword){
		$where .="`meta_keywords` like '%$keyword%'";
		if($key !=($total_keywords -1)){
			$where .="OR";
			}
		}
		$where .=")";
		$result="select * from news where $where";
		 if ($result2 = $this->db->query($result)) {
            return $result2->result();
        } else {
            return false;
        }
}		

function keyword($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^\x{0600}-\x{06FF}A-Za-z\-]/u', '', $string); // Removes special chars.

   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}
///
function clean($string) {
   $string = preg_replace('/[^\x{0600}-\x{06FF}A-Za-z\- "!@#$%^&*()]/u', '', $string); // Removes special chars.

   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}		
		// 
	
}
?>
<?php 
namespace App\Helpers;
use Illuminate\Support\Facades\DB;
use App\Models\Posts;
class Common {
	/*
	* Get Distance
	*/
	public static function checkUsernameOrEmail($str) 
	{
		$check_is_email = strpos($str,'@');
		if (isset($check_is_email)) return true;
		return false;
	}
	/*
	* Check status
	*/
	public static function checkStatus($status)
	{
		$html ='';
		switch ($status) {
			case '0':
			$html.='<span class="label-danger status-label">Hủy kích hoạt</span>';
			break;
			case '1':
			$html.='<span class="label-success status-label">kích hoạt</span>';
			break;
			default:
				# code...
			break;
		}
		return $html;
	}

	public static function checkStatusss($status)
	{
		$html ='';
		switch ($status) {
			case '-1':
			$html.='<span class="label-danger status-label">Đơn hàng hủy</span>';
			break;
			case '1':
			$html.='<span class="label-success status-label">Đơn hàng thành công</span>';
			break;

			case '0':
			$html.='<span class="label-primary status-label">Đơn hàng đang giao</span>';
			break;
			default:
				# code...
			break;
		}
		return $html;
	}
	/*
	* Check Role Name By User Id
	*/
	public static function checkRoleName($user_id)
	{
		$role_user = DB::table('users')
		->join('roles','roles.id','users.role_id')
		->select('users.full_name','roles.id','roles.name','roles.display_name')
		->first();
		if (!$role_user) return false;
		return $role_user; 
	}
	/*
	* Recursion Categories
	*/
	public static function showCategories($menus, $id_parent = 0 , $arg_check = 0, $name ) 
	{
    # Lấy danh sách có parent bằng 0 ( menu cha )
		$menu_tmp = array();
		foreach ($menus as $key => $item) {
	    # Nếu có parent_id bằng với parrent id hiện tại
			if ((int) $item['parent_id'] == (int) $id_parent) {
				$menu_tmp[] = $item;
        // Sau khi thêm vào biên lưu trữ menu ở bước lặp thì unset nó ra khỏi danh sách menu ở các bước tiếp theo
				unset($menus[$key]);
			}
		}
    # BƯỚC 2: lẶP MENU THEO DANH SÁCH MENU Ở BƯỚC 1 Điều kiện dừng của đệ quy là cho tới khi menu không còn nữa
		if ($menu_tmp) 
		{
			echo '<select class="form-control" name='.$name.'>';
			echo '<option value="">Lựa chọn</option>';
			foreach ($menu_tmp as $item) 
			{
				if ($item['id'] == $id_parent) {
					echo '<option value="'.$item['id'].'" selected>&nbsp;&nbsp;'.$item['title'].'</option>';
				} else {
					echo '<option value="'.$item['id'].'" >&nbsp;&nbsp;'.$item['title'].'</option>';
				}
			}
          		// Truyền vào danh sách menu chưa lặp và id parent của menu hiện tại
			echo '</select>';
		}
	}
	/*
	* Recursion Brand
	*/
	public static function showBrands($menus, $id_parent = 0 , $current_brand = 0 ) 
	{
    # Lấy danh sách có parent bằng 0 ( menu cha )
		$menu_tmp = array();
		foreach ($menus as $key => $item) {
	    # Nếu có parent_id bằng với parrent id hiện tại
			if ((int) $item['parent_id'] == (int) $id_parent) {
				$menu_tmp[] = $item;
        // Sau khi thêm vào biên lưu trữ menu ở bước lặp thì unset nó ra khỏi danh sách menu ở các bước tiếp theo
				unset($menus[$key]);
			}
		}
    # BƯỚC 2: lẶP MENU THEO DANH SÁCH MENU Ở BƯỚC 1 Điều kiện dừng của đệ quy là cho tới khi menu không còn nữa
		if ($menu_tmp) 
		{
			echo '<ul>';
			foreach ($menu_tmp as $item) 
			{
				echo '<li value="'.$item['id'].'">';
				if ( $item['id'] == $current_brand ) {
					echo '<label><input checked class="category-checkbox" type="checkbox" value="'.$item['id'].'" name="brands[]" >&nbsp;&nbsp;'.$item['name'].'</label>';
				} else {
					echo '<label><input class="category-checkbox" type="checkbox" value="'.$item['id'].'" name="brands[]" >&nbsp;&nbsp;'.$item['name'].'</label>';
				}
          		// Truyền vào danh sách menu chưa lặp và id parent của menu hiện tại
				self::showBrands($menus, $item['id']);
				echo '</li>';
			}
			echo '</ul>';
		}
	}

	public static function getDistance($latitudeFrom, $longitudeFrom, $longitudeTo,$latitudeTo) {
		//Calculate distance from latitude and longitude
		$theta = $longitudeFrom - $longitudeTo;
		$dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);
		$dist = $dist * 60 * 1.1515;
		$feet = $dist * 5280;
		$yards = $feet / 3;
		$kilometers = $dist * 1.609344;
		$meters = $kilometers * 1000;
		return compact('feet','yards','kilometers','meters');
	}

	public static function calcDistance($distance)
	{
		$dist = $distance;
		$feet = $dist * 5280;
		$yards = $feet / 3;
		$kilometers = $dist * 1.609344;
		$meters = $kilometers * 1000;
		return compact('feet','yards','kilometers','meters');
	}

	public static function getPostNearby($lat, $lng, $distance, $offset,$take){
		// Radius of the earth 3959 miles or 6371 kilometers.
		$radius = 6371;
		$posts = DB::select('SELECT posts.*, ( '.$radius.' * acos ( cos ( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin ( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance FROM posts HAVING distance < 150 ORDER BY distance ASC , id DESC');
		return $posts;
	}

	public static function checkSocial($social)
	{
		$html ='';
		switch ($social) {
			case '1':
			$html.='<i class="fa fa-facebook-official" style="font-size:30px;color:#4267b2" aria-hidden="true"></i>';
			break;
			case '2':
			$html.='<i class="fa fa-twitter-square" style="font-size:30px;color:rgb(29, 161, 242);" aria-hidden="true"></i>';
			break;
			default:
				# code...
			break;
		}
		return $html;
	}
	public static function checkStatusPost($status)
	{
		$html ='';
		switch ($status) {
			
			case '1':
			$html.='<span class="label-success status-label">Thành công</span>';
			break;

			case '0':
			$html.='<span class="label-danger status-label">Thất bại</span>';
			break;
			default:
				# code...
			break;
		}
		return $html;
	}
	/*
	* get name category parent by id
	*/
	public static function getCateNameById($cate_id)
	{
		$role_cate = DB::table('categories')
		->where('id',$cate_id)
		->select('name')
		->first();
		if (!$role_cate) return false;
		return $role_cate; 
	}
	/*
	* number format price
	*/
	public static function numberFormat($n){
	    $output = '.'; /// các bạn có thể thay dấu "." thành dấu khác tùy ý
	    return str_replace(",",$output,number_format($n));
	}

//show rating
public static function showRating($vote){
 for($i = 1; $i <= $vote; $i++){
  echo '<span><i class="fa fa-star orange"></i></span>';
 }

 if(5-$vote >0){
  for($i = 1; $i <= 5-$vote; $i++){
    echo '<span><i class="fa fa-star lightgrey"></i></span>';
  }
 }
}

}
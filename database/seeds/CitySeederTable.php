<?php

use Illuminate\Database\Seeder;

class CitySeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('city')->insert([
    					[
    						'name' => 'Hà Nội',
    						'name_eng' => 'Ha Noi City'
    					],[
    						'name' => 'Hà Giang',
    						'name_eng' => 'Ha Giang'
    					],[
    						'name' => 'Cao Bằng',
    						'name_eng' => 'Cao Bang'
    					],[
    						'name' => 'Bắc Kạn ',
    						'name_eng' => 'Bac Kan'
    					],[
    						'name' => 'Tuyên Quang ',
    						'name_eng' => 'Tuyen Quang'
    					],[
    						'name' => 'TỉnhLào Cai',
    						'name_eng' => 'Lao Cai'
    					],[
    						'name' => 'Điện Biên',
    						'name_eng' => 'Dien Bien'
    					],[
    						'name' => 'Lai Châu',
    						'name_eng' => 'Lai Chau'
    					],[
    						'name' => 'Sơn La',
    						'name_eng' => 'Son La'
    					],[
    						'name' => 'Yên Bái',
    						'name_eng' => 'Yen Bai'
    					],[
    						'name' => 'Hòa Bình',
    						'name_eng' => 'Hoa Binh'
    					],[
    						'name' => 'Thái Nguyên',
    						'name_eng' => 'Thai Nguyen'
    					],[
    						'name' => 'Lạng Sơn',
    						'name_eng' => 'Lang Son'
    					],[
    						'name' => 'Quảng Ninh',
    						'name_eng' => 'Quang Ninh'
    					],[
    						'name' => 'Bắc Giang',
    						'name_eng' => 'Bac Giang'
    					],[
    						'name' => 'Phú Thọ',
    						'name_eng' => 'Phu Tho'
    					],[
    						'name' => 'Vĩnh Phúc',
    						'name_eng' => 'Vinh Phuc'
    					],[
    						'name' => 'Bắc Ninh',
    						'name_eng' => 'Bac Ninh'
    					],[
    						'name' => 'Hải Dương',
    						'name_eng' => 'Hai Duong'
    					],[
    						'name' => 'Hải Phòng',
    						'name_eng' => 'Hai Duong'
    					],[
    						'name' => 'Hưng Yên',
    						'name_eng' => 'Hung Yen'
    					],[
    						'name' => 'Thái Bình',
    						'name_eng' => 'Thai Binh'
    					],[
    						'name' => 'Hà Nam',
    						'name_eng' => 'Ha Nam'
    					],[
    						'name' => 'Nam Định',
    						'name_eng' => 'Nam Dinh'
    					],[
    						'name' => 'Ninh Bình',
    						'name_eng' => 'Ninh Binh'
    					],[
    						'name' => 'Thanh Hoá',
    						'name_eng' => 'Thanh Hoa'
    					],[
    						'name' => 'Nghệ An',
    						'name_eng' => 'Nghe An'
    					],[
    						'name' => 'Hà Tĩnh',
    						'name_eng' => 'Ha Tinh'
    					],[
    						'name' => 'Quảng Bình',
    						'name_eng' => 'Quang Binh'
    					],[
    						'name' => 'Quảng Trị',
    						'name_eng' => 'Quang Tri'
    					],[
    						'name' => 'Thừa Thiên Huế',
    						'name_eng' => 'Thua Thien Hue'
    					],[
    						'name' => 'Đà Nẵng',
    						'name_eng' => 'Da Nang City'
    					],[
    						'name' => 'Quảng Nam',
    						'name_eng' => 'Quang Nam'
    					],[
    						'name' => 'Quảng Ngãi',
    						'name_eng' => 'Quang Ngai'
    					],[
    						'name' => 'Bình Định',
    						'name_eng' => 'Binh Dinh'
    					],[
    						'name' => 'Phú Yên',
    						'name_eng' => 'Phu Yen'
    					],[
    						'name' => 'Khánh Hòa',
    						'name_eng' => 'Khanh Hoa'
    					],[
    						'name' => 'Ninh Thuận',
    						'name_eng' => 'Ninh Thuan'
    					],[
    						'name' => 'Bình Thuận',
    						'name_eng' => 'Binh Thuan'
    					],[
    						'name' => 'Kon Tum',
    						'name_eng' => 'Kon Tum'
    					],[
    						'name' => 'Gia Lai',
    						'name_eng' => 'Gia Lai'
    					],[
    						'name' => 'Đắk Lắk',
    						'name_eng' => 'Dak Lak'
    					],[
    						'name' => 'Đắk Nông',
    						'name_eng' => 'Dak Nong'
    					],[
    						'name' => 'Lâm Đồng',
    						'name_eng' => 'Lam Dong'
    					],[
    						'name' => 'Bình Phước',
    						'name_eng' => 'Binh Phuoc'
    					],[
    						'name' => 'Tây Ninh',
    						'name_eng' => 'Tay Ninh'
    					],[
    						'name' => 'Bình Dương',
    						'name_eng' => 'Binh Dương'
    					],[
    						'name' => 'Đồng Nai',
    						'name_eng' => 'Dong Nai'
    					],[
    						'name' => 'Bà Rịa - Vũng Tàu',
    						'name_eng' => 'Ba Ria - Vung Tau'
    					],[
    						'name' => 'Hồ Chí Minh',
    						'name_eng' => 'Ho Chi Minh City'
    					],[
    						'name' => 'Long An',
    						'name_eng' => 'Long An'
    					],[
    						'name' => 'Tiền Giang',
    						'name_eng' => 'Tien Giang'
    					],[
    						'name' => 'Bến Tre',
    						'name_eng' => 'Ben Tre'
    					],[
    						'name' => 'Trà Vinh',
    						'name_eng' => 'Tra Vinh'
    					],[
    						'name' => 'Vĩnh Long',
    						'name_eng' => 'Vinh Long'
    					],[
    						'name' => 'Đồng Tháp',
    						'name_eng' => 'Dong Thap'
    					],[
    						'name' => 'An Giang',
    						'name_eng' => 'An Giang'
    					],[
    						'name' => 'Kiên Giang',
    						'name_eng' => 'Kiên Giang'
    					],[
    						'name' => 'Cần Thơ',
    						'name_eng' => 'Can Tho City'
    					],[
    						'name' => 'Hậu Giang',
    						'name_eng' => 'Hau Giang'
    					],[
    						'name' => 'Sóc Trăng',
    						'name_eng' => 'Soc Trang'
    					],[
    						'name' => 'Bạc Liêu',
    						'name_eng' => 'Bac Lieu'
    					],[
    						'name' => 'Cà Mau',
    						'name_eng' => 'Ca Mau'
    					],
    			]);
    }
}

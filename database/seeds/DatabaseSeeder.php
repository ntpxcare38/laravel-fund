<?php

use Illuminate\Database\Seeder;
use App\GroupAcc;
use App\Village;
use App\MemberType;
use App\PositionFund;
use App\PositionCom;
use App\BenefitType;
use App\FundInformation;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //------------------------ สวัสดิการ ----------------------//
        FundInformation::create([
            'fund_name' => 'กองทุนสวัสดิการชุมชนตำบลหนองควาย',
            'fund_no' => '156',
            'fund_village' => 'ต้นเกว๋น',
            'fund_moo' => 4,
            'fund_soi' => '-',
            'fund_road' => 'สันป่าสัก-ต้นเกว๋น',
            'fund_tumbol' => 'หนองควาย',
            'fund_district' => 'หางดง',
            'fund_province' => 'เชียงใหม่',
            'fund_zipcode' => 50230,
            'fund_tel' => '053125070',
            'fund_tel_m' => '0819155649',
            'fund_fax' => '053125070',
            'fund_email' => 'eu-au@hotmail.com',
            'fund_web' => 'www.eu-au.co.th',
            'fund_name_h' => 'นายอินถา หลวงใจ',
            'fund_name_c' => 'นางสาวอารีย์พันธ์ จีรัง',
            'fund_habitant' => 10897,
            'p_id' => 29,
            'fund_edit_time' => '2562-01-01 00:00:00'
        ]);

        //------------------------ สวัสดิการ ----------------------//
        BenefitType::create([
            'type_bname' => 'สวัสดิการเกี่ยวกับเด็กแรกเกิด/คลอดบุตร'
        ]);
        BenefitType::create([
            'type_bname' => 'สวัสดิการเกี่ยวกับการเจ็บป่วย/รักษาพยาบาล'
        ]);
        BenefitType::create([
            'type_bname' => 'สวัสดิการผู้สูงอายุ'
        ]);
        BenefitType::create([
            'type_bname' => 'สวัสดิการกรณีเสียชีวิต'
        ]);
        BenefitType::create([
            'type_bname' => 'สวัสดิการค่าใช้จ่ายเกี่ยวกับงานศพ'
        ]);
        BenefitType::create([
            'type_bname' => 'สวัสดิการคนด้อยโอกาส/พิการ'
        ]);
        BenefitType::create([
            'type_bname' => 'สวัสดิการเพื่อพัฒนาอาชีพ'
        ]);
        BenefitType::create([
            'type_bname' => 'สวัสดิการเพื่อการศึกษา'
        ]);
        BenefitType::create([
            'type_bname' => 'สวัสดิการการแต่งงาน'
        ]);
        BenefitType::create([
            'type_bname' => 'สวัสดิการทหารเกณฑ์'
        ]);
        BenefitType::create([
            'type_bname' => 'สวัสดิการอุปสมบท'
        ]);

        //------------------------ ตำแหน่งในหมู่บ้าน ----------------------//
        PositionCom::create([
            'position_cname' => 'บุคคลทั่วไป'
        ]);
        PositionCom::create([
            'position_cname' => 'ผู้ใหญ่บ้าน'
        ]);


        //------------------------ ตำแหน่งในกองทุน ----------------------//
        PositionFund::create([
            'position_fname' => 'ประธานกองทุน'
        ]);
        PositionFund::create([
            'position_fname' => 'รองประธานกองทุน'
        ]);
        PositionFund::create([
            'position_fname' => 'เลขานุการ'
        ]);
        PositionFund::create([
            'position_fname' => 'ผู้ช่วยเลขานุการ'
        ]);
        PositionFund::create([
            'position_fname' => 'เหรัญญิก'
        ]);
        PositionFund::create([
            'position_fname' => 'ผู้ช่วยเหรัญญิก'
        ]);
        PositionFund::create([
            'position_fname' => 'ฝ่ายทะเบียน'
        ]);
        PositionFund::create([
            'position_fname' => 'ฝ่ายสวัสดิการ'
        ]);
        PositionFund::create([
            'position_fname' => 'ฝ่ายประชาสัมพันธ์'
        ]);
        PositionFund::create([
            'position_fname' => 'กรรมการตรวจสอบภายใน'
        ]);
        PositionFund::create([
            'position_fname' => 'กรรมการ'
        ]);
        PositionFund::create([
            'position_fname' => 'กรรมการตรวจสอบภายนอก'
        ]);
        PositionFund::create([
            'position_fname' => 'ที่ปรึกษา'
        ]);

        //------------------------ ประเภทสมาชิก ----------------------//
        MemberType::create([
            'type_mname' => 'บุคคลทั่วไป'
        ]);
        MemberType::create([
            'type_mname' => 'เด็ก/เยาวชน'
        ]);
        MemberType::create([
            'type_mname' => 'ผู้สูงอายุ'
        ]);
        MemberType::create([
            'type_mname' => 'ผู้ด้อยโอกาส/ผู้พิการ'
        ]);

        //------------------------ หมู่บ้าน ----------------------//
        Village::create([
            'v_name' => 'บ้านตองกาย'
        ]);
        Village::create([
            'v_name' => 'บ้านฟ่อน'
        ]);
        Village::create([
            'v_name' => 'บ้านไร่กองขิง'
        ]);
        Village::create([
            'v_name' => 'บ้านต้นเกว๋น'
        ]);
        Village::create([
            'v_name' => 'บ้านหนองควาย'
        ]);
        Village::create([
            'v_name' => 'บ้านร้อยจันทร์'
        ]);
        Village::create([
            'v_name' => 'บ้านเหมืองกุง'
        ]);
        Village::create([
            'v_name' => 'บ้านขุนเส'
        ]);
        Village::create([
            'v_name' => 'บ้านสันทราย'
        ]);
        Village::create([
            'v_name' => 'บ้านนาบุก'
        ]);
        Village::create([
            'v_name' => 'บ้านสันป่าสัก'
        ]);
        Village::create([
            'v_name' => 'บ้านตองกายเหนือ'
        ]);

        //------------------------ หมวดบัญชี ----------------------//
        GroupAcc::create([
            'group_acname' => 'เงินสมทบจากสมาชิก',
            'type_acc' => 1
        ]);
        GroupAcc::create([
            'group_acname' => 'เงินจากสถานบัน พอช.',
            'type_acc' => 1
        ]);
        GroupAcc::create([
            'group_acname' => 'งบสมทบจากรัฐบาลผ่าน พอช.',
            'type_acc' => 1
        ]);
        GroupAcc::create([
            'group_acname' => 'องค์กรปกครองส่วนท้องถิ่น',
            'type_acc' => 1
        ]);
        GroupAcc::create([
            'group_acname' => 'หน่วยงานภาครัฐอื่นๆ',
            'type_acc' => 1
        ]);
        GroupAcc::create([
            'group_acname' => 'เงินฝากธนาคาร',
            'type_acc' => 3
        ]);
        GroupAcc::create([
            'group_acname' => 'เงินสดในมือ',
            'type_acc' => 3
        ]);
        GroupAcc::create([
            'group_acname' => 'เงินลงทุนอื่นๆ',
            'type_acc' => 3
        ]);
        GroupAcc::create([
            'group_acname' => 'ค่าธรรมเนียมแรกเข้า/ค่าสมัคร',
            'type_acc' => 2
        ]);
        GroupAcc::create([
            'group_acname' => 'เงินบริจาค',
            'type_acc' => 2
        ]);
        GroupAcc::create([
            'group_acname' => 'ดอกเบี้ยเงินฝากธนาคาร',
            'type_acc' => 2
        ]);
        GroupAcc::create([
            'group_acname' => 'เงินรายได้อื่นๆ',
            'type_acc' => 2
        ]);
        GroupAcc::create([
            'group_acname' => 'ค่าตอบแทนคนทำงาน',
            'type_acc' => 4
        ]);
        GroupAcc::create([
            'group_acname' => 'ค่าพาหนะ',
            'type_acc' => 4
        ]);
        GroupAcc::create([
            'group_acname' => 'ค่าเอกสาร/เครื่องเขียน',
            'type_acc' => 4
        ]);
        GroupAcc::create([
            'group_acname' => 'สนับสนุนกิจกรรม',
            'type_acc' => 4
        ]);
    }
}

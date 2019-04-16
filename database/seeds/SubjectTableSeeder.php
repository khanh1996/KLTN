<?php

use Illuminate\Database\Seeder;

class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // khoa học máy tính 8
        DB::table('subjects')->insert([
            'name' => 'Xây dựng phần mềm quản lý khóa luận tốt nghiệp',
            'evaluate' => 3,
            'faculty_id' => 1,
            'department_id' => 8,
            'user_id' => 4,
        ]);
        DB::table('subjects')->insert([
            'name' => 'Xây dựng ứng dụng nhập điểm tự động',
            'evaluate' => 1,
            'faculty_id' => 1,
            'department_id' => 8,
            'user_id' => 4,
        ]);
        DB::table('subjects')->insert([
            'name' => 'Quản lý cho thuê xe du lịch',
            'evaluate' => 2,
            'faculty_id' => 1,
            'department_id' => 8,
            'user_id' => 4,
        ]);
        DB::table('subjects')->insert([
            'name' => 'Thiết kế hệ thống báo cháy chống trộm',
            'evaluate' => 2,
            'faculty_id' => 1,
            'department_id' => 8,
            'user_id' => 5,
        ]);
         //toán túng dụng 7
        DB::table('subjects')->insert([
            'name' => 'Mô hình phân loại trực tuyến mới dựa vào suy diễn phương sai và Bayes',
            'evaluate' => 1,
            'faculty_id' => 1,
            'department_id' => 8,
            'user_id' => 12,
        ]);
        DB::table('subjects')->insert([
            'name' => 'Cải tiến thuật toán ID3',
            'evaluate' => 2,
            'faculty_id' => 1,
            'department_id' => 8,
            'user_id' => 12,
        ]);
        DB::table('subjects')->insert([
            'name' => 'Thư viện mã nguồn mở giải Bài toán đạo hàm riêng bằng phương pháp phần tử hữu hạn',
            'evaluate' => 3,
            'faculty_id' => 1,
            'department_id' => 8,
            'user_id' => 12,
        ]);
        // truyền thông mạng máy tính 9
        DB::table('subjects')->insert([
            'name' => 'Mô phỏng nhiệt độ trong nhà thông minh theo thời gian thực',
            'evaluate' => 1,
            'faculty_id' => 1,
            'department_id' => 8,
            'user_id' => 5,
        ]);
        DB::table('subjects')->insert([
            'name' => 'Giải pháp quản lý kho tập trung cho các sàn thương mại điện tử',
            'evaluate' => 2,
            'faculty_id' => 1,
            'department_id' => 8,
            'user_id' => 5,
        ]);
        DB::table('subjects')->insert([
            'name' => 'Điều khiển các thiết bị qua wifi',
            'evaluate' => 3,
            'faculty_id' => 1,
            'department_id' => 8,
            'user_id' => 5,
        ]);
        // Hệ thống thông tin 10
        DB::table('subjects')->insert([
            'name' => 'Công nghệ ảo hóa và ứng dụng mô hình ảo hóa trong doanh nghiệp nhỏ',
            'evaluate' => 1,
            'faculty_id' => 1,
            'department_id' => 8,
            'user_id' => 6,
        ]);
        DB::table('subjects')->insert([
            'name' => 'SEO- Công nghệ marketing online',
            'evaluate' => 2,
            'faculty_id' => 1,
            'department_id' => 8,
            'user_id' => 6,
        ]);
        DB::table('subjects')->insert([
            'name' => 'Xây dựng hệ thống mạng xã hội trường học',
            'evaluate' => 3,
            'faculty_id' => 1,
            'department_id' => 8,
            'user_id' => 6,
        ]);
//
//        // kế toán 11
//        DB::table('subjects')->insert([
//            'name' => 'Tổ chức lập và phân tích  báo cáo tài chính',
//            'evaluate' => 1,
//            'faculty_id' => 2,
//            'department_id' => 11,
//        ]);
//        DB::table('subjects')->insert([
//            'name' => 'Tình thình thực hiện thuế giá trị gia tăng, thu nhập doanh nghiệp và một số giải pháp khắc phục',
//            'evaluate' => 2,
//            'faculty_id' => 2,
//            'department_id' => 11,
//        ]);
//        DB::table('subjects')->insert([
//            'name' => 'Hoàn thiện tổ chức công tác kế toán trong đơn vị hành chính sự nghiệp',
//            'evaluate' => 3,
//            'faculty_id' => 2,
//            'department_id' => 11,
//        ]);
//        // tài chính ngân hàng 12
//        DB::table('subjects')->insert([
//            'name' => 'Giải pháp nâng cao hiệu quả hoạt động cho vay đối với hộ sản xuất tại Ngân hàng Nông nghiệp',
//            'evaluate' => 1,
//            'faculty_id' => 2,
//            'department_id' => 12,
//        ]);
//        DB::table('subjects')->insert([
//            'name' => 'Kiểm định mô hình 3 nhân tố Fama-French trên TTCK Việt Nam',
//            'evaluate' => 2,
//            'faculty_id' => 2,
//            'department_id' => 12,
//        ]);
//        DB::table('subjects')->insert([
//            'name' => 'Giải pháp phát triển hoạt động thanh toán quốc tế tại Techcombank,giai đoạn 2015 – 2017',
//            'evaluate' => 3,
//            'faculty_id' => 2,
//            'department_id' => 12,
//        ]);
//        // quản trị kinh doanh 13
//        DB::table('subjects')->insert([
//            'name' => 'Đánh giá hiệu quả tuyển dụng tại công ty TNHH Cargill Việt Nam',
//            'evaluate' => 1,
//            'faculty_id' => 2,
//            'department_id' => 13,
//        ]);
//        DB::table('subjects')->insert([
//            'name' => 'Chiến lược kinh doanh của Tổng Công ty Sành sứ Thủy tinh Công nghiệp',
//            'evaluate' => 2,
//            'faculty_id' => 2,
//            'department_id' => 13,
//        ]);
//        DB::table('subjects')->insert([
//            'name' => 'Hoàn thiện công tác quản trị nguồn nhân lực tại Công ty cổ phần Dệt May Huế',
//            'evaluate' => 3,
//            'faculty_id' => 2,
//            'department_id' => 13,
//        ]);
//        // quản trị dịch vụ du lịch lữ hành 14
//        DB::table('subjects')->insert([
//            'name' => 'Quản Trị Kinh Doanh Dịch vụ Du lịch khách sạn PARK HYATT',
//            'evaluate' => 1,
//            'faculty_id' => 2,
//            'department_id' => 14,
//        ]);
//        DB::table('subjects')->insert([
//            'name' => 'Biện pháp quản lý cầu du lịch quốc tế đến VN',
//            'evaluate' => 1,
//            'faculty_id' => 2,
//            'department_id' => 14,
//        ]);
//        DB::table('subjects')->insert([
//            'name' => 'Dịch vụ lữ hành Saigontourist',
//            'evaluate' => 3,
//            'faculty_id' => 2,
//            'department_id' => 14,
//        ]);
//        // điều dưỡng 15
//        DB::table('subjects')->insert([
//            'name' => 'Chăm sóc bệnh nhân nhồi máu não giai đoạn sớm',
//            'evaluate' => 1,
//            'faculty_id' => 3,
//            'department_id' => 15,
//        ]);
//        DB::table('subjects')->insert([
//            'name' => 'Chăm sóc bệnh nhân tay chân miệng tại bệnh viện Đa khoa Đức Giang',
//            'evaluate' => 2,
//            'faculty_id' => 3,
//            'department_id' => 15,
//        ]);
//        DB::table('subjects')->insert([
//            'name' => 'Chăm sóc điều dưỡng cho bệnh nhân ung thư phổi điều trị hóa chất',
//            'evaluate' => 3,
//            'faculty_id' => 3,
//            'department_id' => 15,
//        ]);
//        // y tế công cộng 16
//        DB::table('subjects')->insert([
//            'name' => 'Mạng lưới sản xuất toàn cầu - thực trạng và triển vọng',
//            'evaluate' => 1,
//            'faculty_id' => 3,
//            'department_id' => 16,
//        ]);
//        DB::table('subjects')->insert([
//            'name' => 'Nâng cao hiệu quả sử dụng vốn tại Công ty TNHH đầu tư phát triển thiết bị y tế',
//            'evaluate' => 2,
//            'faculty_id' => 3,
//            'department_id' => 16,
//        ]);
//        DB::table('subjects')->insert([
//            'name' => 'Tiêm chủng, nâng cao sức khỏe',
//            'evaluate' => 3,
//            'faculty_id' => 3,
//            'department_id' => 16,
//        ]);
//        // dinh dưỡng 17
//        DB::table('subjects')->insert([
//            'name' => 'Thực trạng dinh dưỡng của trẻ 5 - 6 tuổi ở một số trường mầm non thành phố Hà Nội',
//            'evaluate' => 1,
//            'faculty_id' => 3,
//            'department_id' => 17,
//        ]);
//        DB::table('subjects')->insert([
//            'name' => 'Nghiên cứu bào chế và độ ổn định phytosome quercetin',
//            'evaluate' => 2,
//            'faculty_id' => 3,
//            'department_id' => 17,
//        ]);
//        DB::table('subjects')->insert([
//            'name' => 'Nghiên cứu bào chế kem chứa alpha arbutin',
//            'evaluate' => 3,
//            'faculty_id' => 3,
//            'department_id' => 17,
//        ]);
//        // quản lý bệnh viện 18
//        DB::table('subjects')->insert([
//            'name' => 'Hoàn thiện công tác đào tạo bồi dưỡng công chức viên chức Bệnh viện Mắt Trung ương',
//            'evaluate' => 1,
//            'faculty_id' => 3,
//            'department_id' => 18,
//        ]);
//        DB::table('subjects')->insert([
//            'name' => 'Tạo động lực làm việc cho viên chức bệnh viện đa khoa Đông Anh, thành phố Hà Nội',
//            'evaluate' => 2,
//            'faculty_id' => 3,
//            'department_id' => 18,
//        ]);
//        DB::table('subjects')->insert([
//            'name' => 'Quản lý nhà nước về thi đua, khen thưởng tại bệnh viện tuyến trung ương trên địa bàn thành phố Hà Nội',
//            'evaluate' => 3,
//            'faculty_id' => 3,
//            'department_id' => 18,
//        ]);
//        // Ngôn ngữ Anh 19
//        DB::table('subjects')->insert([
//            'name' => 'Nghiên cứu một số lỗi thường gặp trong văn viết tiếng Anh của sinh viên, trường ĐH Thăng Long',
//            'evaluate' => 1,
//            'faculty_id' => 4,
//            'department_id' => 19,
//        ]);
//        DB::table('subjects')->insert([
//            'name' => 'Nghiên cứu chiến lược học từ vựng/ từ vựng pháp lý của sinh viên ngành NA, trường ĐH Thăng Long',
//            'evaluate' => 2,
//            'faculty_id' => 4,
//            'department_id' => 19,
//        ]);
//        DB::table('subjects')->insert([
//            'name' => 'Động lực và thái độ của sinh viên chuyên ngữ tại Trường ĐH Thăng Long về việc học tiếng Anh',
//            'evaluate' => 3,
//            'faculty_id' => 4,
//            'department_id' => 19,
//        ]);
//        // Ngôn ngữ Trung Quốc 20
//        DB::table('subjects')->insert([
//            'name' => 'Giải pháp nâng cao chất lượng dạy ngữ âm tiếng Trung Quốc tại ĐH Thăng Long',
//            'evaluate' => 1,
//            'faculty_id' => 4,
//            'department_id' => 20,
//        ]);
//        DB::table('subjects')->insert([
//            'name' => 'Khảo sát thực trạng thiết kế và sử dụng bài tập trong dạy học tiếng Hán giai đoạn sơ cấp ở ĐH Thăng Long',
//            'evaluate' => 2,
//            'faculty_id' => 4,
//            'department_id' => 20,
//        ]);
//        DB::table('subjects')->insert([
//            'name' => 'Nghiên cứu cách chuyển dịch tên người tiếng Anh sang tiếng Hán',
//            'evaluate' => 3,
//            'faculty_id' => 4,
//            'department_id' => 20,
//        ]);
//        // Ngôn ngữ Nhật 21
//        DB::table('subjects')->insert([
//            'name' => 'Omotenashi - Văn hóa phục vụ bằng trái tim của người Nhật',
//            'evaluate' => 1,
//            'faculty_id' => 4,
//            'department_id' => 21,
//        ]);
//        DB::table('subjects')->insert([
//            'name' => 'Văn hóa ứng xử trong doanh nghiệp Nhật Bản',
//            'evaluate' => 2,
//            'faculty_id' => 4,
//            'department_id' => 21,
//        ]);
//        DB::table('subjects')->insert([
//            'name' => 'Chẩm thảo tử của Sei Shônagon trong tùy bút cổ điển Nhật Bản',
//            'evaluate' => 3,
//            'faculty_id' => 4,
//            'department_id' => 21,
//        ]);
//        // Ngôn ngữ Hàn 22
//        DB::table('subjects')->insert([
//            'name' => 'Khảo sát sự nhận thức của sinh viên năm 2 khoa Ngôn ngữ Hàn Quốc trường ĐH Thăng Long',
//            'evaluate' => 1,
//            'faculty_id' => 4,
//            'department_id' => 22,
//        ]);
//        DB::table('subjects')->insert([
//            'name' => 'Phương thức biển hiện ý nghĩa thời gian trong tiếng Hàn',
//            'evaluate' => 2,
//            'faculty_id' => 4,
//            'department_id' => 22,
//        ]);
//        DB::table('subjects')->insert([
//            'name' => 'Truyền thuyết lập quốc của Hàn Quốc',
//            'evaluate' => 3,
//            'faculty_id' => 4,
//            'department_id' => 22,
//        ]);
//        // việt nam học 23
//        DB::table('subjects')->insert([
//            'name' => 'Tiếp cận lý thuyết và một số phương pháp cần được giảng dạy trong ngành Việt Nam học',
//            'evaluate' => 1,
//            'faculty_id' => 5,
//            'department_id' => 23,
//        ]);
//        DB::table('subjects')->insert([
//            'name' => 'Chất lượng đào tạo ngành Việt Nam học ở trường ĐH Thăng Long – Thực trạng và giải pháp',
//            'evaluate' => 2,
//            'faculty_id' => 5,
//            'department_id' => 23,
//        ]);
//        DB::table('subjects')->insert([
//            'name' => 'Tìm hiểu lịch sử và văn hóa Việt Nam',
//            'evaluate' => 3,
//            'faculty_id' => 5,
//            'department_id' => 23,
//        ]);
//        // công tác xã hội 24
//        DB::table('subjects')->insert([
//            'name' => 'Công tác xã hội trong việc hỗ trợ kiến thức cho phụ nữ về Luật phòng chống bạo lực gia đình',
//            'evaluate' => 1,
//            'faculty_id' => 5,
//            'department_id' => 24,
//        ]);
//        DB::table('subjects')->insert([
//            'name' => 'Công tác xã hội trong việc phòng ngừa nguy cơ bị lạm dụng tình dục ở trẻ lao động sớm',
//            'evaluate' => 2,
//            'faculty_id' => 5,
//            'department_id' => 24,
//        ]);
//        DB::table('subjects')->insert([
//            'name' => 'Đời sống kinh tế của thương bệnh binh và vai trò của công tác xã hội',
//            'evaluate' => 3,
//            'faculty_id' => 5,
//            'department_id' => 24,
//        ]);
//        // thang nhạc 25
//        DB::table('subjects')->insert([
//            'name' => 'Tìm hiểu kiến thức và ký thuật chơi Piano',
//            'evaluate' => 1,
//            'faculty_id' => 6,
//            'department_id' => 25,
//        ]);
//        DB::table('subjects')->insert([
//            'name' => 'Phân tích 1 số tác phẩm piano viết ở những hình thức và thể loại lớn',
//            'evaluate' => 2,
//            'faculty_id' => 6,
//            'department_id' => 25,
//        ]);
//        DB::table('subjects')->insert([
//            'name' => 'Hình thức biến tấu trong sáng tác của một số nhạc sĩ Việt Nam hiện nay',
//            'evaluate' => 3,
//            'faculty_id' => 6,
//            'department_id' => 25,
//        ]);









    }
}

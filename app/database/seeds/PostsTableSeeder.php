<?php

class PostsTableSeeder extends Seeder {

    protected $content1 = ' Nếu bạn là một người sống trên một đất nước nào đó ở dải đất Mỹ La Tinh thì bạn đang là những người hạnh phúc nhất hành tinh hiện nay, theo số liệu thăm dò mới nhất được công bố bởi viện Gallup, cơ quan thăm dò dư luận nổi tiếng của Mỹ.

Theo Viện nghiên cứu Gallup, lần đầu tiên trong một thập kỷ qua, các quốc gia ở Mỹ La Tinh được xếp vào top 10 quốc gia có chỉ số lạc quan hàng đầu trên thế giới. Đứng đầu là Paraguay với 89 điểm, tiếp đến là Columbia, Ecuador và Guatemala đều đạt 84 điểm. Được biết, các số liệu thống kê này được Gallup biên soạn từ 5 câu hỏi dành cho người trưởng thành tại hơn 143 quốc gia và vùng lãnh thổ trên thế giới trong năm 2014.

Nhìn chung có tới 70% người được hỏi nói rằng, họ được tận hưởng, được cười thỏa thích, cảm thấy thoải mái và quan trọng là được đối xử tôn trọng tại các quốc gia có chỉ số lạc quan cao.

Top 10 quốc gia có chỉ số lạc quan cao nhất thế giới. Ảnh Gallup

Trong khi các quốc gia La Tinh là những người đang được hưởng cảm xúc lạc quan nhất trên thế giới thì đáng buồn thay, các quốc gia bị chiến tranh tàn phá và thường xảy ra xung đột như Afghanistan, Sudan, Serbia,...vẫn đang là những quốc gia nằm trong top 10 nước có chỉ số lạc quan thuộc hàng thấp nhất trên thế giới.

Theo khảo sát, Sudan (quốc gia mới tách thành 2 nước là Sudan và Nam Sudan) đang là quốc gia có chỉ số lạc quan thấp nhất thế giới với 47 điểm, tiếp đến là Tunisia với 52 điểm, Bangladesh là 54 điểm và tới vị trí cuối cùng là Afghanistan là 55 điểm. Tuy nhiên, theo ghi nhận của Viện Gallup, Syria dường như đã thoát khỏi danh sách các nước có chỉ số lạc quan thấp nhất.

Top 10 quốc gia có chỉ số lạc quan thấp nhất thế giới. Ảnh Gallup

Tại các khu vực như Trung Đông hay Bắc Phi tuy không được xếp vào các quốc gia có chỉ số lạc quan thấp nhất nhưng tại những khu vực này, bản báo cáo đã cho thấy xuất hiện khá nhiều cảm xúc tiêu cực của người dân.

Cũng trong danh sách này, Việt Nam đang đứng ở vị trí thứ 61 với 71 điểm, xếp sau Malaysia và đứng trước Ghana. Đáng ngạc nhiên là trong danh sách, quốc gia láng giềng trong khu vực Đông Nam Á là Philippines lại đang đứng ở vị trí khá cao, xếp thứ 11 với 80 điểm mặc cho phải hứng chịu khá nhiều thiên tai. Quốc gia đứng vị trí 12 sau đó là Singapore với 80 điểm, Indonesia đứng vị trí 28 với 78 điểm, Thái Lan ở vị trí 48 với 75 điểm. Trong khi đó, Mỹ và Trung Quốc đang chia sẻ hai vị trí là 25 (79 điểm) và 45 (75 điểm).

Tuy nhiên, do được thực hiện riêng tại từng quốc gia nên sẽ có những sai số khác biệt, có quốc gia thấp chỉ 2,1% nhưng cũng có quốc gia có sai số lên tới 5,3%.

Được biết, các kết quả tổng hợp trên được Gallup ghi lại từ hơn 2014 cuộc điện thoại và phỏng vấn với trên 1.000 người trưởng thành được xếp vào độ tuổi từ 15 trở lên. Ở cấp độ toàn cầu, sai số được Gallup dự đoán chỉ ít hơn 1%. Điểm chỉ số lạc quan/vui vẻ toàn cầu theo đánh giá tổng quát của Gallup là 71 điểm và nhìn chung vẫn cho thấy những dấu hiệu lạc quan trong năm 2015 mặc cho những tác động từ suy thoái kinh tế và các vấn đề khách quan khác.

';
    protected $content2 = ' Theo báo cáo mới nhất từ Trung Quốc, kế hoạch sản xuất 2,5 tới 3 triệu chiếc Apple Watch trong một tháng của Apple có thể không thành công. Sản lượng màn hình do LG sản xuất ở mức thấp là một phần nguyên nhân.

Apple giảm sản lượng dự kiến của Apple Watch

Do sử dụng nhựa thay cho kính nên việc sản xuất màn hình OLED cho Apple Watch trở nên khó khăn hơn, sản lượng chỉ đạt khoảng 30% đến 40%. Bên cạnh vấn đề với màn hình, quá trình lắp ráp Apple Watch được thực hiện bởi Quanta cũng gặp một số khó khăn. Quanta chuyên sản xuất máy tính xách tay nên công ty này đã gặp khó trong quá trình lắp ráp một thiết bị nhỏ như smartwatch.

Apple buộc phải giảm sản lượng dự kiến của Apple Watch xuống chỉ còn 1,25 tới 1,5 triệu chiếc mỗi tháng. Một số nguồn tin cho rằng ở thời điểm hiện tại mỗi tháng Apple chỉ có thể xuất xưởng 300.000 chiếc Apple Watch. Nhiều khả năng Apple sẽ yêu cầu Foxconn tham gia lắp ráp Apple Watch nhằm tăng sản lượng tổng thể.';

    protected $content3 = '';

    public function run()
    {
        DB::table('posts')->delete();

        $user_id = User::first()->id;

        DB::table('posts')->insert( array(
            array(
                'user_id'    => $user_id,
                'title'      => 'Việt Nam đứng thứ 61 thế giới về chỉ số lạc quan',
                'slug'       => 'viet-name-dung-thu-61-the-gioi-ve-chi-so-lac-quan',
                'content'    => $this->content1,
                'meta_title' => 'meta_title1',
                'meta_description' => 'meta_description1',
                'meta_keywords' => 'meta_keywords1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'user_id'    => $user_id,
                'title'      => 'Apple giảm sản lượng dự kiến của Apple Watch ',
                'slug'       => 'apple-giam-san-luong-du-kien-cua-apple-watch',
                'content'    => $this->content2,
                'meta_title' => 'meta_title2',
                'meta_description' => 'meta_description2',
                'meta_keywords' => 'meta_keywords2',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'user_id'    => $user_id,
                'title'      => 'John Chen sẽ biến BlackBerry thành công ty phần mềm? ',
                'slug'       => 'john-chen-se-bien-blackberry-thanh-cong-ty-phan-mem',
                'content'    => $this->content3,
                'meta_title' => 'meta_title3',
                'meta_description' => 'meta_description3',
                'meta_keywords' => 'meta_keywords3',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ))
        );
    }

}

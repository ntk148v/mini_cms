<?php

class CommentsTableSeeder extends Seeder {

    protected $content1 = 'Có thể là đơn đặt hàng ít nên giảm sản lượng';
    protected $content2 = 'Anh em đung dung toi thang ASUS nhe.minh moi mua con Zen5 duoc 2thang thi bi liet phim cam ung.mang ra bao hanh no kêu ko bh man hình!';
    protected $content3 = 'Kiểu này mua hàng xách tay chứ hàng chính hãng thằng nào màn hình liệt cảm ứng mà không bảo hàng bao giờ mà nói không bảo hành màn hình';

    public function run()
    {
        DB::table('comments')->delete();

        $user_id = User::first()->id;
        $post_id = Post::first()->id;

        DB::table('comments')->insert( array(
            array(
                'user_id'    => $user_id,
                'post_id'    => $post_id,
                'content'    => $this->content1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'user_id'    => $user_id,
                'post_id'    => $post_id,
                'content'    => $this->content2,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'user_id'    => $user_id,
                'post_id'    => $post_id,
                'content'    => $this->content3,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'user_id'    => $user_id,
                'post_id'    => $post_id+1,
                'content'    => $this->content1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'user_id'    => $user_id,
                'post_id'    => $post_id+1,
                'content'    => $this->content2,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'user_id'    => $user_id,
                'post_id'    => $post_id+2,
                'content'    => $this->content1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ))
        );
    }

}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\About>
 */
class AboutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'company_name'=>'HatGiongGiaRe.net - Nơi Nảy Mầm Sự Sáng Tạo Cho Vườn Nhà Bạn!',
            'description'=>'<p>Chào mừng bạn đến với HatGiongGiaRe.net - điểm đến hàng đầu cho những người yêu thích trồng cây và tạo nên vườn ươm sáng tạo tại ngôi nhà của mình. Chúng tôi tự hào là địa chỉ đáng tin cậy cung cấp các loại hạt giống chất lượng vượt trội.</p>

            <p>Tại HatGiongGiaRe.net, bạn sẽ khám phá một thế giới đa dạng với hàng trăm loại hạt giống từ rau cải, cây ăn trái cho đến hoa kiểng và cây cảnh. Chúng tôi hiểu rằng mỗi khu vườn là một tác phẩm nghệ thuật riêng, vì vậy chúng tôi luôn tập trung vào việc mang đến sự lựa chọn phong phú và thông tin chi tiết để bạn có thể thực hiện dự án trồng cây của mình một cách dễ dàng và thành công.</p>

            <p>Chất lượng luôn là ưu tiên hàng đầu tại HatGiongGiaRe.net. Mỗi hạt giống được chọn lọc kỹ càng và kiểm định bởi các chuyên gia về cây trồng, đảm bảo độ nảy mầm cao và sức kháng tốt. Hướng dẫn trồng và chăm sóc chi tiết cùng với đội ngũ hỗ trợ khách hàng nhiệt tình sẽ giúp bạn điều hướng mọi thử thách và đạt được thành công trong việc nuôi dưỡng cây cối.</p>

            <p>Hãy cùng HatGiongGiaRe.net khám phá một thế giới thú vị, nơi những ý tưởng sáng tạo bắt đầu nảy mầm. Đến với chúng tôi, bạn không chỉ mua hạt giống, bạn đang khởi đầu một hành trình sáng tạo và tạo nên mảng xanh trong không gian sống của mình.</p>',
            'contact'=>'<h2>CÔNG TY TNHH THƯƠNG MẠI DỊCH VỤ LÂM SƠN</h2>
            <p>Mã số thuế: 0316478995</p>
            <p>HotLine/Zalo: 0862.572.752</p>
            <p>Facebook: https://www.facebook.com/hatgionglamson</p>
            <p>Website: hatgionglamson.com</p>
            <p>Email: hatgionglamson@gmail.com</p>

            <p>Văn Phòng: 77D Bàu Cát 8, Phường 11, Quận Tân Bình, TP Hồ Chí Minh</p>
            <p>Kho Hàng: 105/2 Phan Chu Trinh, Phường Lộc Tiến, TP Bảo Lộc</p>',


        ];
    }
}

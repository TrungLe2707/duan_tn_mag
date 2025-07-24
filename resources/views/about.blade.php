@extends('app')

@section('body')
    <div class="about_hero">
        <h1>Giới Thiệu Shop MAG</h1>
    </div>

    <section class="about_sec">
        <h2>Về MAG</h2>
        <p>
            MAG là thương hiệu thời trang được thành lập với mong muốn mang đến cho người Việt những sản phẩm quần áo
            chất lượng, hợp xu hướng và giá cả phải chăng. Chúng tôi hiểu rằng mỗi người đều xứng đáng được mặc đẹp mỗi
            ngày mà không phải lo lắng quá nhiều về chi phí hay sự phù hợp. Vì thế, MAG không ngừng nghiên cứu và phát
            triển để tạo ra những bộ trang phục đáp ứng được nhu cầu thực tế của người tiêu dùng Việt: vừa thời trang,
            vừa tiện dụng và phù hợp với nhiều hoàn cảnh sử dụng khác nhau.
        </p>
        <p>
            Với phương châm "Đơn giản - Thanh lịch - Thoải mái", MAG hướng tới việc xây dựng một phong cách thời trang
            hiện đại nhưng không phô trương, nhẹ nhàng nhưng vẫn đầy cuốn hút. Sự đơn giản chính là điểm bắt đầu cho sự
            tinh tế, và chúng tôi tin rằng vẻ đẹp bền vững luôn đến từ những thiết kế hài hòa, dễ ứng dụng và mang tính
            cá nhân hóa cao.
        </p>
    </section>

    <section class="about_sec">
    <h2>Triết Lý Thiết Kế</h2>
    <div class="philosophy-section">
        <div class="philosophy-card">
            <div class="philosophy-image">
                <img src="https://images.unsplash.com/photo-1551232864-3f0890e580d9?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Minimalism Design">
            </div>
            <h3>Minimalism</h3>
            <p>Là một phong cách trong nghệ thuật, thiết kế, và thậm chí trong lối sống, tập trung vào việc đơn giản hóa
                mọi thứ, giảm thiểu sự phức tạp. Ý tưởng chính là chỉ sử dụng những yếu tố cần thiết và loại bỏ sự dư
                thừa.</p>
        </div>
        <div class="philosophy-card">
            <div class="philosophy-image">
                <img src="https://images.unsplash.com/photo-1554412933-514a83d2f3c8?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Artistic Design">
            </div>
            <h3>Artistic</h3>
            <p>Mang tính nghệ thuật, liên quan đến sáng tạo, thẩm mỹ hoặc các biểu hiện nghệ thuật. Từ này mô tả những
                thứ đẹp mắt, có sự sáng tạo, hoặc thể hiện cảm xúc và suy nghĩ của con người qua hình thức nghệ thuật.</p>
        </div>
        <div class="philosophy-card">
            <div class="philosophy-image">
                <img src="https://images.unsplash.com/photo-1539109136881-3be0616acf4b?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Glamorous Design">
            </div>
            <h3>Glamorous</h3>
            <p>Mô tả sự quyến rũ, sang trọng, và nổi bật. Một cái gì đó "glamorous" thường mang lại cảm giác lôi cuốn,
                đẳng cấp, và có vẻ ngoài rất thu hút, thường là trong bối cảnh thời trang, điện ảnh, hoặc các sự kiện
                lớn.</p>
        </div>
    </div>
</section>


    <section class="about_sec">
        <h2>Lý Do Thành Lập</h2>
        <p>
            Trong thời đại công nghệ phát triển không ngừng, thương mại điện tử đã trở thành xu hướng mua sắm phổ biến,
            đặc biệt trong lĩnh vực thời trang. Việc mua quần áo online ngày càng được nhiều người lựa chọn nhờ sự tiện
            lợi, nhanh chóng và đa dạng về mẫu mã. Tuy nhiên, bên cạnh những lợi ích đó, không ít khách hàng vẫn còn cảm
            thấy băn khoăn, lo lắng khi đặt hàng qua mạng. Họ sợ rằng sản phẩm nhận được không giống hình ảnh quảng cáo,
            chất lượng không đảm bảo hoặc dịch vụ chăm sóc khách hàng thiếu chuyên nghiệp.
        </p>
        <p>
            Chính vì thấu hiểu những lo ngại đó, MAG được ra đời với sứ mệnh giải quyết triệt để những vấn đề mà người
            tiêu dùng đang gặp phải khi mua sắm thời trang online. Chúng tôi mong muốn mang đến một trải nghiệm mua sắm
            dễ dàng, nhanh chóng và thực sự đáng tin cậy cho mọi khách hàng – dù bạn ở thành thị hay nông thôn, dù bạn
            mua sắm lần đầu hay là khách hàng thân thiết lâu năm.
        </p>
    </section>

    <section class="about_sec">
        <h2>Phương Châm Hoạt Động</h2>
        <div class="about_grid">
            <div class="about_card">
                <img src="./img/muc_tieu.png" alt="Mục tiêu">
                <h3>Mục tiêu</h3>
                <p>Tạo nên những bộ sưu tập phù hợp với mọi đối tượng, giúp bạn tự tin trong từng khoảnh khắc.</p>
            </div>
            <div class="about_card">
                <img src="./img/su_menh.jpg" alt="Sứ mệnh">
                <h3>Sứ mệnh</h3>
                <p>Mang thời trang đẹp và tiện ích đến gần hơn với cộng đồng yêu thích phong cách sống hiện đại.</p>
            </div>
            <div class="about_card">
                <img src="./img/tam_nhin.webp" alt="Tầm nhìn">
                <h3>Tầm nhìn</h3>
                <p>Trở thành thương hiệu thời trang online được tin yêu hàng đầu tại Việt Nam.</p>
            </div>
        </div>
    </section>

    <section class="about_sec">
        <h2>Đội Ngũ MAG</h2>
        <div class="about_grid">
            <div class="about_card">
                <img src="./img/manh.png" alt="Văn Mạnh">
                <h3>Văn Mạnh</h3>
                <p>Nhà sáng lập - Với đam mê thời trang và kinh nghiệm trong ngành bán lẻ, Mai là người đặt nền móng cho
                    thương hiệu MAG.</p>
            </div>
            <div class="about_card">
                <img src="./img/trung.png" alt="Trung Lê">
                <h3>Trung Lê</h3>
                <p>Thiết kế chính - Người mang đến những bộ sưu tập thanh lịch và thời thượng, phù hợp với xu hướng mới
                    nhất.</p>
            </div>
            <div class="about_card">
                <img src="./img/nam.png" alt="Phương Nam">
                <h3>Phương Nam</h3>
                <p>Truyền thông & Marketing - Chuyên gia tạo dựng hình ảnh và kết nối khách hàng cùng thương hiệu MAG.</p>
            </div>
        </div>
    </section>
@endsection

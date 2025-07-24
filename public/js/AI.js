        document.addEventListener('DOMContentLoaded', function () {
            const boxAvt = document.querySelector('.avatar'); // Sửa lại cho đúng id
            const boxAi = document.getElementById('box-ai');

            boxAvt.addEventListener('click', function () {
                boxAvt.style.display = 'none';
                boxAi.style.display = 'block';
            });


            // Nếu bạn có nút đóng box chat, thêm đoạn này:
            const closeBtn = document.querySelector('.close-chat');
            if (closeBtn) {
                closeBtn.addEventListener('click', function () {
                    boxAi.style.display = 'none';
                    boxAvt.style.display = 'flex'; // hoặc 'block'
                });
            }
        });
   